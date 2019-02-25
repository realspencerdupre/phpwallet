<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");

$query = $mysqli->query("SELECT * FROM users WHERE username = '${_SESSION['user_session']}';");
$user = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?=$fullname?> admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, crypto ico admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Account Profile -
        <?=$fullname?>
    </title>
    <link rel="apple-touch-icon" href="/assets/images/ico/apple-icon-120.png">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/forms/toggle/switchery.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/pages/account-profile.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/assets/images/logo/logo.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/assets/images/logo/logo.png" />
    <link rel="icon" type="image/png" href="/assets/images/logo/logo.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="/assets/images/logo/logo.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="/assets/images/logo/logo.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/assets/images/logo/logo.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="/assets/images/logo/logo.png" sizes="128x128" />
    <meta name="application-name" content="<?=$fullname?> Wallet"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="/assets/images/logo/logo.png" />
    <meta name="msapplication-square70x70logo" content="/assets/images/logo/logo.png" />
    <meta name="msapplication-square150x150logo" content="/assets/images/logo/logo.png" />
    <meta name="msapplication-wide310x150logo" content="/assets/images/logo/logo.png" />
    <meta name="msapplication-square310x310logo" content="/assets/images/logo/logo.png" /></head>

<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    <?php include_once('nav.php'); ?>
    <?php include_once('main-menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Account Profile</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a> </li>
                                <li class="breadcrumb-item active">Account Profile </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <?php printMessages($messages);?>
                <div class="row">
                <div class="col-12 col-md-8">
                <!-- User Profile -->
                <section class="card">
                <div class="card-content">
                <div class="card-body">
                <div class="col-12">
                <div class="row">
                    <div class="col-md-2 col-12"> <img src="/assets/images/portrait/medium/avatar-m-1.png" class="rounded-circle height-100" alt="Card image" /> </div>
                    <div class="col-md-10 col-12">
                        <div class="row">
                            <?php
                                $_SESSION['user_session'];
                                $un = $user['username'];
                                $recent_login = $mysqli->query("select * from logins where user = '$un' order by -id limit 1;")->fetch_assoc();
                                $login_date = $recent_login['datetime'];
                                $datetime = strtotime($login_date);
                                function get_day_name($raw) {
                                    $date = date('d/m/Y', $raw);
                                    if($date == date('d/m/Y')) {
                                      return 'Today';
                                    } 
                                    else if($date == date('d/m/Y',new DateTime() - (24 * 60 * 60))) {
                                      return 'Yesterday';
                                    }
                                    return date('m-d-Y', $raw);
                                }
                                $date = get_day_name($datetime);
                                $time = date("g:i a", $datetime);
                                $login_ip = $recent_login['ip'];
                            ?>
                            <div class="col-12 col-md-4">
                                <p class="text-bold-700 text-uppercase mb-0">Last login</p>
                                <p class="mb-0"><?=$time?>, <?=$date?></p>
                            </div>
                            <div class="col-12 col-md-4">
                                <p class="text-bold-700 text-uppercase mb-0">IP</p>
                                <p class="mb-0"><?=$login_ip?></p>
                            </div>
                        </div>
                        <hr/>
                        <form class="form-horizontal form-user-profile mt-2" action="process-account.php" method="POST">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <div class="row">
                                <div class="col-6">
                                    <p>Email address:</p>
                        <?php
                            $confirm = $mysqli->query("SELECT * FROM confirmations WHERE user = '$un' ORDER BY -id LIMIT 1;")->fetch_assoc();
                            if (is_null($confirm['confirmed']) == 1) {
                                echo '<p class="danger">Unconfirmed</p>';
                            } else {
                                echo '<p class="success">Confirmed</p>';
                            }
                        ?>
                                </div>
                                <div class="col-6">
                                    <fieldset class="form-label-group">
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email'];?>" required="" autofocus="">
                                        <label for="email">Email</label>
                                    </fieldset>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    Change password:
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <fieldset class="form-label-group">
                                        <input type="password" class="form-control" id="old-password" placeholder="Enter Password" autofocus="" name="oldpassword">
                                        <label for="old-password">Old password</label>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <fieldset class="form-label-group">
                                        <input type="password" class="form-control" id="new-password" placeholder="Enter Password" autofocus="" name="newpassword">
                                        <label for="new-password">New password</label>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <fieldset class="form-label-group">
                                        <input type="confirmpassword" class="form-control" id="confirm-password" placeholder="Enter Password" autofocus="" name="conpassword">
                                        <label for="confirm-password">Confirm password</label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn-gradient-primary my-1">Save</button>
                            </div>
                        </form>
                        <h5 class="mt-3">Security</h5>
                        <hr/>
                        <div class="row">
                            <div class="col-9">
                                <a href="/view/account-login-history.php">Login history</a><br><br>
                            </div>
                            <div class="col-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <p>Two-factor authorization</p>
                            </div>
                            <div class="col-3">
                                <input type="checkbox" id="switcherySize2" class="switchery" data-size="sm" checked/> </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <p>Login notification</p>
                            </div>
                            <div class="col-3">
                                <input type="checkbox" id="switcherySize2" class="switchery" data-size="sm" /> </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </section>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer footer-static footer-transparent">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; <?php echo date("Y"); ?> Blockstarter, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span></p>
    </footer>
    <!-- BEGIN VENDOR JS-->
    <script src="/assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="/assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/assets/js/scripts/forms/account-profile.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>