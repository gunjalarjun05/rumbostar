function ValidateEmail_front(email) {	
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	return expr.test(email);
}

function valid_first_letter(email){ 
	var regexp = /^[a-z 0-9]/;	
	return regexp.test(email);
}

$(".prv_date_pick").each(function(){
	$(this).datepicker({
     	dateFormat: "yy-mm-d",
	  	changeMonth: true,
		changeYear: true,
	    showButtonPanel: true,
	    //todayHighlight: true,
	    minDate: 0,
      }); 
});

$(".birth_date_pick").each(function(){
	$(this).datepicker({
	  	dateFormat: "yy-mm-d",
	  	changeMonth: true,
		changeYear: true,
	    showButtonPanel: true, 
	    //todayHighlight: true,  
	    yearRange: '1945:'+(new Date).getFullYear(), 
  	}); 
})

$(document).ready(function(){

	$("#train-passen-user-form").submit(function(){
		var validArr = [];		

		if($("#guest-name").val().trim() ==''){
			$("#guest-name").addClass("valid-cls");
			validArr[0] = false;
			//return false;
		}else{
			var guest_name = $("#guest-name").val();
			var charRegExp = /^[a-zA-Z ']+$/;
		 	if(guest_name.search(charRegExp)!=0 ){
	 			$("#error_guest_name").html("Please enter valid name.");	
	 			$("#error_guest_name").css('color','red');			   
		    	validArr[0] = false;
		    	return false;
			}else{
				$("#guest-name").removeClass("valid-cls");
				$("#error_guest_name").html("");
				validArr[0] = true;	
				//return true;
			}		
		}


		var guest_phoneno = $("#guest-phone").val();
		var countrycode = $("#countriesSelects").val();
	 	if(guest_phoneno == '' ){	 	
		$("#guest-phone").addClass("valid-cls");	
		$("#countriesSelects").addClass("valid-cls");	
		//return false;
		validArr[1] = false;
		}else if(guest_phoneno.length < 4 || guest_phoneno.length >16){
			$("#error_guest_phone").html("Please enter min 4 and max 16 digits contact number.");
			$("#guest-phone").addClass("valid-cls");
			$("#error_guest_phone").css('color','red');
			//return false;
			validArr[1] = false;
		}else if(isNaN(guest_phoneno)){			
			$("#guest-phone").addClass("valid-cls");
			$("#error_guest_phone").html("Only numbers are allowed.");
			$("#error_guest_phone").css('color','red');
			//return false;
			validArr[1] = false;
		}else if(countrycode == ''){
		$("#countriesSelects").addClass("valid-cls");
		$("#error_guest_phone").html("Please select country code.");
		$("#error_guest_phone").css('color','red');
		validArr[1] = false;	
		}else{			
			$("#guest-phone").removeClass("valid-cls");
			$("#countriesSelects").removeClass("valid-cls");
			$("#error_guest_phone").html("");
			//return true;
			validArr[1] = true;
		}

		if($("#guest-email").val().trim() ==''){
			$("#guest-email").addClass("valid-cls");			
			validArr[2] = false;
		}else if(!ValidateEmail_front($("#guest-email").val())){
			$("#guest-email").addClass("valid-cls");
			$("#error_guest_email").css('color','red');
			$("#error_guest_email").html("Please enter valid email.");
			validArr[2] = false;
		}else if(!valid_first_letter($("#guest-email").val())){
			$("#guest-email").addClass("valid-cls");
			validArr[2] = false;
		}else{			
			$("#guest-email").removeClass("valid-cls");	
			$("#error_guest_email").html("");		
			validArr[2] = true;
		}
		
		var j = 3;


		$(".fname-cls").each(function(){			
			var $this =$(this);
			//console.log($this);	
			var name = $this[0].value;	
			//alert($this.attr('data-id'));		
			//var current_firstname = '#first-name-'+$this.attr('data-id');
			//var current_last_name = last_name
			if(name ==''){
	    	    $this.addClass("valid-cls");	  
	    	    validArr[j] = false;
			}else if($this.attr('data-name') == 'first_name'){
				
				var charRegExp = /^[a-zA-Z ']+$/;
				if(name.search(charRegExp)!=0 ){
	 				$("#error_first_name_"+$this.attr('data-id')).html("Invalid first name entered.");	
	 				$("#error_first_name_"+$this.attr('data-id')).css('color','red');			   
		    	validArr[j] = false;		    
				}else{
					$(".fname-cls").removeClass("valid-cls");
					$("#error_first_name_"+$this.attr('data-id')).html("");
					validArr[j] = true;				
				}				
							
			}else if($this.attr('data-name') == 'last_name'){
				var charRegExp = /^[a-zA-Z ']+$/;
				if(name.search(charRegExp)!=0 ){
	 				$("#error_last_name_"+$this.attr('data-id')).html("Invalid last name entered.");	
	 				$("#error_last_name_"+$this.attr('data-id')).css('color','red');			   
		    	validArr[j] = false;		    
				}else{
					$(".fname-cls").removeClass("valid-cls");
					$("#error_last_name_"+$this.attr('data-id')).html("");
					validArr[j] = true;				
				}

			}else if($this.attr('data-name') == 'id_number'){
				if(isNaN(name)){			
					$(".fname-cls").addClass("valid-cls");
					$("#error_id_number_"+$this.attr('data-id')).html("Only numbers are allowed.");
					$("#error_id_number_"+$this.attr('data-id')).css('color','red');			
					validArr[j] = false;
				}else{			
					$(".fname-cls").removeClass("valid-cls");
					$("#error_id_number_"+$this.attr('data-id')).html("");			
					validArr[j] = true;
				}
			}else if($this.attr('data-name') == 'pass_expire_date'){
					var dtToday = new Date();
					var nowdate = (dtToday.getMonth() + 1) + '/' + dtToday.getDate() + '/' +  dtToday.getFullYear();
					var todaydate = new Date(nowdate);
					var pass_exp_date = new Date(name);
					var month = dtToday.getMonth()+1;
					var currentdate =  dtToday.getFullYear()+'-'+((''+month).length<2 ? '0' : '') + month + '-' + dtToday.getDate();
					if(pass_exp_date < todaydate){
				   		$(".pass_expire_date").addClass("valid-cls");
				   		$("#error_pass_expire_date_"+$this.attr('data-id')).html("Date must be in the future.");
				   		$("#error_pass_expire_date_"+$this.attr('data-id')).css('color','red');
				   		validArr[j] = false;
				   }else if(name == currentdate){
				   		$(".pass_expire_date").addClass("valid-cls");
				   		$("#error_pass_expire_date_"+$this.attr('data-id')).html("Date must be in the future.");
				   		$("#error_pass_expire_date_"+$this.attr('data-id')).css('color','red');
				   		validArr[j] = false;
				   }else{
			   			$(".fname-cls").removeClass("valid-cls");
			   			$("#error_pass_expire_date_"+$this.attr('data-id')).html("");
						validArr[j] = true;	  
					}

			}else if($this.attr('data-name') == 'date_of_birth'){

				var dtTodays = new Date();
				var nowDates = (dtTodays.getMonth() + 1) + '/' + dtTodays.getDate() + '/' +  dtTodays.getFullYear()
				var tydate = new Date(nowDates);
				var birth_date = new Date(name);
				if(birth_date >= tydate){
					$("#error_date_of_birth_"+$this.attr('data-id')).html("You cannot enter a date in the future!");
					$("#error_date_of_birth_"+$this.attr('data-id')).css('color','red');
					validArr[j] = false;
				}else{
					$(".fname-cls").removeClass("valid-cls");
		   			$("#error_date_of_birth_"+$this.attr('data-id')).html("");
					validArr[j] = true;	  
				}
			}/*else if($this.attr('data-name') == 'country_name'){
				if(name == 'Indonesia'){
				//alert(name);					
					$("#id-card-no-"+$this.attr('data-id')).attr("disabled", true);
					$("#pass-expire-date-"+$this.attr('data-id')).attr("disabled", true);
				}else{
					
					$("#id-card-no-"+$this.attr('data-id')).removeAttr('disabled');
					$("#pass-expire-date-"+$this.attr('data-id')).removeAttr('disabled');
					$("#id-card-no-"+$this.attr('data-id')).addClass('fname-cls');
					$("#pass-expire-date-"+$this.attr('data-id')).addClass('fname-cls');
				}

			}*/
			else{
				$this.removeClass("valid-cls");	


			}
			console.log(validArr);			
			j++;
		});

		console.log(validArr.length);
		console.log(validArr);
		//$(".form-error").css("color","red");
		for(i=0;i<validArr.length;i++){
			if(validArr[i] == false){ 
				return false;
			}
		}




	});
});