<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

$query = $mysqli->query("SELECT * FROM invoices WHERE user = '${_SESSION['user_session']}'and confirmed = 0 and cancelled = 0;");
$existing = $query->fetch_assoc();

$COINMAX = $config['coinmax'];
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
    <title>Buy -
        <?=$fullname?>
    </title>
    <link rel="apple-touch-icon" href="/assets/images/ico/apple-icon-120.png">
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

<body class="vertical-layout vertical-compact-menu content-detached-right-sidebar   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="content-detached-right-sidebar">
<?php include_once('nav.php'); ?>
<?php include_once('main-menu.php'); ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Buy <?=$short?></h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a> </li>
                            <li class="breadcrumb-item active">Buy <?=$short?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached content-left">
            <div class="content-body">
                <?php
                    printMessages($messages);
                    $currencies = $mysqli->query('SELECT * FROM currencies;')->fetch_all(MYSQLI_ASSOC);
                    foreach ($currencies as $currency) {
                ?>
                <section class="card">
                    <div class="card-content">
                    <div class="card-body">
                    <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 col-xl-2 col-12 d-none d-md-block">
                            <div class="crypto-circle rounded-circle"> <i class="cc <?=$currency['short']?>-alt"></i> </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-5 col-xl-6 col-12">
                            <p><strong><?=$short?>  Deposited After 1 Confirmation</strong></p>
                            <h1>Buy with <?=$currency['fullname']?></h1> </div>
                        <div class="col-md-4 col-xl-4 col-12 d-none d-md-block text-right">
                            <?php if (!$existing) {?>
                                <button type="button" class="btn-gradient-primary mt-2" data-toggle="modal" data-target="#purchase<?=$currency['short']?>ModalLabel">Buy <i class="la la-angle-right"></i></button>
                            <?php } else {?>
                                <br>
                                <br> <a href="/view/invoice.php?uuid=<?=$existing['uuid']?>">Pending Invoice</a>
                            <?php }?>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </section>
                <!-- Purchase with <?=$currency['short']?> Modal -->
                <div class="modal fade" id="purchase<?=$currency['short']?>ModalLabel" tabindex="-1" role="dialog" aria-labelledby="purchase<?=$currency['short']?>ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="purchaseModalLabel">Buy with <?=$currency['fullname']?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal mt-2 mx-2" method="POST" action="process-buy.php">
                                    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                                    <input type="hidden" name="currency" value="<?=$currency['fullname']?>">
                                    <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-2 label-control" for="projectinput1"><?=$currency['short']?></label>
                                                <fieldset class="col-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="0" aria-describedby="basic-addon4" disabled id="buy<?=$currency['short']?>" data-currency="<?=$currency['short']?>">
                                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon4"><i class="cc <?=$currency['short']?>-alt"></i></span></div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <fieldset class="col-12">
                                                <p class="mb-0 text-center font-medium-5">=</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-2 label-control" for="projectinput2">
                                                    <?=$short?>
                                                </label>
                                                <fieldset class="col-10">
                                                    <div class="input-group">
                                                        <input name="amount" type="text" class="form-control" value="0" aria-describedby="basic-addon4" id="buyLocal<?=$currency['short']?>" onkeyup="onlyNumbers(this);populate(this);" data-target="buy<?=$currency['short']?>">
                                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon4"><i class="icon-layers"></i></span> </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-9"></div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group row">
                                                <button type="submit" class="btn-gradient-primary mt-2">Buy <i class="la la-angle-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                                <div class="alert alert-danger">
                                <p>Please ensure you send enough <?=$currency['fullname']?> to fulfill your invoice and any transaction fees or you will not receive the purchased <?=$fullname?>. Over payments will be forfeited. We cannot offer refunds at this time.</p>
                                </div>
                                <p class="font-italic mx-1 mb-2">The calculator uses the effective <?=$short?> price, which is based on the price <?=$currency['rate']?> <?=$short?> = 1.0 <?=$currency['short']?>.</p>
                                <h6 class="mx-1">4 step guide</h6>
                                <ol>
                                    <li>Calculate how many tokens you want to buy.</li>
                                    <li>Copy/Scan the displayed address</li>
                                    <li>Send your <?=$currency['short']?> to that address. You may send it right from your exchange.</li>
                                    <li>Upon transaction confirmation, you will see
                                        <?=$short?> tokens in your wallet balance.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Purchase with <?=$currency['short']?> Modal -->
                <?php }?>
            </div>
        </div>
        <div class="sidebar-detached sidebar-right"="">
            <div class="sidebar">
                <div class="sidebar-content">
                    <!-- token sale progress -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title text-center">Calculator</h6> </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <script>
                                    </script>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <fieldset class="col-12">
                                                <div class="input-group">
                                                    <input id="calcBTC" type="text" class="form-control" placeholder="BTC" aria-describedby="basic-addon4" onkeyup="onlyNumbers(this);populate(this, fromLocal=false);" data-target="calcLocal" data-currency="BTC">
                                                    <div class="input-group-append"> <span class="input-group-text" id="basic-addon4"><i class="cc BTC-alt"></i></span> </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="form-group row">
                                            <fieldset class="col-12">
                                                <p class="mb-0">=</p>
                                            </fieldset>
                                        </div>
                                        <div class="form-group row">
                                            <fieldset class="col-12">
                                                <div class="input-group">
                                                    <input id="calcLocal" type="text" class="form-control" placeholder="<?=$short?>" aria-describedby="basic-addon4" onkeyup="onlyNumbers(this);populate(this);" data-target="calcBTC">
                                                    <div class="input-group-append"> <span class="input-group-text" id="basic-addon4"><?=$short?></span> </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ token sale progress -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<footer class="footer footer-static footer-transparent">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; <?php echo date("Y"); ?> Blockstarter, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted
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
<script src="/assets/js/util.js"></script>
<script>
    currJSON = <?php echo json_encode($currencies);?>;
    currencies = {};
    for (var c in currJSON) {
        currencies[currJSON[c].short] = currJSON[c];
    }
    function populate(obj, fromLocal=true) {
        val = obj.value;
        target = document.getElementById(obj.dataset.target);
        var result = 0;
        if (fromLocal) {
            rate = currencies[target.dataset.currency].rate;
            result = val * rate
        } else {
            rate = currencies[obj.dataset.currency].rate;
            result = val / rate
        }
        target.value = result
    }
</script>
<!-- END PAGE LEVEL JS-->
</body>

</html>
