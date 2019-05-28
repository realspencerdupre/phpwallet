<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
include ("../admin_required.php");

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

if ($_POST['token'] == $_SESSION['token']) {
    $_SESSION['token'] = sha1('@s%a$l£t#'.rand(0, 32000));
} else {
    addMessage("Invalid CSRF token", 'warning');
    header('Location: admin-terms-register.php'); die();
}

$terms_register = $mysqli->real_escape_string($_POST["terms_register"]);
if ($terms_register != $config['terms_register']) {
    $q = "UPDATE configuration SET terms_register = '$terms_register';";
    $mysqli->query($q);
    addMessage("Updated terms_register to $terms_register", 'success');
}

header("Location: admin-terms-register.php");

?>