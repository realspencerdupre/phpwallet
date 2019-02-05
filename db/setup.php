#!/usr/bin/php
<?php
chdir(dirname(__FILE__));

define("IN_WALLET", true);
include(dirname(__DIR__).'/classes/Client.php');
include(dirname(__DIR__).'/classes/Currency.php');
include(dirname(__DIR__).'/settings.php');

$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);

require dirname(__DIR__).'/vendor/autoload.php';

foreach ($pay_currencies as $currency) {
    if (is_null(Currency::get($mysqli, $currency['fullname']))) {
        echo "Added currency " . $currency['fullname'] . "\n";
        Currency::create($mysqli, $currency['fullname'], $currency['shortname']);
    }
}

?>