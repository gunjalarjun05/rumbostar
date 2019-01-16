$("#contactinfo_form").submit(function(){
	$(".add-form-error-msg").html('');
	var validArr = [];
	if($("#name").val().trim() == '' ){
		$("#error_name").html("Please enter name.");
		validArr[0] = false;
	}else if($("#name").val().length >50){
		$("#error_name").html('Name max length is 50 characters only.');
		validArr[0] = false;
	}if($("#email").val().trim() ==''){
			$("#error_email").html("Please enter email.");
			validArr[1] = false;
	}if($("#contactno").val().trim() == '' ){
		$("#error_contactno").html("Please enter mobile number.");
		validArr[2] = false;
	}else if($("#contactno").val().length < 4 ||  $("#contactno").val().length > 16){
		$("#error_contactno").html("Please enter mobile number min 4 and max 16 digits only.");
		validArr[2] = false;
	}else if(isNaN($("#contactno").val())){
		$("#error_contactno").html("Please enter mobile number digits only.");
		validArr[2] = false;
	}
	if($("#subject").val().trim() == '' ){
		$("#error_subject").html("Please enter subject.");
		validArr[3] = false;
	}
	if($("#message").val().trim() == '' ){
		$("#error_message").html("Please enter message.");
		validArr[4] = false;
	}
	$(".add-form-error-msg").css("color","red");
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){
			return false;
		}
	}
	/*$.ajax({
		url:site_url+'static_pages/contactus',
		data:$("#contactinfo_form").serialize(),
		type:'POST',
		dataType:'json',
		success:function(data){
			if(data.status == 'error' ){
				$(".old-pass-error").html(data.msg);
				return false;
			}else{
				window.location.reload();
				return false;
			}
		}
	});
	return false;*/
});

$('.only-alphabets').keypress(function(key) {
	if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)){
		if(key.charCode==0){

		}else{
			return false;
		}
	} 
});
$("#contactno").keydown(function (e) {
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