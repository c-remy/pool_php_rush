<?php

class Database {

	private $host = "localhost";
	private $username = "root";
	private $password = "password";
	private $port = 42;
	private $db = "pool_php_rush";

	public $conn = null;

	public function connect()
	{
		$this->conn = null;

		try {
        $this->conn = new PDO("mysql:host=" .$this->host. ";port=" .$this->port. ";dbname=" .$this->db, $this->username, $this->password);
        // set the PDO error mode to exception
        //$this->$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    }
    
    catch(PDOException $e)
        {
            echo "PDO ERROR: " .$e->getMessage(). " storage in ERROR_LOG_FILE\n";
            file_put_contents("ERROR_LOG_FILE", $e->getMessage() . "\n", FILE_APPEND);
            die();
            return (false);
        }
    return ($this->conn);
	}

	public function disconnect()
	{
		$this->conn = null;
	}
}
?>