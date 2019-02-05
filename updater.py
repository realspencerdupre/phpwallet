#!/usr/local/bin/python3

import subprocess as subp
from os import chdir, listdir
from os.path import join, isfile, realpath, dirname
import getpass
import sys
import MySQLdb
import MySQLdb.cursors
import re
import importlib.util


USERNAME = getpass.getuser()
BASE_PATH = dirname(realpath(__file__))


def run(cmd):
    return subp.run(cmd, stdout=subp.PIPE, stderr=subp.PIPE)


def run2var(cmd):
    out = run(cmd).stdout.decode('utf-8')
    out = '\n'.join(out.split('\n')[:-1])
    return out


def is_ver(s, sep='\.'):
    pattern = 'v\d{2}.\d{2}.\d{2}.\d{2}'.replace('.', sep)
    return re.match(pattern, s)


def get_new_ver_files(loc, sep='\.'):
    output = {}
    for f in listdir(loc):
        fullpath = join(loc, f)
        shortname = is_ver(f, sep=sep)
        if isfile(fullpath) and shortname:
            output[shortname[0].replace(sep, '.')] = (fullpath)
    return output


def get_db_config():
    settings = join(BASE_PATH, 'settings.php')
    with open(settings) as f:
        settings = f.read()
    return {
        'host': re.findall(r'\$db_host = \"(.+?)\"', settings)[0],
        'user': re.findall(r'\$db_user = \"(.+?)\"', settings)[0],
        'pass': re.findall(r'\$db_pass = \"(.+?)\"', settings)[0],
        'name': re.findall(r'\$db_name = \"(.+?)\"', settings)[0],
    }


chdir(BASE_PATH)

db_conf = get_db_config()

# Connect
db = MySQLdb.connect(
    host=db_conf['host'],
    user=db_conf['user'],
    passwd=db_conf['pass'],
    db=db_conf['name'],
    cursorclass=MySQLdb.cursors.DictCursor,
)

cursor = db.cursor()

# Execute SQL select statement
cursor.execute("SELECT * FROM configuration")
config = cursor.fetchone()
curr_ver = config['current_version']

run(['git', 'fetch'])
tags = run2var(['git', 'tag']).split('\n')
tags = list(filter(lambda x: is_ver(x), tags))
tags = list(filter(lambda x: x > curr_ver, tags))
latest_ver = tags[-1]

git_status = run2var(['git', 'status']).split('\n')[0]
is_at_head = latest_ver in git_status

if is_at_head:
    sys.exit()

git_status = run2var(['git', 'status']).split('\n')[0]
git_status = git_status.split()[-1]

UPDS = join(BASE_PATH, 'updates')
updates = get_new_ver_files(UPDS, sep='_')

MIGS = join(BASE_PATH, 'db')
migrations = get_new_ver_files(MIGS, sep='_')


for tag in tags:
    print('Upgrading to', tag, 'from', curr_ver)
    run(['git', 'checkout', tag])
    update = updates.get(tag)
    mod = None
    if update:
        spec = importlib.util.spec_from_file_location('*', update)
        mod = importlib.util.module_from_spec(spec)
        spec.loader.exec_module(mod)
    if mod:
        mod.pre_script(BASE_PATH)
    migration = migrations.get(tag)
    if migration:
        conn = MySQLdb.connect(
            host="localhost",
            user="wallet_user",
            passwd="wallet_password",
            db="wallet",
            cursorclass=MySQLdb.cursors.DictCursor,
        )
        try:
            cur = conn.cursor()
            with open(migration, 'r') as f:
                query = f.read()
            cur.execute(query)
            cur.close()
            conn.commit()
        except Exception as e:
            print('Error upgrading to', tag)
            print(e)
            conn.rollback()
    if mod:
        mod.post_script(BASE_PATH)
    query = 'UPDATE configuration SET current_version = "{}"'
    cursor.execute(query.format(tag))
