<?php
define("IN_WALLET", true);
include '../common.php';

$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);
include "../setup_view.php";
include "../require_admin.php";

use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Buffertools\Buffer;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Crypto\EcAdapter\Impl\PhpEcc\Key\PublicKey;
use kornrunner\Keccak;

require __DIR__ . '/../vendor/autoload.php';

$btcnetwork = Bitcoin::getNetwork();

if (!$config['private'])
header('Location: generate-seed.php');

function pubkeyToEtherAddress($pubkey) {
    if (in_array('getHex', get_class_methods($pubkey))) {
        $adapter = $pubkey->getPoint()->getAdapter();
        $xp = $adapter->decHex(''.$pubkey->getPoint()->getX());
        $yp = $adapter->decHex(''.$pubkey->getPoint()->getY());
        $pubkey = $xp.$yp;
    }
    if (strlen($pubkey) < 100) {
        $pubkey = hex2bin(substr($pubkey, 2));
    } else {
        $pubkey = hex2bin($pubkey);
    }
    $hash = Keccak::hash($pubkey, 256);
    $raw_address = substr($hash, 24);

    $checksum = strtolower($raw_address);
    $checksum = Keccak::hash($checksum, 256);
    $address = '';
    for ($i = 0; $i < strlen($raw_address); $i++){
        if (hexdec($checksum[$i]) > 7) {
            $address .= strtoupper($raw_address[$i]);
        }
        else {
            $address .= $raw_address[$i];
        }
    }

    return '0x' . $address;
}

$all = $_GET['all'];
if ($all)
	$invoices = $mysqli->query('SELECT * from invoices;');
else
	$invoices = $mysqli->query('SELECT * from invoices where swept = 0;');

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="<?php echo $fullname
?> admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
	<meta name="keywords" content="admin template, crypto ico admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
	<meta name="author" content="PIXINVENT">
	<title>Wallet -
		<?php echo $fullname ?>
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
	<link rel="stylesheet" type="text/css" href="/assets/css/pages/wallet.css">
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
					<h3 class="content-header-title mb-0 d-inline-block">Admin Wallet</h3>
					<div class="row breadcrumbs-top d-inline-block">
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/view/admin-settings.php">Admin Settings</a></li>
								<li class="breadcrumb-item active">Admin Wallet</li>
								<li class="breadcrumb-item"><a href="/view/admin-test-email.php">Admin Test Email</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-detached content-left">
				<div class="content-body col-md-12">
					<div class="row">
						<div class="col-md-8">
							<h6 class="my-2">Invoices</h6>
						</div>
						<div class="col-md-4">
							<?php if ($all) {?>
							<a href="admin-wallet.php">Hide Swept</a>
							<?php } else {?>
							<a href="?all=1">Show Swept</a>
							<?php }?>
						</div>
					</div>
					<div id="wallet">
						<div class="wallet-table-th d-none d-md-block">
							<div class="row">
								<div class="col-md-4 col-12 py-1">
									<p class="mt-0 text-capitalize">Invoice</p>
								</div>
								<div class="col-md-2 col-12 py-1 text-center">
									<p class="mt-0 text-capitalize">Balance</p>
								</div>
								<div class="col-md-4 col-12 py-1 text-center">
									<p class="mt-0 text-capitalize">Sweep</p>
								</div>
							</div>
						</div>
						<?php 
	while ($row = $invoices->fetch_assoc()) {
		$apiurl = "https://api.blockcypher.com/v1/btc/test3/addrs/".$row['pay_addr']."/full?limit=50&confirmations=$required_confirmations";
		$json = json_decode(file_get_contents($apiurl));
?>
							<!-- BTC -->
							<section class="card">
								<div class="card-content">
									<div class="card-body">
										<div class="col-12">
											<div class="row">
												<div class="col-md-4 col-12 py-1">
													<div class="media">
														<div class="media-body">
															<h5 class="mt-0 text-capitalize"><?php echo $row['user'];?></h5>
															<p class="text-muted mb-0 font-small-3 wallet-address">
																<?php
								echo substr($row['pay_addr'], 0, 20), '...';
								echo "<p><a href=\"$apiurl\">api data</a></p>";
							?> </p>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-12 py-1 text-center">
													<p>Pay <strong><?php echo satoshitize($row['pay_amt'] / 100000000) . ' ' . $row['pay_curr']; ?></strong></p>
													<p>Get <strong><?php echo satoshitize($row['tok_amt'] / 100000000) . ' ' . $short; ?></strong></p>
													<hr>
													<?php if (!$row['swept']) {?>
														<p>Balance <strong><?php echo satoshitize($json->balance / 100000000) . ' ' . $row['pay_curr']; ?></strong></p>
														<p>Bal. (0 conf) <strong><?php echo satoshitize($json->unconfirmed_balance / 100000000) . ' ' . $row['pay_curr']; ?></strong></p>
														<p class="text-muted mb-0 font-small-3">
															<!-- Exchange converted value -->
														</p>
														<?php } else {?>
															<p><strong>Swept</strong></p>
															<?php } ?>
												</div>
												<div class="col-md-5 col-12 py-1 text-center">
													<?php if (!$row['swept']) {?>
														<input id="sweep_<?php echo $row['pay_addr']; ?>" placeholder="address...">
														<button onclick="sweepAddress(this)" class="btn-primary btn line-height-3" data-address="<?php echo $row['pay_addr']; ?>" data-index="<?php echo $row['id']; ?>">Sweep</button>
														<?php } ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-12 py-1">
													<p id="hex_<?php echo $row['pay_addr']; ?>"></p>
													<p>
														<a id="txhref_<?php echo $row['pay_addr']; ?>" href="#"></a>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!--/ BTC -->
							<?php 
	}
?>
					</div>
					<div class="row">
						<h6 class="my-2">Hot wallet info (<?=$short?>)</h6>
						<div class="col-12">
							<div class="card">
								<div class="card-content collapse show">
									<div class="card-body">
										<p>Balance:
				<?php
					$accTotal = 0;
					$q = $mysqli->query('SELECT * FROM users WHERE username != "piWallet";');
					$i = $q->fetch_assoc();
					while($i) {
					$accTotal += $client->getBalance($i['username']);
					$i = $q->fetch_assoc();
					}
					$total = $client->getTotalBalance();
					echo $total;
				?>
										</p>
										<p>Held by users:
											<?php echo $accTotal; ?>
										</p>
										<p>Surplus:
											<?php echo $total - $accTotal; ?>
										</p>
										<p>Admin address:
											<?php echo $client->getAddress('piWallet');?>
										</p>
									</div>
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
		<p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; <?php
echo date("Y"); ?> Blockstarter, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span></p>
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
	function finishSweep(data, priv, obj) {
		const txb = new bitcoin.TransactionBuilder(bitcoin.networks.testnet)
		fees = 0;
		for(tx of data.txrefs) {
			txb.addInput(tx.tx_hash, tx.tx_output_n)
				// fees += 876015;
		}
		to = document.getElementById('sweep_' + obj.dataset.address);
		txb.addOutput(to.value, data.balance - fees);
		for(const x of Array(data.txrefs.length).keys()) {
			txb.sign(x, priv);
		}
		size = (txb.build().toHex().length / 2) + 50;
		fees = size * <?=$satoshis_per_byte?>;
		console.log("tx fee", fees, 'size', size);
		txb.__tx.outs[0].value -= fees;
		console.log('txb', txb);
		for(inp of txb.__inputs) {
			inp.signatures = [];
		}
		for(const x of Array(data.txrefs.length).keys()) {
			txb.sign(x, priv);
		}
		conf_message = "Are you sure you want to send " + ((data.balance - fees) / 100000000) + " BTC to " + to.value + "?";
		if(confirm(conf_message)) {
			built = txb.build();
			hex = document.getElementById('hex_' + obj.dataset.address);
			hex.innerHTML = built.toHex();
			txurl = "https://live.blockcypher.com/btc-testnet/tx/" + built.getId() + "/";
			txhref = document.getElementById('txhref_' + obj.dataset.address);
			txhref.href = txurl;
			txhref.innerHTML = built.getId();
			to.value = '';
		}
	}

	function sweepAddress(obj) {
		addr = obj.dataset.address;
		index = obj.dataset.index;
		passw = prompt('Enter wallet passphrase', '');
		decrypted = CryptoJS.AES.decrypt(encryptedSeed, passw).toString(CryptoJS.enc.Utf8)
		seed = bip32.fromBase58(decrypted, bitcoin.networks.testnet);
		path = 'm/44/0/' + index + '/0/0';
		priv = seed.derivePath(path);
		address = bitcoin.payments.p2pkh({
			pubkey: priv.publicKey,
			network: bitcoin.networks.testnet
		}).address;
		url = "https://api.blockcypher.com/v1/btc/test3/addrs/" + address + "?limit=50&unspentOnly=1";
		$.getJSON(url, function(data) {
			finishSweep(data, priv, obj)
		});
	};
	var encryptedSeed = "<?php echo pack("
	H * ", $config['private']);?>";
	</script>
	<!-- END PAGE LEVEL JS-->
</body>

</html>
