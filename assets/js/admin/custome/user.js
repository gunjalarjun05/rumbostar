$("#oldpassword").val('');
$("#change_password").submit(function(){
	$(".gif-loader").show();
	$(".add-form-error-msg").html('');
	var validArr = [];
	if($("#oldpassword").val().trim() == '' ){
		$("#error_oldpassword").html("Please enter old password.");
		validArr[0] = false;
	}else if($("#oldpassword").val().length >6){
		$("#error_oldpassword").html('old password max length is 6 characters only.');
		validArr[0] = false;
	}
	
	if($("#newpassword").val().trim() == '' ){
		$("#error_newpassword").html("Please enter new password.");
		validArr[1] = false;
	}else {
		var newpass = $("#newpassword").val().length;
		if(newpass <= 5){
			$("#error_newpassword").html('New password max length must be 6 characters only.');
			validArr[1] = false;		
		}
	}

	if($("#cpassword").val().trim() == '' ){
		$("#error_cpassword").html("Please enter confirm password.");
		validArr[2] = false;
	}else if($("#cpassword").val() != $("#newpassword").val() ){
		$("#error_cpassword").html("Password and confirm password does not match.");
		validArr[2] = false;
	}
	if($("#oldpassword").val()!=''  && $("#newpassword").val() !='' ){
		if($("#oldpassword").val() == $("#newpassword").val() ){
			$("#error_newpassword").html("Old password & New password should not be same.");
			validArr[3] = false;
		}
	}
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){
			$(".gif-loader").hide();
			return false;
		}
	}
	$.ajax({
		url:site_url+'dashboard/change_password',
		data:$("#change_password").serialize(),
		type:'post',
		dataType:'json',
		success:function(data){
			if(data.status == 'error' ){
				$(".old-pass-error").html(data.msg);
				$(".gif-loader").hide();
				return false;
			}else{
				//$(".old-pass-error").html(data.msg).css("color","green");
				$(".gif-loader").hide();
				window.location.reload();
				return false;
			}
		}
	});
	return false;
});
$('.only-alphabets').keypress(function(key) {
	if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)){
		if(key.charCode==0){

		}else{
			return false;
		}
	} 
});
$("#mobileno").keydown(function (e) {
	// Allow: backspace, delete, tab, escape, enter and .
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		 // Allow: Ctrl+A, Command+A
		(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
		 // Allow: home, end, left, right, down, up
		(e.keyCode >= 35 && e.keyCode <= 40)) {
			 // let it happen, don't do anything
			 return;
	}
	// Ensure that it is a number and stop the keypress
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}	
});

$("#userinfo_form").submit(function(data){
	$(".add-form-error-msg").html('');
	var validArr = [];
	if($("#username").val().trim() == '' ){
		$("#error_username").html("Please enter name.");
		validArr[0] = false;
	}else if($("#username").val().length >50){
		$("#error_username").html('Name max length is 50 characters only.');
		validArr[0] = false;
	}
	if($("#mobileno").val().trim() == '' ){
		$("#error_mobileno").html("Please enter mobile number.");
		validArr[2] = false;
	}else if($("#mobileno").val().length != 12 ){
		$("#error_mobileno").html("Please enter mobile number 12 digits only.");
		validArr[2] = false;
	}else if(isNaN($("#mobileno").val())){
		$("#error_mobileno").html("Please enter mobile number digits only.");
		validArr[2] = false;
	}
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){ 
			return false;
		}
	}
});
