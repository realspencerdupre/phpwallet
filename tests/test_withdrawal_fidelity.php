#!/usr/bin/php
<?php
require_once('utils.php');


$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);

$pre_bal = $client->getBalance($hot_account_main);
$expected = $pre_bal - 5;
wait_msg("Do withdrawal of 5 COIN from main account, then press Enter...");
$bal = $client->getBalance($hot_account_main);

my_assert($bal == $expected, '', "Balance is unexpected $bal, not $expected");
echo "Test passed\n";
?>