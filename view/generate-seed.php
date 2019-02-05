<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
include "../require_admin.php"

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
    <title>Generating seed -
        <?=$fullname?>
    </title>
    <link rel="apple-touch-icon" href="/assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/pages/buy-ico.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-compact-menu content-detached-right-sidebar   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="content-detached-right-sidebar">
    <?php include_once('nav.php'); ?>
    <?php include_once('main-menu.php'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Generate Seed</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a> </li>
                                <li class="breadcrumb-item active">Generate Seed </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block"> </div>
            </div>
            <div class="content-detached content-left">
                <div class="content-body">
                    <!-- <?=$short?> -->
                    <section class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3 col-xl-2 col-12 d-none d-md-block">
                                            <div class="crypto-circle rounded-circle"> </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br> </div>
                                        <div class="col-md-9 col-xl-10 col-12">
                                            <p><strong><?=$invoice['pay_addr']?></strong></p>
                                            <h3>Write down these words:</h3>
                                            <hr>
                                            <p><strong id="seedDisplay"></strong></p>
                                            <hr>
                                            <p>The sentence above can be used to recover your coins, should you lose your private key.</p>
                                            <br>
                                            <p>Enter your password:
                                                <input type="password" id="passwordInput">
                                            </p>
                                            <p>Your master key is encrypted on your browser. It is never stored in this site's database.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 col-xl-9 col-12"></div>
                                        <div class="col-md-4 col-xl-3 col-12">
                                            <form action="verify-seed.php" method="POST" onsubmit="encryptSeed();">
                                                <input type="hidden" id="encryptedSeed" name="encryptedSeed">
                                                <input type="hidden" id="masterPubKey" name="masterPubKey">
                                                <div class="form-group row">
                                                    <button type="submit" class="btn-gradient-primary mt-2">continue <i class="la la-angle-right"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="sidebar-detached sidebar-right"="">
                <div class="sidebar">
                    <div class="sidebar-content"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer footer-static footer-transparent">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright
            &copy;
            <?php echo date("Y"); ?> Blockstarter, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted
            & Made with <i class="ft-heart pink"></i></span></p>
    </footer>
    <!-- BEGIN VENDOR JS-->
    <script src="/assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/assets/js/bundle.js"></script>
    <script src="/assets/js/aes.js"></script>
    <script>
        var words = bip39.generateMnemonic();
        var seed = bip39.mnemonicToSeed(words);
        inter = bip32.fromSeed(seed);
        inter.network = bitcoin.networks.testnet;
        var masterKey = inter.toBase58();
        var masterPubKey = inter.neutered().toBase58();
        seedDisplay = document.getElementById('seedDisplay');
        seedDisplay.innerHTML = words;
        var passwordInput = document.getElementById('passwordInput');
        var encryptedSeed = document.getElementById('encryptedSeed');
        var pubInput = document.getElementById('masterPubKey');
        pubInput.value = masterPubKey;

        function encryptSeed() {
            var password = passwordInput.value;
            var ciphertext = CryptoJS.AES.encrypt(masterKey, password).toString();
            encryptedSeed.value = ciphertext;
            return true;
        }
    </script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>
