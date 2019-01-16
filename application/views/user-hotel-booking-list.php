<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
		  <div class="col-md-12"><?php $this->load->view('message');?></div>
			<div class="col-md-12">
				<?php $this->load->view('user-left-menu');?>
				<div class="col-md-8 col-sm-8 info-right-sec">
				  <div class="inner-sec">	
					<div class="tab-content" id="bookings">
					      <h3>Hotel Bookings</h3>
					      <?php if(count($hotel_booking_dtl)>0){
							  foreach($hotel_booking_dtl as $key=>$val){
							  ?>
							<div class="hotel-item">
                                <div class="item-media">
                                   <div class="image-cover">
                                	 	 <img src="http://exceptionaire.co/rumbostar/assets/images/no-img.jpg" alt="Venture 	Hostel" style="height: 100%; width: auto;"> 
                                    </div>
                                </div>
                                <div class="item-body">
                                    <div class="item-title">
                                        <h2>
                                         <a href="javascript:void(0)"><?php echo (isset($val->hotel_name) && $val->hotel_name)?$val->hotel_name:''; ?></a>
                                     	</h2>
                                 	</div>
                                 <div class="item-hotel-star">
                                 </div>
                                 <div class="item-address">
                                    <i class="awe-icon awe-icon-marker-2"></i>
                                    <?php echo $val->address; ?><?php echo (isset($val->city) && $val->city)?$val->city.' ,'.$val->address:'';?>
                                </div>
                                <div class="item-footer">
                                 <div class="chk-in-details">
                                 	<p class="in">
                                 		<span><b>Check In :</b></span>
                                 		<span> <?php echo (isset($val->check_in_date) && $val->check_in_date)?$val->check_in_date:''; ?></span>
                                 	</p>
                                 	<p class="out">
                                 		<span><b>Check Out :</b></span>
                                 		<span> <?php echo (isset($val->check_out_date) && $val->check_out_date)?$val->check_out_date:''; ?></span>
                                 	</p>
                                 </div>
                             </div>
                         </div>
                         <div class="item-price-more">
                           <div class="price">
								<span class="amount"> Rp <?php echo (isset($val->booking_amount) && $val->booking_amount)? number_format($val->booking_amount):''; ?></span>
							</div>
                            <a href="<?php echo site_url('booking/view-hotel-booking/'.encode_string($val->cust_id)); ?>" class="awe-btn hvr-rectangle-out">View Details</a>
						</div>
						</div>
						<?php }
						}else{ ?>
                            <div class="hotel-item"><?php echo "No Hotel Book."?></div>
                     <?php }
					?>
              </div>
            </div>
          </div>
        </div>
     </div>
    </div>
   </div>
  </section>
  <script type="text/javascript">
	/*$(document).ready(function(){
		$(".my-bookings-sec a").click(function(){
			$(".booking-submenu").fadeToggle('500');
		});
	});*/

  var hrefs = $(this).attr('url'); 
  var pathname = window.location.pathname; 
  var result = pathname.substring(pathname.lastIndexOf("/") + 1);
  console.log(result);

  if(result == 'my-hotel-booking'){
  $("#subMenuContainer").addClass("active");
  $("#subMenuContainer").addClass("open");
  $("#fixed_booking").addClass("active");
  $("#fixed_booking").css("color","#00AEEF");
  $("#submenu2").addClass("open collapse in");
}
  
    /*if(result == 'my-hotel-booking'){
        $("#subMenuContainer").addClass("active");
        $("#subMenuContainer").addClass("open");
        $("#hotelbooks").addClass("active");
        $("#myprofile").removeClass("active");
        $("#mywallets").removeClass("active");
        $("#subMemuContainerSetting").removeClass("active");
        //var a = $('a#actHotelMy');        
        //act.style('color', '#00AEEF', 'important');
        $("#actHotelMy").css('color', '#00AEEF', 'important');        
    }

    if(result == '#profile')
    {
         window.location.href = "<?php echo site_url(); ?>user-profile";
    }
    */
</script>
                
