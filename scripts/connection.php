<?php 


class Connector{
	
	private $user ;
	private $password ;
	private $db;
	private $host;
	private $port;
	private $link;
	
	
	public function __construct() {
		print "In BaseClass constructor\n";
		 $user = 'Moka';
		 $password = 'moka';
		 $db = 'Moka';
		 $host = '127.0.01';
		 $port = 8889;
		 $link = "";
	}
	
	public function connect(){
		
		$link = mysqli_connect(
				"$host:$port",
				$user,
				$password,
				$db
				);
		
		if (!$link) {
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
		$this->select();
		
	}
	
	
	private function select(){
		
		$db_selected = mysqli_select_db(
				$link,
				$db
				);
		
		if (!$db_selected) {
			die("Database connection failed: " . mysqli_connect_error());
		}
	}
	
	
	public function close(){
		$link->close();
	}
	
	public function getConnector(){
		return $link;
	}
	
	
}


class QueryDb{
	
	private $conn;
	public $query;
	
	function __construct(){
		
		$this->$conn = new Connector();
		$this->$conn->connect();
	}
	
	
	
	public function queryDb($sql){
		
		$result = $this->$conn->getConnector()->query($sql);
		return $result;
	}
	
	function __destruct(){
		$this->$conn->close();
	}
	
	
}



?>