$("#oldpassword").val('');
$("#change_password").submit(function(){
	$(".add-form-error-msg").html('');
	$(".add-form-error-msg").css('color','red');
	var validArr = [];
	if($("#oldpassword").val().trim() == '' ){
		$("#error_oldpassword").html("Please enter old password.");
		validArr[0] = false;
	}else if($("#oldpassword").val().length<6){
		$("#error_oldpassword").html('old password max length is 6 characters only.');
		validArr[0] = false;
	}
	if($("#newpassword").val().trim() == '' ){
		$("#error_newpassword").html("Please enter new password.");
		validArr[1] = false;
	}else if($("#newpassword").val().length<6){
		$("#error_newpassword").html('New password max length is 6 characters only.');
		validArr[0] = false;
	}
	if($("#cpassword").val().trim() == '' ){
		$("#error_cpassword").html("Please enter confirm password.");
		validArr[2] = false;
	}else if($("#cpassword").val() != $("#newpassword").val() ){
		$("#error_cpassword").html("New password and confirm password does not same.");
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
			return false;
		}
	}
	$.ajax({
		url:site_url+'user/change_password',
		data:$("#change_password").serialize(),
		type:'post',
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
	return false;
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
	$(".add-form-error-msg").css('color','red');
	var validArr = [];

	if($("#first_name").val().trim() == '' ){
		$("#error_first_name").html("Please enter first name.");
		validArr[0] = false;
	}else if($("#first_name").val().length >50){
		$("#error_first_name").html('First name max length is 50 characters only.');
		validArr[0] = false;
	}else{
		var firstname = $("#first_name").val();
		var charRegExp = /^[a-zA-Z ']+$/;
		if(firstname.search(charRegExp)!=0 ){
	 		$("#error_first_name").html("Invalid first name entered.");				   
		    validArr[0] = false;
		}
	}

	if($("#last_name").val().trim() == '' ){
		$("#error_last_name").html("Please enter last name.");
		validArr[1] = false;
	}else if($("#last_name").val().length >50){
		$("#error_last_name").html('Last name max length is 50 characters only.');
		validArr[1] = false;
	}else{
		var lastname = $("#last_name").val();
		var charRegExp = /^[a-zA-Z ']+$/;
		if(lastname.search(charRegExp)!=0 ){
	 		$("#error_last_name").html("Invalid last name entered.");				   
		    validArr[1] = false;
		}
	}

	/*if($("#name").val().trim() == '' ){
		$("#error_name").html("Please enter name.");
		validArr[0] = false;
	}else if($("#name").val().length >50){
		$("#error_name").html('Name max length is 50 characters only.');
		validArr[0] = false;
	}
*/
	if($("#email").val().trim() == ''){
		$("#error_email").html("Please enter email Id.");
		validArr[2] = false;
	}else if(!ValidateEmail_front($("#email").val())){
		$("#error_email").html("Please enter valid email.");
		validArr[2] = false;
	}else if(!valid_first_letter($("#email").val())){
		$("#error_email").html("Please enter valid email.");
		validArr[2] = false;
	}

	
	if($("#phone").val().trim() == '' && $("#countriesSelects").val() == '' ){
		$("#error_phone").html("Please select country code and enter mobile number.");
		validArr[3] = false;
	}else if($("#phone").val().length < 10 ||  $("#phone").val().length > 14){
		$("#error_phone").html("Please enter mobile number min 10 and max 14 digits only.");
		validArr[3] = false;
	}else if(isNaN($("#phone").val())){
		$("#error_phone").html("Please enter mobile number digits only.");
		validArr[3] = false;
	}else if($("#countriesSelects").val() == ''){
		$("#error_phone").html("Please select country code.");
		validArr[3] = false;	
	}

	var dtToday = new Date();
	var nowdate = (dtToday.getMonth() + 1) + '/' + dtToday.getDate() + '/' +  dtToday.getFullYear()
	var todaydate = new Date(nowdate);
	var birth_date = new Date($("#birth_date").val());
	//console.log(todaydate);
	//console.log(birth_date);

	
	if($("#birth_date").val().trim() == ''){
		$("#error_birth_date").html("Please select Birth Date.");
		validArr[4] = false;
	}else if($("#birth_date").val().trim() == nowdate){
		$("#error_birth_date").html("Please select Valid Date.");
		validArr[4] = false;
	}else if(birth_date >= todaydate){
		$("#error_birth_date").html("You cannot enter a date in the future!");
		validArr[4] = false;
	}

	if($("#passport_no").val().trim() == ''){
		$("#error_passport_no").html("Please enter your passport number.");
		validArr[5] = false;
	}

	if($("#card_type").val().trim() == ''){
		$("#error_card_type").html("Please select your Card type.");
		validArr[6] = false;
	}

	if($("#card_number").val().trim() == ''){
		$("#error_card_number").html("Please enter your Card number.");
		validArr[7] = false;
	}


	if($("#card_holder_name").val().trim() == ''){
		$("#error_card_holder_name").html("Please enter your Card holder name.");
		validArr[8] = false;
	}else{
		var cardholdername = $("#card_holder_name").val();
		var charRegExp = /^[a-zA-Z ']+$/;
		if(cardholdername.search(charRegExp)!=0 ){
	 		$("#error_card_holder_name").html("Invalid card holder name entered.");				   
		    validArr[8] = false;
		}
	}

	
	//var mothYr = (dtToday.getMonth() + 1) + '/' +  dtToday.getFullYear();
	//console.log(mothYr);
	var today, expirydate;
	var expiry = $("#expiry").val().trim();	
	var expDate= expiry.split("/");
	today = new Date();
	expirydate = new Date();
	expirydate.setFullYear(expDate[1], expDate[0], 1);	
	console.log(expirydate);

	if($("#expiry").val().trim() == ''){
		$("#error_expiry_date").html("Please enter your Card expiry date.");
		validArr[9] = false;
	}else if(expirydate < today){
		$("#error_expiry_date").html("The expiry date is before today's date. Please select a valid expiry date");
		validArr[9] = false;
	}

console.log(validArr);

	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){ 
			return false;
		}
	}
});

$("#social-profile").submit(function(data){  
	$(".add-form-error-msg").html(''); 
	$(".add-form-error-msg").css('color','red');
	var validArr = [];
	if($("#name").val().trim() == '' ){
		$("#error_name").html("Please enter name.");
		validArr[0] = false;
	}else if($("#name").val().length >50){
		$("#error_name").html('Name max length is 50 characters only.');
		validArr[0] = false;
	}
	if($("#phone").val().trim() == '' ){
		$("#error_phone").html("Please enter mobile number.");
		validArr[2] = false;
	}else if($("#phone").val().length < 10 || $("#phone").val().length > 14 ){
		$("#error_phone").html("Please enter mobile number min 10 and max 14 digits only.");
		validArr[2] = false;
	}else if(isNaN($("#phone").val())){
		$("#error_phone").html("Please enter mobile number digits only.");
		validArr[2] = false;
	}
	  
	if($("#id_emailid").val().trim() ==''){ 
		$("#error_email").html("Please enter email.");
		validArr[3] = false;
	}else if(!ValidateEmail_front($("#id_emailid").val())){
		$("#error_email").html("Please enter valid email.");
		validArr[3] = false;
	}else if(!valid_first_letter($("#id_emailid").val())){
		$("#error_email").html("Please enter valid email.");
		validArr[3] = false;
	}
		
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){ 
			return false;
		}
	}
});

//sk add validation for my wallet textbox user-profile page 12-12-2017
$("#my-wallet-form").submit(function(){

	var validArr = [];
	if($("#add_balance").val().trim() == '' ){		
		$(".add-form-error-msg").css('color','red');
		$("#error_add_balance").html("Please enter amount.");
		validArr[0] = false;
	}else if($("#add_balance").val().trim() == 0){		
		$(".add-form-error-msg").css('color','red');
		$("#error_add_balance").html("Please enter amount at list 1.");
		validArr[0] = false;
	}




	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){ 
			return false;
		}
	}

});
