<?php

$server_url = "/";  // ENTER WEBSITE URL ALONG WITH A TRAILING SLASH

$db_host = "localhost";
$db_user = "walletuser";
$db_pass = "{mysql_pass}";
$db_name = "wallet";

$rpc_host = "127.0.0.1";
$rpc_port = "{rpcport}";
$rpc_user = "{rpcuser}";
$rpc_pass = "{rpcpass}";

$fullname = "{fullname}"; //Coin Name (Bitcoin)
$short = "{shortname}"; //Coin Short (BTC)
$blockchain_tx_url = "http://blockchain.info/tx/"; //Blockchain Url
$support = "support@yourwebsite.com"; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = ""; //Donation Address

$reserve = "0"; //This fee acts as a reserve. The users balance will display as the balance in the daemon minus the reserve. We don't reccomend setting this more than the Fee the daemon charges.

$required_confirmations = 1;
$satoshis_per_byte = 30;

$pay_currencies = [
    [
        'fullname' => 'Bitcoin',
        'shortname' => 'BTC',
    ],
];

$hot_account_main = 'piWallet';
$hot_account_wait = 'piWallet_wait';

?>
