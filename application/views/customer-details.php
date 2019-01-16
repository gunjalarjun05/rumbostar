
<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
						<div class="inner-sec">
							<a href="<?php echo base_url() ?>user/add-customer">Add Customer</a>
							<div>
								<!--<form>
									<input type="text" name="search_customer" value="" placeholder="Search Customer">
									<input type="button" name="search_btn" value="Search">
								</form>-->
							</div>
							
							<div class="table-responsive referral_table">
							<table class="table">
							    <thead>
							      <tr>
							        <th>First name</th>
							        <th>Last name</th>
							        <th>Email</th>
							        <th>Contact No</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    <?php if(isset($customer_details) && count($customer_details) >0){
							    		foreach ($customer_details as $value) { //print_r($value); ?>	
							      <tr>
								        <td><?php echo ($value->cust_first_name)?$value->cust_first_name: 'N/A';?></td>
								        <td><?php echo ($value->cust_last_name)?$value->cust_last_name: 'N/A';?></td>
								        <td><?php echo ($value->cust_email_id)?$value->cust_email_id: 'N/A';?></td>

								        <td><?php echo ($value->country_id)?$value->country_id: 'N/A'?> - <?php echo ($value->contact_no)?$value->contact_no: 'N/A'; ?> </td>	
								        <td>
								         <?php //if($value->parent_user_id ==''){ ?>
								        <a href="#" class="travelling_way"  data-id="<?php echo $value->id; ?>" data-toggle="modal" data-target="#viewModal">View</a> |
								        <a href="#" class="add_booking" data-id="<?php echo $value->id; ?>" data-toggle="modal" data-target="#addBookingModal">Add Booking</a>
								         <?php //} ?>
								        </td>							       
							      </tr>
							      <?php } } ?>
							    </tbody>
							  </table>
							  </div>

						</div>
					</div>
				</div>
		</div>
	</div>

	<!-- Modal -->
	<div id="viewModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Travel Details</h4>
	      </div>
	      <div class="modal-body">
	       <!--  <div class="table-responsive referral_table"> -->
				<table class="table" id="travell_data">
				    <thead>
				      <tr>
				        <th>Booking For</th>
				        <th>No-Of Passenger</th>
				        <th>Booking Date</th>				        
				      </tr>
				    </thead>
				    <tbody>	
				    </tbody>
				  </table>
				  <!-- </div> -->
	      	</div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal -->
	<div id="addBookingModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Booking Detail From</h4>
	      </div>
	      <div class="modal-body">
	     <div class="col-md-8 col-sm-8 info-right-sec">
	        <form class="proeditform customer-details-sec" id="customer_booking_form" action="" method="POST">
	      		<div class="row">
					<div class="form-group paddleft">
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
				</div>
 				<div class="row">
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
					<div class="form-group paddleft">	
						<label for="name" control-label">Date of Booking <span class="asterisk">*</span></label>
						<span class="show-icon" id="booking_cal">
						<img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img"></span>
						<input type="text" class="form-control awe-calendar" name="booking_date" id="booking_date" placeholder="Booking Date" value=""/>
						<div class="add-form-error-msg"  id="error_booking_date"></div>
					</div>	
					<input type="hidden" value="" name="cust_id" id="cust_id">
				</div>
				
				<div class="row"> 
				<input type="submit" value="Save" class="save_btn ma-green-btn inline-block" name="customerbookdata">
				</div> 
	      </form>
		</div> 
      	 </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>
	<!-- end model-->

</section>
<script src="<?php echo site_url()?>assets/js/front/customer_booking.js"></script>
<script type="text/javascript">

/*<?php base_url()?>user/add-customer*/

</script>

<style type="text/css">
#booking_cal{
    background: #f2f2f2 none repeat scroll 0 0 !important;
    border-right: 1px solid #b7b7b7 !important;
    display: block;
    left: 22px;
    margin: 0px !important;
    padding: 0px;
    position: absolute;
    top: 67.7%;
    bottom: 18px;
    height: 30px;
}	
input#booking_date {
    padding-left: 50px;
}
</style>
