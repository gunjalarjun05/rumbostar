$(document).ready(function(){

	$("#admin-login-form").submit(function(){ 
		var validArr = [];
		$(".form-error").html('');
		$(".form-error").css('color','red');
		if($("#id-email").val().trim() ==''){
			$("#id-error-email").html("Please enter email.");
			validArr[0] = false;
		}else if(!ValidateEmail_front($("#id-email").val())){
			$("#id-error-email").html("Please enter valid email.");
			validArr[0] = false;
		}
		if($("#id-password").val() ==''){
			$("#id-error-password").html("Please enter password.");
			validArr[1] = false;
		}
		
		for(i=0; i<validArr.length;i++){
			if(validArr[i] == false){
				return false;
			}
		} 
		

		var formData = $("#admin-login-form").serialize();

		$.ajax({
			url:site_url+'home/checkadminlogin',
			data:formData,
			type:'post',
			dataType:'json',
			success : function(data){ 
				 if(data.status == 'success'){ 
					location.href = site_url+'dashboard';
					return false;
				}
				if(data.varlidationError.email !=''){ 
					$("#id-error-email").html(data.varlidationError.email);
				}
				if(data.varlidationError.password !=''){
					$("#id-error-password").html(data.varlidationError.password);
				}
			//}else{
				$("#error_password").html(data.msg);
					//}
					
				return false;	
				//}
			}
		});
		return false;
	});
	
	$("#forgot-password-link").click(function(){
		$(".form-error").html('');
		$("#admin-login-form").hide();
		$("#forgot-psw-form").show();
	});
	$("#back_login_form").click(function(){
		$(".form-error").html('');
		$("#admin-login-form").show();
		$("#forgot-psw-form").hide();
	});

	$("#forgot-psw-form").submit(function(){
		$(".form-error").html('');
		$("#error_forgot_password").html();
		$(".form-error").css('color','red');
		var emailid = $('[name="femail"]').val().trim();
		if($('[name="femail"]').val().trim() ==''){ 
				$("#id-error-femail").html("Please enter email.");
				return false;
		}else if(!ValidateEmail_front($('[name="femail"]').val())){
			$("#id-error-femail").html("Please enter valid email.");
				return false;
		}
		
		$.ajax({
				url: site_url+'home/forgotpassword',
				data:{emailid:emailid},
				type:"post",
				success: function(data){
					if(data.trim() !=1){
						$("#error_forgot_password").html(data);	
					}else{
							//return false;
							location.reload();
					}
				}
		});
		return false;
	});


});