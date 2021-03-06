<!-- PRELOADER -->
<?php //echo '<pre>'; print_r($this->session->userdata());exit;
 //echo '<pre>';
    //     print_r($result);   
$hotel_searchinfo=$this->session->userdata('searchinfo');
?>
<div class="preloader"></div>
<section class="product-detail hotel-booking-details">
    <div class="container">
		<div class="col-md-12"><?php $this->load->view('message');?></div>
        <div class="row">
            <div class="col-md-6 col-sm-6 hotel-details-sec">
                <form id="hotel-pay-form" name="hotel_pay_form" action="<?php echo site_url('hotel-payment');?>" method="post">
                    <div class="form-item">
                    <label>Name</label>
                    <input type="text" name="guest_name" id="guest-name" value="<?php echo ($this->session->userdata(USER_SESSION.'is_logged_in') == true && $this->session->userdata(USER_SESSION.'name') != '')?$this->session->userdata(USER_SESSION.'name'):''?>" placeholder="Name">
                    </div>
                    <div class="form-item">
                    <label>Contact Number</label>
                    <input type="text" name="guest_phone" id="guest-phone" value="<?php echo ($this->session->userdata(USER_SESSION.'is_logged_in') == 1 && $this->session->userdata(USER_SESSION.'contact_no') != '')?$this->session->userdata(USER_SESSION.'contact_no'):''?>" placeholder="Contact Number">
                    </div>
                    <div class="form-item">
                    <label>Email</label>
                    <input value ="<?php echo ($this->session->userdata(USER_SESSION.'is_logged_in') == true && $this->session->userdata(USER_SESSION.'emailid') != '')?$this->session->userdata(USER_SESSION.'emailid'):''?>" type="text" name="guest_email" id="guest-email" placeholder="Email">
                    </div>
                    <input type="hidden" name="sessionid" value="<?php echo $result->search_info->session_id;?>">
                    <input type="hidden" name="payment_type" value="deposit">
                    <input type="hidden" name="payref" value="payref">
                    <input type="hidden" name="room_code" value="<?php echo $result->search_info->room_code;?>">
                    <div class="form-item sub-btn">                   
                   
                   
                    <label>Payment Type</label>
                    <table>
                    <tr>
                     <td><input type="radio" checked="checked" onclick="hideError();" class="radio" id="p1" style="width:15px;" name="paytype" value="Paypal"></td><td>Paypal</td><td>&nbsp;&nbsp;&nbsp;</td>
                  <!--   <td> <input type="radio" onclick="hideError();" class="radio" id="p2" name="paytype" value="Midtrans"></td><td>Midtrans</td>-->
                    </tr>
                    </table>
                    <span id="payTypeError" style="display: none;color:red;">Please select payment type</span>
                    <br><br>
                    <?php if($this->session->userdata(USER_SESSION.'is_logged_in') == 1){ ?>
                    <button type="submit hvr-rectangle-out" name="hotelpay" onclick="return selectPayment();" value="pay">Make Payment</button>
                   <?php }else{ ?>
                    <button type="submit hvr-rectangle-out" name="guest_hotel_pay" onclick="return selectPayment();" value="guest">Guest Booking</button>
                    <a href="<?php echo base_url('user-login'); ?>" >Login</a>
                      <input type="hidden" name="user_type" value="GUEST">
                    <?php } ?>
                    
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-6 booking-details">
                <div class="booking-details-container">
                <div class="booking-head col-md-12 col-sm-12">
                    <h3>Booking Details</h3>
                </div>
                <div class="booking-hotel-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="hotel-pic">
                            <!-- <img src="<?php echo site_url().ASSETS_IMAGES?>/no-img.jpg"> -->
                             <img src="<?php echo $result->img_hotel;?>">
                        </div>
                        <div class="hotel-name">
                            <input type="hidden" id="h-start-rating" value="<?php echo $result->star;?>">                            
                            <p class="hot-name"><?php echo $result->name_hotel;?></p>
                        </div>
                    </div>
                    <!--<p><i class="fa fa-wifi" aria-hidden="true"></i> Free WiFi</p>-->
                </div>
                <?php //echo '<pre>'; print_r($result->room_price->total_price_per_night); ?>
                <div class="booking-hotel-info col-md-12 col-sm-12">
                    <p class="duration"><span class="head">Room Name</span><span><?php echo $result->name_room;?></span></p>
                    <p class="checkin"><span class="head">Check-In</span><span><?php echo $result->ci;?></span></p>
                    <p class="checkout"><span class="head">Check-Out</span><span><?php echo $result->co;?></span></p>
                    <p class="roomtype"><span class="head">Night</span><span><?php echo $result->night;?></span></p>
                    <p class="roomcount"><span class="head">No. Of Rooms</span><span><?php echo $result->room;?></span></p>
                    <p class="guest-no"><span class="head">No. Of Guest</span><span><?php echo $result->adults;?> Guest</span></p>
                    <p class="roomcount"><span class="head">Address</span><span><?php echo $result->address_hotel;?></span></p>
                    <p class="per_person_price"><span class="head">Per Person Price</span><span><?php if(isset($result->room_price->total_price_per_night)){
                         $perPersonPrice = $result->room_price->total_price_per_night / $result->adults;
                         echo  number_format($perPersonPrice);
                        }?></span></p>
                    <p class="roomcount">
					<?php
                             $curren=(isset($curr['IDR']) && $curr['IDR']!='')? $curr['IDR']:'';
                             $offer = get_hotel_city_offer($hotel_searchinfo['city'],$result->room_price->total_price_per_night);
							if($offer['discounted_price'] > 0){ ?>
							  <del>
								  <span class="head">Price</span><?php echo $curren."".$offer['actual_price'];?></del>
								<span class="head">Discount</span><span><?php echo $curren."".$offer['discounted_price']; ?></span>
								</p>
								<p class="roomcount">
								<?php }else {?>
							  <span class="head">Price</span><span><?php echo $curren."".$offer['actual_price'];?></span>
							   <?php } ?>
							</div>
						</p>
                    <p class="roomcount"><span class="head">Check In Instructions</span><span><?php echo $result->checkInInstruction;?></span></p>
                </div>
            </div>

<!--             <div class="col-md-6">
                <div class="detail-sidebar">
                    <div class="call-to-book">
                        <i class="awe-icon awe-icon-phone"></i>
                        <em>Call to book</em>
                        <span>+1-888-8765-1234</span>
                    </div>
                    <div class="booking-info">
                        <h3>Booking info</h3>
                        <div class="form-group">
                            <div class="form-elements form-adult">
                                <label>Adult</label>
                                <div class="form-item">
                                    <select class="awe-select">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                <span>12 yo and above</span>
                            </div>
                            <div class="form-elements form-kids">
                                <label>Kids</label>
                                <div class="form-item">
                                    <select class="awe-select">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                <span>11 and under</span>
                            </div>
                        </div>
                        <div class="form-baggage-weight">
                            <label>Extra baggage weight / person</label>
                            <div class="form-item">
                                <select class="awe-select">
                                    <option>15 kg - $20</option>
                                    <option>15 kg - $20</option>
                                </select>
                            </div>
                            <div class="form-item">
                                <select class="awe-select">
                                    <option>25 kg - $40</option>
                                    <option>25 kg - $40</option>
                                </select>
                            </div>
                            <span>Cabin 7kg/person for free</span>
                        </div>
                        <div class="price">
                            <em>Total for this booking</em>
                            <span class="amount">$5,923</span>
                        </div>
                        <div class="form-submit">
                            <div class="add-to-cart">
                                <button type="submit">
                                    Book now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             -->
            </div>
        </div>
       
    </section>
<script>
    $(document).on('ready', function(){
        $('#h-start-rating').rating({displayOnly: true, step: 0.5});
        $("#hotel-pay-form").submit(function(){
          });
 
});

function hideError()
{
 $("#payTypeError").css("display","none");   
}

function selectPayment(){
if ((document.getElementById('p1').checked) || (document.getElementById('p2').checked)) {
$("#payTypeError").css("display","none");
return true;
}  else {
$("#payTypeError").css("display","inline");
return false;  
}
}    
</script> 
