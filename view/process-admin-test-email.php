<?php
define("IN_WALLET", true);
include_once('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once("../setup_view.php");
include_once("../require_admin.php");
include_once("../email.php");

if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    header('Location: admin-test-email.php'); die();
}

$to = $mysqli->real_escape_string($_POST["to"]);
$subject = $mysqli->real_escape_string($_POST["subject"]);
$body = $mysqli->real_escape_string($_POST["body"]);
$body = str_replace('\r\n', '<br>', $body);
sendEmail([$to], $subject, $body);
addMessage("Your message was sent to $to", 'success');


header("Location: admin-test-email.php");

?>