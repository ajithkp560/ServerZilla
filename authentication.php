<?php
	if(file_exists('config.php'))
	{
		@include 'config.php';
	}
	else 
	{
		header("Location: install.php");
	}
	$han = mysql_connect($dbHost, $dbUsr, $dbPass);
	$sel = mysql_select_db("ftp_db", $han);
	
	if(isset($_COOKIE['usr']) && isset($_COOKIE['pass']))
	{
		$flg = FALSE;
		$query = mysql_query("SELECT passwd FROM ftp_user WHERE usrname='".mysql_real_escape_string(trim($_COOKIE['usr']))."'");
		while($row=mysql_fetch_array($query))
		{
			if($row['passwd']==$_COOKIE['pass'])
			{
				$flg = TRUE;
			}
		}
		if(!$flg)
		{
			//print '<script>document.location="login.php";</script>';
			header("Location: login.php");
			exit;
		}
	}
	else {
		header("Location: login.php");
		exit;
	}
?>