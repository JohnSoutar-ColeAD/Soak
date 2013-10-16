<?php

class Database {
	var $username	= 'root';
	var $password 	= 'root';

	var $statement;
	var $result;

	var $conn;

	function Database() {
		try {
		    $this->conn = new PDO('mysql:host=localhost;dbname=john.s-test', $this->username, $this->password);
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
		}
	}

	function prepare($query) {
		$this->statement = $this->conn->prepare($query);
	}
	function execute($array) {
		$this->statement->execute($array);
		$this->result = $this->statement->fetchAll();
	}
	function execOne($array) {
		$this->statement->execute($array);
	}


}

?>