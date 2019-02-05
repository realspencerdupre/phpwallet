<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php

require __DIR__ . '/../vendor/autoload.php';


class Currency {

	private $mysqli;

	function __construct($mysqli) {
        $this->mysqli = $mysqli;
        $this->fullname = NULL;
        $this->short = NULL;
        $this->rate = NULL;
        $this->id = NULL;
	}

	public static function create($mysqli, $fullname, $short) {
        $currency = new Currency($mysqli);
        $query = $mysqli->query(
            "INSERT INTO currencies (`fullname`, `short`) VALUES ('$fullname', '$short');"
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
