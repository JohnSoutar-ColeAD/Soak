<?php require('inc/common.php'); ?>
<?php

    if ($Site->Session->logIn($_POST['username'], $_POST['password'], TRUE)) {
    	header("Location: ../");
    } else {
    	header("Location: ../?err=auth");

    }



?>    
