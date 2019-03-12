#!/usr/bin/php
<?php
require_once('utils.php');
require_once('../classes/Invoice.php');
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Network\NetworkFactory;
require __DIR__ . '/../vendor/autoload.php';

$xpub = 'tpubD6NzVbkrYhZ4Wt66VVtbt1hUBegLHMbdXnYG1qGX5bMHgFuJ3FTpiUU6y6k5WwNjBf9tNxHjAvwGCEp7enE9iKrD4mh7QCbegpzQ9uBJ4DU';
$hdFactory = new HierarchicalKeyFactory();
$xpub = $hdFactory->fromExtended($xpub);

$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);

$inv1 = new Invoice($mysqli, $xpub);
$inv2 = new Invoice($mysqli, $xpub);
my_assert(!is_null($inv1->id), '', 'Invoice 1 id is null');
my_assert(!is_null($inv2->id), '', 'Invoice 2 id is null');

$success1 = $inv1->add(999, 999, 'piWallet', "BTC");
$success2 = $inv2->add(999, 999, 'piWallet', "BTC");

my_assert($success1, '', 'Adding invoice 1 failed');
my_assert(!$success2, '', "Adding invoice 2 failed");

$mysqli->query("DELETE FROM invoices WHERE id = $inv1->id;");
echo "Test passed\n";
?>