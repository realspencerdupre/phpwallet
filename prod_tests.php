#!/usr/bin/php
<?php
chdir(dirname(__FILE__));
define("IN_WALLET", true);
require_once('settings.php');
require_once('jsonRPCClient.php');
require_once('classes/Client.php');

function wait_msg($msg) {
    echo $msg;
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    // if(trim($line) != 'yes'){
    //     echo "ABORTING!\n";
    //     exit;
    // }
}

// Active assert and make it quiet
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

// Create a handler function
function my_assert_handler($file, $line, $code)
{
    echo "<hr>Assertion Failed:
        File '$file'<br />
        Line '$line'<br />
        Code '$code'<br /><hr />";
}

// Set up the callback
assert_options(ASSERT_CALLBACK, 'my_assert_handler');

function my_assert($condition, $success="Success", $fail="Fail") {
    if (!$condition) {
        if ($fail)
            echo 'Failed: ', $fail, "\n";
        die();
    }
    if ($success)
        echo 'Succeeded: ', $success, "\n";
}

//
//
// Actual tests
//
//

$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);

// Test initial hot balances
wait_msg("Move funds to main account, then press any key...");
$main_bal = floatval($client->getBalance($hot_account_main));
$wait_bal = floatval($client->getBalance($hot_account_wait));
my_assert($main_bal > 0, '', 'Main balance not > 0');
my_assert($wait_bal == 0, '', 'Wait balance not 0');
my_assert(!is_null($wait_bal), '', 'Wait balance is null');

// Test hot balances after invoicing
wait_msg("Create a new invoice, then press any key...");
$wait_bal = floatval($client->getBalance($hot_account_wait));
my_assert($wait_bal > 0, '', 'Wait balance <= 0');
my_assert(floatval($client->getBalance($hot_account_main)) < $main_bal, '', 'Main balance is the same as before');
?>