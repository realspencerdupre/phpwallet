#!/usr/local/bin/python3

import subprocess as subp
from os import chdir, listdir
from os.path import join, isfile, realpath, dirname
import getpass
import MySQLdb
import MySQLdb.cursors
import re


def run(cmd):
    return subp.run(cmd, stdout=subp.PIPE, stderr=subp.PIPE)


def run2var(cmd):
    out = run(cmd).stdout.decode('utf-8')
    out = '\n'.join(out.split('\n')[:-1])
    return out


def get_db_config(base_path, filename='settings.php'):
    settings = join(base_path, filename)
    with open(settings) as f:
        settings = f.read()
    return {
        'host': re.findall(r'\$db_host = \"(.+?)\"', settings)[0],
        'user': re.findall(r'\$db_user = \"(.+?)\"', settings)[0],
        'pass': re.findall(r'\$db_pass = \"(.+?)\"', settings)[0],
        'name': re.findall(r'\$db_name = \"(.+?)\"', settings)[0],
    }


def get_db(base_path):
    db_conf = get_db_config(base_path)
    return MySQLdb.connect(
        host=db_conf['host'],
        user=db_conf['user'],
        passwd=db_conf['pass'],
        db=db_conf['name'],
        cursorclass=MySQLdb.cursors.DictCursor,
    )


USERNAME = getpass.getuser()
BASE_PATH = dirname(realpath(__file__))

chdir(BASE_PATH)

db = get_db(BASE_PATH)

cursor = db.cursor()
cursor.execute("SELECT * FROM configuration;")
config = cursor.fetchone()
db.close()
currM = int(config['current_migration'])

run(['git', 'pull'])

dbp = join(BASE_PATH, 'db')
files = sorted([f for f in listdir(dbp) if re.match(r'\d\d\d\d_.*\.sql', f)])
print('Current migration', f'{currM:04}')
did_migrate = False

for f in files:
    if int(f[:4]) > currM:
        did_migrate = True
        print('Applying migration', f)
        conn = get_db(BASE_PATH)
        fullf = join(dbp, f)
        try:
            cur = conn.cursor()
            with open(fullf, 'r') as mf:
                query = mf.read()
            cur.execute(query)
            cur.close()
            conn.commit()
        except Exception as e:
            print('Error upgrading to', f)
            print(e)
            conn.rollback()
        currM = int(f[:4])

db = get_db(BASE_PATH)
cursor = db.cursor()

if not did_migrate:
    print('No new migrations found')
else:
    cursor.execute(
        f"UPDATE configuration SET current_migration = '{currM:04}';")
cursor.close()
db.commit()
