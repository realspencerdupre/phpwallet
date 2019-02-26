<?php
define("IN_WALLET", true);
include_once('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once("../email.php");

$username = $mysqli->real_escape_string(strip_tags($_POST["username"]));
$email = $mysqli->real_escape_string(strip_tags($_POST["email"]));
$password = $mysqli->real_escape_string(strip_tags($_POST["password"]));
$terms = $mysqli->real_escape_string(strip_tags($_POST["terms"]));


if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    header('Location: account-register.php'); die();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addMessage("Invalid email - $email", 'warning');
    header('Location: account-register.php'); die();
}

if (!$terms) {
    addMessage("You must agree to the Terms to register", 'warning');
    header('Location: account-register.php'); die();
}

$user = new User($mysqli);

$result = $user->add($username, $email, $password);
if ($result !== true) {
    addMessage("$result", 'warning');
    header('Location: account-register.php'); die();
}
else {
    // $_SESSION['user_session'] = $username;
    $_SESSION['user_supportpin'] = "Please relogin for Support Key";
    addMessage("$username is now registered. Login to continue", 'success');
    header("Location: account-login.php"); die();
}



header("Location: account-register.php");

?>