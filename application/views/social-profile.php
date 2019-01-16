<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
		  <div class="col-md-12"><?php $this->load->view('message');?></div>
			<div class="col-md-12">
				      
				<div class="col-md-8 col-sm-8 info-right-sec">
				  <div class="inner-sec">	
					<div class="tab-content">
					    
					    <div id="" class="tab-pane fade in active"> 
					           <div class="col-md-12 col-sm-12 user-details"> 		
						      		<div class="User-content">
						      			<div class="login-id">
						      				<form class="user-details-sec" id="social-profile" action="" method="POST">
						      					<div class="form-item">
	                           						 <label>Name : </label>
	                           						 <input placeholder="Name" value="<?php echo $userinfo['fname']." ".$userinfo['lname'];?>" name="name" id="name" type="text" disabled>
	                            						<div class="add-form-error-msg" id="error_name"></div>
	                       						 </div>	

						      					<div class="form-item">
	                           						 <label>Email : </label>
	                           						 <input placeholder="Email" value="" name="emailid" id="id_emailid" type="text"> 
	                            						<div class="add-form-error-msg" id="error_email"><?php echo form_error('emailid');?></div>
	                       						 </div>	

						      					<div class="form-item">
	                           						 <label>Phone : </label>
	                           						 <input placeholder="Mobile number" class="only-numbers" value="" name="phone" id="phone" type="text">
	                            						<div class="add-form-error-msg" id="error_phone"><?php echo form_error('phone');?></div>
	                       						 </div>
						      					<div class="form-item sub-sec">
						      						<input value="save" name="userdata" class="submit-info" type="submit">	
	                       						</div>	
	                       						 	                       						                        						 
						      				</form>
						      			</div>
						      			
						      		</div>
						      	</div>
					    </div>
					</div>
				  </div>	
				</div>
			</div>	
		</div>	
	</div> 
</section>
<script src="<?php echo site_url()?>assets/js/front/comman.js"></script>
<script src="<?php echo site_url()?>assets/js/front/user.js"></script>

