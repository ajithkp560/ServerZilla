$(function(){
	$("#logoutBtn").on("click", function(){
		$.ajax({
			type: "GET",
			url: "delcookie.php",
			data: "logout",
			success: function(msg){
				$(location).attr('href', "?#");
			}
		});
		//$(location).attr('href', "?#");
	});
	
	$("#loginButton").on("click", function(){
		$(location).attr('href', "?#loginbox");
	});
	
	
	$('#host').on('blur', function(){
		var inp = $(this);
		var hos = inp.val();
		if(hos) {
			$('#hostDiv').removeClass("has-error").addClass("has-success");
		}
		else {
			$('#hostDiv').removeClass("has-success").addClass("has-error");
		}
	});
	
	$('#usrname').on('blur', function(){
		var inp = $(this);
		var hos = inp.val();
		if(hos) {
			$('#usrDiv').removeClass("has-error").addClass("has-success");
		}
		else {
			$('#usrDiv').removeClass("has-success").addClass("has-error");
		}
	});
	
	$('#passwrd').on('blur', function(){
		var inp = $(this);
		var hos = inp.val();
		if(hos) {
			$('#passwdDiv').removeClass("has-error").addClass("has-success");
		}
		else {
			$('#passwdDiv').removeClass("has-success").addClass("has-error");
		}
	});
	
	$('#username').on('blur', function(){
		var inp = $(this);
		var hos = inp.val();
		if(hos) {
			$('#usernameDiv').removeClass("has-error").addClass("has-success");
		}
		else {
			$('#usernameDiv').removeClass("has-success").addClass("has-error");
		}
	});
	
	$('#password').on('blur', function(){
		var inp = $(this);
		var hos = inp.val();
		if(hos) {
			$('#passwordDiv').removeClass("has-error").addClass("has-success");
		}
		else {
			$('#passwordDiv').removeClass("has-success").addClass("has-error");
		}
	});
	var data = Array();
	$('#host').change(function(){    
		$.ajax({
        	type:     "post",
        	url:      "host_json.php?host="+$('#host').val(),
        	data:     $(this).serialize(),
        	dataType: "json"
		}).done(function(response) {
    		data = response;
    		var ho = $('#host').val();
    		$.each(data, function(key, val){
    			if(val.host==ho)
    			{
    				$('#usrname').val(val.username);
    				$('#passwrd').val(val.password);
    			}
    		});
		});
	});
});


function resetForm()
{
	$('#host').removeClass('valid').removeClass('invalid');
	$('#usrname').removeClass('valid').removeClass('invalid');
	$('#passwrd').removeClass('valid').removeClass('invalid');
}
