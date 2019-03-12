<?php
define("IN_WALLET", true);
include ('../common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include ("../setup_view.php");

$transactionList = $client->getTransactionList($user_session, $txpage);

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
	<title>Transactions -
		<?=$fullname?>
	</title>
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
	<link rel="stylesheet" type="text/css" href="/assets/css/pages/transactions.css">
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
					<h3 class="content-header-title mb-0 d-inline-block">Transactions </h3>
					<div class="row breadcrumbs-top d-inline-block">
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a> </li>
								<li class="breadcrumb-item active">Transactions </li>
							</ol>
						</div>
					</div>
				</div>
				<div class=" col-md-4">
					<li class="breadcrumb breadcrumb-item"><a href="https://blockstarter.net/exp/<?=$fullname?>/">Block Explorer</a> </li>
				</div>
			</div>
			<div class="content-body">
				<div id="transactions">
					<div class="transactions-table-th d-none d-md-block">
						<div class="col-12">
							<div class="row px-1">
								<div class="col-md-2 col-12 py-1">
									<p class="mb-0">Date</p>
								</div>
								<div class="col-md-2 col-12 py-1">
									<p class="mb-0">Type</p>
								</div>
								<div class="col-md-2 col-12 py-1">
									<p class="mb-0">Amount</p>
								</div>
								<div class="col-md-2 col-12 py-1">
									<p class="mb-0">Status</p>
								</div>
								<div class="col-md-2 col-12 py-1">
									<p class="mb-0">Explorer</p>
								</div>
							</div>
						</div>
					</div>
					<div class="transactions-table-tbody">
						<?php
							foreach(array_reverse($transactionList) as $tx) {
								// floatval ok for non-write ops
								$amount = floatval($tx['amount']);
								if($amount < 0) {
									$tx_type = ['Sent', 'danger'];
								} else {
									$tx_type = ['Received', 'success'];
								}
								if($tx['confirmations'] > 5) {
									$tx_status = 'Confirmed';
								} elseif($tx['category']=='move') {
									$tx_status = 'Confirmed';
							        } else {
									$tx_status = 'Pending';
								}
						?>
							<section class="card pull-up">
								<div class="card-content">
	<div class="card-body">
		<div class="col-12">
			<div class="row">
				<div class="col-md-2 col-12 py-1">
					<p class="mb-0"><span class="d-inline-block d-md-none text-bold-700">Date: </span>
						<?php echo date('n/j/Y h:i a', $tx['time']) ?>
					</p>
				</div>
				<div class="col-md-2 col-12 py-1"> <span class="d-inline-block d-md-none text-bold-700">Type: </span> <span class="d-inline-block d-md-none text-bold-700">Type: </span>
					<a href="#" class="mb-0 btn-sm btn btn-outline-<?=$tx_type[1]?> round">
						<?=$tx_type[0]?>
					</a>
				</div>
				<div class="col-md-2 col-12 py-1">
					<p class="mb-0"><span class="d-inline-block d-md-none text-bold-700">Amount: </span>
						<?=abs($tx['amount']); ?>
							<?=$short?>
					</p>
				</div>
				<div class="col-md-2 col-12 py-1">
					<p class="mb-0"><span class="d-inline-block d-md-none text-bold-700">Status: </span>
						<?=$tx_status?>
					</p>
				</div>
				<div class="col-md-2 col-12 py-1">
					<p class="mb-0"><span class="d-inline-block d-md-none text-bold-700">Details: </span>
						<?php if ($tx['txid']) {?>
							<a href="https://blockstarter.net/exp/<?=$fullname?>/tx/<?php echo $tx['txid'];?>/">Details</a>
                        <?php } elseif($amount < 0 and $tx['category'] == 'move') { 
                            $len = strlen($tx['otheraccount']);
                            $purchaser = substr($tx['otheraccount'], 7, $len-8);
                        ?>
							<strong>Purchased by user</strong>
						<?php } else { ?>
							<strong>Purchased off-chain</strong>
					  	<?php } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
								</div>
							</section>
						<?php } ?>
						<nav aria-label="Page navigation">
<ul class="pagination justify-content-center pagination-separate pagination-flat">
	<?php if ($txpage > 3) { ?>
		<li class="page-item">
			<a class="page-link" href="transactions.php?txpage=1" aria-label="Previous"> <span aria-hidden="true">First</span> <span class="sr-only">First</span> </a>
		</li>
	<?php } ?>
	<li class="page-item">
		<a class="page-link" href="transactions.php?txpage=<?=$txpage > 1 ? $txpage - 1 : 1?>" aria-label="Previous"> <span aria-hidden="true">« Prev</span> <span class="sr-only">Previous</span> </a>
	</li>
	<?php
		if ($txpage > 3) {
			$pagerange = range($txpage - 2, $txpage + 2);
		} else {
			$pagerange = range(1, 5);
		}
		foreach ($pagerange as $p) {
	?>
		<li class="page-item <?php if ($p == $txpage) echo 'active';?>"><a class="page-link" href="transactions.php?txpage=<?=$p?>"><?=$p?></a></li>
	<?php } ?>
	<li class="page-item">
		<a class="page-link" href="transactions.php?txpage=<?= $txpage+1 ?>" aria-label="Next"> <span aria-hidden="true">Next »</span> <span class="sr-only">Next</span> </a>
	</li>
</ul>
						</nav>
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