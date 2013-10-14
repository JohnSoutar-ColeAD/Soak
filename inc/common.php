<?php

// Load constants & functions
require('constants.php');
require('functions.php');

// Load & instantiate PHPass
require('class/PasswordHash.php');
$passHasher = new PasswordHash(8, FALSE);

// Load classes
require('class/site.php');
require('class/setting.php');
require('class/page.php');
require('class/template.php');
require('class/theme.php');
require('class/database.php');	
require('class/session.php');
require('class/login.php');
require('class/user.php');
require('class/registration.php');

$DB = new Database;
$Site = new Site;

?>