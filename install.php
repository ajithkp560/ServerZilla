<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>ServerZila Web Installer</title>
    	<link href="img/icon.gif" rel="icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery.confirm.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="css/misc.css" />
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
						$('#msgUserId').html("");
					}
					else {
						$('#usrId').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#dbName').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#dbDbName').removeClass("has-error").addClass("has-success");
						$('#msgDbName').html("");
					}
					else {
						$('#dbDbName').removeClass("has-success").addClass("has-error");
					}
				});
				
				$('#rpasswd').on('blur', function(){
					var psw = $('#passwd').val();
					var inp = $(this);
					var hos = inp.val();
					if(hos==psw) {
						$('#rpassId').removeClass("has-error").addClass("has-success");
						$('#msgRPassId').html("");
					}
					else {
						$('#rpassId').removeClass("has-success").addClass("has-error");
						$('#msgRPassId').html("Passwords does not match. Check again.");
					}
				});
				
				
				$('#passwd').on('blur', function(){
					var inp = $(this);
					var hos = inp.val();
					if(hos) {
						$('#passId').removeClass("has-error").addClass("has-success");
						$('#msgPassId').html("");
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
						$('#msgDbUser').html("");
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
						$('#msgDbPass').html("");
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
						$('#msgDbHost').html("");
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
						$('#msgEmailId').html("");
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
				
				var flg = true;     		
        		if(document.getElementById("usrname").value=="")
        		{
        			$("#usrId").addClass("has-error");
					$("#msgUserId").html("Enter username");
        			flg = false;
        		}
        		if(document.getElementById("passwd").value=="")
        		{
        			$("#passId").addClass("has-error");
					$("#msgPassId").html("Enter Password");
        			flg = false;
        		}
        		if(document.getElementById("dbUsr").value=="")
        		{
        			$("#dbUsrId").addClass("has-error");
					$("#msgDbUser").html("Enter Database Username");
        			flg = false;
        		}
        		if(document.getElementById("email").value=="")
        		{
        			$("#email").addClass("has-error");
					$("#msgEmailId").html("Enter EMail ID");
        			flg = false;
        		}
        		if(document.getElementById("dbHost").value=="")
        		{
        			$("#dbHostId").addClass("has-error");
					$("#msgDbHost").html("Enter Database Host");
        			flg = false;
        		}
				if(document.getElementById("rpasswd").value=="")
        		{
        			$("#rpassId").addClass("has-error");
					$("#msgRPassId").html("Enter password again");
        			flg = false;
        		}
				if(document.getElementById("email").value=="")
        		{
        			$("#emailId").addClass("has-error");
					$("#msgPassId").html("Enter password");
        			flg = false;
        		}
				if(document.getElementById("dbName").value=="")
        		{
        			$("#dbDbName").addClass("has-error");
					$("#msgDbName").html("Enter Database Name");
        			flg = false;
        		}
				
				if(document.getElementById("passwd").value!=document.getElementById("rpasswd").value)
				{
					$('#passId').removeClass("has-success").addClass("has-error");
					$('#rpassId').removeClass("has-success").addClass("has-error");
					$("#msgRPassId").html("Passwords does not match. Enter again");
					flg = false;
				}
        		return flg;
        	}
        </script>

	</head>
	<body>
	<div style="background: black url('img/bg.jpg') no-repeat 50% 50%;color: yellow; height: 150px; width:100%;">
	</div>
    <br />
	<div style="width:95%;float:center;" class="container">	
	<form method="post">
		<fieldset>	
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
                            <div id="msgUserId" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
  						<div class="form-group" id="passId">
  							<div class="control-label">
    							<label for="passwd" class="required">Password</label>
    						</div>
    						<div class="controls">
    							<input name="passwd" style="width:90%;" type="password" class="form-control" id="passwd" placeholder="Password">
  							</div>
                            <div id="msgPassId" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
                        
                        <div class="form-group" id="rpassId">
  							<div class="control-label">
    							<label for="rpasswd" class="required">Confirm Password</label>
    						</div>
    						<div class="controls">
    							<input name="rpasswd" style="width:90%;" type="password" class="form-control" id="rpasswd" placeholder="Password">
  							</div>
                            <div id="msgRPassId" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
  						
  						<div class="form-group" id="emailId">
  							<div class="control-label">
    							<label for="email" class="required">Email</label>
    						</div>
    						<div class="controls">
    							<input name="email" style="width:90%;" type="text" class="form-control" id="email" placeholder="Email">
  							</div>
                            <div id="msgEmailId" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
  						
  					</div>
  					
  					<div class="push-right" style="width:40%; float:right; -ms-transform: translate(50px,0px); -webkit-transform: translate(50px,0px);transform: translate(50px,0px);">
                    
                    <div class="form-group" id="dbDbName">
  							<div class="control-label">
    							<label for="dbName" class="required">Database Name</label>
    						</div>
    						<div class="controls">
	    						<input name="dbName" style="width:90%;" type="text" class="form-control" id="dbName" placeholder="Enter DB Name">
  							</div>
                            <div id="msgDbName" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
                        
                    
  						<div class="form-group" id="dbUsrId">
  							<div class="control-label">
    							<label for="dbUsr" class="required">Database Username</label>
    						</div>
    						<div class="controls">
	    						<input name="dbUsr" style="width:90%;" type="text" class="form-control" id="dbUsr" placeholder="Enter DB Username">
  							</div>
                            <div id="msgDbUser" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
  						<div class="form-group" id="dbPassId">
  							<div class="control-label">
    							<label for="dbPass" class="required">Database Password</label>
    						</div>
    						<div class="controls">
	    						<input name="dbPass" style="width:90%;" type="password" class="form-control" id="dbPass" placeholder="DB Password">
  							</div>
                            <div id="msgDbPass" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
  						<div class="form-group" id="dbHostId">
  							<div class="control-label">
  								<label for="dbHost" class="required">Database Host</label>
  							</div>
  							<div class="controls">
	  							<input name="dbHost" style="width:90%;" type="host" class="form-control" id="dbHost" placeholder="DB Host">
  							</div>
                            <div id="msgDbHost" class="control-label required" style="text-align:justify; text-decoration:blink;"></div>
  						</div>
					</div>
  				</div>
  			</div>
  			
  			
  			<div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-13 controls">
                                    <center><button id="btn-fblogin" onClick="return check()" href="#" class="btn btn-primary" type="submit">Save Configaration</button></center>
                                    </div>
                                </div>
  		</fieldset>
	</form>
<?php
	@error_reporting(4);
	if(isset($_POST['usrname'])  && isset($_POST['passwd'])  && isset($_POST['dbUsr'])  && isset($_POST['dbPass'])  && isset($_POST['dbHost']) && isset($_POST['email']) && isset($_POST['dbName']))
	{
		if($_POST['rpasswd']!=$_POST['passwd'])
		{
			?>
            <script type="text/javascript">
				$('#passId').removeClass("has-success").addClass("has-error");
				$('#rpassId').removeClass("has-success").addClass("has-error");
			</script>
            <?php
			message("Error", "Passwords does not match.");
		}
		$db = $_POST[dbName];
		$conn = mysql_connect($_POST['dbHost'], $_POST['dbUsr'], $_POST['dbPass']);
		if(!$conn)
		{
			?><script type="text/javascript">
        		$("#dbUsrId").addClass("has-error");
        		$("#dbPassId").addClass("has-error");
        		$("#dbHostId").addClass("has-error");
				$("#msgDbHost").html("Failed to connect: Host. Check Host.");
				$("#msgDbUser").html("Failed to connect: Host. Check Username");
				$("#msgDbPass").html("Failed to connect: Host. Check Password");
			</script><?php
			message("Error", "Failed to connect database. Check database username, password and host.");
		}
		else {
			mysql_query("CREATE DATABASE $db;");
			mysql_select_db("$db", $conn);
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
				$handle = fopen("config.php", "w+");
				$db = $_POST['dbName'];
				$cont = "<?php\n\$db=\"$db\";\n\$dbUsr=\"".$_POST['dbUsr']."\";\n\$dbPass=\"".$_POST['dbPass']."\";\n\$dbHost=\"".$_POST['dbHost']."\";\n?>";
				if(!$handle)
				{
					message("Error", "Permission denied to create files!!!.");
				}
				$wri = fwrite($handle, $cont);
				if(!$wri)
				{
					message("Error", "Permission denied to write files!!!.");
				}
				?>
				<script type="text/javascript">
				$(function(){
					bootbox.alert({
						title: "Message",
						message: "You have configured application successfully.",
						callback: function(){ document.location="login.php"; }
					});
				});
				//
				</script>
				<?php
			}
			else {
				?><script type="text/javascript">
        		$("#dbUsrId").addClass("has-error");
        		$("#dbPassId").addClass("has-error");
        		$("#dbHostId").addClass("has-error");				
				$("#msgDbHost").html("Failed to connect: Host. Check Host.");
				$("#msgDbUser").html("Failed to connect: Host. Check Username");
				$("#msgDbPass").html("Failed to connect: Host. Check Password");
				</script><?php
				message("Error", "Failed to connect database. Check database username, password and host.");
			}
		}
		
	}
?>
	</div>
	<footer id="header" style="position:inherit; bottom: 0; width: 100%;">
		<center><label>&copy; ServerZilla &copy;</label></center>
	</footer>
    <?php
    function message($title, $message)
	{
		?>
		<script type="text/javascript">
			$(function(){
				bootbox.alert({
					title: "<?php echo $title; ?>",
					message: "<?php echo $message; ?>"
				});
			});
		</script>
		<?php
	}
	?>
     <script src="js/bootstrap.min.js"></script>
	</body>
</html>