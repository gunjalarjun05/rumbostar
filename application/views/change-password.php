
<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
						<div class="inner-sec">	

						<div id="setting" class="tab-pane">						
							<h3>Settings</h3>
							<div class="password-setting">
								<form class="password-settng-sec" id="change_password" name="change_password" method="POST">
									<div class="form-item">
										<label>Old Password : </label>
										<input placeholder="Old Password" name="oldpassword" id="oldpassword" type="password">
										<div class="add-form-error-msg" name="oldpassword" id="error_oldpassword"></div>
										<div class="add-form-error-msg old-pass-error error"></div>	    
									</div>	

									<div class="form-item">
										<label>New Password : </label>
										<input placeholder="New Password" name="newpassword" id="newpassword" type="password">
										<div class="add-form-error-msg" name="error_newpassword" id="error_newpassword"></div>
									</div>	

									<div class="form-item">
										<label>Confirm Password : </label>
										<input placeholder="Confirm New Password" name="confirm-password" id="cpassword" type="password">
										<div class="add-form-error-msg" name="cpass" id="error_cpassword"></div>
									</div>

									<div class="form-item sub-sec">
										<input type="hidden" name="hform" id="hform" value="1">
										<button type="submit" name="forgot_pass" id="forgot_pass" value="forgot_pass" class="submit-info">Submit</button>
									</div> 	 
								</form> 		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
var hrefs = $(this).attr('url'); 
var pathname = window.location.pathname; 
var result = pathname.substring(pathname.lastIndexOf("/") + 1);
console.log(result);

if(result == 'change-password'){	
	$("#subthree").addClass("open collapse in");
	$("#sett").css("color", "#00AEEF");
	$(".chPass").css("color","#00AEEF");
}

$("#change_password").submit(function(){
	$(".add-form-error-msg").html('');
	$(".add-form-error-msg").css('color','red');
	var validArr = [];
	if($("#oldpassword").val().trim() == '' ){
		$("#error_oldpassword").html("Please enter old password.");
		validArr[0] = false;
	}else if($("#oldpassword").val().length<6){
		$("#error_oldpassword").html('Old password should be at least 6 characters long.');
		validArr[0] = false;
	}
	if($("#newpassword").val().trim() == '' ){
		$("#error_newpassword").html("Please enter new password.");
		validArr[1] = false;
	}else if($("#newpassword").val().length<6){
		$("#error_newpassword").html('New password should be at least 6 characters long.');
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
</script>