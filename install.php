<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>ServerZila Web Installer</title>
    	<link href="img/icon.gif" rel="icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        
		<script src="js/jquery-1.11.1.min.js"></script>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/misc.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
        <style type="text/css">
        	hr { border:1px solid #ccc;}
        </style>
        
        <script type="text/javascript">
        	$(function(){
    	    	$('#usrname').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#usrId').removeClass("has-error").addClass("has-success");
					}
					else {
						$('#usrId').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#passwd').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#passId').removeClass("has-error").addClass("has-success");
					}
					else {
						$('#passId').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#dbUsr').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#dbUsrId').removeClass("has-error").addClass("has-success");
					}
					else {
						$('#dbUsrId').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#dbPass').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#dbPassId').removeClass("has-error").addClass("has-success");
					}
					else {
						$('#dbPassId').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#dbHost').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#dbHostId').removeClass("has-error").addClass("has-success");
					}
					else {
						$('#dbHostId').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#email').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#emailId').removeClass("has-error").addClass("has-success");
					}
					else {
						$('#emailId').removeClass("has-success").addClass("has-error");
					}
				});
			});
			
        	function check()
        	{
        		$("#usrId").removeClass("has-error");
        		$("#passId").removeClass("has-error");
        		$("#dbUsrId").removeClass("has-error");
        		$("#dbPassId").removeClass("has-error");
        		$("#dbHostId").removeClass("has-error");
        		
        		if(document.getElementById("usrname").value=="")
        		{
        			$("#usrId").addClass("has-error");
        			return false;
        		}
        		if(document.getElementById("passwd").value=="")
        		{
        			$("#passId").addClass("has-error");
        			return false;
        		}
        		if(document.getElementById("dbUsr").value=="")
        		{
        			$("#dbUsrId").addClass("has-error");
        			return false;
        		}
        		if(document.getElementById("email").value=="")
        		{
        			$("#email").addClass("has-error");
        			return false;
        		}
        		if(document.getElementById("dbHost").value=="")
        		{
        			$("#dbHostId").addClass("has-error");
        			return false;
        		}
        		return true;
        	}
        </script>

	</head>
	<body>
	<div style="background: black url('img/bg.jpg') no-repeat 50% 50%;color: yellow; height: 150px; width:100%;">
	</div>
	<form method="post">
		<fieldset>
		<div style="width:95%;float:center;" class="container">		
			<div class="row-fluid">
				<div class="col-lg-11 col-ms-12 col-sm-12 col-xs-12" style="height:auto;">
					<div class="push-left" style="width: 40%; float:left; height: auto; -ms-transform: translate(50px,0px); -webkit-transform: translate(50px,0px);transform: translate(50px,0px);">
 	 					<div class="form-group" id="usrId">
  							<div class="control-label">
    							<label for="usrname" class="required">Username</label>
    						</div>
    						<div class="controls">
    							<input name="usrname" style="width:90%;" type="text" class="form-control" id="usrname" placeholder="Enter Username">					
							</div>
  						</div>
  						<div class="form-group" id="passId">
  							<div class="control-label">
    							<label for="passwd" class="required">Password</label>
    						</div>
    						<div class="controls">
    							<input name="passwd" style="width:90%;" type="password" class="form-control" id="passwd" placeholder="Password">
  							</div>
  						</div>
  						
  						<div class="form-group" id="emailId">
  							<div class="control-label">
    							<label for="email" class="required">Email</label>
    						</div>
    						<div class="controls">
    							<input name="email" style="width:90%;" type="text" class="form-control" id="email" placeholder="Email">
  							</div>
  						</div>
  						
  					</div>
  					
  					<div class="push-right" style="width:40%; float:right; -ms-transform: translate(50px,0px); -webkit-transform: translate(50px,0px);transform: translate(50px,0px);">
  						<div class="form-group" id="dbUsrId">
  							<div class="control-label">
    							<label for="dbUsr" class="required">Database Username</label>
    						</div>
    						<div class="controls">
	    						<input name="dbUsr" style="width:90%;" type="text" class="form-control" id="dbUsr" placeholder="Enter DB Username">
  							</div>
  						</div>
  						<div class="form-group" id="dbPassId">
  							<div class="control-label">
    							<label for="dbPass" class="required">Database Password</label>
    						</div>
    						<div class="controls">
	    						<input name="dbPass" style="width:90%;" type="password" class="form-control" id="dbPass" placeholder="DB Password">
  							</div>
  						</div>
  						<div class="form-group" id="dbHostId">
  							<div class="control-label">
  								<label for="dbHost" class="required">Database Host</label>
  							</div>
  							<div class="controls">
	  							<input name="dbHost" style="width:90%;" type="host" class="form-control" id="dbHost" placeholder="DB Host">
  							</div>
  						</div>
					</div>
  				</div>
  			</div>
  			
  			
  			<div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-13 controls">
                                    <center><button id="btn-fblogin" href="#" class="btn btn-primary" type="submit">Save Configaration</button></center>
                                    </div>
                                </div>
  		</div>
  		</fieldset>
	</form>
<?php
	@error_reporting(4);
	if(isset($_POST['usrname'])  && isset($_POST['passwd'])  && isset($_POST['dbUsr'])  && isset($_POST['dbPass'])  && isset($_POST['dbHost']) && isset($_POST['email']))
	{
		$handle = fopen("config.php", "w+");
		$cont = "<?php\n\$dbUsr=\"".$_POST['dbUsr']."\";\n\$dbPass=\"".$_POST['dbPass']."\";\n\$dbHost=\"".$_POST['dbHost']."\";\n?>";
		if(!$handle)
		{
			print "<script>alert(\"Permission: The application have no permission to write files\");</script>";
		}
		$wri = fwrite($handle, $cont);
		if(!$wri)
		{
			print "<script>alert(\"Permission: The application have no permission to write files\");</script>";
		}
		$conn = mysql_connect($_POST['dbHost'], $_POST['dbUsr'], $_POST['dbPass']);
		if(!$conn)
		{
			?><script type="text/javascript">
        		$("#dbUsrId").addClass("has-error");
        		$("#dbPassId").addClass("has-error");
        		$("#dbHostId").addClass("has-error");
			</script><?php
		}
		else {
			mysql_query("CREATE DATABASE ftp_db;");
			mysql_select_db("ftp_db", $conn);
			$e = mysql_query("CREATE TABLE ftp_user(usrname varchar(50) unique, passwd varchar(50), email varchar(50) not null, reset varchar(50));");
			$h = mysql_query("CREATE TABLE ftp_host(host varchar(50), username varchar(50), password varchar(50));");
			if(!$e || !$h)
			{
				?><script type="text/javascript">
        		$("#dbUsrId").addClass("has-error");
        		$("#dbPassId").addClass("has-error");
        		$("#dbHostId").addClass("has-error");
				</script><?php
			}
			$e = mysql_query("INSERT INTO ftp_user values('".$_POST['usrname']."', '".md5($_POST['passwd'])."', '".$_POST['email']."', '');");
			if($e)
			{
				print "<script>document.location='index.php';</script>";
			}
			else {
				?><script type="text/javascript">
        		$("#dbUsrId").addClass("has-error");
        		$("#dbPassId").addClass("has-error");
        		$("#dbHostId").addClass("has-error");
				</script><?php
			}
		}
		
	}
?>

	<hr />
	<footer id="header" style="position: fixed; bottom: 0; width: 100%;">
		<center><label>&copy; ServerZilla &copy;</label></center>
	</footer>
	</body>
</html>