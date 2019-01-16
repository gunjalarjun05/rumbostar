
$(document).ready(function(){
	$("#cat_reg").validationEngine();
});
//click event on delete user
function delete_record(id){
	var result = confirm("Are you sure you want to delete this?");
	if (result) {
		//Logic to delete the item
		$.ajax({
			url:site_url+'user-management/delete',
			data:{id:userid},
			type:'post',
			success:function(data){
				window.location.href = site_url+'user-management';
				return false;
				
			}
		});
	}
	
}

function change_status(id,status){
	var status_s = status.value;
	//Logic to delete the item
	$.ajax({
		url:site_url+'user-management/change_status',
		data:{id:id,status:status_s},
		type:'post',
		success:function(data){
			//if(data.trim() == 1){
				window.location.href = site_url+'user-management';
				return false;
			//}
		}
	});
	
	
}
