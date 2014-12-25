<?php

	@include 'config.php';
	@include 'authentication.php';
	if(isset($_POST['usrname']) && isset($_POST['passwrd']) && isset($_POST['host']))
	{
		setcookie('f_usr', $_POST['usrname']);
		setcookie('f_pass', $_POST['passwrd']);
		setcookie('f_host', $_POST['host']);
		header("Location: index.php");
	}
?>