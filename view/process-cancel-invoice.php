<?php
define("IN_WALLET", true);
include_once('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once("../setup_view.php");
include_once("../require_admin.php");
use Peekmo\JsonPath\JsonStore;

if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    header('Location: admin-wallet.php'); die();
}

$inv_id = intval($_POST['id']);
$invoice = $mysqli->query("SELECT cancelled, uuid, pay_curr, pay_addr, tok_amt FROM invoices WHERE id = $inv_id;");
if (is_null($invoice)) {
    addMessage("Invalid invoice", 'warning');
    header('Location: admin-wallet.php'); die();
}
$invoice = $invoice->fetch_assoc();

if ($invoice['cancelled']) {
    addMessage("Invoice already cancelled", 'warning');
    header('Location: admin-wallet.php'); die();
}

$currency_code = $invoice['pay_curr'];
$currency = $mysqli->query("SELECT fullname FROM currencies WHERE short = '$currency_code';")->fetch_assoc();
$currency = Currency::get($mysqli, $currency['fullname']);
$jsonurl = str_replace('<address>', $invoice['pay_addr'], $currency->balance_api['address_url']);

// Always use 0 conf, we don't want any incoming funds
$jsonurl = str_replace('<confirmations>', 0, $jsonurl);

$json = file_get_contents($jsonurl);
$store = new JsonStore($json);
$bal = $store->get($currency->balance_api['jsonpath'])[0] * 100000000;

if ($bal != 0) {
    addMessage("Can't cancel invoice with positive balance", 'warning');
    header('Location: admin-wallet.php'); die();
}

$tx = $client->release_hold($user_session, floatval(bcdiv($invoice['tok_amt'], 100000000)));
if ($tx) {
    $result = $mysqli->query("UPDATE invoices SET cancelled = 1 WHERE id = $inv_id;");
}
if (is_null($result)) {
    addMessage("Invoice cancellation failed", 'warning');
    header('Location: admin-wallet.php'); die();
}

addMessage("Successfully cancelled invoice", 'success');
header("Location: admin-wallet.php"); die();

?>