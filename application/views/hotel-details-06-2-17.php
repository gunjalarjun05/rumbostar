<!-- PRELOADER -->
<div class="preloader"></div>
<!-- END / PRELOADER -->
<section class="header-bottom">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo site_url();?>">Home</a></li>
                <li><a href="<?php echo site_url('hotel');?>">Hotel</a></li>
                <li><span>Hotel Detail</span></li>
            </ul>
        </div>
    </div>
</section>
<section class="product-detail" style="transform: none;">
            <div class="container" style="transform: none;">
				<?php if(isset($hotel_details->result_data) && count($hotel_details->result_data)>0){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-detail__info">
                            <div class="product-title">
                                <h2><?php echo (isset($hotel_details->result_data->name) && $hotel_details->result_data->name!='')?$hotel_details->result_data->name:'';?></h2>
                                <p><input id="input-3-xs" name="input-3-xs" value="<?php echo (isset($hotel_details->result_data->review_rating->reviewOverall) && $hotel_details->result_data->review_rating->reviewOverall!='')? $hotel_details->result_data->review_rating->reviewOverall:''; ?>"class="rating-loading" data-size="xs"></p>
                            </div>
                            <div class="product-address">
                                <span><?php  
                                $address=(isset($hotel_details->result_data->address) && $hotel_details->result_data->address!='')? $hotel_details->result_data->address:''; 
                                $cityname=(isset($hotel_details->result_data->cityName) && $hotel_details->result_data->cityName !='')?$hotel_details->result_data->cityName:'';
                                echo $address.", ".$cityname; ?></span>
                            </div>
                            <div class="rating-trip-reviews">
                                <div class="item good">
                                    <span class="count"><?php echo (isset($hotel_details->result_data->review_rating->reviewOverall) && $hotel_details->result_data->review_rating->reviewOverall!='')? $hotel_details->result_data->review_rating->reviewOverall:''; ?></span>
                                    <h6>Average rating</h6>
                                </div>
                                <div class="item">
                                    <h6>TripAdvisor</h6>
                                    <img src="<?php echo (isset($hotel_details->result_data->review_rating->reviewImage) && $hotel_details->result_data->review_rating->reviewImage!='')? $hotel_details->result_data->review_rating->reviewImage:''; ?>" alt="<?php echo (isset($hotel_details->result_data->name) && $hotel_details->result_data->name!='')? $hotel_details->result_data->name:'';?>">
                                </div>
                            </div>

                            <div class="product-descriptions">
                                <p><?php echo (isset($hotel_details->result_data->hotel_info->detail_facilities) && $hotel_details->result_data->hotel_info->detail_facilities!='')? $hotel_details->result_data->hotel_info->detail_facilities:''; ?></p>
                            </div>
                            
                            <div class="property-highlights">
                                <h3>Property highlights</h3>
                                <div class="property-highlights__content spacedetails">
                                   <?php echo (isset($hotel_details->result_data->hotel_info->propertyDescription) && $hotel_details->result_data->hotel_info->propertyDescription!='')? html_entity_decode($hotel_details->result_data->hotel_info->propertyDescription):'';?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="product-detail__gallery">
                            <div class="product-slider-wrapper">
                                <div class="product-slider">
                                <?php if(count($hotel_details->result_data->image_thumb->big_img)>0){
                                foreach($hotel_details->result_data->image_thumb->big_img as $key=>$imgArr): ?>
                                    <div class="item">
                                        <img src="<?php echo $imgArr;?>" alt="">
                                    </div>
                                <?php endforeach; }?>                                    
                                </div>
                                <div class="product-slider-thumb-row">
                                    <div class="product-slider-thumb">
                                     <?php 
                                    if(count($hotel_details->result_data->image_thumb->small_img)>0){
                                       foreach($hotel_details->result_data->image_thumb->small_img as $key=>$imgsArr): ?>
                                        <div class="item">
                                            <img src="<?php echo $imgsArr;?>" alt="">
                                        </div>
                                      <?php endforeach; }?>  
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="product-map">
                                <div data-latlong="21.036697, 105.834871"></div>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="row" style="transform: none;">
                    <div class="col-md-9">
                        <div class="product-tabs tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
                            <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                                <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true">
                                    <a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Room detail</a>
                                </li>
                                <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false">
                                    <a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">Facilities &amp; freebies</a>
                                </li>
                                <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false">
                                    <a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">Good to know</a>
                                </li>
                                <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-4" aria-selected="false">
                                    <a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-4">Review &amp; rating</a>
                                </li>
                            </ul>
                            <div class="product-tabs__content">
                                <div id="tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="true" aria-hidden="false">
                                    <!--<div class="check-availability">
                                        <form>
                                            <div class="form-group">
                                                <div class="form-elements form-checkin">
                                                    <label>Check in</label>
                                                 <div class="form-item">
                                                        <i class="awe-icon awe-icon-calendar"></i>
                                                        <input type="text" class="awe-calendar" value="Date">
                                                    </div>
                                                </div>
                                                <div class="form-elements form-checkout">
                                                    <label>Check out</label>
                                                 <div class="form-item">
                                                        <i class="awe-icon awe-icon-calendar"></i>
                                                        <input type="text" class="awe-calendar" value="Date">
                                                    </div>
                                                </div>
                                                <div class="form-elements form-adult">
                                                    <label>Adult</label>
                                                    <div class="form-item">
                                                        <div class="awe-select-wrapper"><select class="awe-select">
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select><i class="fa fa-caret-down"></i></div>
                                                    </div>
                                                    <span>12 yo and above</span>
                                                </div>
                                                <div class="form-elements form-kids">
                                                    <label>Kids</label>
                                                    <div class="form-item">
                                                        <div class="awe-select-wrapper"><select class="awe-select">
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select><i class="fa fa-caret-down"></i></div>
                                                    </div>
                                                    <span>0-11 yo</span>
                                                </div>
                        
                                                <div class="form-actions">
                                                    <input value="CHECK AVAILABILITY" class="awe-btn awe-btn-style3" type="submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>-->
                                    <table class="room-type-table">
                                        <thead>
                                            <tr>
                                                <th class="room-type">Room type</th>
                                                <th class="room-people">Max</th>
                                                <th class="room-condition">Condition</th>
                                                <th class="room-price">Today price</th>
                                            </tr>
                                        </thead>
                                    <?php  if(count($hotel_details->result_data->available_room)>0) { foreach($hotel_details->result_data->available_room as $key=>$roomArr): ?>
                                        <tbody>
                                            <tr>
                                                <td class="room-type">
                                                    <div class="room-thumb">
                                                        <img src="<?php echo $roomArr->small_images; ?>" alt="">
                                                    </div>
                                                    <div class="room-title">
                                                        <h4><?php echo $roomArr->room_name; ?></h4>
                                                    </div>
                                                    <div class="room-descriptions">
                                                        <p><?php echo $roomArr->room_description; ?></p>
                                                    </div>
                                                </td>
                                                <td class="room-people">
                                                     <p><?php echo $roomArr->room_capacity; ?></p>
                                                </td>
                                                <td class="room-condition">
                                                   <p><?php echo $roomArr->cancelDetail; ?></p> 
                                                </td>
                                                <td class="room-price">
                                                    <div class="price">
                                                        <span class="amount"><?php echo $curr['IDR']."".number_format($roomArr->total_price) ?></span>
                                                        <em><?php echo $roomArr->currentAllotment ?> room available</em>
                                                    </div>
                                                    <a class="awe-btn" href="<?php echo site_url('hotel-booking/'.$hotel_details->search_info->session_id.'/'.$roomArr->room_code);?>">Book Now</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                   <?php endforeach; }?>  
                                    </table>
                                </div>
                                <div id="tabs-2" aria-labelledby="ui-id-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true">
                                    <table class="facilities-freebies-table">
                                        <tbody>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Hotel facilities</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->hotel_facilities) && $hotel_details->result_data->hotel_info->hotel_facilities!='')? $hotel_details->result_data->hotel_info->hotel_facilities:''; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Room facilities</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->room_facilities) && $hotel_details->result_data->hotel_info->room_facilities!='')? html_entity_decode($hotel_details->result_data->hotel_info->room_facilities):'' ; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Detail facilities</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->detail_facilities) && $hotel_details->result_data->hotel_info->detail_facilities!='')? $hotel_details->result_data->hotel_info->detail_facilities:''; ?></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tabs-3" aria-labelledby="ui-id-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true">
                                    <table class="good-to-know-table">
                                        <tbody>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Check in</p>
                                                </th>
                                                <td>
                                                    <p>From <?php echo (isset($hotel_details->result_data->hotel_info->checkInTime) && $hotel_details->result_data->hotel_info->checkInTime!='')? $hotel_details->result_data->hotel_info->checkInTime:''; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Check out</p>
                                                </th>
                                                <td>
                                                    <p>Until <?php echo (isset($hotel_details->result_data->hotel_info->checkOutTime) && $hotel_details->result_data->hotel_info->checkOutTime!='')? $hotel_details->result_data->hotel_info->checkOutTime:''; ?> </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Check in instructions</p>
                                                </th>
                                                <td>
                                                    <p class="just"><?php echo (isset($hotel_details->result_data->hotel_info->checkInInstructions) && $hotel_details->result_data->hotel_info->checkInInstructions)? $hotel_details->result_data->hotel_info->checkInInstructions:''; ?> </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Hotel policy</p>
                                                </th>
                                                <td>
                                                    <p class="just"> <?php echo (isset($hotel_details->result_data->hotel_info->hotelPolicy) && $hotel_details->result_data->hotel_info->hotelPolicy!='')? $hotel_details->result_data->hotel_info->hotelPolicy:''; ?> </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Property information</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->propertyInformation) && $hotel_details->result_data->hotel_info->hotelPolicy!='')? $hotel_details->result_data->hotel_info->hotelPolicy:''; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Room fees description</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->roomFeesDescription) && $hotel_details->result_data->hotel_info->roomFeesDescription!='')? $hotel_details->result_data->hotel_info->roomFeesDescription:''; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="top-facility">
                                                    <p>Amenities description</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->amenitiesDescription) && $hotel_details->result_data->hotel_info->amenitiesDescription!='')? $hotel_details->result_data->hotel_info->amenitiesDescription:''; ?></p>
                                                </td>
                                            </tr>
                                             <tr>
                                                <th class="top-facility">
                                                    <p>Dining description</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->diningDescription) && $hotel_details->result_data->hotel_info->diningDescription!='')? $hotel_details->result_data->hotel_info->diningDescription:''; ?></p>
                                                </td>
                                            </tr>
                                             <tr>
                                                <th class="top-facility">
                                                    <p>Business amenities description</p>
                                                </th>
                                                <td>
                                                    <p><?php echo (isset($hotel_details->result_data->hotel_info->businessAmenitiesDescription) && $hotel_details->result_data->hotel_info->businessAmenitiesDescription!='')? $hotel_details->result_data->hotel_info->businessAmenitiesDescription:''; ?></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="tabs-4" aria-labelledby="ui-id-4" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true">
                                    <div id="reviews">
                                        <div class="rating-info">
                                            <div class="average-rating-review good">
                                                <span class="count"><?php echo (isset($hotel_details->result_data->review_rating->reviewOverall) && $hotel_details->result_data->review_rating->reviewOverall!='')? $hotel_details->result_data->review_rating->reviewOverall:''; ?></span>
                                                <em>Average rating</em>
                                            </div>
                                            <ul class="rating-review">
                                                <li>
                                                    <em>Cleanliness</em>
                                                    <span><?php echo (isset($hotel_details->result_data->review_rating->cleanlinessRating) && $hotel_details->result_data->review_rating->cleanlinessRating!='')? $hotel_details->result_data->review_rating->cleanlinessRating:''; ?></span>
                                                </li>
                                                <li>
                                                    <em>Service</em>
                                                    <span><?php echo (isset($hotel_details->result_data->review_rating->serviceAndStaffRating) && $hotel_details->result_data->review_rating->serviceAndStaffRating!='')? $hotel_details->result_data->review_rating->serviceAndStaffRating:''; ?></span>
                                                </li>
                                                <li>
                                                    <em>Room</em>
                                                    <span><?php echo (isset($hotel_details->result_data->review_rating->roomComfortRating) && $hotel_details->result_data->review_rating->roomComfortRating!='')? $hotel_details->result_data->review_rating->roomComfortRating:''; ?></span>
                                                </li>
                                                <li>
                                                    <em>Hotel</em>
                                                    <span><?php echo (isset($hotel_details->result_data->review_rating->hotelConditionRating) && $hotel_details->result_data->review_rating->hotelConditionRating!='')? $hotel_details->result_data->review_rating->hotelConditionRating:'' ; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1182px;">
                        
                    <div class="theiaStickySidebar" style="padding-top: 1px; padding-bottom: 1px; position: absolute; top: -2px; width: 263px;"><div class="detail-sidebar">
                            <div class="booking-info">
                                <h3>Booking info</h3>
                                <div class="form-group">
                                    <div class="form-elements form-checkin">
                                        <label>Check in</label>
                                             <div class="form-item">
                                                    <input type="text" class="awe-calendar" value="Date">
                                                </div>
                                    </div>
                                    <div class="form-elements form-checkout">
                                        <label>Check out</label>
                                             <div class="form-item">
                                                    
                                                    <input type="text" class="awe-calendar" value="Date">
                                                </div>
                                    </div>
                                </div>
                                <div class="form-elements form-room">
                                    <label>Room detail</label>
                                    <!-- FORM ROOM -->
                                    <div class="form-group">
                                        <div class="form-item">
                                            <div class="awe-select-wrapper"><select class="awe-select">
                                                <option>R-type</option>
                                                <option>Std - $59/n</option>
                                            </select><i class="fa fa-caret-down"></i></div>
                                        </div>
                                        <div class="form-item">
                                            <div class="awe-select-wrapper"><select class="awe-select">
                                                <option>Number</option>
                                                <option>1</option>
                                            </select><i class="fa fa-caret-down"></i></div>
                                        </div>
                                    </div>
                                    <!-- END / FORM ROOM -->

                                    <!-- FORM ROOM -->
                                    <div class="form-group">
                                        <div class="form-item">
                                            <div class="awe-select-wrapper"><select class="awe-select">
                                                <option>R-type</option>
                                                <option>Std - $59/n</option>
                                            </select><i class="fa fa-caret-down"></i></div>
                                        </div>
                                        <div class="form-item">
                                            <div class="awe-select-wrapper"><select class="awe-select">
                                                <option>Number</option>
                                                <option>1</option>
                                            </select><i class="fa fa-caret-down"></i></div>
                                        </div>
                                    </div>
                                    <!-- END / FORM ROOM -->

                                    <div class="add-room-type">
                                        <a href="#"><i class="awe-icon awe-icon-plus"></i>Add More Room type</a>
                                    </div>
                                </div>
                                <div class="price">
                                    <em>Total for this booking</em>
                                    <span class="amount"><?php echo $curr['IDR']; ?></span>
                                </div>
                                <div class="form-submit">
                                    <div class="add-to-cart">
                                        <button type="submit">
                                          Book now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div></div></div>
                </div>
                <?php } ?>
            </div>
        </section> 
         <script>
            $(document).on('ready', function(){
                $('#input-3-xs').rating({displayOnly: true, step: 0.5});
            });
        </script>  
