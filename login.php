<?php $siteID = 1;
require('soak-core/common.php'); ?>
<?php

    if ($Site->Session->logIn($_POST['username'], $_POST['password'], TRUE)) {
    	header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
    	header("Location: " . $_SERVER['HTTP_REFERER'] . "?err=auth");

    }



?>    
