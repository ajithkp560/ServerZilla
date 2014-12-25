<?php
	@include 'config.php';
	@include 'authentication.php';
    $hostQuery = mysql_query("select * from ftp_host where host='".$_GET['host']."';");
	$data = array();
	while($row=mysql_fetch_assoc($hostQuery)) {
		$data[] = array('host'=>$row['host'], 'username'=>$row['username'], 'password'=>$row['password']);
		$post = json_encode($data);
	}
	echo $post;
?>