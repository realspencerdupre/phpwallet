<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<?php
//To enable developer mode (no need for an RPC server, replace this file with the snipet at https://gist.github.com/d3e148deb5969c0e4b60 

require_once "../settings.php";

class Client {
	private $uri;
	public $jsonrpc;

	function __construct($host, $port, $user, $pass)
	{
		$this->uri = "http://$user:$pass@$host:$port/";
		$this->jsonrpc = new jsonRPCClient($this->uri);
	}

	function getBalance($user_session)
	{
		return $this->jsonrpc->getbalance("zelles($user_session)", 6);
	}

	function getTotalBalance()
	{
		return $this->jsonrpc->getbalance("*", 6);
	}

	function getAddress($user_session)
	{
        return $this->jsonrpc->getaccountaddress("zelles($user_session)");
	}

	function getAddressList($user_session)
	{
		return $this->jsonrpc->getaddressesbyaccount("zelles($user_session)");
	}

	function getTransactionList($user_session, $page = 1)
	{
		return $this->jsonrpc->listtransactions("zelles($user_session)", 5, ($page - 1) * 5);
	}

	function getNewAddress($user_session)
	{
		return $this->jsonrpc->getnewaddress("zelles($user_session)");
	}

	function withdraw($user_session, $address, $amount)
	{
		return $this->jsonrpc->sendfrom("zelles($user_session)", $address, (float)$amount, 6);
	}
	function placehold($user_session, $amount) {
		global $hot_account_main;
		global $hot_account_wait;
		echo "Placing hold for $amount for $user_session\n";
		return $this->jsonrpc->move("zelles($hot_account_main)", "zelles($hot_account_wait)", $amount);
	}
	function credit($user_session, $amount)
	{
		global $hot_account_wait;
		return $this->jsonrpc->move("zelles($hot_account_wait)", "zelles($user_session)", $amount);
	}
}
?>
