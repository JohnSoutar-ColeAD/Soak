<?php require('inc/common.php'); ?>
<?php

    $Session = new Session();
    if ($Session->logIn($_POST['username'], $_POST['password'], TRUE)) {
    	header("Location: ../");
    } else {
    	header("Location: ../?err=auth");

    }



?>    
