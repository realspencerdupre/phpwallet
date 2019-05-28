<?php
define("IN_WALLET", true);
include_once('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once("../setup_view.php");
include_once("../email.php");

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

$email = $mysqli->real_escape_string($_POST["email"]);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addMessage("Invalid email - $email", 'warning');
    header('Location: forgot-password.php'); die();
}

$query = $mysqli->query("SELECT * FROM users WHERE email = '$email';");
$user = $query->fetch_assoc();
$userid = $user['id'];

if ($email) {
    $subject = "$short - Confirmation Email";
    $code = createConf($user['username'], $email, 'reset');
    $body = file_get_contents("email-reset.php");
    $body = str_replace('$user', $user['username'], $body);
    $body = str_replace('$code', $code, $body);
    $body = str_replace('$host', $config['host'], $body);
    
    sendEmail([$email], $subject, $body);
    addMessage("Sent confirmation email", 'success');
}
else {
    header("Location: forgot-password.php"); die();
}

header("Location: forgot-landing.php");

?>