<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Network\NetworkFactory;

require __DIR__ . '/../vendor/autoload.php';

$query = $mysqli->query("SELECT * FROM configuration;");
$config = $query->fetch_assoc();
$hdFactory = new HierarchicalKeyFactory();
$xpub = $hdFactory->fromExtended($config['public']);
$invoice = new Invoice($mysqli, $xpub);

if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
    header('Location: buy-ico.php'); die();
}

$query = $mysqli->query("SELECT * FROM invoices WHERE user = '${_SESSION['user_session']}'and confirmed = 0 and cancelled = 0;");
$existing = $query->fetch_assoc();
if ($existing) {
    header("Location: invoice.php?id=".$existing['id']);
    die('pre-existing invoice');
}

$COINMAX = min($config['coinmax'], $client->getBalance($hot_account_main));
if (bccomp($_POST['amount'], $COINMAX) == 1) {
    addMessage("{$_POST['amount']} $short exceeds the buy limit", 'warning');
    header("Location: buy-ico.php");
    die();
}

$amount = bcmul($_POST['amount'], 100000000);

if (bccomp($amount, 0) == 0) {
    addMessage("Amount must be greater than 0", 'warning');
    header("Location: buy-ico.php");
    die();
}

$curr_name = $mysqli->real_escape_string($_POST['currency']);
$currency = Currency::get($mysqli, $curr_name);

$pay_amount = bcmul($amount, $currency->rate);
$success = $invoice->add($amount, $pay_amount, $user_session, "BTC");
if (!$success) {
    addMessage("Purchase order conflicted with another purchase, please try again", 'warning');
    header("Location: buy-ico.php");
    die();
}

// JSON library requires float, seems OK for just typing a string
$client->placehold($user_session, floatval(bcdiv($amount, 100000000, 8)));
$uuid = $invoice->uuid;
if ($success) {
    header("Location: invoice.php?uuid=$uuid"); die();
} else {
    echo var_dump($mysqli);
}


?>