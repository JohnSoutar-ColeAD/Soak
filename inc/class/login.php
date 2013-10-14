<?php


class Login {
	var $username;
	var $hashedPassword;

	var $loginid;

	var $User;

	function addToDatabase() {
		global $DB;

		$DB->prepare('INSERT INTO login SET loginid = :loginid, username = :username');
		$DB->execOne(array('loginid' => $this->loginid, 'username' => $this->User->username));
	}

	function removeFromDatabase($loginid) {
		global $DB;

		$DB->prepare('DELETE FROM login WHERE loginid = :loginid');
		$DB->execOne(array('loginid' => $loginid));
	}
	
	function auth($username, $password) {
		global $passHasher;

		if ($username && $password) {

			$User = new User;
			$User->loadFromUsername($username);

			if ($passHasher->CheckPassword($password, $User->hashedPassword)) {
				// Auth success
				
				$this->User = $User;

				// Generate a login ID
				$this->loginid = $this->generateRandID();
				$this->User->loginid = $this->loginid;

				// Add the login to the database
				$this->addToDatabase();

				// Return the User object
				return $this->User;

			} else {
				// Auth fail
				return false;	
			}
		}
	}

	function isValid() {
		global $DB;

		// Query the database for a login matching the login ID we have
		$DB->prepare('SELECT * FROM login WHERE loginid = :loginid');
		$DB->execute(array(':loginid' => $this->loginid));

		// If the login we found matches our user, the provided login is valid
		if (count($DB->result) > 0) {
			if ($DB->result[0]['username'] == $this->username) {
				return true;
			} else {
				return false;
			}
		}
	}

	// RandID & RandStr functions from Jpmaster77
	function generateRandID() {
      return md5($this->generateRandStr(16));
   	}

   	function generateRandStr ($length){
      	$randstr = "";
      	for($i=0; $i<$length; $i++){
         	$randnum = mt_rand(0,61);
         	if($randnum < 10) {
            	$randstr .= chr($randnum+48);
	        } elseif ($randnum < 36) {
	            $randstr .= chr($randnum+55);
	        } else {
	            $randstr .= chr($randnum+61);
	        }
      	}	
      	return $randstr;
   	}  
}

?>