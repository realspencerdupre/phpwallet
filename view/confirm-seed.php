<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
include "../require_admin.php";

if (empty($_POST)) {
    header("Location: verify-seed.php");
}

$encryptedSeed = implode(unpack("H*", $_POST['encryptedSeed']));;
$masterPubKey = $_POST['masterPubKey'];
$mysqli->query("UPDATE configuration SET private=\"$encryptedSeed\", public=\"$masterPubKey\" WHERE id = 1;");

header("Location: admin-wallet.php");

?>