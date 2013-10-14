<?php


class User {	
	var $userID 		= '';
	var $username 		= '';
	var $firstName 		= '';
	var $lastName 		= '';
	var $fullName 		= '';
	var $emailAddress 	= '';
	var $userLevel		= '';
	var $DBMembers = array('userID', 'username', 'firstName', 'lastName', 'emailAddress', 'userLevel', 'hashedPassword');

	var $loginID		= '';

	var $hashedPassword	= '';

	function User($userID = '') {
		if ($userID != '') {
			$this->loadFromID($userID);
		} else {
			$this->userID = 0;
		}
	}

	function loadFromID($userID) {
		global $DB;
		$this->userID = $userID;
		// Perform MySQL query to load user from ID
		$DB->prepare('SELECT * FROM user WHERE userid = :userid');
		$DB->execute(array(':userid' => $userID));

		if (count($DB->result[0]) >= 1) {
			$resultArray = $DB->result[0];
		}

		// Populate the user object from the returned array
		$this->loadFromArray($resultArray);
	}

	function loadFromUsername($username) {

		// Perform MySQL query to load user from username
		global $DB;
		$this->username = $username;
		// Perform MySQL query to load user from ID
		$DB->prepare('SELECT * FROM user WHERE username = :username');
		$DB->execute(array(':username' => $username));


		if (is_array($DB->result) && (count($DB->result[0]) >= 1)) {
			$resultArray = $DB->result[0];
		}

		// Populate the user object from the returned array
		$this->loadFromArray($resultArray);
	}

	function loadFromArray($userArray) {
		if (count($userArray) > 0) {
			foreach ($userArray as $key => $value) {
				if (isset($this->$key)) {
					$this->$key = $value;
				}
			}

			$this->fullName = $this->firstName . ' ' . $this->lastName;
		}
	}

	function getExportArray() {
		$exportArray = array();

		foreach ($this as $key => $value) {
			if ((in_array($key, $this->DBMembers)) & ($value != "")) {
				$exportArray[$key] = $value;
			}
		}

		return $exportArray;
	}
}

?>