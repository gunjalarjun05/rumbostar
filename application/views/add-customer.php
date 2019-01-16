
<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
						<div class="inner-sec">
							<a href="<?php echo base_url() ?>user/customer-details">Customer Details</a>


								<form class="proeditform customer-details-sec" id="customer_form" action="" method="POST"> 	
									<div class="row">
										<div class="form-group paddright">
											<label for="name" control-label">First Name <span class="asterisk">*</span></label>
											<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="" />
											<div class="add-form-error-msg" id="error_first_name"></div>
										</div>

										<div class="form-group paddleft">
											<label for="name" control-label">Last Name <span class="asterisk">*</span></label>
											<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="" />
											<div class="add-form-error-msg" id="error_last_name"></div>
										</div>
									</div>
									<div class="row">
											<div class="form-group paddright">
											<label for="name" control-label">Country Code <span class="asterisk">*</span></label>
											<div id="country_flag" class='iti-flag '></div>
											<span id="country_sortName" class="<?php //echo ($userinfo[0]->sortname)?>"></span> 
											<select name="countries" id="countriesSelects" class="selectpicker form-control" data-style="btn-primary">
												<option value="">Country code</option>
												<?php 
												if(count($countrries_codedata)>0){
												foreach ($countrries_codedata as $value){ ?>    
												<option id="<?php echo $value->sortname; ?>" value="<?php echo $value->country_code ?>" > 
												<?php echo $value->country_code ?> 
												</option>	      	
												<?php }
												}?> 
											</select>
											<input type="text" class="form-control only-numbers" value=""  name="phone" id="phone" placeholder="Mobile"/>
											<div class="add-form-error-msg" id="error_phone"></div>

											<!-- <div class="add-form-error-msg" id="error_country_code" ></div> -->


										</div>
										 <div class="form-group paddleft">
											<label for="name" control-label">Email <span class="asterisk">*</span></label>
										
											<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="" />	
											<div class="add-form-error-msg" id="error_email"></div>	
										</div> 
									</div>

									<div class="row">
										<div class="form-group paddright">
											<label for="name" control-label">No-Of Passenger <span class="asterisk">*</span></label></label>
											<select name="no_of_passenger" id="no_of_passenger" class="selectpicker form-control">
												<option value="">Select Passenger</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
											</select>
											<div class="add-form-error-msg" id="error_passenger"></div>
										</div>

										<div class="form-group paddleft">
											<label class="required">Booking For <span class="asterisk">*</span></label>
											<select name="travelling_way" id="travelling_way" class="selectpicker form-control">
												<option value="">Select Travelling way</option>
												<option value="0">Flight</option>
												<option value="1">Hotel</option>
												<option value="2">Train</option>
											</select>
											<div class="add-form-error-msg" id="error_travelling_way"></div>
										</div>
									
									</div>


									<div class="row">
										<div class="form-group paddright">	
											<label for="name" control-label">Date of Booking <span class="asterisk">*</span></label>
											<span class="show-icon" id="booking_cal">
											<img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img"></span>
											<input type="text" class="form-control awe-calendar" name="booking_date" id="booking_date" placeholder="Booking Date" value=""/>
											<div class="add-form-error-msg"  id="error_booking_date"></div>
										</div>
										


									</div>
									
									<input type="submit" value="Save" class="save_btn ma-green-btn inline-block" name="customerdata">
								</form>
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

if(result == 'add-customer'){
  $("#subMenuContainer").addClass("active");
  $("#subMenuContainer").addClass("open");
  $("#mycust").css("color","#00AEEF");
}
</script>
<style type="text/css">
#booking_cal{
    background: #f2f2f2 none repeat scroll 0 0 !important;
    border-right: 1px solid #b7b7b7 !important;
    display: block;
    left: 37px;
    margin: 0px !important;
    padding: 0px;
    position: absolute;
    top: 77.7%;
    bottom: 18px;
    height: 30px;
}	
input#booking_date {
    padding-left: 50px;
}
</style>

<script src="<?php echo site_url()?>assets/js/front/customer.js"></script>