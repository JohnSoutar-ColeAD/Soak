<?php

class Registration {

	var $User;
	var $success;


	function Registration($userArray = '') {

		$User = new User;

		// Check that an array of user details was actually provided
		// We might struggle to create a user with no details..
		if(is_array($userArray)) {
			$this->registerUser($userArray);
		} else {
			die('No user to register');
		}
	}

	function registerUser($userArray) {

		global $DB;
		global $passHasher;

		// Build a new User object from the array provided
		// This will normally be $_POST data from a registration form
		// but could be used in other contexts
		$User = new User;
		$User->loadFromArray($userArray);

		$this->User = $User;

		// Hash the password
		$User->hashedPassword = $passHasher->HashPassword($userArray['password']);

		$DB->prepare('SELECT * FROM user WHERE username = :username');
		$DB->execute(array(':username' => $User->username));

		// If no results are returned for the username provided
		if (count($DB->result) == 0) {
			// The username is free and we can insert the new user
			// with their desired name
			$DB->prepare('INSERT INTO user SET username = :username, firstName = :firstName, lastName = :lastName, emailAddress = :emailAddress, hashedPassword = :hashedPassword');
			$DB->execOne(array(	'username'  	=> $User->username,
								'firstName'		=> $User->firstName,
								'lastName' 		=> $User->lastName,
								'emailAddress' => $User->emailAddress,
								'hashedPassword' => $User->hashedPassword ));

			$this->success = TRUE;

		} else {
			// Username taken
			$error[] = "usertaken";
			$this->success = FALSE;

			return $error;

		}

	}
}

?>