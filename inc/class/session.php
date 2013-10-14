<?php

class Session {
	var $User;
	var $Login;
	var $remember = TRUE;
	
	function Session($remember = TRUE, $User = '') {
		$this->remember = $remember;

		if (is_object($User)) {
			$this->User = $User;
		} elseif (!$User && $this->loggedIn()) {
			// Logged in!
		} else {
			session_start();
		}
	}

	function startSession() {
		// We are using a randomised login id and the users username to identify
		// a legitimate session. The login id is stored in the database while
		// the user is logged in.

		// Set the session variables
		$_SESSION['username'] 	= $this->User->username;
		$_SESSION['loginid']	= $this->User->loginid;

		// If we need to remember the user, we can store their session info
		// in cookies in their browser
		if ($this->remember) {
			setcookie("username", $this->User->username, time()+COOKIE_EXPIRE, COOKIE_PATH);
        	setcookie("loginid",   $this->User->loginid,   time()+COOKIE_EXPIRE, COOKIE_PATH);
		}
	}

	function loggedIn() {

		// Does the user have login information stored in their cookies?
		if (isset($_COOKIE['username']) && isset($_COOKIE['loginid'])) {

			// Populate the session with the details from the users cookies
			$_SESSION['username'] 	= $_COOKIE['username'];
			$_SESSION['loginid']	= $_COOKIE['loginid'];
		}

		// Do we have any session details stored?
		if (isset($_SESSION['username']) && isset($_SESSION['loginid'])) {

			// Load the user from the database using the username
			$this->User = new User();
			$this->User->loginid = $_SESSION['loginid'];
			$this->User->loadFromUsername($_SESSION['username']);

			// Determine whether or not the user is real & valid
			$Login = new Login;
			$Login->username = $this->User->username;
			$Login->loginid = $this->User->loginid;

			if ($Login->isValid()) {
				return true;
			} else {
				// Uh oh, either something has gone wrong or someone's being naughty
				// and trying to spoof a session
				// Either way, their session is invalid
				//
				// Not logged in
				return false;
			}
		} else {
			// No active session
			//
			// Not logged in
			return false;
		}
	}

	function logIn($username, $password, $remember) {
		$this->remember = $remember;
		// Attempt a login
		$this->Login = new Login;
		$loginUser = $this->Login->auth($username, $password);

		if ($loginUser) {
			// Auth success
			$this->User = $loginUser;
			$this->startSession();


			return true;
		} else {
			// Auth fail
			return false;
		}
	}

	function logOut() {
		$this->Login = new Login;
		$this->Login->removeFromDatabase($this->User->loginid);

		// Set the cookies to expire 100 days ago
		// Overkill? Maybe
		setcookie("username", '', time()-COOKIE_EXPIRE, COOKIE_PATH);
        setcookie("loginid",   '',   time()-COOKIE_EXPIRE, COOKIE_PATH);
	}


}

?>