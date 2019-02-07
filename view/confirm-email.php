<?php
define("IN_WALLET", true);
include_once('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include_once("../setup_view.php");
include_once("../require_admin.php");
include_once("../email.php");

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

$query = $mysqli->query("SELECT * FROM users WHERE username = '{$_SESSION['user_session']}';");
$user = $query->fetch_assoc();

$code = $_GET['code'];
$q = "SELECT * FROM confirmations WHERE code = '$code' and confirmed IS NULL;";
$confirm = $mysqli->query($q)->fetch_assoc();

$id = $confirm['id'];
$username = $confirm['user'];
$mysqli->query("UPDATE users SET email_conf = $id where username = $username;");
$mysqli->query("UPDATE confirmations SET confirmed = 1 where code = '$code';");


header("Location: account-profile.php");

?>