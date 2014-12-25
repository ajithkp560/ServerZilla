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
	<?php
			@include 'config.php';
			@include 'authentication.php';
        	@include 'setcookie.php';
			@include 'delcookie.php';
			@error_reporting(1000000);
			set_time_limit(0);
       		$usr  = "";
        	$pass = "";
        	$host = "";
			$conn = "";
			$login = "";
			$fpath = "";
			$path = "";
			$self = $_SERVER['PHP_SELF'];				
			$sep="/";
			if(strtolower(substr(PHP_OS,0,3))=="win")
			{
			    $os="win";
    			$sep="\\";
    			$ox="Windows";
			}
			else
			{
			    $os="nix";
    			$ox="Linux";
			}
			
			if(isset($_POST['dbstore']))
			{
				$var = $_POST['dbstore'];
				if($var==1)
				{
					$query = mysql_query("insert into ftp_host values('".$_POST['host']."', '".$_POST['usrname']."', '".$_POST['passwrd']."');");
				}
			}
			if(file_exists(getcwd().$sep."config.php"))
			{
				@include 'config.php';
			}
			else {
				header("Location: install.php");
			}
			if(isset($_COOKIE['f_usr']) && isset($_COOKIE['f_pass']) && isset($_COOKIE['f_host'])) {
				$usr  = $_COOKIE['f_usr'];
				$pass = $_COOKIE['f_pass'];
				$host = str_replace("ftp://", "", $_COOKIE['f_host']);		
				$conn = ftp_connect($host); 
				if($conn)
				{
					$login = ftp_login($conn, $usr, $pass);
					if($login)
					{
						$fpath = ftp_pwd($conn);
					}
				}
			}
			if(isset($_GET['path']))
			{
				chdir($_GET['path']);
			}
			
			if(isset($_GET['fpath']))
			{
				$fpath = $_GET['fpath'];
				ftp_chdir($conn, $fpath);
			}

			if(isset($_GET['upload']))
			{
				$file = $_GET['upload'];
				if($conn)
				{
					$upload = ftp_put($conn, basename($file), basename($file), FTP_BINARY);
					if($upload)
					{
						?>
						<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Success",
								message: "The file '<?php echo basename($file); ?>' uploaded successfully!!!.",
							});
						});
						</script>
						<?php
					}
					else{
						?>
						<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Error",
								message: "The file '<?php echo basename($file); ?>' failed to upload!!!.",
							});
						});
						</script>
						<?php
					}
				}
				else {
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
							title: "Error",
							message: "Connect to FTP server to upload file!!!.",
						});
					});
					</script>
					<?php
				}
				
			}
			
			if(isset($_GET['rename']))
			{
				$id = $_GET['id'];
				$filer = $_GET['rename'];
				$path = $_GET['path'];
				$fpath = $_GET['fpath'];
				?>
				<script type="text/javascript">
					$(function(){
						$('#action<?php echo $id; ?>').hide('slow');
						$('#form<?php echo $id; ?>').append("<form method='get' class='form-inline'><input type='hidden' name='fpath' value='<?php echo addslashes($fpath); ?>'><input type='hidden' name='path' value='<?php echo addslashes($path); ?>'><input type='hidden' name='oldname' value='<?php echo $filer; ?>'><input type='text' name='dorename' placeholder='<?php echo $filer; ?>' style='width='5%;' class='form-control input-small'><button class='btn btn-success btn-small' type='submit'> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </button></form>");
					});
				</script>
				<?php
			}
			
			if(isset($_GET['renamef']))
			{
				$id = $_GET['id'];
				$filer = $_GET['renamef'];
				$path = $_GET['path'];
				$fpath = $_GET['fpath'];
				?>
				<script type="text/javascript">
					$(function(){
						$('#action<?php echo $id; ?>').hide('slow');
						$('#form<?php echo $id; ?>').append("<form method='get' class='form-inline'><input type='hidden' name='fpath' value='<?php echo addslashes($fpath); ?>'><input type='hidden' name='path' value='<?php echo addslashes($path); ?>'><input type='hidden' name='oldnamef' value='<?php echo $filer; ?>'><input type='text' name='dorenamef' placeholder='<?php echo $filer; ?>' style='width='5%;' class='form-control input-small'><button class='btn btn-success btn-small' type='submit'> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </button></form>");
					});
				</script>
				<?php
			}
			
			if(isset($_GET['oldname']) && isset($_GET['dorename']))
			{
				$oldname = $_GET['oldname'];
				$newname = $_GET['dorename'];
				if(rename($oldname, $newname))
				{
					?>
					<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Success",
								message: "The file '<?php echo $oldname; ?>' renamed to '<?php echo $newname; ?>' successfully!!!.",
							});
						});
					</script>
					<?php
				}
				else {
					?>
					<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Error",
								message: "The file '<?php echo $oldname; ?>' is not renamed to '<?php echo $newname; ?>' successfully!!!.",
							});
						});
					</script>
					<?php
				}
			}

			if(isset($_GET['delete']))
			{
				$file = $_GET['delete'];
				$id = $_GET['id'];
				?>
	 	       	<script type="text/javascript">
					$(function(){
						$.confirm({
    						title:"Delete Confirmation",
   							text:"You are going to delete file '<?php echo $file; ?>'. It may harm your remote host. Are you sure?",
   							confirm: function(button) {
   								document.location="<?php echo "$self?path=".addslashes(getcwd())."&fpath=$fpath&deletefile=$file"; ?>";
    						},
    						cancel: function(button) {
        						bootbox.alert({
   									title: "Cancelled",
   									message: "You have cancelled the job to delete file."
   								});
    						},
    						confirmButton: "Yes",
    						cancelButton: "No"
						});
					});
    		    </script>
			<?php
			}
			
			if(isset($_GET['deletefile']))
			{
				$file = $_GET['deletefile'];
				if(is_dir($file))
				{
					if(deleteDir($file))
					{
						?>
						<script type="text/javascript">
							$(function(){
								bootbox.alert({
   									title: "Success",
   									message: "You have deleted directory <?php echo $file; ?>."
   								});
							});
						</script>
						<?php
					}
					else {
						?>
						<script type="text/javascript">
							$(function(){
								bootbox.alert({
   									title: "Failed",
   									message: "You cannot directory file <?php echo $file; ?>."
   								});
							});
						</script>
						<?php
					}
				}
				else {
					if(unlink($file))
					{
						?>
						<script type="text/javascript">
							$(function(){
								bootbox.alert({
   									title: "Success",
   									message: "You have deleted file <?php echo $file; ?>."
   								});
   							});
						</script>
						<?php
					}
					else {
						?>
						<script type="text/javascript">
							$(function(){
								bootbox.alert({
   									title: "Error",
   									message: "You cannot delete file <?php echo $file; ?>."
   								});
   							});
						</script>
						<?php
					}
				}
			}
			
			if(isset($_GET['oldnamef']) && isset($_GET['dorenamef']))
			{
				$oldname = $_GET['oldnamef'];
				$newname = $_GET['dorenamef'];
				if(ftp_rename($conn, $oldname, $newname))
				{
					?>
					<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Success",
								message: "The file '<?php echo $oldname; ?>' renamed to '<?php echo $newname; ?>' successfully!!!.",
							});
						});
					</script>
					<?php
				}
				else {
					?>
					<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Error",
								message: "The file '<?php echo $oldname; ?>' is not renamed to '<?php echo $newname; ?>' successfully!!!.",
							});
						});
					</script>
					<?php
				}
			}
			
			if(isset($_GET['download']))
			{
				$file = $_GET['download'];
				if(ftp_get($conn, $file, $file, FTP_BINARY))
				{
					?>
					<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Success",
								message: "The file '<?php echo $file; ?>' downloaded to remote host successfully!!!"
							})
						});
					</script>
					<?php
				}
				else {
					?>
					<script type="text/javascript">
						$(function(){
							bootbox.alert({
								title: "Error",
								message: "The file '<?php echo $file; ?>' failed to download!!!"
							})
						});
					</script>
					<?php
				}
			}
			
			if(isset($_GET['deletef']))
			{
				$filed = $_GET['deletef'];
				?>
	 	       	<script type="text/javascript">
					$(function(){
						$.confirm({
    						title:"Delete Confirmation",
   							text:"You are going to delete file '<?php echo $filed; ?>'. It may harm your FTP host. Are you sure?",
   							confirm: function(button) {
   								document.location="<?php echo "$self?path=".addslashes(getcwd())."&fpath=$fpath&deletefilef=$filed"; ?>";
   								
    						},
    						cancel: function(button) {
        						bootbox.alert({
   									title: "Cancelled",
   									message: "You have cancelled the job to delete file."
   								});
    						},
    						confirmButton: "Yes",
    						cancelButton: "No"
						});
					});
    		    </script>
			<?php
			}
			
			
			if(isset($_GET['deletedf']))
			{
				$filed = $_GET['deletedf'];
				?>
	 	       	<script type="text/javascript">
					$(function(){
						$.confirm({
    						title:"Delete Confirmation",
   							text:"You are going to delete file '<?php echo $filed; ?>'. It may harm your FTP host. Are you sure?",
   							confirm: function(button) {
   								document.location="<?php echo "$self?path=".addslashes(getcwd())."&fpath=$fpath&deletefiledf=$filed"; ?>";
   								
    						},
    						cancel: function(button) {
        						bootbox.alert({
   									title: "Cancelled",
   									message: "You have cancelled the job to delete file."
   								});
    						},
    						confirmButton: "Yes",
    						cancelButton: "No"
						});
					});
    		    </script>
			<?php
			}
			
			if(isset($_GET['deletefilef']))
			{
				$file = $_GET['deletefilef'];
				if(ftp_delete($conn, $file))
				{
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Success",
   							message: "You have deleted the file '<?php echo $file; ?>'."
   						});
					});
					</script>
					<?php
				}
				else {
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Error",
   							message: "You cannot delete the file '<?php echo $file; ?>'."
   						});
					});
					</script>
					<?php
				}
			}
			
			if(isset($_GET['deletefiledf']))
			{
				$file = $_GET['deletefiledf'];
				if(deleteFDir($conn, $file))
				{
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Success",
   							message: "You have deleted the directory '<?php echo $file; ?>'."
   						});
					});
					</script>
					<?php
				}		
				else{
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Error",
   							message: "You cannot delete the directory '<?php echo $file; ?>'."
   						});
					});
					</script>
					<?php
				}		
			}
			
			if(isset($_GET['newdir']))
			{
				$dir = $_GET['newdir'];
				if(mkdir($dir))
				{
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Success",
   							message: "You have created the directory '<?php echo $dir; ?>'."
   						});
					});
					</script>
					<?php
				}
				else {
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Error",
   							message: "You cannot create the directory '<?php echo $dir; ?>'."
   						});
					});
					</script>
					<?php
				}
			}
			
			if(isset($_GET['newdirf']))
			{
				$dir = $_GET['newdirf'];
				if(ftp_mkdir($conn, $dir))
				{
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Success",
   							message: "You have created the directory '<?php echo $dir; ?>'."
   						});
					});
					</script>
					<?php
				}
				else {
					?>
					<script type="text/javascript">
					$(function(){
						bootbox.alert({
   							title: "Error",
   							message: "You cannot create the directory '<?php echo $dir; ?>'."
   						});
					});
					</script>
					<?php
				}
			}
			
			function deleteFDir($conn, $path)
			{
				$list = getfiles(ftp_pwd($conn).'/'.$path);
				foreach($list as $item)
				{
					if($item['type']=='Directory')
					{
						deleteFDir($conn, $path.'/'.$item['name']);
					}
					else {
						ftp_delete($conn, $path.'/'.$item['name']);
					}
				}
				if(ftp_rmdir($conn, $path))
				{
					return true;
				}
				else {
					return false;
				}
			}
			
			$flg = false;
			
			function deleteDir($file)
			{
				global $sep, $flg;
				$file = (substr($file,-1)==$sep)? $file:$file.$sep;
				$flg = FALSE;
				if($dh = opendir($file)){
					while(($f = readdir($dh))!==false){
						if($f != '.' && $f != '..'){
							$f = $file.$f;
							if(is_dir($f)){
								deleteDir($f);
							}
							else{
								unlink($f);
							}
						}
					}
					closedir($dh);
					if(rmdir($file))
					{
						$flg = TRUE;
					}
					else {
						$flg = FALSE;
					}
				}
				return $flg;
			}
			
			function filesizes($size)
			{
    			if ($size>=1073741824)$size = round(($size/1073741824) ,2)." GB";
    			elseif ($size>=1048576)$size = round(($size/1048576),2)." MB";
    			elseif ($size>=1024)$size = round(($size/1024),2)." KB";
    			else $size .= " B";
    			return $size;
			}
			
			if($conn)
			{
				?>
				<script type="text/javascript">
					$(function(){
						$("#connect").text("Disconnect");
						$('#connect').attr('href', '?disconnect');
						$('#connect').removeClass('btn-primary').addClass('btn-danger');
					});
				</script>
				<?php
			}	
			else {
				?>
				<script type="text/javascript">
					$(function(){
						$("#connect").text("Connect");
						$('#connect').attr('href', '#loginbox');
					});
				</script>
				<?php
			}
			?>
    </head>
    <body>
    <div style="background: black url('img/bg.jpg') no-repeat 50% 50%;color: yellow; height: 150px; width:100%;">
    	<div class="row" style="text-align: right;width:100%; ">
			<a class="btn btn-primary" data-toggle="modal" href="#loginbox" id="connect">Connect</a>
			<a class="btn btn-danger" href="?logout">Logout</a>
		</div>
	</div>

    	
    <div class="container">
		<div id="loginbox" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
   			<div class="modal-dialog">
   				<div class="modal-content">
   					<div class="modal-header">
      					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      					<h1 class="text-center">Login FTP</h1>
  					</div>
  					<div class="modal-body">
      					<form class="form col-md-12 center-block" method="post" action="?">
        					<div class="form-group has-property" id="hostDiv">
          						<input type="text" class="form-control" name="host" id="host" placeholder="FTP Host" list="hosts">
          						<datalist id="hosts">
          							<?php
          							$hostQuery = mysql_query("select * from ftp_host;");
									while($row=mysql_fetch_array($hostQuery))
									{
										print "<option>".$row['host']."</option>\n";
									}
          							?>
          						</datalist>	
       						</div>
       						
        					<div class="form-group has-property" id="usrDiv">
          						<input type="text" class="form-control" name="usrname" id="usrname" placeholder="Username">
       						</div>
        					<div class="form-group has-property" id="passwdDiv">
          						<input type="password" class="form-control" name="passwrd" id="passwrd" placeholder="Password">
        					</div>
        					
        					
        					
        					<div class="checkbox">
    							<label>
      								<input type="checkbox" name="dbstore" value="1"> Save to Database
    							</label>
  							</div>
  							
  							
        					<div class="form-group">
          						<button class="btn btn-primary btn-block">Sign In</button>
        					</div>
        					
      					</form>
   					</div>
   					<div class="modal-footer">
   						<div class="col-md-12">
   							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
   						</div>    
   					</div>
   				</div>
   			</div>
   		</div>
   	</div>
   	<div class="container-fluid">
   		<div class="row">
   			<div class="col-md-6" style="height:100%; border-right: 1px solid #ccc;">
				<?php
				$path = getcwd();
				$dirs = array();
				$fils = array();
				?>
				<h2 style="text-align: center;">Remote Host Files</h2><hr />
   				<form method="get" action="#"><div class="form-inline"><input type="hidden" value="<?php echo $fpath; ?>" name="fpath"><input type="hidden" name="path" value="<?php echo $path; ?>" /><div><label for="path" class="required">Path: </label></div><input style="width: 80%;" value="<?php echo $path; ?>" class='input-large form-control search-query' name='path'><button class="btn btn-success" type="submit"> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </button></div></form><hr />
				<form method="get" action="#"><div class="form-inline"><input type="hidden" value="<?php echo $fpath; ?>" name="fpath"><input type="hidden" name="path" value="<?php echo $path; ?>" /><div><label for="directory" class="required">New Directory: </label></div><input style="width: 80%;" placeholder="New Directory" class='input-large form-control search-query' name='newdir'><button class="btn btn-success" type="submit"> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </button></div></form><hr />
				<table class="table table-hover">
				<?php
				if(is_dir($path))
				{
					chdir($path);
					?>
					<tr><th>Name</th><th>Size</th><th>Actions</th></tr>
					<?php
					$id = 0;
					if($handle=opendir($path))
					{
						while(($item=readdir($handle))!==FALSE)
						{
							if($item=='.'){continue;}
							elseif ($item=='..') {continue;}
							if(is_dir($item))
							{
								array_push($dirs, $path.$sep.$item);
							}
							else {
								array_push($fils, $path.$sep.$item);
							}
						}
						foreach ($dirs as $dir) {
							echo "<tr><td>[ <a href='$self?path=$dir&fpath=$fpath'>".basename($dir)."</a> ]</td><td>".filesizes(filesize($dir))."</td><td style='width:40%;'><div id='action$id'>| <a href='$self?id=$id&path=$path&fpath=$fpath&rename=".basename($dir)."#action$id'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a> | <a id='delete$id' href='$self?id=$id&path=$path&fpath=$fpath&delete=".basename($dir)."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a> | </div><div style='text-align='right';' id='form$id'></div></td></tr>\n";
							$id = $id+1;	
						}
						foreach ($fils as $fil) {
							echo "<tr><td><a href='$self?path=$path&upload=$fil&fpath=$fpath'>".basename($fil)."</a></td><td>".filesizes(filesize($fil))."</td><td style='width:40%;'><div id='action$id'> | <a href='$self?id=$id&path=$path&fpath=$fpath&rename=".basename($fil)."#action$id'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a> | <a id='delete$id' href='$self?id=$id&path=$path&fpath=$fpath&delete=".basename($fil)."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a> | <a href='$self?path=$path&upload=$fil&fpath=$fpath'><span class='glyphicon glyphicon-open' aria-hidden='true'></span></a> | </div><div id='form$id'></div></td></tr>\n";
							$id = $id+1;
						}
					}
					
				}
				?>
			</table>
	      	</div>

    		<div class="col-md-6" style="height:100%;border-left: 1px solid #ccc;">
    		<h2 style="text-align: center">FTP Server Files</h2><hr />
    		<div class="form-inline"><form method="get" action="#"><div><label for="fpath" class="required">Path: </label></div><input type="hidden" value="<?php echo $path; ?>" name="path"><input type="hidden" name="fpath" value="<?php echo $fpath;?>"><input style="width: 80%;" value="<?php echo $fpath; ?>" class='input-large form-control search-query' name='fpath'><button class="btn btn-success" type="submit"> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </button></div></form><hr />
			<div class="form-inline"><form method="get" action="#"><div><label for="newdir" class="required">New Directory: </label></div><input type="hidden" value="<?php echo $path; ?>" name="path"><input type="hidden" name="fpath" value="<?php echo $fpath;?>"><input style="width: 80%;" placeholder="New Directory" class='input-large form-control search-query' name='newdirf'><button class="btn btn-success" type="submit"> <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> </button></div></form><hr />
			<table class="table table-hover">
				<tr><th>Name</th><th>Size</th><th>Actions</th></tr>
				<?php
				if($conn)
				{
					$props = getfiles($fpath);
					$dirs = array();
					$fils = array();
					foreach($props as $prop) {
						if($prop['type']=='Directory')
						{
							array_push($dirs, $prop);
						}
						else {
							array_push($fils, $prop);
						}
					}
					foreach($dirs as $dir){
						echo "<tr><td>[ <a href='$self?path=$path&fpath=$fpath".$dir['name']."/'>".$dir['name']."</a> ]</td><td>".filesizes($dir['size'])."</td><td style='width:40%;'><div id='action$id'> | <a href='$self?id=$id&path=$path&fpath=$fpath&renamef=".$dir['name']."#action$id'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a> |  <a href='$self?path=$path&fpath=$fpath&deletedf=".$dir['name']."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a> | </div><div id='form$id'></div></td></tr>";
						$id = $id+1;
					}
					foreach ($fils as $fil) {
						echo "<tr><td><a href='$self?path=$path&fpath=$fpath&download=".$fil['name']."'>".$fil['name']."</a></td><td>".filesizes($fil['size'])."</td><td style='width:40%;'><div id='action$id'> | <a href='$self?id=$id&path=$path&fpath=$fpath&renamef=".$fil['name']."#action$id'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a> |   <a href='$self?path=$path&fpath=$fpath&deletef=".$fil['name']."'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a> | <a href='$self?path=$path&fpath=$fpath&download=".$fil['name']."'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></a> | </div><div id='form$id'></div></td></tr>";
						$id = $id+1;
					}
				}
				?>
			</table>
			</div>
   		</div>
   	</div>
   	</body>
   	
   	<?php
   	function getfiles($directory=".")
	{
		global $conn;
		if(is_array($directs=ftp_rawlist($conn, $directory)))
		{
			$prop = array();
			$props = array();
			foreach($directs as $dirx)
			{
				$chunks = preg_split("/[\s]+/", $dirx, 9);
				list($prop['perm'], $prop['num'], $prop['user'], $prop['group'], $prop['size'], $prop['mon'], $prop['day'], $prop['time']) = $chunks;
				$prop['type']=$chunks[0]{0}==='d'?'Directory':'File';
				$prop['name']=$chunks[8];
				array_splice($chunks, 0, 8);
				$props[implode(" ", $chunks)]=$prop;
			}
			return $props;
		}
	}
				
	if(isset($_COOKIE['f_usr']) && isset($_COOKIE['f_pass']) && isset($_COOKIE['f_host'])) {
			if(!$conn) {
				?>
				<script>
					var logBox = $("#loginbox");
					logBox.fadeIn("slow");
					$("#loginbox").modal("show");
					$('#hostDiv').removeClass("has-success").addClass("has-error");
					$(location).attr('href', "?#loginbox");
				</script>
				<?php
			}
			else {
				if(!$login) {
					?>
					<script>
						var logBox = $("#loginbox");
						logBox.fadeIn("slow");
						$("#loginbox").modal();
						$('#usrDiv').removeClass("has-success").addClass("has-error");
						$('#passwdDiv').removeClass("has-success").addClass("has-error");
						$(location).attr('href', "?#loginbox");
					</script>
					<?php
				}
			}
	}
   	?>
	<hr />
	<footer id="header" style="position: fixed; bottom: 0; width: 100%;">
		<center><label>&copy; ServerZilla &copy;</label></center>
	</footer>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/impress.js"></script>
	<script>impress().init();</script>-->
    </body>
</html>