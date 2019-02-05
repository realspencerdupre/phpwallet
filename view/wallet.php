<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");
?> '
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?=$fullname?> admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, crypto ico admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Wallet - <?=$fullname?></title>
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
    <link rel="stylesheet" type="text/css" href="/assets/css/pages/wallet.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-compact-menu content-detached-right-sidebar   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="content-detached-right-sidebar">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
      <div class="navbar-wrapper">
        <div class="navbar-header d-md-none">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item d-md-none"><a class="navbar-brand" href="index.php"><img class="brand-logo d-none d-md-block" alt="crypto ico admin logo" src="/assets/images/logo/logo.png"><img class="brand-logo d-sm-block d-md-none" alt="crypto ico admin logo sm" src="/assets/images/logo/logo-sm.png"></a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v">   </i></a></li>
          </ul>
        </div>
        <div class="navbar-container">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a></li>
              <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                <div class="search-input">
                  <input class="input" type="text" placeholder="Explore <?=$fullname?>...">
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav float-right">         
              <li class="dropdown dropdown-language nav-item"> <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-<?php echo $lang['FLAG']; ?>"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                  <a class="dropdown-item" href="index.php?lang=en"><i class="flag-icon flag-icon-gb"></i> English</a>
                  <a class="dropdown-item" href="index.php?lang=zho"><i class="flag-icon flag-icon-cn"></i> 普通話</a>
                  <a class="dropdown-item" href="index.php?lang=spa"><i class="flag-icon flag-icon-es"></i> Español</a>
                  <a class="dropdown-item" href="index.php?lang=hin"><i class="flag-icon flag-icon-in"></i> हिन्दी</a>
                  <a class="dropdown-item" href="index.php?lang=ara"><i class="flag-icon flag-icon-sa"></i> العربية</a>
                  <a class="dropdown-item" href="index.php?lang=por"><i class="flag-icon flag-icon-pt"></i> Português</a>
                  <a class="dropdown-item" href="index.php?lang=rus"><i class="flag-icon flag-icon-ru"></i> Русский</a>
                  <a class="dropdown-item" href="index.php?lang=jpn"><i class="flag-icon flag-icon-jp"></i> 日本語</a>
                  <a class="dropdown-item" href="index.php?lang=deu"><i class="flag-icon flag-icon-de"></i> Deutsch</a>
                  <a class="dropdown-item" href="index.php?lang=vie"><i class="flag-icon flag-icon-vn"></i> Tiếng việt</a>
                  <a class="dropdown-item" href="index.php?lang=kor"><i class="flag-icon flag-icon-kr"></i> 한국어</a>
                  <a class="dropdown-item" href="index.php?lang=fra"><i class="flag-icon flag-icon-fr"></i> Français</a>
                  <a class="dropdown-item" href="index.php?lang=tur"><i class="flag-icon flag-icon-tr"></i> Türkçe</a>
                  <a class="dropdown-item" href="index.php?lang=ita"><i class="flag-icon flag-icon-it"></i> Italiano</a>
                </div>
              </li>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="wallet.php"><i class="ficon icon-wallet"></i></a></li>
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="/assets/images/portrait/small/avatar-s-1.png" alt="avatar"></span><span class="mr-1"><?=$short?><span class="user-name text-bold-700"><?php echo satoshitize($balance); ?></span></span></a>
              <?php include("right-dropdown.php") ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow">
      <div class="main-menu-content"><a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="index.php"><img class="brand-logo" alt="crypto ico admin logo" src="/assets/images/logo/logo.png"/></a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="index.php"><i class="icon-grid"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class=" nav-item"><a href="buy-ico.php"><i class="icon-layers"></i><span class="menu-title" data-i18n="">Buy ICO</span></a>
          </li>
          <li class="active"><a href="wallet.php"><i class="icon-wallet"></i><span class="menu-title" data-i18n="">Wallet</span></a>
          </li>
          <li class=" nav-item"><a href="transactions.php"><i class="icon-shuffle"></i><span class="menu-title" data-i18n="">Transactions</span></a>
          </li>
          <li class=" nav-item"><a href="faq.php"><i class="icon-support"></i><span class="menu-title" data-i18n="">FAQ</span></a>
          </li>
          <li class=" nav-item"><a href="#"><i class="icon-user-following"></i><span class="menu-title" data-i18n="">Account</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="account-profile.php">Profile</a>
              </li>
              <li><a class="menu-item" href="account-login-history.php">Login History</a>
              </li>
              <li class="navigation-divider"></li>
              <li><a class="menu-item" href="#">Misc</a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="account-login.php">Login</a>
                  </li>
                  <li><a class="menu-item" href="account-register.php">Register</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Wallet</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Wallet
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-detached content-left">
          <div class="content-body"><div id="wallet">
    <div class="wallet-table-th d-none d-md-block">
        <div class="row">
            <div class="col-md-6 col-12 py-1">
                <p class="mt-0 text-capitalize">Cryptocurrency</p>
            </div>
            <div class="col-md-2 col-12 py-1 text-center">
                <p class="mt-0 text-capitalize">Available</p>
            </div>
            <div class="col-md-4 col-12 py-1 text-center">
                <p class="mt-0 text-capitalize">Transect</p>
            </div>
        </div>
    </div>
    <!-- BTC -->
    <section class="card pull-up">
        <div class="card-content">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 col-12 py-1">
                            <div class="media">
                                <i class="cc BTC mr-2 font-large-2 warning"></i>
                                <div class="media-body">
                                    <h5 class="mt-0 text-capitalize">Bitcoin</h5>
                                    <p class="text-muted mb-0 font-small-3 wallet-address">0xd38d9eeb5b9617d758cee2c683e1d385637635e9</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <h6>0.019842 BTC</h6>
                            <p class="text-muted mb-0 font-small-3">~ $2650.78</p>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Deposit</a>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ BTC -->
    <!-- ETH -->
    <section class="card pull-up">
        <div class="card-content">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 col-12 py-1">
                            <div class="media">
                                <i class="cc ETH mr-2 font-large-2 blue accent-3"></i>
                                <div class="media-body">
                                    <h5 class="mt-0 text-capitalize">Ethereum</h5>
                                    <p class="text-muted mb-0 font-small-3 wallet-address">0xd38d9eeb5b9617d758cee2c683e1d385637635e9</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <h6>0.6789842 ETH</h6>
                            <p class="text-muted mb-0 font-small-3">~ $650.78</p>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Deposit</a>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ ETH -->
    <!-- TetherUSD -->
    <section class="card pull-up">
        <div class="card-content">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 col-12 py-1">
                            <div class="media">
                                <i class="cc USDT-alt mr-2 font-large-2 teal lighten-2"></i>
                                <div class="media-body">
                                    <h5 class="mt-0 text-capitalize">TetherUSD</h5>
                                    <p class="text-muted mb-0 font-small-3 wallet-address">0xd38d9eeb5b9617d758cee2c683e1d385637635e9</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <h6>0 USDT</h6>
                            <p class="text-muted mb-0 font-small-3">~ $0</p>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Deposit</a>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ TetherUSD -->
    <!-- USD, EUR, other fiat currencies -->
    <section class="card pull-up">
        <div class="card-content">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 col-12 py-1">
                            <div class="media">
                                <i class="la la-dollar mr-2 bg-primary white bg-lighten-2 rounded-circle"></i>
                                <div class="media-body">
                                    <h5 class="mt-0 text-capitalize">USD</h5>
                                    <p class="text-muted mb-0 font-small-3 wallet-address">Fiat currencies</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <h6>1500 USD</h6>
                            <p class="text-muted mb-0 font-small-3">~ $1500</p>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Deposit</a>
                        </div>
                        <div class="col-md-2 col-12 py-1 text-center">
                            <a href="#" class="line-height-3">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ USD, EUR, other fiat currencies -->
</div>
          </div>
        </div>
        <div class="sidebar-detached sidebar-right" ="">
          <div class="sidebar"><div id="wallet-sidebar" class="sidebar-content">
	<div class="row">
		<p class="py-1 text-capitalize col-12">Your balance</p>
	</div>
	<div class="card">
        <div class="card-header">
            <h6 class="card-title text-center">ICO Tokens</h6>            
        </div>
        <div class="card-content collapse show">
            <div class="card-body">

                <div class="text-center row clearfix mb-2">
                	<div class="col-12">
                		<i class="icon-layers font-large-3 bg-warning bg-glow white rounded-circle p-3 d-inline-block"></i>
                	</div>
                </div>
                <h3 class="text-center"><?php echo satoshitize($balance); ?> <?=$short?></h3>
            </div>
            <div class="table-responsive">
                  <table class="table table-de mb-0">                    
                    <tbody>
                      <tr>
                        <td><?=$short?> Token</td>
                        <td><i class="icon-layers"></i> 3,258 <?=$short?></td>
                      </tr>
                      <tr>
                        <td><?=$short?> Referral</td>
                        <td><i class="icon-layers"></i> 200.88 <?=$short?></td>                        
                      </tr>
                      <tr>
                        <td><?=$short?> Price</td>
                        <td><i class="cc BTC-alt"></i> 0.0001 BTC</td>
                      </tr>
                      <tr>
                        <td>Raised BTC</td>
                        <td><i class="cc BTC-alt"></i> 2154 BTC</td>                        
                      </tr>
                      <tr>
                        <td>Raised USD</td>
                        <td><i class="la la-dollar"></i> 4.52 M</td>                        
                      </tr>                      
                    </tbody>
                  </table>
                </div>
        </div>
    </div>
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