<?php $siteID = 1;
require('soak-core/common.php'); ?>
<?php

    if ($Site->Session->loggedIn()) {
    	$Site->Session->logOut();
    }

    header("Location: ../");

?>