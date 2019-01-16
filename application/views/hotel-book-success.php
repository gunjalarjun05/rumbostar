<!-- PRELOADER -->
<div class="preloader"></div>
<section class="product-detail hotel-success-msg">
    <div class="container">
        <div class="col-md-12 col-sm-12">
        <?php 
      
      $img= (isset($result->img_hotel) && $result->img_hotel) ? $result->img_hotel: site_url().ASSETS_IMAGES.'/no-img.jpg';
        //print_r($result);exit;
           // if($result == "no data"){ 

              //  echo '<p class="rese-head"> </p>'
            // }else{
        

             ?>

        	<div class="message-content">
        	    <p class="succ-msg"><i class="fa fa-check" aria-hidden="true"></i><?php echo'Your Hotel Rooms Booked Successfully';?></p>
                <div class="col-md-12 col-sm-12 hotel-booking-details">
        	       <p class="rese-head">Reservation Information And Details </p>
                    <div class="hotel-data-container">
                        <div class="col-md-2 col-sm-2 hotel-pic">
                        <?php echo '<img src="'. $img .'">'; ?>    
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <p class="hot-name"><?php echo (isset($result->name_hotel) && $result->name_hotel) ?$result->name_hotel:''; ?></p>
                            <p class="hot-address"><?php echo (isset($result->address_hotel) && $result->address_hotel)? $result->address_hotel:''; ?></p>
                        </div>
                        <div class="col-md-4 col-sm-4 hotel-booking-dates">
                            <div class="date-content">
                            <div class="checkin">
                                <h3>Check In</h3>
                                <span><?php echo (isset($result->ci) && $result->ci) ? $result->ci:''; ?></span>
                            </div>

                            <div class="checkout">
                                <h3>Check Out</h3>
                                <span><?php echo (isset($result->co) && $result->co) ? $result->co:''; ?></span>
                            </div>
                            </div>
                        </div>
                    </div>    
                        <div class="col-md-12 col-sm-12 other-content">
                            <div class="col-md-6 col-sm-6">
                            <p class="duration">
                                <span class="head">Confirmation Numbers</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->confirmationNumbers) && $result->payment_detail->HotelRoomReservationResponse->confirmationNumbers)?$result->payment_detail->HotelRoomReservationResponse->confirmationNumbers:''; ?></span>
                            </p>
                            <p class="duration">
                                <span class="head">First Name</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->RateInfos) && $result->payment_detail->HotelRoomReservationResponse->RateInfos)? $result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->RoomGroup->Room->firstName:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Last Name</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->RateInfos) && $result->payment_detail->HotelRoomReservationResponse->RateInfos)? $result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->RoomGroup->Room->lastName:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Number Of Adults</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->RateInfos) && $result->payment_detail->HotelRoomReservationResponse->RateInfos)? $result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->RoomGroup->Room->numberOfAdults:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Number Of Children</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->RateInfos) && $result->payment_detail->HotelRoomReservationResponse->RateInfos)? $result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->RoomGroup->Room->numberOfChildren:'';?></span>
                            </p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                            <p class="duration">
                                <span class="head">Number Of Rooms Booked</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->numberOfRoomsBooked) && $result->payment_detail->HotelRoomReservationResponse->numberOfRoomsBooked)? $result->payment_detail->HotelRoomReservationResponse->numberOfRoomsBooked:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Room Description</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->roomDescription) && $result->payment_detail->HotelRoomReservationResponse->roomDescription)? $result->payment_detail->HotelRoomReservationResponse->roomDescription:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Hotel City</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->hotelCity) && $result->payment_detail->HotelRoomReservationResponse->hotelCity)? $result->payment_detail->HotelRoomReservationResponse->hotelCity:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Hotel Country Code</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->hotelCountryCode) && $result->payment_detail->HotelRoomReservationResponse->hotelCountryCode)? $result->payment_detail->HotelRoomReservationResponse->hotelCountryCode:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Reservation Status Code</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->reservationStatusCode) && $result->payment_detail->HotelRoomReservationResponse->reservationStatusCode)? $result->payment_detail->HotelRoomReservationResponse->reservationStatusCode:'';?></span>
                            </p>
                            <p class="duration">
                                <span class="head">Existing Itinerary</span>
                                <span><?php echo (isset($result->payment_detail->HotelRoomReservationResponse->existingItinerary) && $result->payment_detail->HotelRoomReservationResponse->existingItinerary)? $result->payment_detail->HotelRoomReservationResponse->existingItinerary:'';?></span>
                            </p>                            
                            </div>                                                                                                                                            
                        </div>	
					</div>
					<div class="tatal-paid">
                    <?php $total = '@total';?>
                    <div class="col-md-6 col-sm-6 amount"><span><b>Total Paid :</b></span> <span>Rp<?php echo (isset($result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->ChargeableRateInfo->$total) && $result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->ChargeableRateInfo->$total)? $result->payment_detail->HotelRoomReservationResponse->RateInfos->RateInfo->ChargeableRateInfo->$total:''; ?></span></div>
                    <div class="col-md-6 col-sm-6 print"><a href="javascript:window.print()"><i class="fa fa-print" aria-hidden="true"></i> print</a></div>
                </div>
        	</div>  
            <?php //} ?>  
        </div>    
    </div>
</section>
<script>
    $(document).ready(function() {
      //    $("html").niceScroll();  // The document page (html)
       $("#boxscroll2").niceScroll({touchbehavior:false,cursorcolor:"#00F",cursoropacitymax:0.7,cursorwidth:6,background:"#ccc",autohidemode:false});
});
</script>
