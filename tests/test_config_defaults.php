#!/usr/bin/php
<?php
require_once('utils.php');


$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);

$config = $mysqli->query("SELECT * FROM configuration;")->fetch_assoc();
my_assert(!is_null($config['coinmax']), '', 'coinmax is null');

$currs = $mysqli->query("SELECT * FROM currencies;");
while ($c = $currs->fetch_assoc()) {
    my_assert(!is_null($c['rate']), '', "${c['short']} rate unset");
    my_assert(!is_null($c['balance_url']), '', "${c['short']} balance_url unset");
    my_assert(!is_null($c['balance_jsonpath']), '', "${c['short']} balance_jsonpath unset");
    my_assert(!is_null($c['required_conf']), '', "${c['short']} required_conf unset");
}


echo "Test passed\n";
?>