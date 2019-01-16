//click event on delete single entry
function delete_function(id){
	var result = confirm("Do you want to delete this?");
	if (result) {
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {id:id};
		commanObj.ajax_call(site_url+'property/delete_animities');		
	}	
}
function set_unset_property_of_week(id,status,btn_id){
	$.ajax({
		url : site_url+'property/set_unset_property_of_week',
		data:{id:id,status:status},
		type:"post",
		dataType:"json",
		success:function(data){
			if(data.status =='success'){
				if(status == 1){
					$("#set_prop_"+btn_id).hide();
					$("#unset_prop_"+btn_id).show();
				}else{
					$("#unset_prop_"+btn_id).hide();
					$("#set_prop_"+btn_id).show();
				}
			}			
			var html = flash_message(data.status,data.message);
			$(".tbl-message").html(html);
			console.log(data);
		}
	});
}
//funcction for change status 
function change_status(id,status){
	var status_s = status.value;
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:id,status:status_s};
	commanObj.ajax_call(site_url+'property/change_animity_status');	
}
//slector js
$("#owner").select2();
$("#general_info_btn_prop").click(function(event){
	event.stopImmediatePropagation();
	$("#general_info_form .add-form-error-msg").html('');
	var is_valid = []; 
	if(edit_from == ''){
		if($('#owner>option:selected').val().trim() ==''){ 
			$("#error_owner").html('Please select owner.');
			is_valid[0] = false;
		}	
	}
	if($("#prop_name").val().trim() ==''){
		$("#error_prop_name").html('Please enter property name.');
		is_valid[1] = false;
	}else if($("#prop_name").val().length>50){
		$("#error_prop_name").html('Property name max lenght is 50 characters.');
		is_valid[1] = false;
	}
	if($("#category").val().trim() ==''){
		$("#error_category").html('Please select accommodation.');
		is_valid[2] = false;
	}
	if($("#condition").val().trim() ==''){
		$("#error_condition").html('Please select condition for room.');
		is_valid[3] = false;
	}
	if($("#room_type").val().trim() ==''){
		$("#error_room_type").html('Please enter room type.');
		is_valid[3] = false;
	}
	if($("#prop_desc").val().trim() ==''){
		$("#error_desc").html('Please enter property description.');
		is_valid[4] = false;
	}else if($("#prop_desc").val().length >500){
		$("#error_desc").html('property description max lenght is 500 characters.');
		is_valid[4] = false;
	}
	if($("#numberofbedrooms").val().trim() ==''){
		$("#error_numberofbedrooms").html('Please enter number of bedrooms.');
		is_valid[5] = false;
	}else if($.isNumeric($("#numberofbedrooms").val()) == false){
		$("#error_numberofbedrooms").html('Number of bedrooms contained only numeric values.');
		is_valid[5] = false;
	}else if($("#numberofbedrooms").val().length >10){
		$("#error_numberofbedrooms").html('Number of bedrooms max lenght is 10 digits.');
		is_valid[5] = false;
	}
	if($("#numberofbathrooms").val().trim() ==''){
		$("#error_numberofbathrooms").html('Please enter number of bathrooms.');
		is_valid[6] = false;
	}else if($.isNumeric($("#numberofbathrooms").val()) == false){
		$("#error_numberofbathrooms").html('number of bathrooms contained only numeric values.');
		is_valid[6] = false;
	}else if($("#numberofbathrooms").val().length>10){
		$("#error_numberofbathrooms").html('Number of bathrooms max lenght is 10 digits.');
		is_valid[6] = false;
	}
	if($("#country>option:selected").val().trim() ==''){
		$("#error_country").html('Please select state.');
		is_valid[7] = false;
	}
	if($("#city>option:selected").val().trim() ==''){
		$("#error_city").html('Please select city.');
		is_valid[8] = false;
	}
	if($("#postcode").val().trim() ==''){
		$("#error_postcode").html('Please enter postal code.');
		is_valid[9] = false;
	}else if($.isNumeric($("#postcode").val()) == false){
		$("#error_postcode").html('postcode contained only numeric values.');
		is_valid[9] = false;
	}else if($("#postcode").val().length>10){
		$("#error_postcode").html('Postcode max lenght is 10 digits.');
		is_valid[9] = false;
	}
	if($("#prop_addr").val().trim() ==''){
		$("#error_addr").html('Please enter address.');
		is_valid[10] = false;
	}else if($("#prop_addr").val().lenght>250){
		$("#error_addr").html('Address max lenght is 250 characters.');
		is_valid[10] = false;	
	}
	
	if(edit_from == ''){
		if($("#default_img").val() ==''){
			$("#error_img").html('Please select property default image.');
			is_valid[11] = false;
		}
	}
	if($("#price_per_night").val().trim() ==''){
		$("#error_price_per_night").html('Please enter price per night.');
		is_valid[12] = false;
	}else if($.isNumeric($("#price_per_night").val()) == false){
		$("#error_price_per_night").html('Price per night contained only numeric values.');
		is_valid[12] = false;
	}else if($("#price_per_night").val().length>20){
		$("#error_price_per_night").html('Price per night max lenght is 20 digits.');
		is_valid[12] = false;
	}else if($("#price_per_night").val()<200){
		$("#error_price_per_night").html('Price per night must be greater than 200.');
		is_valid[12] = false;
	}
	if($("#numberofadults").val().trim() ==''){ 
		$("#error_numberofadults").html("Please enter number of adults.");
		is_valid[13] = false;
	}else if($.isNumeric($("#numberofadults").val()) == false){
		$("#error_numberofadults").html("Number of adults contained only numeric values.");
		is_valid[13] = false;
	}else if($("#numberofadults").val().length>10){
		$("#error_numberofadults").html("Number of adults max lenght is 10 digits.");
		is_valid[13] = false;
	}
	if($("#numberofchild").val().trim() ==''){
		$("#error_numberofchild").html("Please enter number of children.");
		is_valid[14] = false;
	}else if($.isNumeric($("#numberofchild").val()) == false){
		$("#error_numberofchild").html("Number of children contained only numeric values.");
		is_valid[14] = false;
	}else if($("#numberofchild").val().length>10){
		$("#error_numberofchild").html("Number of children max lenght is 10 digits.");
		is_valid[14] = false;
	}
	for(i=0;i<is_valid.length;i++){
		if(is_valid[i] == false){
			return false;
		}
	}
	var formData = new FormData($("#general_info_form")[0]);	
	var addurl = site_url+'property/add_property';
	$.ajax({
			url: addurl,
			type: "post",
			data : formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success:function(data){
				
				if(data.status == 'error'){
					if(data.validationError.owner !=''){
						$("#error_owner").html(data.validationError.owner);
					}
					if(data.validationError.prop_name !=''){
						$("#error_prop_name").html(data.validationError.prop_name);
					}
					if(data.validationError.category !=''){
						$("#error_category").html(data.validationError.category);
					}
					if(data.validationError.condition !=''){
						$("#error_condition").html(data.validationError.condition);
					}
					if(data.validationError.prop_desc !=''){
						$("#error_desc").html(data.validationError.prop_desc);
					}
					if(data.validationError.no_of_bed !=''){
						$("#error_numberofbedrooms").html(data.validationError.no_of_bed);
					}
					if(data.validationError.no_of_bath !=''){
						$("#error_numberofbathrooms").html(data.validationError.no_of_bath);
					}
					if(data.validationError.country !=''){
						$("#error_country").html(data.validationError.country);
					}
					if(data.validationError.city !=''){
						$("#error_city").html(data.validationError.city);
					}
					if(data.validationError.postcode !=''){
						$("#error_postcode").html(data.validationError.postcode);
					}
					if(data.validationError.prop_addr !=''){
						$("#error_addr").html(data.validationError.prop_addr);
					}
					if(data.validationError.default_img !=''){
						$("#error_img").html(data.validationError.default_img);
					}
					if(data.validationError.price_per_night !=''){
						$("#error_price_per_night").html(data.validationError.price_per_night);
					}
					if(data.validationError.numberofchild !=''){ 
						$("#error_numberofchild").html(data.validationError.numberofchild);
					}
					if(data.validationError.numberofadults !=''){
						$("#error_numberofadults").html(data.validationError.numberofadults);
					}		
				}else if(data.status == 'success'){
					if(data.prop_data !=''){
						window.location.href = site_url+'property/add-animities/'+data.prop_data;
					}
				}
				return false;
			}
			
	});
/*	ajaxObj.success(function(data){
		if(data.status == 'error'){
			if(data.validationError.owner !=''){
				$("#error_owner").html(data.validationError.owner);
			}
			if(data.validationError.prop_name !=''){
				$("#error_prop_name").html(data.validationError.prop_name);
			}
			if(data.validationError.category !=''){
				$("#error_category").html(data.validationError.category);
			}
			if(data.validationError.condition !=''){
				$("#error_condition").html(data.validationError.condition);
			}
			if(data.validationError.prop_desc !=''){
				$("#error_desc").html(data.validationError.prop_desc);
			}
			if(data.validationError.no_of_bed !=''){
				$("#error_numberofbedrooms").html(data.validationError.no_of_bed);
			}
			if(data.validationError.no_of_bath !=''){
				$("#error_numberofbathrooms").html(data.validationError.no_of_bath);
			}
			if(data.validationError.country !=''){
				$("#error_country").html(data.validationError.country);
			}
			if(data.validationError.city !=''){
				$("#error_city").html(data.validationError.city);
			}
			if(data.validationError.postcode !=''){
				$("#error_postcode").html(data.validationError.postcode);
			}
			if(data.validationError.prop_addr !=''){
				$("#error_addr").html(data.validationError.prop_addr);
			}
			if(data.validationError.default_img !=''){
				$("#error_img").html(data.validationError.default_img);
			}
			if(data.validationError.price_per_night !=''){
				$("#error_price_per_night").html(data.validationError.price_per_night);
			}
			if(data.validationError.numberofchild !=''){ 
				$("#error_numberofchild").html(data.validationError.numberofchild);
			}
			if(data.validationError.numberofadults !=''){
				$("#error_numberofadults").html(data.validationError.numberofadults);
			}		
		}else if(data.status == 'success'){
			if(data.prop_data !=''){
				window.location.href = site_url+'property/add-animities/'+data.prop_data;
			}
		}
		return false;
	});*/
	//return false;
});

//event for submit animities for properties
$("#gallery_img_arr").val('');
$("#animit_submit_btn").click(function(e){ 
	//e.stopImmediatePropagation();
	var prop_id = $("#animities_form").find("#property_id").val();
	var formData = $("#animities_form").serialize();
	if(prop_id.trim() ==''){
		var message = flash_message('error','Add property information first.');
		$("#flash_error_msg").html(message);
		return false;
	}
	//var commanObj = new comman_ajax_function();
	//commanObj.dataObj = formData;
	//var ajaxObj = commanObj.return_ajax_call(site_url+'property/add_proprty_animities');
	//ajaxObj.success(function(data){
	//	if(data.status== 'success'){
	//		window.location.href = site_url+'property/gallery/'+data.prop_data;
	//		return false;
	//	}			
	//});

	$.ajax({
		url:site_url+'property/add_proprty_animities',
		data:formData,
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.status== 'success'){
				window.location.href = site_url+'property/gallery/'+data.prop_data;
				return false;
			}
		}
	});

});

//function for upload files
$("#gallery_submit_btn").click(function(e){
	e.stopImmediatePropagation();
	var prop_id = $("#gallery_form").find("#property_gallery_id").val();
	var formData = new FormData($("#gallery_form")[0]);;
	if(prop_id.trim() ==''){
		var message = flash_message('error','Add property information first.');
		$("#flash_error_msg").html(message);
		return false;
	}
	/*var commanObj = new comman_ajax_function();
	commanObj.dataObj = formData;
	var ajaxObj = commanObj.ajax_file_upload(site_url+'property/add_proprty_gallery');
	ajaxObj.success(function(data){
		if(data.status =='success'){
			$("#gallery_img_arr").val('');
			window.location.reload();
			return false;
		}else{
			var message='';
			for(i=0;i<data.validationError.default_img.length;i++){
				message += 'File Name:-'+data.validationError.default_img[i]['file_name']+' Error :-'+data.validationError.default_img[i]['msg']+'<br>';				
			}
			var display_msg = flash_message(data.status,message);
			$("#flash_error_msg").html(display_msg);
			return false;
		}	
	});*/

	$.ajax({
		url:site_url+'property/add_proprty_gallery',
		data:formData,
		dataType:'json',
		type:'post',
		processData : false,
		contentType : false,
		success:function(data){
			if(data.status =='success'){
				$("#gallery_img_arr").val('');
				window.location.reload();
				return false;
			}else{
				var message='';
				for(i=0;i<data.validationError.default_img.length;i++){
					message += 'File Name:-'+data.validationError.default_img[i]['file_name']+' Error :-'+data.validationError.default_img[i]['msg']+'<br>';				
				}
				var display_msg = flash_message(data.status,message);
				$("#flash_error_msg").html(display_msg);
				return false;
			}
		}
	});

	return false;
});

//event for delete single image form gallery

$(".img-gallery-outer-outer").find(".delete-gallry-img").click(function(e){
	e.stopImmediatePropagation();
	var $this = $(this); 
	var img_id = $(this).attr('img_id');
	var link = $(this).attr('file_name');
	var result = confirm("Do you want to delete image?");
	if (result) {
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {'href':link,img_id:img_id};
		var ajaxObj = commanObj.return_ajax_call(site_url+'property/delete_gallry_img');
		ajaxObj.success(function(data){
			if(data.status== 'success'){
				$this.parent().remove();
			}			
		});
	}
});
$("#add_offer").click(function(){
	$("input[type='text']").val('');
	$("#offerID").val(0);
	$("#imeg-additionaloffers").modal('show');
});
$("#add-offer-btn").click(function(){
	var validArr = [];
	$(".add-form-error-msg").html('');
	if($("#offer_title").val().trim() ==''){
		$("#error_offer_title").html("Please enter offer title.");
		validArr[0] = false; 
	}else if ($("#offer_title").val().length >50){
		$("#error_offer_title").html("Offer title contains 50 charactors only.");
		validArr[0] = false;
	}
	if($("#offer").val().trim() ==''){
		$("#error_offer").html("Please value enter offer.");
		validArr[1] = false; 
	}else if($.isNumeric($("#offer").val()) == false){
		$("#error_offer").html('Offer value contained only numeric values.');
		is_valid[1] = false;
	}else if ($("#offer").val() >100 && $("#offer_type").val() == 1){
		$("#error_offer").html("Discount should not be greater than 100%.");	
		validArr[1] = false;
	}else if($("#offer_type").val() == 2){ //alert($("#offer").val()); alert($("#hsprice").val());
		if(parseInt($("#offer").val().trim()) > parseInt($("#hsprice").val().trim())){
			$("#error_offer").html("Discount should not be greater than price per night.");	
			validArr[1] = false;	
		}
		
	}
	//console.log($("#offer").val());
	if($("#offer_sdate").val().trim() ==''){
		$("#error_offer_sdate").html("Please enter start date.");
		validArr[2] = false; 
	}
	if($("#offer_edate").val().trim() ==''){
		$("#error_offer_edate").html("Please enter end date.");
		validArr[3] = false; 
	}
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){
			return false;
		}
	}
	var formData = $("#addition_offer_form").serialize();
	if($("#offerID").val().trim() !=0){
		$.ajax({
			url: site_url+'admin/property/update_offer',
			data:formData,
			type:'post',
			dataType:'json',		
			success: function(data){ 
				if(data.status == 'success'){ 
					/*var offertype = (data.data.prop_offer_type == 1)? '%': '$';
					$("#tbl-no-data-found").remove();
					var notr = parseInt($('#example1 tbody tr').length) + 1;
					var trElement = '<tr id="'+notr+'">'+
										'<td>'+notr+'</td>'+
										'<td>'+data.data.prop_offer_name+'</td>'+
										'<td>'+data.data.prop_offer+''+offertype+'</td>'+
										'<td>'+data.data.prop_offer_sdate+'</td>'+
										'<td>'+data.data.prop_offer_edate+'</td>'+
										'<td><a herf="javascript:void(0);" class="delete_offer" name="delete_offer" del="'+data.data.offer_id+'"><i aria-hidden="true" class="fa fa-trash"></i></td>'+
									'</tr>';				
					
					$("#imeg-additionaloffers").modal('hide');
					$('#example1 tbody:last').append(trElement);
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg);
					$("#addition_offer_form input[type='text']").val('');*/
					location.reload();
					return false;
				}else if(data.status== 'error' && data.valErrorArr.length <=0){
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg);
					$("#imeg-additionaloffers").modal('hide');
				}
			}
		});
	}else{
		$.ajax({
			url: site_url+'imeg-admin/property/add_offer',
			data:formData,
			type:'post',
			dataType:'json',		
			success: function(data){ 
				/*if(data.status == 'success'){ 
					var offertype = (data.data.prop_offer_type == 1)? '%': '$';
					$("#tbl-no-data-found").remove();
					var notr = parseInt($('#example1 tbody tr').length) + 1;
					var trElement = '<tr id="'+notr+'">'+
										'<td>'+notr+'</td>'+
										'<td>'+data.data.prop_offer_name+'</td>'+
										'<td>'+data.data.prop_offer+''+offertype+'</td>'+
										'<td>'+data.data.prop_offer_sdate+'</td>'+
										'<td>'+data.data.prop_offer_edate+'</td>'+
										'<td><a herf="javascript:void(0);" class="delete_offer" name="delete_offer" del="'+data.data.offer_id+'"><i aria-hidden="true" class="fa fa-trash"></i></td>'+
									'</tr>';				
					
					$("#imeg-additionaloffers").modal('hide');
					$('#example1 tbody:last').append(trElement);
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg);
					$("#addition_offer_form input[type='text']").val('');
					return false;
				}else if(data.status== 'error' && data.valErrorArr.length <=0){
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg);
					$("#imeg-additionaloffers").modal('hide');
				}*/
				if(data.status== 'error' && data.valErrorArr.length <=0){
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg);
					$("#imeg-additionaloffers").modal('hide');
				}else{
					location.reload();
				}				
			}
		});
	}
	
});

$(".edit_offer").click(function(){
	var editID = $(this).attr('edit');
	$.ajax({
		url: site_url+'admin/property/get_offer_data',
		data:{id : editID},
		dataType:'json',
		type:'post',
		success: function(data){
			if(data.status== 'success'){
				$("#offer_title").val(data.result.prop_offer_name);
				$("#offer").val(data.result.prop_offer);
				$("#offer_type option[value='"+data.result.prop_offer_type+"']").attr("selected","selected");
				$("#offer_sdate").val(data.result.prop_offer_sdate);
				$("#offer_edate").val(data.result.prop_offer_edate);
				$("#offerID").val(editID);
				$("#imeg-additionaloffers").modal('show');
				return false;
			}
		}
	});	
});

$( "#example1 tbody" ).on( "click", "tr .delete_offer", function() {
	//alert($(this).attr('del'));return false;
	var $this = $(this);
	var result = confirm("Are you sure want to delete offer?");
	if (result) {		
		$.ajax({
			url: site_url+'property/delete_offer',
			data:{offerID : $(this).attr('del')},
			dataType:'json',
			type:'post',
			success: function(data){
				if(data.status== 'success'){
					$this.closest('tr').remove();
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg);
					return false;
				}else{
					var display_msg = flash_message(data.status,data.msg);
					$("#flash_error_msg").html(display_msg).css("color","red");
					if(data.msg == 'Check validation'){
						
					}
				}
			}
		});	
	}
});

function draw_calender($eventsArr){
	var nowDate = new Date();
	var today = nowDate.getFullYear()+"-"+nowDate.getMonth()+"-"+nowDate.getDate();
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: ''
		},
		selectable: true,
		selectHelper: true,
		select: function(start, end) {
			var stDate = new Date(start);
    		var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			var finalToday = yyyy+'-'+mm+'-'+dd;
			if(stDate.getDate()<10){
				var dy = '0'+stDate.getDate();
			}else{
				var dy = stDate.getDate();
			}
			if((stDate.getMonth()+1)<10){
				var mn = '0'+(stDate.getMonth()+1);
			}else{
				var mn = stDate.getMonth()+1;
			}
			var fstDate = stDate.getFullYear()+'-'+mn+'-'+dy;
			
			var pdate = Date.parse(fstDate.trim());
			var tparse = Date.parse(finalToday);
    		
    		if(Date.parse(fstDate)>=Date.parse(finalToday)){
    			show_popup(start,end);	
    		}else{
    			var message = flash_message('error','Date selection is not allowed before current date.'); 
				$("#flash_error_msg").html(message);
				alert_fadeOut();
    		}	
			//show_popup(start,end);			
		},
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: $eventsArr
	});
}
$("#cal_event").change(function(e){
	if( $(this).val() == 1 || $(this).val() == 2 ){
		$(".display_none_price").hide();
	}else{
		$(".display_none_price").show();
	}
	if( $(this).val() == 8 ){
		$(".display_none_days_con").show();
	}else{
		$(".display_none_days_con").hide();
	}
});

$("#custom-rate-btn").click(function(){
	show_popup('','');
});
$("#custom-rate-list-btn").click(function(){
	$("#cust-list-rates-popup").modal('show');
});
function show_popup($start,$end){
	if($start !='' && $end !=''){
		var sDate = new Date($start);
		var eDate = new Date($end);
		$('#cal_sdate').val(sDate.getFullYear()+'-'+(sDate.getMonth()+1)+'-'+sDate.getDate());
		$('#cal_edate').val(eDate.getFullYear()+'-'+(eDate.getMonth()+1)+'-'+ (eDate.getDate()-1) );
		//console.log(eDate.getDate()-1);
		$("#add-cust-rates-popup").modal('show');	
		return false;
	}else{
		$("#add-cust-rates-popup").modal('show');	
		return false;
	}
}

function get_cal_data(prop_id){
	$(".gif-loader").show();
	$.ajax({
		url: site_url+'imeg-admin/property/get_calender_data',
		data:{prop_id:prop_id},
		type:'post',
		dataType:'json',
		success:function(data){
			//console.log(data);
			var eventarr = JSON.parse(data.data);
			if(data.status == 'success'){
				//draw_calender(eventarr);
				$("#add-cust-rates-popup").modal('hide');
				//console.log(eventarr);return false;
				$('#calendar').fullCalendar( 'removeEvents', function(e){ return !e.isUserCreated});
				for(var j=0;j<eventarr.length;j++){
					$('#calendar').fullCalendar('renderEvent', eventarr[j], true);
				}
				
				//location.reload();
			}
			$(".gif-loader").hide();
			return false;
		}
	});
}
$(".del-cust-rate-btn").click(function(){
	var prop_id = $(this).attr("prop_id");
	var statrdate = $(this).attr("sdate");
	var end_date = $(this).attr("edate");
	var status = $(this).attr("status");
	var rowid = $(this).attr("rowid");
	var result = confirm("Are you sure want to delete this rate?");
	var $this = $(this);
	if (result) {
		$.ajax({
			url: site_url+'imeg-admin/property/delete_property_rates',
			data:{prop_id:prop_id,statrdate:statrdate,end_date:end_date,status:status},
			type:'post',
			dataType:'json',
			success:function(data){
				console.log(data);
				if(data.status == 'success'){
					get_cal_data(prop_id);
					$this.closest('tr').remove();				
					$("#display_msg").html(data.message);
				}
				return false;
			}
		});
	}
});
$(".edit-cust-rate-btn").click(function(){
	var prop_id = $(this).attr("prop_id");
	var date = $(this).attr("date");
	var status = $(this).attr("status");
	$.ajax({
			url: site_url+'imeg-admin/property/get_property_rates',
			data:{prop_id:prop_id,date:date,status:status},
			type:'post',
			dataType:'json',
			success:function(data){
				//if(data.result.length>0){
					$("#add-cust-rates-popup").modal('show');
					$("#cal_season option[value='"+data.result.cal_season+"']").attr("selected","selected");
					$("#cal_event option[value='"+data.result.status+"']").attr("selected","selected");
					var datec = data.result.start_end_date;
					$("#old_date").val(data.result.start_end_date);
					var split = datec.split("_");
					$("#cal_sdate").val(split[0]);
					$("#cal_edate").val(split[1]);
					if(data.result.price ==0){
						$("#cal_price").val('');
					}else{
						$("#cal_price").val(data.result.price);
					}					
					$("#days_con").val(data.result.days_con);
					if(data.result.status == '1'){
						$(".display_none_price").hide();
					}else if(data.result.status == '8'){
						$(".display_none_days_con").show();
					}
					$("#prop_offerid_form").val(2);
					$("#cal_old_event").val(data.result.status);
					
					
				//}
				return false;
			}
		});
});

if(segment == 'prop_calender'){
	//$("#example-cust-rates").DataTable();
	//$("#cal_sdate").datepicker();
	var dateFormat ='yy-mm-dd';
var from1 = $( "#cal_sdate" )
        .datepicker({
          changeMonth: false,
          numberOfMonths: 1,
          minDate: 0,
          dateFormat : 'yy-mm-dd'
        })
        .on( "change", function() {
          to1.datepicker( "option", "minDate", getDate( this ) );
        })
 var to1 = $( "#cal_edate" ).datepicker({
        changeMonth: false,
        numberOfMonths: 1,
        minDate: 0,
        dateFormat : 'yy-mm-dd'
      })
      .on( "change", function() { 
        from1.datepicker( "option", "maxDate", getDate( this ) );
      });
     // var cal_res = cal_res;
        console.log(cal_res);
	var eventarr = JSON.parse(cal_res);	
	
	draw_calender(eventarr);
}

$("#add_cust_btn").click(function(e){
	var formData = $("#addition_cust_rates").serialize();
	//console.log(formData);return false;
	var validArr = [],i=0;;
	if($("#cal_season").val() == ''){
		validArr [i] = false;
		i++;
		$("#error_cal_season").html("Please select season.");
	}
	if($("#cal_event").val() == ''){
		validArr [i] = false;
		i++;
		$("#error_cal_event").html("Please select event type.");
	}
	if($("#cal_sdate").val() == ''){
		validArr [i] = false;
		i++;
		$("#error_cal_sdate").html("Please select start date.");
	}
	if($("#cal_edate").val() == ''){
		validArr [i] = false;
		i++;
		$("#error_cal_edate").html("Please select end date.");
	}
	if($("#cal_event").val() == 1 || $("#cal_event").val() == 2 ){
		
	}else{
		if($("#cal_price").val() == ''){
			validArr [i] = false;
			i++;
			$("#error_cal_price").html("Please enter price.");
		}
	}
	if($("#cal_event").val() == 8 ){
		if($("#days_con").val() == ''){
			validArr [i] = false;
			$("#error_days_con").html("Please enter no of days for log stay.");
		}
	}
	for(j=0;j<validArr.length;j++){
		if(validArr[j] == false){
			return false;
		}
	}
	var prop_id = $("#prop_offerid").val();
	var prop_offerid_form = $("#prop_offerid_form").val();
	$(".gif-loader").show();	
	if(prop_offerid_form == 2){
		$.ajax({
			url: site_url+'imeg-admin/property/update_property_rates',
			data:formData,
			type:'post',
			dataType:'json',
			success:function(data){
				console.log(data);
				if(data.status == 'error'){
					$(".error_custome_rates").html(data.message);
				}else{
					get_cal_data(prop_id);
					$("#display_msg").html(data.message);
				}
				$(".gif-loader").hide();
				return false;
			}
		});
	}else if(prop_offerid_form == 1){
		$.ajax({
			url: site_url+'imeg-admin/property/add_calender',
			data:formData,
			type:'post',
			dataType:'json',
			success:function(data){
				console.log(data);
				if(data.status == 'error'){
					$(".error_custome_rates").html(data.message);
				}else{
					get_cal_data(prop_id);
				}
				$(".gif-loader").hide();
				return false;
			}
		});
	}
	
});

$("#cal_price").keydown(function (e) {
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


var dateFormat ='yy-mm-dd';
var from = $( "#offer_sdate" )
        .datepicker({
          defaultDate: "+1w",
          numberOfMonths: 1,
          minDate: 0,
          dateFormat : 'yy-mm-dd'
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        })
 var to = $( "#offer_edate" ).datepicker({
        defaultDate: "+1w",
        numberOfMonths: 1,
        minDate: 0,
        dateFormat : 'yy-mm-dd'
      })
      .on( "change", function() { 
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
     function getDate( element ) {
      var date;
      try {
        date = element.value;
      } catch( error ) {
        date = null;
      }
 
      return element.value;
    }

function initialize() {

	var myLatLng = {lat: -36.07369461323828, lng: 146.91354179999996};
	var map = new google.maps.Map(document.getElementById('map_canvas'), {
		zoom: 15,
		center: myLatLng,
		mapTypeId: google.maps.MapTypeId.HYBRID
	});
	map.setTilt(45);
	var  marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: 'Hello World!',
		draggable: true
	});
		marker.addListener('drag',function(event) {
		document.getElementById('lat').value = event.latLng.lat();
		document.getElementById('lng').value = event.latLng.lng();
	});
}
if(segment == 'add'){ 
	google.maps.event.addDomListener(window, 'load', initialize);
}

function getCountry(country) {
	var geocoder = new google.maps.Geocoder();
	var myLatLng = {lat: -36.07369461323828, lng: 146.91354179999996};
	var map = new google.maps.Map(document.getElementById('map_canvas'), {
		zoom: 15,
		center: myLatLng,
		mapTypeId: google.maps.MapTypeId.HYBRID,
	});
	geocoder.geocode( { 'address': country }, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location,				
				draggable: true
			});
			document.getElementById('lat').value = results[0].geometry.location.lat();
			document.getElementById('lng').value = results[0].geometry.location.lng();
			marker.addListener('drag',function(event) {
				document.getElementById('lat').value = event.latLng.lat();
				document.getElementById('lng').value = event.latLng.lng();
			});
		} else {
			console.log("Geocode was not successful for the following reason: " + status);
		}
	});
}

function set_map(city){
	var city = city.options[city.selectedIndex].innerHTML;
	var country = $('#country>option:selected').text();
	getCountry(city+","+country);
}

//function for aprove property event
function approve_property(id,current_event){
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:id};
	commanObj.ajax_call(site_url+'property/aprove_prop');
	return false;
}
function delete_property(id){
	var result = confirm("Are you sure you want to delete this?");
	if (result) {
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {id:id};
		commanObj.ajax_call(site_url+'property/delete_property');
		return false;
	}
}
$("#postcode").keydown(function (e) {
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
$("#price_per_night").keydown(function (e) {
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
$("#numberofadults").keydown(function (e) {
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
$("#numberofchild").keydown(function (e) {
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
$("#lat").keydown(function (e) {
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
$("#lng").keydown(function (e) {
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
$("#numberofbedrooms").keydown(function (e) {
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
$("#numberofbathrooms").keydown(function (e) {
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

$("#finish").click(function(){
	var propid = $("#property_gallery_id").val();
	if(propid !=''){
		var dataObj = {propid:propid};
		$.ajax({
			url: site_url+'imeg-admin/property/admin_finish',
			data : dataObj,
			type:'POST',
			dataType: 'json',
			success:function(data){
				if(data.status== 'success'){
					var url = $("#is_verify_prop").val();
					location.href = site_url+''+url;
				}
			}
		});
		
	}
});


