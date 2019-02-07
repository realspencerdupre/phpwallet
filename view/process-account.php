<?php
define("IN_WALLET", true);
include_once('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once("../setup_view.php");
include_once("../email.php");

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

$query = $mysqli->query("SELECT * FROM users WHERE username = '{$_SESSION['user_session']}';");
$user = $query->fetch_assoc();
$userid = $user['id'];

$email = $mysqli->real_escape_string($_POST["email"]);
$oldpass = $mysqli->real_escape_string($_POST["oldpassword"]);
$newpass = $mysqli->real_escape_string($_POST["newpassword"]);
$conpass = $mysqli->real_escape_string($_POST["conpassword"]);

if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    $tok1 = $_SESSION['token'];
    $tok2 = $_POST['token'];
    addMessage("Invalid CSRF token", 'warning');
    header('Location: account-profile.php'); die();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addMessage("Invalid email - $email", 'warning');
    header('Location: account-profile.php'); die();
}

if ($email != $user['email']) {
    $mysqli->query("UPDATE users SET email = '$email' where id = $userid;");
    addMessage("Updated email to $email", 'success');
    $subject = "$short - Confirmation Email";
    $code = createConf($user['username'], $email);
    $body = file_get_contents("email-confirmation.php");
    $body = str_replace('$user', $user['username'], $body);
    $body = str_replace('$code', $code, $body);
    $body = str_replace('$host', $config['host'], $body);
    
    sendEmail([$email], $subject, $body);
    addMessage("Sent confirmation email", 'success');
}

if (($oldpass or $newpass or $conpass) and !($oldpass and $newpass and $conpass)) {
    addMessage("Must provide old, new, and confirmed password", 'warning');
    header('Location: account-profile.php'); die();
}


header("Location: account-profile.php");

?>