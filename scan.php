#!/usr/bin/php
<?php
chdir(dirname(__FILE__));

define("IN_WALLET", true);
include 'common.php';
include 'settings.php';

$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);

require __DIR__ . '/vendor/autoload.php';
use Peekmo\JsonPath\JsonStore;

$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);

$jsonurl = "https://api.blockcypher.com/v1/btc/test3/addrs/msAnoTvAYhVjdpvXGDHHSKPAXjtHCB5jx8/full?limit=50&confirmations=1";
$json = file_get_contents($jsonurl);


function scanInvoices() {
    global $mysqli;
    $query = 'SELECT * from invoices WHERE swept = 0;';
    $invoices = $mysqli->query($query);
    while ($row = $invoices->fetch_assoc()) {
        global $required_confirmations;
        global $client;
        $btcaddr = $row['pay_addr'];
        print "Processing invoice $btcaddr ... ";
        $id = $row['id'];
        $currency_code = $row['pay_curr'];
        $currency = $mysqli->query("SELECT * FROM currencies WHERE short = '$currency_code';")->fetch_assoc();
        print $currency['short'];
        $jsonurl = str_replace('<address>', $btcaddr, $currency['balance_url']);
        $jsonurl = str_replace('<confirmations>', $currency['required_conf'], $jsonurl);
        $json = file_get_contents($jsonurl);
        time_nanosleep(0, intdiv(1000000000, 3));

        $store = new JsonStore($json);
        $bal = $store->get($currency['balance_jsonpath'])[0];
        $required = $row['pay_amt'];
        print " balance = $bal\n";
        // if ($json == null) {
        //     die("API source down\n");
        // }
        // if ($row['confirmed'] == 0 and $bal >= $required) {
        //     $query = 'UPDATE invoices SET confirmed = 1 WHERE id = '.$id.';';
        //     $result = $mysqli->query($query);
        //     $rate = $row['tok_amt'] / $row['pay_amt'];
        //     $receive = $bal / 100000000 * $rate;
        //     $client->credit($row['user'], $receive);
            
        //     print "credited \n";
        // }
        // else if ($row['confirmed'] == 1 and $bal == 0) {
        //     $query = 'UPDATE invoices SET swept = 1 WHERE id = '.$id.';';
        //     $result = $mysqli->query($query);
        //     print "swept \n";
        // }
        // else if ($row['confirmed']) {
        //     print "confirmed, unswept\n";
        // } else {
        //     print "unconfirmed \n";
        // }
    }
}

scanInvoices();

?>