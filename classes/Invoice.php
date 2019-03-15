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



// Bitcoin::setNetwork(NetworkFactory::bitcoinTestnet());

class Invoice {

	private $mysqli;

	function __construct($mysqli, $xpub, $id=null) {
        $this->mysqli = $mysqli;
        $this->xpub = $xpub;
        if (is_null($id)) {
            $result=$mysqli->query("SHOW TABLE STATUS LIKE 'invoices'");
            $this->id = $result->fetch_assoc()['Auto_increment'];
        };
        $date = date("U");
        $this->uuid = sha1("$date".rand(0, 32000));
	}

	function add($tok_amount, $pay_amount, $user, $currency) {
        $date = date("n/j/Y g:i a");
        $uuid = $this->uuid;
        $query = $this->mysqli->query(
            "INSERT INTO invoices (`id`, `date`, `uuid`, `pay_curr`, `pay_amt`, `tok_amt`, `user`, `pay_addr`) VALUES ('$this->id', '$date', '$uuid', '$currency', '$pay_amount', '$tok_amount', '$user', 'abcdefgh');"
        );
        if (!$query) {
            return $query;
        };
        if (is_null($this->id)) {
            $this->id = $this->mysqli->insert_id;
        }
        $key = $this->xpub->derivePath("44/0/$this->id/0/0");
        $addr = (new PayToPubKeyHashAddress($key->getPublicKey()->getPubKeyHash()))->getAddress();
        $query = $this->mysqli->query(
            "UPDATE invoices SET pay_addr = '$addr' WHERE id = $this->id;"
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
