
$(".travelling_way").click(function(){
		var cust_id = $(this).attr("data-id");
		$.ajax({
		url:site_url+'user/customer_travelling_detail',
		data:{'cust_id':cust_id},
		type:'post',
		dataType:'json',
		success:function(results){
			console.log(results);
			$('#travell_data tbody').empty();

			$.each(results, function( index, value ) {				 

		      var elem = '<tr>'+
		       	'<td>';
		       	if(value.travelling_type == '0'){
					elem += '<span class="travelling_way">Flight</span>';
				}

				if(value.travelling_type == '1'){
					elem += '<span class="travelling_way">Hotel</span>';
				}
				if(value.travelling_type == '2'){
					elem +='<span class="travelling_way">Train</span>';
				}

		       elem +='</td>';
		       elem +='<td>'+
		      '<span class="no_of_passenger">'+ value.no_of_passenger+'</span>'+
		      '</td>';
		      var date=value.date_of_booking.split(' ')[0];
		      elem +='<td><span class="booking_date">'+date+'</span></td></tr>';
				
			$('#travell_data tbody').append(elem);
			  
			});
			
		}
	});

});


$(".add_booking").click(function(){
var cust_id = $(this).attr("data-id");
$("#cust_id").val(cust_id);
});

$("#customer_booking_form").submit(function(data){
alert('hii');

$(".add-form-error-msg").html('');
	$(".add-form-error-msg").css('color','red');
	var validArr = [];

	if($("#no_of_passenger").val().trim() == ''){
		$("#error_passenger").html("Please select no of passenger.");
		validArr[0] = false;
	}

	if($("#travelling_way").val().trim() == ''){
		$("#error_travelling_way").html("Please select travelling Way.");
		validArr[1] = false;
	}

	var dtToday = new Date();
	var nowdate = (dtToday.getMonth() + 1) + '/' + dtToday.getDate() + '/' +  dtToday.getFullYear();
	var todaydate = new Date(nowdate);
	var pass_exp_date = new Date($("#booking_date").val());

	if($("#booking_date").val().trim() == ''){
		$("#error_booking_date").html("Please select Booking Date.");
		validArr[2] = false;
	}else if(pass_exp_date < todaydate){
		$("#error_booking_date").html("Date must be in the future.");
		validArr[2] = false;
	}


	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){ 
			return false;
		}
	}

});


/*function mysearchCustomer(){
	var inputval = $('#search_customer').val();
	alert(inputval);
	$.ajax({
        type: 'POST',
        url: "/customer-details",  
        data: {'searchval':inputval},      
        dataType: "json",
        success: function(resultDatas) {
         console.log(resultDatas); 
                    
                    
      }       
  });
}*/