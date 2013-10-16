<?php

$siteID = 1;

require('../soak-core/admin-common.php');

if ($Panel->Session->loggedIn()) {
	if ($Panel->Session->User->userLevel > 1) {
		// Logged in & correct user level
		// Give them the tools!
		echo "Logged in & authorised";
	} else {
		// Note to self:
		// Remember to remove the bloody curse words
		echo "Your name don't mean shit around these parts, " . $Panel->Session->User->username;
	}
} else {
	echo "Not logged in";
}