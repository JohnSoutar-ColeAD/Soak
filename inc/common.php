<?php

// Load constants
require('constants.php');

// Load & instantiate PHPass
require('class/PasswordHash.php');
$passHasher = new PasswordHash(8, FALSE);

// Load classes
require('class/database.php');	
require('class/session.php');
require('class/login.php');
require('class/user.php');
require('class/registration.php');

$DB = new Database;

?>