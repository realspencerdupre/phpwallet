<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php

require __DIR__ . '/../vendor/autoload.php';


class Currency {

    private $mysqli;
    public static $api_options = [
        'btc_block_cypher_testnet' => [
            'name' => 'BTC Blockcypher Testnet',
            'url' => 'https://api.blockcypher.com/v1/btc/test3/addrs/<address>/full?limit=50&confirmations=<confirmations>',
            'jsonpath' => '$.balance',
        ],
        'btc_chainso_testnet' => [
            'name' => 'BTC Chain.so Testnet',
            'url' => 'https://chain.so/api/v2/get_address_balance/BTCTEST/<address>/<confirmations>',
            'jsonpath' => '$.data.confirmed_balance',
        ],
    ];

	function __construct($mysqli) {
        $this->mysqli = $mysqli;
        $this->fullname = NULL;
        $this->short = NULL;
        $this->rate = NULL;
        $this->id = NULL;
	}

	public static function create($mysqli, $fullname, $short) {
        $currency = new Currency($mysqli);
        reset(Currency::$api_options);
        $default_api = key(Currency::$api_options);
        $query = $mysqli->query(
            "INSERT INTO currencies (`fullname`, `short`, `rate`, `required_conf`, `balance_api`) VALUES ('$fullname', '$short', 1, 1, '$default_api');"
        );
        if (!$query)
            return mysqli_error($mysqli);
        $currency->fullname = $fullname;
        $currency->short = $short;
        $currency->id = $mysqli->insert_id;
        return $currency;
    }

	static public function get($mysqli, $fullname) {
        $currency = new Currency($mysqli);
        $query = $currency->mysqli->query(
            "SELECT * FROM currencies where fullname = '$fullname';"
        );
        if (!$query)
            return mysqli_error($currency->$mysqli);
        $obj = $query->fetch_assoc();
        if (is_null($obj)) 
            return NULL;
        $currency->id = $obj['id'];
        $currency->fullname = $obj['fullname'];
        $currency->short = $obj['short'];
        $currency->rate = $obj['rate'];
        $currency->balance_api = Currency::$api_options[$obj['balance_api']];
        $currency->required_conf = $obj['required_conf'];
        return $currency;
    }
    
    function update() {
        $fullname = $this->fullname;
        $short = $this->short;
        $rate = $this->rate;
        $id = $this->id;
        $query = $this->mysqli->query("UPDATE currencies SET fullname = '$fullname', short = '$short', rate = $rate WHERE id = $id;");
        if (!$query) {
            return mysqli_error($this->$mysqli);
        }
    }
}

?>
