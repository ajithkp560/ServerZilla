<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>        
    	<title>ServerZilla</title>
    	<link href="img/icon.gif" rel="icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/jquery.confirm.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="css/misc.css" />
    </head>
	<body>
	<div style="background: black url('img/bg.jpg') no-repeat 50% 50%;color: yellow; height: 150px; width:100%;">
	</div>
	<div class="container">  
        <?php
        @include 'config.php';
		$admin = $_SERVER['SERVER_ADMIN'];
        $conn = mysql_connect($dbHost, $dbUsr, $dbPass);
		$sel = mysql_select_db("$db", $conn);
		$query = mysql_query("SELECT * FROM ftp_user;");
		if(isset($_POST['newpass']) && isset($_POST['email']) && isset($_POST['code'])) {
			$flg = FALSE;
			while($row=mysql_fetch_array($query))
			{
				if($_POST['email'] == $row['email'] && $_POST['code']==$row['reset'])
				{
					$update = mysql_query("UPDATE ftp_user SET passwd='".md5($_POST['newpass'])."' where email='".$_POST['email']."';");
					$flg = TRUE;
				}
			}
			if($flg)
			{
				message("Success", "Password changed successfully", "login.php");
			}
			else
			{
				message("Error", "Failed to change password.", "reset.php");
			}
		}
		else if(isset($_POST['code']) && isset($_POST['email']))
		{
			$code = mysql_query("SELECT reset FROM ftp_user where email='".$_POST['email']."';");
			while($row=mysql_fetch_array($code))
			{
				if($row['reset']==$_POST['code'])
				{
					
					?>
					<div id="newpass" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            			<div class="panel panel-primary" >
                		    <div class="panel-heading">
                  		  	    <div class="panel-title">ServerZilla: New Password</div>
                    		</div>
                    		<div style="padding-top:15px;" class="panel-body">
                            	Enter new password.
                            </div>
                   			<div style="padding-top:10px" class="panel-body" >
                    		    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    	    <form id="loginform" class="form-horizontal" role="form" method="post">
                    	    	<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                    	    	<input type="hidden" name="code" value="<?php echo $_POST['code']; ?>">
                        	    <div style="margin-bottom: 25px" class="input-group form-group" id='codeDiv'>
                           		    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                	<input id="newpass" type="password" class="form-control" name="newpass" value="" placeholder="New Password">                                        
                            	</div>
                           		<div style="margin-top:10px" class="form-group">
                            		<div class="col-sm-12 controls">
                            	    	<button id="btn-login" type="submit" class="btn btn-success">Submit </button>
                                	    <button id="btn-fblogin" type="reset" class="btn btn-primary">Reset</button>
                                	</div>
                           		</div>
                        	</form>  
                  		</div>                     
              		</div>  
        		</div>
				<?php
				}
				else {
					message("Error", "The code you inserted is wrong. Try again from beginning.", "reset.php");
				}
			}
		}
		else if(isset($_POST['email']))
		{
			while ($row = mysql_fetch_array($query)) 
			{
				if($row['email']==$_POST['email'])
				{
					$email = $_POST['email'];
					$code = rand(100000, 999999);
					$update = mysql_query("UPDATE ftp_user SET reset='$code' where email='".$_POST['email']."'");
					$header = "MIME-Version: 1.0\r\r\n";
					$header .= "Content-Type: text/html;charset=UTF-8\r\r\n";
					$header .= "From <$admin>\r\r\n";
					mail($email, "ServerZilla Password Reset", "<html><head><title>ServerZilla</title></head><body>Your password reset code is <b>$code</b>.<br />:- <i>ServerZilla</i>.</body></html>", $header);
					?>
					<div id="codebox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            			<div class="panel panel-primary" >
                		    <div class="panel-heading">
                  		  	    <div class="panel-title">ServerZilla: Code</div>
                    		</div>    
                    		<div style="padding-top:15px;" class="panel-body">
                            	Enter the secret code sended to your Email.
                            </div>

                   			<div style="padding-top:10px" class="panel-body" >
                    		    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                    	    <form id="loginform" class="form-horizontal" role="form" method="post">
                    	    	<input type="hidden" name="email" value='<?php echo $email;?>'>
                        	    <div style="margin-bottom: 25px" class="input-group form-group" id='codeDiv'>
                           		    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                	<input id="code" type="text" class="form-control" name="code" value="" placeholder="Code">                                        
                            	</div>
                           		<div style="margin-top:10px" class="form-group">
                            		<div class="col-sm-12 controls">
                            	    	<button id="btn-login" type="submit" class="btn btn-success">Submit  </button>
                                	    <button id="btn-fblogin" type="reset" class="btn btn-primary">Reset</button>
                                	</div>
                           		</div>
                        	</form>  
                  		</div>                     
              		</div>  
        		</div>
        		<?php
				}
				else {
					message("Error", "Provide correct E-Mail address.", "reset.php");
				}
			}
		}
		else {			
        ?>  	
        <div id="resetbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-primary" >
                    <div class="panel-heading">
                        <div class="panel-title">ServerZilla: Reset</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group form-group" id='usernameDiv'>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="email" type="text" class="form-control" name="email" value="" placeholder="Email">                                        
                            </div>
                           	<div style="margin-top:10px" class="form-group">
                            	<div class="col-sm-12 controls">
                                	<button id="btn-login" type="submit" class="btn btn-success">Submit  </button>
                                    <button id="btn-fblogin" type="reset" class="btn btn-primary">Reset</button>
                                </div>
                           	</div>
                            </form>     
                        </div>                     
                    </div>  
        </div>
        
        <?php
        }	
	?>
    </div>
    <hr />
	<footer id="header" style="position: fixed; bottom: 0; width: 100%;">
		<center><label>&copy; ServerZilla &copy;</label></center>
	</footer>
	<script src="js/bootstrap.min.js"></script>
	<?php
	function message($title, $message, $loc)
	{
		?>
		<script type="text/javascript">
			$(function(){
				bootbox.alert({
					title: "<?php echo $title; ?>",
					message: "<?php echo $message; ?>",
					callback: function(){ document.location="<?php echo $loc; ?>"; }
				});
			});
			//
		</script>
		<?php
	}
	?>
	</body>
	</html>