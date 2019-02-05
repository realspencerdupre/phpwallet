<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");

$addressList = $client->getAddressList($user_session);
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
    <title>Dashboard -
        <?=$fullname?>
    </title>
    <link rel="apple-touch-icon" href="/assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/pages/timeline.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/pages/dashboard-ico.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    <?php include_once('nav.php'); ?>
    <?php include_once('main-menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"> </div>
            <div class="content-body">
                <?php printMessages($messages);?>
                <!-- ICO Token &  Distribution-->
                <!--/ ICO Token &  Distribution-->
                <!-- Purchase token -->
                <div class="row">
                    <div class="col-12">
                        <h6 class="my-2">Withdraw/Send funds</h6>
                        <div class="card pull-up">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form-horizontal form-purchase-token row" action="process-withdraw.php" method="POST" id="withdrawform">
                                        <input type="hidden" name="action" value="withdraw" />
                                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                        <div class="col-md-2 col-12">
                                            <fieldset class="form-label-group mb-0">
                                                <input type="number" step="0.00000001" class="form-control" id="ico-token" name="amount" required="" autofocus="">
                                                <label for="ico-token">
                                                    <?php echo $lang['WALLET_AMOUNT']; ?>
                                                </label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-1 col-12 text-center"> <span class="la la-arrow-right"></span> </div>
                                        <div class="col-md-4 col-12 mb-1">
                                            <fieldset class="form-label-group mb-0">
                                                <input type="text" class="form-control" id="wallet-address" name="address" required="true" autofocus="">
                                                <label for="wallet-address">
                                                    <?php echo $lang['WALLET_ADDRESS']; ?>
                                                </label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2 col-12 text-center">
                                            <button type="submit" class="btn-gradient-primary">
                                                <?php echo $lang['WALLET_SENDCONF']; ?>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Purchase token -->
                <!-- ICO Token balance & sale progress -->
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h6 class="my-2">Balance</h6>
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <p><strong>Your balance:</strong></p>
                                                <h1><?php echo satoshitize($balance); ?> <?=$short?></h1> </div>
                                            <div class="col-md-3 col-12 text-center text-md-right">
                                                <a href="/view/buy-ico.php">
                                                <button class="btn-gradient-primary mt-2">Buy <?=$short?></button>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-12 text-center text-md-right">
                                                <form action="index.php" method="POST" id="newaddressform">
                                                    <input type="hidden" name="action" value="new_address" />
                                                    <button type="submit" class="btn-gradient-primary mt-2">
                                                        <?php echo $lang['WALLET_NEWADDRESS']; ?> <i class="la la-angle-right"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ ICO Token balance & sale progress -->
                <!-- Recent Transactions -->
                <div class="row">
                    <div id="recent-transactions" class="col-12">
                        <h6 class="my-2">Addresses</h6>
                        <div class="card">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="alist" class="table table-hover table-xl mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Address</th>
                                                <th class="border-top-0">QR code</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach (array_reverse($addressList) as $address) { ?>
                                                <tr>
                                                    <td class="text-truncate">
                                                        <?php echo $address; ?>
                                                    </td>
                                                    <td class="text-truncate"> <a href="<?php echo $server_url;?>qrgen/?address=<?php echo $address;?>">
                            <img src="<?php echo $server_url;?>qrgen/?address=<?php echo $address;?>" alt="QR Code" style="width:42px;height:42px;border:0;">
                            </a> </td>
                                                </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Recent Transactions -->
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
    <script src="/assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/assets/js/scripts/pages/dashboard-ico.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>