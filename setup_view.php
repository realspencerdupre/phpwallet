<?php
ob_start();
$txpage = 1;
$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

$messages = parseMessages($_SESSION['messages']);
$_SESSION['messages'] = '';

if (!empty($_GET['txpage'])) {
    $txpage = $_GET['txpage'];
}
if (!empty($_SESSION['user_session'])) {
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
    }

    $user_session = $_SESSION['user_session'];
    $admin = false;
    if (!empty($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1){
        $admin = true;
    }

    $error = array(
        'type' => "none",
        'message' => ""
    );
    $admin_action = false;
    if ($admin && !empty($_GET['a'])) {
        $admin_action = $_GET['a'];
    }

    if (!$admin_action) {
        $noresbal = $client->getBalance($user_session);
        $resbalance = $noresbal - $reserve;
        if ($resbalance < 0) {
            $balance = $noresbal; //Don't show the user a negitive balance if they have no coins with us
        }
        else {
            $balance = $resbalance;
        }

        if (!empty($_POST['action'])) {
            switch ($_POST['action']) {
            case "new_address":
                $newaddr = $client->getnewaddress($user_session);
                addMessage("Your new address is $newaddr", 'success');
                header("Location: index.php");
                break;

            case "password":
                $user = new User($mysqli);
                if (empty($_POST['oldpassword']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
                    $error['type'] = "password";
                    $error['message'] = "You have to fill all the fields";
                }
                elseif ($_POST['token'] != $_SESSION['token']) {
                    $error['type'] = "password";
                    $error['message'] = "Tokens do not match";
                    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
                }
                else {
                    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
                    $result = $user->updatePassword($user_session, $_POST['oldpassword'], $_POST['newpassword'], $_POST['confirmpassword']);
                    if ($result === true) {
                        header("Location: index.php");
                    }
                    else {
                        $error['type'] = "password";
                        $error['message'] = $result;
                    }
                }

                break;

            case "logout":
                session_destroy();
                header("Location: index.php");
                break;

            case "support":
                $error['message'] = "Please contact support via email at $support";
                echo "Support Key: ";
                echo $_SESSION['user_supportpin'];
                break;

            case "authgen":
                $user = new User($mysqli);
                $secret = $user->createSecret();
                $gen = $user->enableauth();
                echo $gen;
                break;

            case "disauth":
                $user = new User($mysqli);
                $disauth = $user->disauth();
                echo $disauth;
                break;
            }
        }

    }
    else {
        $user = new User($mysqli);
        switch ($admin_action) {
        case "info":
            if (!empty($_GET['i'])) {
                $info = $user->adminGetUserInfo($_GET['i']);
                if (!empty($info)) {
                    $info['balance'] = $client->getBalance($info['username']);
                    if (!empty($_POST['action'])) {
                        switch ($_POST['action']) {
                        case "new_address":
                            $client->getnewaddress($info['username']);
                            header("Location: index.php?a=info&i=" . $info['id']);
                            break;

                        case "password":
                            if ((is_numeric($_GET['i'])) && (!empty($_POST['password']))) {
                                $result = $user->adminUpdatePassword($_GET['i'], $_POST['password']);
                                if ($result === true) {
                                    $error['type'] = "password";
                                    $error['message'] = "Password changed successfully.";
                                    header("Location: index.php?a=info&i=" . $info['id']);
                                }
                                else {
                                    $error['type'] = "password";
                                    $error['message'] = $result;
                                }
                            }
                            else {
                                $error['type'] = "password";
                                $error['message'] = "Something went wrong (at least one field is empty).";
                            }

                            break;
                        }
                    }

                    unset($info['password']);
                }
            }

            $middle_page = "view/admin_info.php";
            break;

        default:
            if ((!empty($_GET['m'])) && (!empty($_GET['i']))) {
                switch ($_GET['m']) {
                case "deadmin":
                    $user->adminDeprivilegeAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;

                case "admin":
                    $user->adminPrivilegeAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;

                case "unlock":
                    $user->adminUnlockAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;

                case "lock":
                    $user->adminLockAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;

                case "del":
                    $user->adminDeleteAccount($_GET['i']);
                    header("Location: index.php?a=home");
                    break;
                }
            }

            $userList = $user->adminGetUserList();

            $middle_page = "view/admin_home.php";
            break;
        }
    }
}
else {
    $error = array(
        'type' => "none",
        'message' => ""
    );
    if (!empty($_POST['action'])) {
        $user = new User($mysqli);
        switch ($_POST['action']) {
        case "login":
            $result = $user->logIn($_POST['username'], $_POST['password'], $_POST['auth']);
            $username = $_POST['username'];
            $datetime = date("c");
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $q = "INSERT INTO logins (`user`, `datetime`, `user_agent`, `ip`)VALUES ('$username', '$datetime', '$agent', '$ip');";
            $mysqli->query($q);
            $login_id = $mysqli->insert_id;

            if (!is_array($result)) {
                addMessage("Login details were incorrect", 'warning');
                $error['type'] = "login";
                $error['message'] = $result;
            }
            else {
                $q = "UPDATE logins SET success = 1 WHERE id = $login_id;";
                $mysqli->query($q);
                $_SESSION['user_session'] = $result['username'];
                $_SESSION['user_admin'] = $result['admin'];
                $_SESSION['user_supportpin'] = $result['supportpin'];
                $_SESSION['user_id'] = $result['id'];
                $next = $_POST['next'];
                header("Location: $next");
                die('force redirect');
            }

            break;

        case "register":
            $result = $user->add($_POST['username'], $_POST['password'], $_POST['confirmPassword']);
            if ($result !== true) {
                $error['type'] = "register";
                $error['message'] = $result;
            }
            else {
                $username = $mysqli->real_escape_string(strip_tags($_POST['username']));
                $_SESSION['user_session'] = $username;
                $_SESSION['user_supportpin'] = "Please relogin for Support Key";
                header("Location: index.php");
            }

            break;
        }
    }
    header("Location: account-login.php?next=".$_SERVER['REQUEST_URI']);

}
?>