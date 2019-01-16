//click event on delete user
function delete_record(id){
	var result = confirm("Do you want to delete this module?");
	if (result) {
		//Logic to delete the item
		$.ajax({
			url:site_url+'imeg-admin/modules_access/delete',
			data:{id:id},
			type:'post',
			success:function(data){
				window.location.reload();
				return false;
				
			}
		});
	}
	
}

//click event click on add mosule btn

$("#add-module-btn").click(function(){
	var module = $("#modulename").val().trim();
	if(module !=''){	
		$.ajax({
			url:site_url+'modules_access/add',
			data:{module:module},
			type:'post',
			dataType:'json',
			success:function(data){
				window.location.reload();
				return false;
	
			}
		});
	}else{
		$("#module-name-error").html("Please eneter the module name.");
		return false;	
			
	}
});

//function for add edit permition
function add_edit_permistions(id){
	
		$.ajax({
			url:site_url+'imeg-admin/modules_access/get_user_permissions',
			data:{id:id},
			type:'post',
			success:function(data){
				//alert('data');			
				//if(data.html !=''){ 
				//alert(data);
					$(".ajax-popup").html(data);
					$("#permistin-model").modal('show');
					$("#module_id").val(id);
					//permission_event();
				//}
				//window.location.reload();
				return false;
				
			}
		});
}


