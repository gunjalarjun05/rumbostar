//click event on delete user
function delete_user(userid){
	var result = confirm("Are you sure you want to delete this?");
	if (result) {
		//Logic to delete the item
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {id:userid};
		commanObj.ajax_call(site_url+'user_management/delete');		
	}	
}
//funcction for change status 
function change_user_status(userid,status,user){
	var status_s = status.value;
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:userid,status:status_s,user:user};
	commanObj.ajax_call(site_url+'user_management/change_user_status');		
}

//click event on delete agent
function delete_agent(userid){
	var result = confirm("Are you sure you want to delete this?");
	if (result) {
		//Logic to delete the item
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {id:userid};
		commanObj.ajax_call(site_url+'agent_management/delete');		
	}	
}
//funcction for change status 
function change_agent_status(userid,status,user,username,emailid,agentcode){
	var status_s = status.value;
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:userid,status:status_s,user:user,username:username,emailid:emailid,agentcode:agentcode};
	commanObj.ajax_call(site_url+'agent_management/change_user_status');		
}

function change_user_status_link(userid,status,user){
	var status_s = status.getAttribute("status_change");
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:userid,status:status_s,user:user};
	commanObj.ajax_call(site_url+'user_management/change_user_status');	
}
//event for add user popup
$("#add-user-btn").click(function(){

	var formData = $("#user_form").serialize();
	$("#add-edit-popup").modal('show');

	$.ajax({
		url:site_url+'agent_management/countryinfo',		
		type:'post',
		dataType: 'json',
		success:function(data){
			if(data.status == 'success'){
				
				$.each(data.countriesinfo, function( index, value ) {
				  console.log(value['country_code'] );
				  $('#countriesSelect').append('<option id='+value['sortname']+' value='+value["country_code"]+'>'+value['country_code']+'</option>');
				});
			}
		}
	});

	$(".add-user-fields").show();
	$("#userid").val('');
	$("#error_fname").text('');
	$("#error_emailid").text('');
	$("#error_pass").text('');
	$("#pass").val('');
	$("#error_cpass").text('');
	$("#cpass").val('');
	$("#error_mobile_no").text('');
	$("#user_form").find('input[type="text"]').val('');
});

//function for edit popup

function edit_user(id){
	$.ajax({
		url:site_url+'user-management/userinfo',
		data:{id:id},
		type:'post',
		dataType: 'json',
		success:function(data){
			if(data.status == 'success'){
				$(".add-user-fields").hide();
				$("#fname").val(data.userinfo.fname);
				$("#lname").val(data.userinfo.lname);
				$("#emailid").val(data.userinfo.email);
				$("#mobile_no").val(data.userinfo.mobile_no);
				$("#add_form").val('update');
				$("#userid").val(id);
				$("#add-edit-popup").modal('show');
			}
		}
	});
	return false;	
}
$('.only-alphabets').keypress(function(key) {
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)){
			if(key.charCode==0){

			}else{
				return false;
			}
		} 
	});
//submit event for add or edit popup
$("#add_edit_user_btn").click(function(){
	var valid_arr = [];
	$(".add-form-error-msg").html('');
	if($("#name").val().trim() ==''){
		$("#error_fname").html('Please enter name.');
		valid_arr[0] = false;
	}else if($("#name").val().length >50){
		$("#error_fname").html('Name max length is 50 characters only.');
		valid_arr[0] = false;
	}
	if($("#add_form").val() !='update'){
		if($("#emailid").val().trim() ==''){
			$("#error_emailid").html('Please enter email.');
			valid_arr[2] = false;
		}else if($("#emailid").val().length >50){
			$("#error_emailid").html('Email max length is 50 characters only.');
			valid_arr[2] = false;
		}else if(!check_first_char_in_string($("#emailid").val())){
			$("#error_emailid").html('Please enter valid email.');
			valid_arr[2] = false;
		}
		if($("#pass").val() ==''){
			$("#error_pass").html('Please enter password.');
			valid_arr[4] = false;
		}else if($("#pass").val().length >30){
			$("#error_pass").html('Password max length is 30 characters only.');
			valid_arr[4] = false;
		}else if($("#pass").val().length <8){
			$("#error_pass").html('Your password must be at least 8 characters long..');
			valid_arr[4] = false;
		}
		if($("#cpass").val() ==''){
			$("#error_cpass").html('Please enter confirm password.');
			valid_arr[5] = false;
		}else if($("#pass").val() != $("#cpass").val()){
			$("#error_cpass").html('Password and confirm password does not match.');
			valid_arr[6] = false;
		}
	}
	if($("#mobile_no").val().trim() ==''){
		$("#error_mobile_no").html('Please enter mobile number.');
		valid_arr[3] = false;
	}else if($("#mobile_no").val().length < 10 && ($("#mobile_no").val().length > 14)){
		$("#error_mobile_no").html('Mobile number should be 10 or 14 digits only.');
		valid_arr[3] = false;
	}
	
	for(i=0;i<valid_arr.length;i++){
		if(valid_arr[i] == false){
			return false;
		}
	}
	var formData = $("#user_form").serialize();
	$.ajax({
		url:site_url+'agent_management/add',
		data:formData,
		type:'post',
		dataType: 'json',
		success:function(data){
			$(".add-form-error-msg").html('');
			if(data.validationError.fname){
				$("#error_fname").html(data.validationError.fname);
			}
			if(data.validationError.lname){
				$("#error_lname").html(data.validationError.lname);
			}
			if(data.validationError.email){
				if(data.validationError.email =="The Email field must contain a unique value."){
					$("#error_emailid").html('Email already exits.');
				}else{
					$("#error_emailid").html(data.validationError.email);
				}
			}
			if(data.validationError.mobile_no){
				$("#error_mobile_no").html(data.validationError.mobile_no);
			}
			if(data.validationError.pass){
				$("#error_pass").html(data.validationError.pass);
			}
			if(data.validationError.cpass){
				$("#error_cpass").html(data.validationError.cpass);
			}
			if(data.status == 'general_error' || data.validationError.length !=0){
				$("#submit_error").html(data.msg);
				return false;
			}else{
				window.location.reload(); 
				return false;	
			}			
			
		}
	});
	return false;
});


$("#general_info").submit(function(){
	var valid_arr = [];
	$(".add-form-error-msg").html('');
	if($("#owner_fname").val().trim() ==''){
		$("#error_owner_fname").html('Please enter first name.');
		valid_arr[0] = false;
	}else if($("#owner_fname").val().length>50){
		$("#error_owner_fname").html('First name max length is 50 characters only.');
		valid_arr[0] = false;
	}
	if($("#owner_lname").val().trim() ==''){
		$("#error_owner_lname").html('Please enter last name.');
		valid_arr[1] = false;
	}else if($("#owner_lname").val().lenght>50){
		$("#error_owner_lname").html('Last name max length is 50 characters only.');
		valid_arr[1] = false;
	}
	
	if($("#add_form").val() !='update'){ 
		if($("#owner_email").val().trim() ==''){
			$("#error_owner_email").html('Please enter email.');
			valid_arr[2] = false;
		}else if(!ValidateEmail($("#owner_email").val())){
			$("#error_owner_email").html('Please enter valid email.');
			valid_arr[2] = false;
		}else if($("#owner_email").val().length>50){
			$("#error_owner_email").html('Email max length is 50 characters only.');
			valid_arr[2] = false;
		}else if(!check_first_char_in_string($("#owner_email").val())){
			$("#error_owner_email").html('Please enter valid email.');
			valid_arr[2] = false;
		}else if(!check_first_char_in_string($("#owner_email").val())){
			$("#error_owner_email").html('Please enter valid email.');
			valid_arr[2] = false;
		}		
		if($("#owner_password").val() ==''){
			$("#error_owner_password").html('Please enter password.');
			valid_arr[4] = false;
		}else if($("#owner_password").val().length<8){
			$("#error_owner_password").html('Password minimum length is 8 characters only.');
			valid_arr[4] = false;
		}
		
		if($("#owner_cpassword").val() ==''){
			$("#error_owner_cpassword").html('Please enter confirm password.');
			valid_arr[5] = false;
		}else if($("#owner_password").val() != $("#owner_cpassword").val()){
			$("#error_owner_cpassword").html('Password and confirm password does not match.');
			valid_arr[6] = false;
		}
		
	}
	if($("#owner_phno").val().trim() !='' && $("#owner_phno").val().length!=10){
		$("#error_owner_phno").html('Alternate contact number should be 10 digits only.');
		valid_arr[3] = false;
	}
	if($("#owner_mobile").val().trim() ==''){
		$("#error_owner_mobile").html('Please enter contact number.');
		valid_arr[7] = false;
	}else if($("#owner_mobile").val().length!=10){
		$("#error_owner_mobile").html('Contact number should be 10 digits only.');
		valid_arr[7] = false;
	}	
	/*if($("#owner_paypal_id").val().trim() ==''){
		$("#error_owner_paypal_id").html('Please enter paypal email.');
		valid_arr[1] = false;
	}else*/
	 if($("#owner_paypal_id").val().trim() !='' && !ValidateEmail($("#owner_paypal_id").val())){
		$("#error_owner_paypal_id").html('Please enter valid paypal email.');
		valid_arr[1] = false;
	}else if($("#owner_paypal_id").val().length>50){
		$("#error_owner_paypal_id").html('Paypal email max length is 50 characters only.');
		valid_arr[1] = false;
	}else if(!check_first_char_in_string($("#owner_paypal_id").val())){
		$("#error_owner_paypal_id").html('Please enter valid paypal ID.');
		valid_arr[1] = false;
	}
	if($("#country").val()== ''){
		$("#error_country").html('Please select state.');
		valid_arr[11] = false;
	}
	if($("#city").val()== ''){
		$("#error_city").html('Please select city.');
		valid_arr[12] = false;
	}
	if($("#company_postal_code").val()== ''){
		$("#error_company_postal_code").html('Please enter postalcode.');
		valid_arr[8] = false;
	}
	if($("#company_postal_code").val()== ''){
		$("#error_company_postal_code").html('Please enter postalcode.');
		valid_arr[8] = false;
	}else if($("#company_postal_code").val().length>10){
		$("#error_company_postal_code").html('Postalcode max length is 10 characters only.');
		valid_arr[8] = false;
	}
	if($("#company_addr").val().trim() ==''){
		$("#error_company_addr").html('Please enter address.');
		valid_arr[9] = false;
	}else if($("#company_addr").val().length>250){
		$("#error_company_addr").html('Company adrress max length is 250 characters only.');
		valid_arr[9] = false;
	}
	if($("#company_name").val().length>50){
		$("#error_company_name").html('Company name max length is 50 characters only.');
		valid_arr[10] = false;
	}
	/*if($("#country>option:selected").val().trim() ==''){
		$("#error_country").html('Please select state');
		valid_arr[7] = false;
	}
	if($("#city>option:selected").val().trim() ==''){
		$("#error_city").html('Please select city');
		valid_arr[8] = false;
	}*/
	for(i=0;i<valid_arr.length;i++){
		if(valid_arr[i] == false){
			return false;
		}
	}	
});

 $("#owner_phno").keydown(function (e) {
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
$("#owner_mobile").keydown(function (e) {
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
$("#company_postal_code").keydown(function (e) {
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

$("#mobile_no").keydown(function (e) {
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



