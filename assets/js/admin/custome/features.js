//click event on delete single entry
function delete_function(id){
	var result = confirm("Are you sure you want to delete this?");
	if (result) {
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {id:id};
		commanObj.ajax_call(site_url+'property/delete_animities');		
	}	
}
//funcction for change status 
function change_status(id,status){
	var status_s = status.value;
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:id,status:status_s};
	commanObj.ajax_call(site_url+'property/change_animity_status');	
}
//event for add user popup
$("#add-amen-feat-btn").click(function(){
	$("#add-edit-animity").modal('show');
	$("#afid").val('');
	$("#add_edit_animity_from").find('input[type="text"]').val('');
});

//function for edit popup

function edit(id){
	$.ajax({
		url:site_url+'property/get_animities',
		data:{id:id},
		type:'post',
		dataType: 'json',
		success:function(data){
			if(data.status == 'success'){
				$("#title").val(data.result.af_name);
				$(".type option").each(function(){
					if($(this).val() == data.result.af_type){
							$(this).attr("selected","selected");
					}
				});
				$("#add_form").val('update');
				$("#afid").val(id);
				$("#add-edit-animity").modal('show');
			}
		}
	});
	return false;	
}

//submit event for add or edit popup
$("#add_edit_af").click(function(){ 
	var formData = $("#add-edit-animity-from").serialize();
	$.ajax({
		url:site_url+'property/add-animities',
		data:formData,
		type:'post',
		dataType: 'json',
		success:function(data){
			$(".add-form-error-msg").html('');
			if(data.validationError.title){
				$("#error_title").html(data.validationError.title);
			}
			if(data.validationError.type){
				$("#error_type").html(data.validationError.type);
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




