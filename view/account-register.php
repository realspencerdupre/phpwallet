<?php
define("IN_WALLET", true);
include ('../common.php');

if (!empty($_SESSION['user_session'])) {
    header("Location: index.php");
}

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = sha1('@s%a$l£t#' . rand(0, 32000));
}

$messages = parseMessages($_SESSION['messages']);
$_SESSION['messages'] = '';
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
    <title>Account Register - <?=$fullname?></title>
    <link rel="apple-touch-icon" href="/assets/images/ico/apple-icon-120.png">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/pages/account-register.css">
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
    <meta name="msapplication-square310x310logo" content="/assets/images/logo/logo.png" />  </head>
  <body class="vertical-layout vertical-compact-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
    <?php printMessages($messages); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section id="account-register" class="flexbox-container">    
    <div class="col-12 d-flex align-items-center justify-content-center">
        <!-- image -->
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0 text-center d-none d-md-block">
            <div class="border-grey border-lighten-3 m-0 box-shadow-0 card-account-left height-500">
                <img src="/assets/images/logo/logo.png" class="card-account-img width-200" alt="card-account-img">
            </div>
        </div>
        <!-- login form -->
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0">
            <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right height-500">                
                <div class="card-content">                    
                    <div class="card-body login-p-3">
                        <p class="text-center h5 text-capitalize">Started with <?=$fullname?>!</p>
                        <p class="mb-3 text-center">Create your account</p>
                        <form class="form-horizontal form-signin" action="process-register.php" method="POST">
                            <input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
                            <fieldset class="form-label-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" required="" autofocus="true">
                                <label for="username">Username</label>
                            </fieldset>
                            <fieldset class="form-label-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Your Email" required="">
                                <label for="email">Email address</label>
                            </fieldset>
                            <fieldset class="form-label-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required="">
                                <label for="user-password">Password</label>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-12 text-center text-sm-left">
                                    <fieldset>
                                        <input type="checkbox" id="terms" name="terms" class="chk-remember">
                                        <label for="terms"> I agree to <?=$fullname?>'s </label>
                                        <a href="#" data-toggle="modal" data-target="#termsModal">terms</a>
                                    </fieldset>
<!-- Purchase with BTC Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel">Terms and Conditions</h5>
            </div>
            <div class="modal-body">
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec commodo magna ut urna efficitur, ac eleifend lectus rhoncus. Cras ut mollis libero, vel ultrices sem. Duis porta, neque id porta porttitor, elit ex sollicitudin quam, nec porttitor libero lorem vel arcu. Sed vitae nisl consectetur libero porttitor rhoncus sit amet ut libero. Praesent sit amet gravida turpis. Suspendisse consequat pulvinar odio mollis iaculis. Nullam nisi nunc, congue id nisl at, rhoncus vestibulum dolor. Sed interdum odio in lacus facilisis, in semper quam varius. Donec tempor gravida nisi non porttitor. Fusce pretium molestie ligula, a laoreet ligula semper eu. Praesent quis dignissim ante. Donec sodales feugiat ex at suscipit. Donec arcu ex, suscipit ac neque porta, iaculis sagittis justo. Mauris molestie tincidunt eros, ac volutpat elit rutrum condimentum. Sed consectetur efficitur volutpat.</p>

                <p>Sed quis efficitur nulla, et porttitor tellus. Nunc hendrerit massa in ipsum pulvinar, et fringilla sem euismod. Etiam at dui urna. Vivamus nec elementum quam. Donec ut posuere enim. Proin eu lectus sit amet nibh feugiat gravida. Donec blandit, sapien quis molestie pretium, dolor sapien sollicitudin eros, non euismod massa nulla ut urna. Fusce lectus nulla, rutrum a nunc quis, porta fringilla tortor. Etiam pharetra condimentum elit, ut sagittis ex eleifend et. Sed accumsan tellus sit amet nunc molestie tempor. Mauris dolor orci, mattis non lacus finibus, efficitur feugiat ipsum. Aliquam venenatis tortor a mattis pretium. Mauris vel massa ac velit semper pretium. Vivamus blandit ex in vehicula ultrices.</p>

<p> Suspendisse pellentesque bibendum purus, at fringilla odio luctus at. Nulla convallis, neque in imperdiet lobortis, lectus urna egestas dolor, et accumsan urna risus eget ante. Aliquam consectetur odio at enim elementum, sit amet posuere eros dictum. Nam sed ex augue. Pellentesque eros metus, vehicula sit amet posuere quis, feugiat eget mauris. Mauris lacinia enim urna, vel tempus tellus ullamcorper in. Donec semper velit diam. Maecenas mattis nunc eget tellus aliquet, at ornare tortor maximus. Vivamus pretium purus vitae dui tincidunt malesuada. Fusce sed commodo eros, non volutpat dui. Sed congue non nisi at rutrum. Aliquam eu tortor erat. Vestibulum suscipit urna in risus luctus, condimentum hendrerit mauris volutpat.
</p>
            </div>
        </div>
    </div>
</div>
<!--/ Purchase with BTC Modal -->
                                </div>                                
                            </div>
                            <button type="submit" class="btn-gradient-primary btn-block my-1">Sign Up</button>
                            <p class="text-center"><a href="account-login.php" class="card-link">Log In</a></p>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>    
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="/assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="/assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="/assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>