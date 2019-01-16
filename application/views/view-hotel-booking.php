<div class="preloader"></div>
<section class="product-detail hotel-success-msg">
    <div class="container">
        <div class="col-md-12 col-sm-12">
			<?php $this->load->view('user-left-menu');?>
        	 <div class="col-md-8 col-sm-12"> 
				 <div class="message-content">
        	    <p class="succ-msg"><?php echo $arr_hotel_booking[0]->hotel_name;?></p>
                <div class="col-md-12 col-sm-12 hotel-booking-details">
        	       <p class="rese-head">Booking Information And Details</p>
                    <div class="hotel-data-container">
                        <div class="col-md-2 col-sm-2 hotel-pic">
                            <img src="<?php echo site_url().ASSETS_IMAGES?>/no-img.jpg" alt="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p class="hot-address"><?php echo (isset($arr_hotel_booking[0]->address) && $arr_hotel_booking[0]->address)? $arr_hotel_booking[0]->address:''; ?></p>
                        </div>
                        <div class="col-md-4 col-sm-4 hotel-booking-dates">
                            <div class="date-content">
                            <div class="checkin">
                                <h3>Check In</h3>
                                <span><?php echo (isset($arr_hotel_booking[0]->check_in_date) && $arr_hotel_booking[0]->check_in_date) ? $arr_hotel_booking[0]->check_in_date:''; ?></span>
                            </div>

                            <div class="checkout">
                                <h3>Check Out</h3>
                                <span><?php echo (isset($arr_hotel_booking[0]->check_out_date) && $arr_hotel_booking[0]->check_out_date) ? $arr_hotel_booking[0]->check_out_date:''; ?></span>
                            </div>
                            </div>
                        </div>
                    </div>    
                        <div class="col-md-12 col-sm-12 other-content">
                            <div class="col-md-6 col-sm-6">
                            <p class="duration">
                                <span class="head">User Name</span>
                                <span><?php echo (isset($arr_hotel_booking[0]->cust_name) && $arr_hotel_booking[0]->cust_name)? $arr_hotel_booking[0]->cust_name:'';?></span>
                            </p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                            <p class="duration">
                                <span class="head">Room Number</span>
                                <span><?php echo (isset($arr_hotel_booking[0]->no_of_rooms) && $arr_hotel_booking[0]->no_of_rooms) ? $arr_hotel_booking[0]->no_of_rooms:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Room Name</span>
                                <span><?php echo (isset($arr_hotel_booking[0]->room_name) && $arr_hotel_booking[0]->room_name) ? $arr_hotel_booking[0]->room_name :'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Hotel City</span>
                                <span><?php echo (isset($arr_hotel_booking[0]->city) && $arr_hotel_booking[0]->city )? $arr_hotel_booking[0]->city :'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Order ID</span>
                                <span><?php echo (isset($arr_hotel_booking[0]->order_id) && $arr_hotel_booking[0]->order_id)? $arr_hotel_booking[0]->order_id :''; ?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Reservation Status</span>
                                <span><?php echo (isset($arr_hotel_booking[0]->payment_status) && $arr_hotel_booking[0]->payment_status)? $arr_hotel_booking[0]->payment_status :'';?></span>
                            </p>
                            </div>                                                                                                                                            
                        </div>	
					</div>
					<div class="tatal-paid">
                    <div class="col-md-6 col-sm-6 amount"><span><b>Total Paid :</b></span> <span>Rp <?php echo (isset($arr_hotel_booking[0]->booking_amount) && $arr_hotel_booking[0]->booking_amount)? number_format($arr_hotel_booking[0]->booking_amount) :''; ?></span></div>
                </div>
        	</div>  
			</div>
        </div>    
    </div>
</section>
<script>
    $(document).ready(function() {
      //$("html").niceScroll();  // The document page (html)
       $("#boxscroll2").niceScroll({touchbehavior:false,cursorcolor:"#00F",cursoropacitymax:0.7,cursorwidth:6,background:"#ccc",autohidemode:false});
});
</script>

