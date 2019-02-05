<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
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
    <title>FAQ -
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
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">FAQ</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a> </li>
                                <li class="breadcrumb-item active">FAQ </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-10 col-12  order-2">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div id="accordion" class="collapse-icon accordion-icon-rotate left">
                                    <div class="card">
                                        <div class="card-header" id="heading11"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11" href="#">How can I purchase project tokens?</a> </div>
                                        <div id="collapse11" class="collapse show" aria-labelledby="heading11" data-parent="#accordion">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading12"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12" href="#">How can I create a crypto-wallet?</a> </div>
                                        <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading13"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13" href="#">What are these addresses for?</a> </div>
                                        <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordion">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading14"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14" href="#">When will I receive purchased tokens?</a> </div>
                                        <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordion">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading15"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15" href="#">When should I do the KYC procedure?</a> </div>
                                        <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordion">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div id="accordion1" class="collapse-icon accordion-icon-rotate left">
                                    <div class="card">
                                        <div class="card-header" id="heading23"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse23" aria-expanded="false" aria-controls="collapse23" href="#">When will I see purchased tokens at my personal account?</a> </div>
                                        <div id="collapse23" class="collapse show" aria-labelledby="heading23" data-parent="#accordion1">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading24"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse24" aria-expanded="false" aria-controls="collapse24" href="#">When should I do the KYC procedure?</a> </div>
                                        <div id="collapse24" class="collapse" aria-labelledby="heading24" data-parent="#accordion1">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading25"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse25" aria-expanded="false" aria-controls="collapse25" href="#">How can I purchase project tokens?</a> </div>
                                        <div id="collapse25" class="collapse" aria-labelledby="heading25" data-parent="#accordion1">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading21"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse21" aria-expanded="false" aria-controls="collapse21" href="#">How can I create a crypto-wallet?</a> </div>
                                        <div id="collapse21" class="collapse" aria-labelledby="heading21" data-parent="#accordion1">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading22"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse22" aria-expanded="false" aria-controls="collapse22" href="#">When will I receive purchased tokens?</a> </div>
                                        <div id="collapse22" class="collapse" aria-labelledby="heading22" data-parent="#accordion1">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div id="accordion2" class="collapse-icon accordion-icon-rotate left">
                                    <div class="card">
                                        <div class="card-header" id="heading34"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse34" aria-expanded="false" aria-controls="collapse34" href="#">When will I receive purchased tokens?</a> </div>
                                        <div id="collapse34" class="collapse show" aria-labelledby="heading34" data-parent="#accordion2">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading35"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse35" aria-expanded="false" aria-controls="collapse35" href="#">When should I do the KYC procedure?</a> </div>
                                        <div id="collapse35" class="collapse" aria-labelledby="heading35" data-parent="#accordion2">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading31"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse31" aria-expanded="false" aria-controls="collapse31" href="#">What are these addresses for?</a> </div>
                                        <div id="collapse31" class="collapse" aria-labelledby="heading31" data-parent="#accordion2">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading32"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse32" aria-expanded="false" aria-controls="collapse32" href="#">How can I create a crypto-wallet?</a> </div>
                                        <div id="collapse32" class="collapse" aria-labelledby="heading32" data-parent="#accordion2">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading33"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse33" aria-expanded="false" aria-controls="collapse33" href="#">What are these addresses for?</a> </div>
                                        <div id="collapse33" class="collapse" aria-labelledby="heading33" data-parent="#accordion2">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div id="accordion3" class="collapse-icon accordion-icon-rotate left">
                                    <div class="card">
                                        <div class="card-header" id="heading42"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse42" aria-expanded="false" aria-controls="collapse42" href="#">How can I create a crypto-wallet?</a> </div>
                                        <div id="collapse42" class="collapse show" aria-labelledby="heading42" data-parent="#accordion3">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading43"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse43" aria-expanded="false" aria-controls="collapse43" href="#">When should I do the KYC procedure?</a> </div>
                                        <div id="collapse43" class="collapse" aria-labelledby="heading43" data-parent="#accordion3">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading41"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse41" aria-expanded="false" aria-controls="collapse41" href="#">How can I purchase project tokens?</a> </div>
                                        <div id="collapse41" class="collapse" aria-labelledby="heading41" data-parent="#accordion3">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading44"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse44" aria-expanded="false" aria-controls="collapse44" href="#">When will I receive purchased tokens?</a> </div>
                                        <div id="collapse44" class="collapse" aria-labelledby="heading44" data-parent="#accordion3">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="heading45"> <a class="card-title lead collapsed" data-toggle="collapse" data-target="#collapse45" aria-expanded="false" aria-controls="collapse45" href="#">What are these addresses for?</a> </div>
                                        <div id="collapse45" class="collapse" aria-labelledby="heading45" data-parent="#accordion3">
                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 order-1">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">General</a> <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Payments</a> <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Withdraw</a> <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Other</a> </div>
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
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

</html>
