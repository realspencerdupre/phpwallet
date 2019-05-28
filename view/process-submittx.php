<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");


$dir = str_replace('/view', '', dirname(__FILE__));
echo "$dir\n";
$escaped_tx = escapeshellarg($_GET['tx']);

// Use Pieter Wuille's node because why not?
$output = `$dir/bitcoin-submittx mainnet '$escaped_tx' echo $(dig +short seed.bitcoin.sipa.be A | tail -1)`;
echo "<pre>$output</pre>";

?>