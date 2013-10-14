<?php require('inc/common.php'); ?>
<?php

$Registration = new Registration($_POST);
if ($Registration->success) {
	$Session = new Session;
	$Session->logIn($_POST['username'], $_POST['password'], TRUE);
	header("Location: ../");
} else {
	header("Location: ../?err=taken");
}


?>