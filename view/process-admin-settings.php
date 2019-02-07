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
    header('Location: admin-settings.php'); die();
}

$coinmax = floatval($_POST["coinmax"]);
if ($coinmax != $config['coinmax']) {
    $mysqli->query("UPDATE configuration SET coinmax = $coinmax;");
    addMessage("Updated maximum buy to $coinmax", 'success');
}

$email_from = $mysqli->real_escape_string($_POST["email_from"]);
if ($email_from != $config['email_from']) {
    $mysqli->query("UPDATE configuration SET email_from = '$email_from';");
    addMessage("Updated sending email to $email_from", 'success');
}

$email_host = $mysqli->real_escape_string($_POST["email_host"]);
if ($email_host != $config['email_host']) {
    $mysqli->query("UPDATE configuration SET email_host = '$email_host';");
    addMessage("Updated SMTP host to $email_host", 'success');
}

$email_pass = $mysqli->real_escape_string($_POST["email_pass"]);
if ($email_pass != $config['email_pass']) {
    $mysqli->query("UPDATE configuration SET email_pass = '$email_pass';");
    addMessage("Updated SMTP password to $email_pass", 'success');
}

$email_port = intval($_POST["email_port"]);
if ($email_port != $config['email_port']) {
    $mysqli->query("UPDATE configuration SET email_port = '$email_port';");
    addMessage("Updated SMTP port to $email_port", 'success');
}

$email_tls = intval($_POST["email_tls"]);
if ($email_tls != $config['email_tls']) {
    $mysqli->query("UPDATE configuration SET email_tls = '$email_tls';");
    addMessage("Updated SMTP tls to $email_tls", 'success');
}

$email_user = $mysqli->real_escape_string($_POST["email_user"]);
if ($email_user != $config['email_user']) {
    $mysqli->query("UPDATE configuration SET email_user = '$email_user';");
    addMessage("Updated SMTP username to $email_user", 'success');
}

$host = $mysqli->real_escape_string($_POST["host"]);
if ($host != $config['host']) {
    $q = "UPDATE configuration SET host = '$host';";
    $mysqli->query($q);
    addMessage("Updated host to $host", 'success');
}

$currencies = $mysqli->query('SELECT * FROM currencies;');
while ($currency = $currencies->fetch_assoc()) {
    $code = $currency['short'];
    $rate = floatval($_POST["currency-rate-$code"]);
    $balance_url = $_POST["currency-balanceurl-$code"];
    $balance_jsonpath = $_POST["currency-balancejsonpath-$code"];
    $required_conf = intval($_POST["currency-requiredconf-$code"]);
    $id = $currency['id'];
    if ($rate != $currency['rate']){
        $mysqli->query("UPDATE currencies SET rate = $rate where id = $id;");
        addMessage("Updated {$currency['fullname']} rate to $rate", 'success');
    }
    if ($balance_url != $currency['balance_url']){
        $mysqli->query("UPDATE currencies SET balance_url = $balance_url where id = $id;");
        addMessage("Updated {$currency['fullname']} balance url to $balance_url", 'success');
    }
    if ($balance_jsonpath != $currency['balance_jsonpath']){
        $mysqli->query("UPDATE currencies SET balance_jsonpath = $balance_jsonpath where id = $id;");
        addMessage("Updated {$currency['fullname']} balance json path to $balance_jsonpath", 'success');
    }
    if ($required_conf != $currency['required_conf']){
        $mysqli->query("UPDATE currencies SET required_conf = $required_conf where id = $id;");
        addMessage("Updated {$currency['fullname']} required conf to $required_conf", 'success');
    }

}

header("Location: admin-settings.php");

?>