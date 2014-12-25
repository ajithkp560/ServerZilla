<?php
	if(isset($_REQUEST['disconnect']))
	{
		setcookie('f_usr', '');
		setcookie('f_pass', '');
		setcookie('f_host', '');
		header("Location: index.php");
	}
	if(isset($_REQUEST['logout']))
	{
		setcookie('f_usr', '');
		setcookie('f_pass', '');
		setcookie('f_host', '');
		setcookie('usr', '');
		setcookie('pass', '');
		header("Location: login.php");
	}
?>