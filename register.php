<?php require('inc/common.php'); ?>
<?php

$Registration = new Registration($_POST);
if ($Registration->success) {
	$Site->Session->logIn($_POST['username'], $_POST['password'], TRUE);
	header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
	header("Location: " . $_SERVER['HTTP_REFERER'] . "?err=error");
}


?>