<!-- PRELOADER -->
<div class="preloader"></div>
<script src="http://connect.facebook.net/en_US/sdk.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<!-- END / PRELOADER -->

<section class="header-bottom hotel-det-bredcum">
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
<?php //echo '<pre>'; print_r($hotel_details); ?>
<section class="product-detail" style="transform: none;">
            <div class="container" style="transform: none;">
				<?php if(isset($hotel_details->result_data) && count($hotel_details->result_data)>0){ 

                   /* echo '<pre>';
                    print_r($hotel_details->result_data->image_thumb->big_img);*/

                    ?>
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
                                <div class="share-icon">
								<ul>
									<li class="fb"><a href="javascript:void(0)" onclick='shareFb("<?php echo $hotel_details->result_data->name; ?>","<?php echo strip_tags($hotel_details->result_data->hotel_info->detail_facilities) ?>")'><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                   <!--  <a href="javascript:void(0)" class="share" data-url="<?php echo site_url().'hotel-details/'.$session_id.'/'.$hotelid;?>" ><i class="fa fa-facebook" aria-hidden="true"></i></a> -->

                                    </li>
									<li class="tw"><a href="javascript:void(0)" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                                    <?php $sv= (isset($hotel_details->result_data->hotel_info->propertyDescription) && $hotel_details->result_data->hotel_info->propertyDescription!="")? $hotel_details->result_data->hotel_info->propertyDescription:''; 
                                   $test= 'data-prefilltext="'.$sv.'"';
                                    ?>
									<li class="gplus">
                                      <!--   <a href="javascript:void(0)" onclick="shareinsocialmedia('https://plus.google.com/share?url=<?php echo site_url().'hotel-details/'.$session_id.'/'.$hotelid;?>')"> -->
                                            <!--button
                                              class="g-interactivepost"
                                              data-contenturl="https://plus.google.com/pages/"
                                              data-contentdeeplinkid="/pages"
                                              data-clientid="693044186785-v72ijvg5hu933kq72dlojikg7ovklrgc.apps.googleusercontent.com "
                                              data-cookiepolicy="single_host_origin"
                                              data-prefilltext="Engage your users today, create a Google+ page for your business."
                                              data-calltoactionlabel="CREATE"
                                              data-calltoactionurl="http://plus.google.com/pages/create"
                                              data-calltoactiondeeplinkid="/pages/create">
                                              google+
                                            </button-->

                                    <!-- <a href="javascript:void(0)" class="g-interactivepost"
                                              data-contenturl="https://plus.google.com/pages/"
                                              data-contentdeeplinkid="/pages"
                                              data-clientid="xxxxx.apps.googleusercontent.com"
                                              data-cookiepolicy="single_host_origin"
                                              data-prefilltext="Engage your users today, create a Google+ page for your business."
                                              data-calltoactionlabel="CREATE"
                                              data-calltoactionurl="http://plus.google.com/pages/create"
                                              data-calltoactiondeeplinkid="/pages/create"><i class="fa fa-google-plus" aria-hidden="true"></i></a> -->


                                              <a href="javascript:void(0)" id="myBtn" class="demo g-interactivepost" data-clientid="588805674563-ulnaaq0mo5q6v3rbl1emdmkb459nblp1.apps.googleusercontent.com" data-contenturl="http://exceptionaire.co/rumbostar/hotel-details/NghPdGDepe8IvpLzJvOD0jMpWW5-SELnT-fvyrNOMb8/476989 " data-calltoactionlabel="INVITE" data-calltoactionurl="https://developers.google.com/+/web/share/interactive?invite=false" data-cookiepolicy="single_host_origin"  data-gapiscan="true" data-onload="true" data-gapiattached="true" 
                                                    <?php echo $test; ?> >

                                                 <i class="fa fa-google-plus" style="margin-top: 7px;" aria-hidden="true"></i></a>



                                              </li>
								</ul>
								</div>
                            </div>
                            <div class="product-descriptions">
                                <p><?php echo (isset($hotel_details->result_data->hotel_info->propertyDescription) && $hotel_details->result_data->hotel_info->propertyDescription!='')? $hotel_details->result_data->hotel_info->propertyDescription:''; ?></p>
                            </div>
                            
                            <div class="property-highlights">
                                <h3>Property highlights</h3>
                                <div class="property-highlights__content spacedetails">
                                   <?php echo (isset($hotel_details->result_data->hotel_info->detail_facilities) && $hotel_details->result_data->hotel_info->detail_facilities!='')? html_entity_decode($hotel_details->result_data->hotel_info->detail_facilities):'';?>
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
                            <div class="product-map">
                                <div data-latlong="21.036697, 105.834871"></div>
                            </div>
                        </div>
                    </div> 


                    <!-- <div class="col-md-6">
                        <div class="product-detail__gallery">
                            <div class="product-slider-wrapper">
                                <div class="product-slider">
                                    <div class="item">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>/img/1.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>/img/2.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>/img/3.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>/img/4.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>/img/5.jpg" alt="">
                                    </div>
                                </div>
                                <div class="product-slider-thumb-row">
                                    <div class="product-slider-thumb">
                                        <div class="item">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>/img/demo-thumb-1.jpg" alt="">
                                        </div>
                                        <div class="item">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>/img/demo-thumb-2.jpg" alt="">
                                        </div>
                                        <div class="item">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>/img/demo-thumb-3.jpg" alt="">
                                        </div>
                                        <div class="item">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>/img/demo-thumb-4.jpg" alt="">
                                        </div>
                                        <div class="item">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>/img/demo-thumb-5.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 -->


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
														<?php
															$curren=(isset($curr['IDR']) && $curr['IDR']!='')? $curr['IDR']:'';
															$offer = get_hotel_city_offer($hotel_details->result_data->cityName,$roomArr->total_price);
															if($offer['discounted_price'] > 0){ ?>
																<del><?php echo $curren."".number_format($roomArr->total_price);?></del>
																<span class="damount"> <?php echo $curr['IDR']."".$offer['discounted_price']; ?></span>
																<?php }else {?>
																<span class="amount"> <?php echo $curr['IDR']."".$offer['actual_price'];?></span>
																
															<?php }?>
                                                        <em><?php echo $roomArr->currentAllotment ?> room available</em>
                                                    </div>
                                                    <a class="awe-btn hvr-rectangle-out" href="<?php echo site_url('hotel-booking/'.$hotel_details->search_info->session_id.'/'.$roomArr->room_code);?>">Book Now</a>
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
                    <!--< div class="col-md-3" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1182px;">
                        
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
                                     FORM ROOM
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
                                     END / FORM ROOM 

                                     FORM ROOM 
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
                                    END / FORM ROOM 

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
                        </div></div></div> -->
                </div>
                <?php } ?>
            </div>
        </section> 
  <script>	
	window.fbAsyncInit = function() {
    FB.init({
      appId      : '135698087212324',
      xfbml      : true,
       status     : true,
        cookie     : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };
	function shareFb(hotel_name,hotel_desc){
		
		str_desc = hotel_desc.replace(/<{1}[^<>]{1,}>{1}/g," ");
		FB.ui({
			method: 'feed',
			display: 'popup',
			href: 'http://exceptionaire.co/rumbostar/',
			name: hotel_name,
			link: site_url,
			picture: 'http://exceptionaire.co/rumbostar/assets/images/samplee.jpg',
			caption: 'Rumbostar',
			description: str_desc
	
 }, function(response){
 });
}
            $(document).on('ready', function(){
                $('#input-3-xs').rating({displayOnly: true, step: 0.5});
            });

function shareinsocialmedia(url){
  window.open(url,'sharein','toolbar=0,status=0,width=648,height=395');
  return true;
  }
</script>  

<div id="sharePost"></div>
<script>
  var options = {
    contenturl: 'https://plus.google.com/pages/',
    contentdeeplinkid: '/pages',
    clientid: '693044186785-v72ijvg5hu933kq72dlojikg7ovklrgc.apps.googleusercontent.com ',
    cookiepolicy: 'single_host_origin',
    prefilltext: 'Create your Google+ Page too!',
    calltoactionlabel: 'CREATE',
    calltoactionurl: 'http://plus.google.com/pages/create',
    calltoactiondeeplinkid: '/pages/create'
  };
  // Call the render method when appropriate within your app to display
  // the button.
  gapi.interactivepost.render('sharePost', options);
</script>

<!-- https://accounts.google.com/o/oauth2/auth?client_id=693044186785-v72ijvg5hu933kq72dlojikg7ovklrgc.apps.googleusercontent.com%20&redirect_uri=postmessage&response_type=code%20token%20id_token%20gsession&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.login&cookie_policy=single_host_origin&include_granted_scopes=true&proxy=oauth2relay878530464&origin=http%3A%2F%2Fexceptionaire.co&gsiwebsdk=1&state=1740707399%7C0.1360280402&&jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.en.rH_DNAowp7o.O%2Fm%3D__features__%2Fam%3DAQ%2Frt%3Dj%2Fd%3D1%2Frs%3DAGLTcCPjBnH1F4aCnBCh3-1YeKgkbV6kbg -->