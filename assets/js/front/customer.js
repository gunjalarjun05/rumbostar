

	// following code set country flags using css
	var countryShortName = '';
	if($('#countriesSelects').val() != ''){
		var shortName = $("#country_sortName").attr('class');	
		countryShortName = shortName.toLowerCase();
		$("#country_flag").addClass(countryShortName);
	}

	$("#countriesSelects").change(function() {
		$("#country_flag").removeClass(countryShortName);
		if($('#countriesSelects').val() != ''){  	
			var shortNames = $('#countriesSelects').find('option:selected').attr('id'); 
			var countryShortNames = shortNames.toLowerCase();
			$("#country_flag").addClass(countryShortNames); 
		}
	});
	// following code set country flags using css end

function valid_first_letter(email){ 
	var regexp = /^[a-z 0-9]/;	
	return regexp.test(email);
}

function ValidateEmail_front(email) {	
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	return expr.test(email);
}


$("#customer_form").submit(function(data){ 

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
		
	if($("#phone").val().trim() == '' && $("#countriesSelects").val() == '' ){
		$("#error_phone").html("Please select country code and enter mobile number.");
		validArr[2] = false;
	}else if($("#phone").val().length < 4 ||  $("#phone").val().length > 16){
		$("#error_phone").html("Please enter mobile number min 4 and max 16 digits only.");
		validArr[2] = false;
	}else if(isNaN($("#phone").val())){
		$("#error_phone").html("Please enter mobile number digits only.");
		validArr[2] = false;
	}else if($("#countriesSelects").val() == ''){
		$("#error_phone").html("Please select country code.");
		validArr[2] = false;	
	}

	if($("#email").val().trim() == ''){
		$("#error_email").html("Please enter email Id.");
		validArr[3] = false;
	}else if(!ValidateEmail_front($("#email").val())){
		$("#error_email").html("Please enter valid email.");
		validArr[3] = false;
	}else if(!valid_first_letter($("#email").val())){
		$("#error_email").html("Please enter valid email.");
		validArr[3] = false;
	}


	if($("#no_of_passenger").val().trim() == ''){
		$("#error_passenger").html("Please select no of passenger.");
		validArr[4] = false;
	}

	if($("#travelling_way").val().trim() == ''){
		$("#error_travelling_way").html("Please select travelling Way.");
		validArr[5] = false;
	}



	var dtToday = new Date();
	var nowdate = (dtToday.getMonth() + 1) + '/' + dtToday.getDate() + '/' +  dtToday.getFullYear();
	var todaydate = new Date(nowdate);
	var pass_exp_date = new Date($("#booking_date").val());

	if($("#booking_date").val().trim() == ''){
		$("#error_booking_date").html("Please select Booking Date.");
		validArr[6] = false;
	}else if(pass_exp_date < todaydate){
		$("#error_booking_date").html("Date must be in the future.");
		validArr[6] = false;
	}


	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){ 
			return false;
		}
	}

});

