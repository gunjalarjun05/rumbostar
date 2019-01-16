//click event on delete user
function delete_user(userid){
	var result = confirm("Do you want to delete?");
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

$("#add-new-images").click(function(){
	$('#add_bg_image').modal('show');
});

$("#add_images_form").submit(function(){
	//var data = new FormData(this);
	
	$.ajax({
		url:site_url+'add_images',
		data:new FormData(this),
		type:'post',
		contentType: false,
		cache: false,
		processData:false,
		success:function(data){
			if(data.trim() == 1){
				window.location.reload();
			}else{
				$(".errors-img-uploads").html(data);
			}
			return false;
		
		}
	});	
	return false;	
});

$(".delete-mark").each(function(){
		$(this).click(function(){
			var imgid = $(this).attr('imgid');
			var result = confirm("Do you want to delete?");
			if (result) {
				//Logic to delete the item
				$.ajax({
					url:site_url+'delete_images',
					data:{id:imgid},
					type:'post',
					success:function(data){
						window.location.reload();
						return false;
						
					}
				});
			}
		});
});
