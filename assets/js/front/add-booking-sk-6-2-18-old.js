function ValidateEmail_front(email) {
	//var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	//var expr = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	//var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return expr.test(email);
}
function valid_first_letter(email){ 
	var regexp = /^[a-z 0-9]/;	
	return regexp.test(email);
}

$(".prv_date_pick").each(function(){
	$(this).datepicker({
      dateFormat: "yy-m-d",
      changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
      }); 
});


$(document).ready(function(){

	$("#passen-user-form").submit(function(){

		var validArr = [];		
		if($("#guest-name").val().trim() ==''){
			$("#guest-name").addClass("valid-cls");
			validArr[0] = false;
			//return false;
		}else{
			var guest_name = $("#guest-name").val();
			var charRegExp = /^[a-zA-Z ']+$/;
		 	if(guest_name.search(charRegExp)!=0 ){
	 			$("#error_guest_name").html("Invalid Name entered.");				   
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
	 	if(guest_phoneno == '' ){	 	
		$("#guest-phone").addClass("valid-cls");
		//return false;
		validArr[1] = false;
		}else if(guest_phoneno.length <10 || guest_phoneno.length>14){
			$("#error_guest_phone").html("Please enter min 10 and max 14 digits contact number.");
			$("#guest-phone").addClass("valid-cls");
			//return false;
			validArr[1] = false;
		}else if(isNaN(guest_phoneno)){			
			$("#guest-phone").addClass("valid-cls");
			$("#error_guest_phone").html("Only numbers are allowed.");
			//return false;
			validArr[1] = false;
		}else{			
			$("#guest-phone").removeClass("valid-cls");
			$("#error_guest_phone").html("");
			//return true;
			validArr[1] = true;
		}
		
		if($("#guest-email").val().trim() ==''){
			$("#guest-email").addClass("valid-cls");			
			validArr[2] = false;
		}else if(!ValidateEmail_front($("#guest-email").val())){
			$("#guest-email").addClass("valid-cls");			
			validArr[2] = false;
		}else if(!valid_first_letter($("#guest-email").val())){
			$("#guest-email").addClass("valid-cls");
			validArr[2] = false;
		}else{			
			$("#guest-email").removeClass("valid-cls");			
			validArr[2] = true;
		}
	    

		var first_name = $(".first_name").val();
		if(first_name ==''){
			$(".first_name").addClass("valid-cls");
			validArr[3] = false;			
		}else{			
			var charRegExp = /^[a-zA-Z ']+$/;
		 	if(first_name.search(charRegExp)!=0 ){
	 			$("#error_first_name").html("Invalid First Name entered.");				   
		    	validArr[3] = false;		    
			}else{
				$(".first_name").removeClass("valid-cls");
				$("#error_first_name").html("");
				validArr[3] = true;					
			}		
		}

		var last_name = $(".last_name").val();
		if(last_name ==''){
			$(".last_name").addClass("valid-cls");
			validArr[4] = false;			
		}else{			
			var charRegExp = /^[a-zA-Z ']+$/;
		 	if(last_name.search(charRegExp)!=0 ){
	 			$("#error_last_name").html("Invalid Last Name entered.");				   
		    	validArr[4] = false;		    	
			}else{
				$(".last_name").removeClass("valid-cls");
				$("#error_last_name").html("");	
				validArr[4] = true;					
			}		
		}
	    
		var id_number = $(".id_number").val();
	 	if(id_number == '' ){	 	
		$(".id_number").addClass("valid-cls");		
		validArr[5] = false;
		}else if(isNaN(id_number)){			
			$(".id_number").addClass("valid-cls");
			$("#error_id_number").html("Only numbers are allowed.");			
			validArr[5] = false;
		}else{			
			$(".id_number").removeClass("valid-cls");
			$("#error_id_number").html("");			
			validArr[5] = true;
		}

		
		$(".passport-cls").each(function(){
			var $this =$(this);
		   if(($this.val().trim() =='')) {
	    	    $this.addClass("valid-cls");
	    	    //return true;
	    	    validArr[6] = false;
			} else {
				$this.removeClass("valid-cls");
				
			}
		});

		var country_passport = $(".country_passport").val();		
		if(country_passport == ''){
			$(".country_passport").addClass("valid-cls");	
			validArr[7] = false;
		}else{			
			$(".country_passport").removeClass("valid-cls");				
			validArr[7] = true;
		}


		var pass_expire_date = $(".pass_expire_date").val();
		
		if(pass_expire_date == ''){
			$(".pass_expire_date").addClass("valid-cls");	
			validArr[8] = false;
		}else{
			   var selectedDate = new Date(pass_expire_date);
			   var now = new Date();
			   if (selectedDate < now){
			   		$(".pass_expire_date").addClass("valid-cls");
			   		$("#error_pass_expire_date").html("Date must be in the future.");
			   		validArr[8] = false;
			   }else{
		   			$(".pass_expire_date").removeClass("valid-cls");
		   			$("#error_pass_expire_date").html("");
					validArr[8] = true;		  
				}
			}

			var date_of_birth = $(".date_of_birth").val();
			if(date_of_birth == ''){
				$(".date_of_birth").addClass("valid-cls");	
				validArr[9] = false;
			}else{
			   var selectedDate = new Date(date_of_birth);
			   var now = new Date();
			   if (selectedDate > now){
			   		$(".date_of_birth").addClass("valid-cls");
			   		$("#error_date_of_birth").html("Invalid date format!");
			   		validArr[9] = false;
			   }else{
		   			$(".date_of_birth").removeClass("valid-cls");
		   			$("#error_date_of_birth").html("");
					validArr[9] = true;		  
				}
			}
		/*$(".fname-cls").each(function(){
			var $this =$(this);
			//var corrent_colum = $this[0].val();
			//alert($this.val().trim());
			//console.log(corrent_colum);
		   if($this.val().trim() ==''){
	    	    $this.addClass("valid-cls");
	    	    //return false;
	    	    validArr[3] = false;
			} else {
				$this.removeClass("valid-cls");
				
			}
		});*/

		console.log(validArr.length);

		for(i=0;i<validArr.length;i++){
			if(validArr[i] == false){ 
				return false;
			}
		}
		/*for(i=0; i<validArr.length;i++){
			if(validArr[i] == false){
				return false;
			}else
			{
				return true;
			}
		} */
	});

$(".passport-cls").keydown(function (e) {
	// Allow: backspace, delete, tab, escape, enter and .
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
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

jQuery("#hotel-pay-form").validate({
	errorClass: "error",
	errorElement: "span",
      rules: {
          guest_name: {
               required: true,
          },
          guest_phone:{
			   required: true,
		       numberonly: true,
			   minlength: 10,
			   maxlength: 10
		  },
		  guest_email:{
			   required: true,
			   email: true,
		  },
		  
     },
      messages: {
          guest_name: {
               required: "Please enter name."
           },
          guest_phone: {
               required: "Please enter contact number."
           },
          guest_email: {
               required: "Please enter email.",
               email: 'Please enter a valid email.'
           },
          
     }, 
 });
});

jQuery.validator.addMethod("numberonly", function (value, element) {
    return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Please enter number only ");

