<?php require('inc/common.php'); ?>
<?php

	$Session = new Session();
    if ($Session->loggedIn()) {
    	$Session->logOut();
    }

    header("Location: ../");

?>