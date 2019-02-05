<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Buffertools\Buffer;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Crypto\EcAdapter\Impl\PhpEcc\Key\PublicKey;
use BitWasp\Bitcoin\Network\NetworkFactory;
use kornrunner\Keccak;

require __DIR__ . '/../vendor/autoload.php';



Bitcoin::setNetwork(NetworkFactory::bitcoinTestnet());

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 'On');
class Invoice {

	private $mysqli;

	function __construct($mysqli, $xpub) {
        $this->mysqli = $mysqli;
        $this->xpub = $xpub;
        $this->id = NULL;
        $date = date("U");
        $this->uuid = sha1("$date".rand(0, 32000));
	}

	function add($tok_amount, $pay_amount, $user, $currency) {
        $date = date("n/j/Y g:i a");
        $uuid = $this->uuid;
        $query = $this->mysqli->query(
            "INSERT INTO invoices (`date`, `uuid`, `pay_curr`, `pay_amt`, `tok_amt`, `user`, `pay_addr`) VALUES ('$date', '$uuid', '$currency', '$pay_amount', '$tok_amount', '$user', 'abcdefgh');"
        );
        if (!$query) {
            return mysqli_error($this->$mysqli);
        }
        $id = $this->mysqli->insert_id;
        $this->id = $id;
        $key = $this->xpub->derivePath("44/0/".$id."/0/0");
        $addr = (new PayToPubKeyHashAddress($key->getPublicKey()->getPubKeyHash()))->getAddress();
        $query = $this->mysqli->query(
            'UPDATE invoices SET pay_addr = "'.$addr.'" WHERE id = '.$id.';'
        );
        if ($query)
        {
            return true;
        } else {
            return $query;
        }
	}
}

?>
