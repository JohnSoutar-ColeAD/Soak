<?php

// Load constants & functions
require('constants.php');
require('functions.php');

// Load & instantiate PHPass
require('class/PasswordHash.php');
$passHasher = new PasswordHash(8, FALSE);

// Load classes
// These are in alphabetical order 
require('class/database.php'); 
require('class/login.php');
require('class/page.php');
require('class/registration.php');
require('class/session.php');
require('class/setting.php');
require('class/site.php');
require('class/template.php');
require('class/theme.php');
require('class/user.php');

require('class/panel.php');

// Create our database and site objects
$DB = new Database;
$Panel = new Panel($siteID);

?>