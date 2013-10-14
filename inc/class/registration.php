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

		$User = new User;
		$User->loadFromArray($userArray);

		// Hash the password
		$User->hashedPassword = $passHasher->HashPassword($userArray['password']);

		$this->User = new User;
		$this->User->loadFromArray($userArray);

		$DB->prepare('SELECT * FROM user WHERE username = :username');
		$DB->execute(array(':username' => $User->username));

		// No results means the username is free
		if (count($DB->result) == 0) {
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