 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>ServerZilla Admin Login</title>
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
      
	<?php
	
	@error_reporting(100000);
	function set_cookies($usr, $pass, $rem)
	{
		if($rem==1)
		{
			setcookie('usr', $usr, time()+60*60*12*30*6);
			setcookie('pass', $pass, time()+60*60*12*30*6);
		}
		else {
			setcookie('usr', $usr);
			setcookie('pass', $pass);
		}
		header("Location: index.php");
	}
	if(file_exists('config.php'))
	{
		@include 'config.php';
	}
	else 
	{
		header("Location: install.php");
	}
	$conn = mysql_connect($dbHost, $dbUsr, $dbPass);
	$sel = mysql_select_db("$db", $conn);
	if(!$conn||!$sel||$query)
	{
		print "Error: ".mysql_error();
	}
	
    if(isset($_POST['username']) && isset($_POST['password']))
	{
		$usrname = $_POST['username'];
		$password = $_POST['password'];
		$rem = $_POST['remember'];
		$query = mysql_query("SELECT passwd FROM ftp_user WHERE usrname='".mysql_real_escape_string(trim($usrname))."'");
		$flg = FALSE;
		while($row=mysql_fetch_array($query))
		{
			if($row['passwd']==md5($password))
			{
				set_cookies($usrname, md5($password), $rem);
				$flg = TRUE;
				//print'<script>document.cookie="usr='.$usrname.';";document.cookie="pass='.md5($password).';";document.location="index.php";</script>';
			}
		}
		if(!$flg)
		{
			?>
			<script type="text/javascript">
			$(function(){
				$('#usernameDiv').addClass("has-error").removeClass("has-success");
				$('#passwordDiv').addClass("has-error").removeClass("has-success");		
			});
			</script>
			<?php
			//header("Location: login.php");
		}
	}
	//else {
	?>
	
	
        
	</head>
	<body>	
	<div style="background: black url('img/bg.jpg') no-repeat 50% 50%;color: yellow; height: 150px; width:100%;">
	</div>
    <div class="container">    	
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div id="shake" class="panel panel-primary" >
                    <div class="panel-heading">
                        <div class="panel-title">ServerZilla: Login</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px;"><a style="color: red;" href="reset.php">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group form-group" id='usernameDiv'>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" name="username" value="" placeholder="Username">                                        
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group form-group" id='passwordDiv'>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                            </div>


                           	<div style="margin-top:10px" class="form-group">
                            	<div class="col-sm-12 controls">
                                	<button id="btn-login" type="submit" class="btn btn-success">Login  </button>
                                    <button id="btn-fblogin" type="reset" class="btn btn-primary">Reset</button>

                               	</div>
                        	</div>


                                <!--<div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    -->
                   		</form>     



                	</div>                     
            	</div>  
        	</div>
    </div>
    <?php
    //}
    ?>    
    <hr />
	<footer id="header" style="position: fixed; bottom: 0; width: 100%;">
		<center><label>&copy; ServerZilla &copy;</label></center>
	</footer>
   </body>
   </html>