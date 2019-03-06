<?php
chdir(dirname(__FILE__));
define("IN_WALLET", true);
require_once("../settings.php");
require_once('../jsonRPCClient.php');
require_once('../classes/Client.php');

function wait_msg($msg) {
    echo $msg;
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    // if(trim($line) != 'yes'){
    //     echo "ABORTING!\n";
    //     exit;
    // }
}

function my_assert($condition, $success="Success", $fail="Fail") {
    if (!$condition) {
        if ($fail)
            echo 'Failed: ', $fail, "\n";
        die();
    }
    if ($success)
        echo 'Succeeded: ', $success, "\n";
}

?>