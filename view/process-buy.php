<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Network\NetworkFactory;

require __DIR__ . '/../vendor/autoload.php';


if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
    header('Location: buy-ico.php'); die();
}

$hdFactory = new HierarchicalKeyFactory();

$query = $mysqli->query("SELECT * FROM invoices WHERE user = '${_SESSION['user_session']}'and confirmed = 0;");
$existing = $query->fetch_assoc();
if ($existing) {
    header("Location: invoice.php?id=".$existing['id']);
    die('pre-existing invoice');
}

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();
$xpub = $hdFactory->fromExtended($config['public']);

$COINMAX = min($config['coinmax'], $client->getBalance('piWallet'));
if (floatval($_POST["amount"]) > $COINMAX) {
    addMessage("{$_POST['amount']} $short is more than the maximum buy of $COINMAX", 'warning');
    header("Location: buy-ico.php");
    die();
}

$amount = intval(floatval($_POST["amount"]) * 100000000);

if ($amount == 0) {
    addMessage("Amount must be greater than 0", 'warning');
    header("Location: buy-ico.php");
    die();
}

$curr_name = $mysqli->real_escape_string($_POST['currency']);
$currency = Currency::get($mysqli, $curr_name);

$pay_amount = intval($amount * $currency->rate);
$invoice = new Invoice($mysqli, $xpub);
$success = $invoice->add($amount, $pay_amount, $user_session, "BTC");
$client->placehold($user_session, floatval($_POST["amount"]));
$uuid = $invoice->uuid;
if ($success) {
    header("Location: invoice.php?uuid=$uuid");
}


?>