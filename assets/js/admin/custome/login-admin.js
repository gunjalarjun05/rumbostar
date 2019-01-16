$(document).ready(function(){
	$("#forgot-link").click(function(){
		$("#admin-login-forgot").show();
		$("#admin-login-form").hide();
	});
	
	$("#login-link").click(function(){
		$("#admin-login-form").show();
		$("#admin-login-forgot").hide();
	});
	$("#femailid").blur(function(){
		if($('[name="femailid"]').val().trim() ==''){ 
				$(".forgot-email-error").html("Please Enter Email ID.");
				return false;
		}else if(!ValidateEmail($('[name="femailid"]').val())){
			$(".forgot-email-error").html("Please Enter Valid Email ID.");
				return false;
		}else{
				$(".forgot-email-error").html("");
		}
	});
	$("#forgotpsw").submit(function(){
		var emailid = $('[name="femailid"]').val().trim();
		if($('[name="femailid"]').val().trim() ==''){ 
				$(".forgot-email-error").html("Please Enter Email ID.");
				return false;
		}else if(!ValidateEmail($('[name="femailid"]').val())){
			$(".forgot-email-error").html("Please Enter Valid Email ID.");
				return false;
		}
		$.ajax({
				url: site_url+'user/forgotpassword',
				data:{emailid:emailid},
				type:"post",
				success: function(data){
					if(data.trim() !=1){
						$(".forgot-email-error").html(data);	
					}else{
							//return false;
							window.loaction.reload();
					}
				}
		});
		return false;
	});
	$("#login").submit(function(){
		$(".error").html('');
		var emailid = $('#emailid').val().trim();
		var validArr = [];
		if($('#emailid').val().trim() ==''){ 
				$("#error_username").html("Please Enter Email ID.");
				validArr[0] = false;
		}
		if($('#Password').val() ==''){ 
				$("#error_password").html("Please Enter Password.");
				validArr[1] = false;
		}
		for(i=0;i<validArr.length;i++){
			if(validArr[i] == false){
				return false;
			}
		}
	});
	
});
function ValidateEmail(email) {
	//var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	return expr.test(email);
}

