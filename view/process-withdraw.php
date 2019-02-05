<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once('../setup_view.php');


if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
    header('Location: index.php'); die();
}

if (!WITHDRAWALS_ENABLED) {
    addMessage("Withdrawals are temporarily disabled", 'warning');
}
elseif (empty($_POST['address']) || empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
    addMessage("You have to fill all the fields", 'warning');
}
elseif ($_POST['amount'] > $balance) {
    addMessage("Withdrawal amount exceeds your wallet balance", 'warning');
    header("Location: index.php");
}
else {
    $withdraw_message = $client->withdraw($user_session, $_POST['address'], (float)$_POST['amount']);
    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
    addMessage("Your withdrawal was successful", 'success');
}

header("Location: index.php");

?>