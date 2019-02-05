<?php
    define("IN_WALLET", true);
    include ('../common.php');
    // die('WE ARE HERE!!!!');
    session_destroy();
    header("Location: account-login.php");
?>