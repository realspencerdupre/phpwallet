<?php

if (!$admin) {
    header("Location: account-login.php?next=".$_SERVER['REQUEST_URI']);
}

?>