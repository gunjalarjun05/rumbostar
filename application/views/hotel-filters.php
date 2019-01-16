
<div class="page-sidebar">
    <form action="<?php echo site_url('hotel');?>" type="post" name="jotel_filter_form" id="hotel-filter-form" method="post">
        <div class="sidebar-title">
            <h2>HOTEL FILTER</h2>

            <!--<div class="clear-filter">
                <a href="#">Clear all</a>
            </div>-->
        </div>
        <!-- WIDGET -->
       <!-- <div class="widget widget_has_radio_checkbox">
            <h3>Hotel Type</h3>
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="hotel_type[]" <?php echo (isset($filterarr[0]) &&  in_array('bed & breakfast', $filterarr[0])) ? 'checked=checked':'';?> value="bed & breakfast">
                        <i class="awe-icon awe-icon-check"></i>
                        Bed & Breakfast
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="hotel_type[]" <?php echo (isset($filterarr[0]) && in_array('hotel', $filterarr[0])) ? 'checked=checked':'';?> value="hotel">
                        <i class="awe-icon awe-icon-check"></i>
                        Hotel
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="hotel_type[]" <?php echo (isset($filterarr[0]) && in_array('vacation rental/condo', $filterarr[0])) ? 'checked=checked':'';?> value="vacation rental/condo">
                        <i class="awe-icon awe-icon-check"></i>
                        Vacation rental/Condo
                    </label>
                </li>           
            </ul>
        </div>
        <!-- END / WIDGET -->


                    <div class="form-group hotel-search-filter">
                        <div class="form-elements hotel-loc">
                            <label>Location</label>
                            <div class="form-item">
                                <i class="awe-icon awe-icon-marker-1"></i>
                                <input type="text" name="destination" id="id_destination" placeholder="City" value="<?php echo (isset($search_info['city']) && $search_info['city']!='')?$search_info['city']:'';?>">
                            </div>
                        </div>
                        <div class="form-elements hotel-checkin">
                            <label>Check in</label>
                            <div class="form-item">
                                <span class="show-icon">
                                    <img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img">
                                </span>
                                <input type="text" name="checkin" id="id_checkin" class="awe-calendar" placeholder="Date" value="<?php echo (isset($search_info['ci']) && $search_info['ci']!='' )? date('d-m-Y',strtotime($search_info['ci'])):'';?>">
                            </div>
                        </div>
                        <div class="form-elements hotel-checkout">
                            <label>Check out</label>
                            <div class="form-item">
                                <span class="show-icon">
                                    <img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img">
                                </span>
                                <input type="text" name="checkout" id="id_checkout" class="awe-calendar" placeholder="Date" value="<?php echo (isset($search_info['co']) && $search_info['co']!='') ? date('d-m-Y',strtotime($search_info['co'])):'';?>"> 
                            </div>
                            <div id="id_checkout_error"></div>
                        </div>
                        <div class="form-elements hotel-guest">
                            <label>Guest</label>
                            <div class="form-item">
                                <div class="awe-select-wrapper">
                                    <select class="awe-select" name="guest" id="id_guest">
                                        <option value="" >Guest</option>
                                        <option value="1" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 1)?'selected=selected':'';?> >1</option>
                                        <option value="2" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 2)?'selected=selected':'';?>>2</option>
                                        <option value="3" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 3)?'selected=selected':'';?>>3</option>
                                        <option value="4" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 4)?'selected=selected':'';?>>4</option>
                                        <option value="5" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 5)?'selected=selected':'';?>>5</option>
                                        <option value="6" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 6)?'selected=selected':'';?>>6</option>
                                        <option value="7" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 7)?'selected=selected':'';?>>7</option>
                                        <option value="8" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 8)?'selected=selected':'';?>>8</option>
                                        <option value="9" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 9)?'selected=selected':'';?>>9</option>
                                        <option value="10" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 10)?'selected=selected':'';?>>10</option>
                                    </select><i class="fa fa-caret-down"></i></div>
                                </div>
                            </div>
                            <div class="form-elements advancenoofrooms">
                                        <label>Number of Rooms</label>
                                        <div class="form-item">
											<select class="awe-select select_css_guest" name="number_of_rooms" id="id_number-of-rooms">
                                                <option value="">Rooms</option>
                                                <option value="1" <?php echo (isset($search_info['room']) && $search_info['room'] == 1)?'selected=selected':'';?>>1</option>
                                                <option value="2" <?php echo (isset($search_info['room']) && $search_info['room'] == 2)?'selected=selected':'';?>>2</option>
                                                <option value="3" <?php echo (isset($search_info['room']) && $search_info['room'] == 3)?'selected=selected':'';?>>3</option>
                                                <option value="4" <?php echo (isset($search_info['room']) && $search_info['room'] == 4)?'selected=selected':'';?>>4</option>
                                                <option value="5" <?php echo (isset($search_info['room']) && $search_info['room'] == 5)?'selected=selected':'';?>>5</option>
                                                <option value="6" <?php echo (isset($search_info['room']) && $search_info['room'] == 6)?'selected=selected':'';?>>6</option>
                                                <option value="7" <?php echo (isset($search_info['room']) && $search_info['room'] == 7)?'selected=selected':'';?>>7</option>
                                                <option value="8" <?php echo (isset($search_info['room']) && $search_info['room'] == 8)?'selected=selected':'';?>>8</option>
                                                <option value="9" <?php echo (isset($search_info['room']) && $search_info['room'] == 9)?'selected=selected':'';?>>9</option>
                                                <option value="10" <?php echo (isset($search_info['room']) && $search_info['room'] == 10)?'selected=selected':'';?>>10</option>
                                            </select>
                                        </div>
                                    </div>

<!--                             <div class="form-actions find-hotel-btn">
                                <input value="FIND MY HOTEL" type="submit" name="searchotel">
                            </div> -->
                        </div>

        <!-- WIDGET -->
        <div class="widget widget_price_filter">
            <h3>Price Level</h3>
            <div class="price-slider-wrapper">
                <div id="price_slider" class="price-slider"></div>                
                <div class="price_slider_amount">
                    <input type="hidden" id="range-slide-min" name="range_slide_min" value="<?php echo (isset($filterarr[3][0]) && $filterarr[3][0]!='')?$filterarr[3][0]:'';?>">
                    <input type="hidden" id="range-slide-max" name="range_slide_max" value="<?php echo (isset($filterarr[3][1]) && $filterarr[3][1]!='')?$filterarr[3][1]:'';?>">
                    <div class="price_label">
                        <span class="from"></span> - <span class="to"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END / WIDGET -->

        <!-- WIDGET -->
        <div class="widget widget_has_radio_checkbox">
            <h3>Star Rating</h3>
            <input id="input-3-xs" name="star_rating_text" value="<?php echo (isset($filterarr[1][0]) && $filterarr[1][0]!='') ? $filterarr[1][0]:'';?>" class="rating-loading" data-size="xs">
            <input type="hidden" class="hidden_rating" name="star_rating" value="<?php echo (isset($filterarr[1][0]) && $filterarr[1][0]!='') ? $filterarr[1][0]:'';?>" >
            <!--<ul>
                <li>
                    <label>
                        <input type="checkbox" name="star_rating[]" <?php echo (isset($filterarr[1]) && in_array('5', $filterarr[1])) ? 'checked=checked':'';?> value="5">
                        <i class="awe-icon awe-icon-check"></i>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="star_rating[]" <?php echo (isset($filterarr[1]) && in_array('4', $filterarr[1])) ? 'checked=checked':'';?> value="4">
                        <i class="awe-icon awe-icon-check"></i>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="star_rating[]" <?php echo (isset($filterarr[1]) && in_array('3', $filterarr[1])) ? 'checked=checked':'';?> value="3">
                        <i class="awe-icon awe-icon-check"></i>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="star_rating[]" <?php echo (isset($filterarr[1]) && in_array('2', $filterarr[1])) ? 'checked=checked':'';?> value="2">
                        <i class="awe-icon awe-icon-check"></i>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="star_rating[]" <?php echo (isset($filterarr[1]) && in_array('1', $filterarr[1])) ? 'checked=checked':'';?> value="1">
                        <i class="awe-icon awe-icon-check"></i>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                        </span>
                    </label>
                </li>
            </ul>-->
        </div>
        <!-- END / WIDGET -->

        <!-- WIDGET -->
        <div class="widget widget_has_radio_checkbox">
            <h3>Service Include</h3>
            <ul>
                <!--<li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) && in_array('Accessible Bathroom', $filterarr[2])) ? 'checked=checked':'';?> value="Accessible Bathroom">
                        <i class="awe-icon awe-icon-check"></i>
                        Accessible Bathroom
                    </label>
                </li>-->
                <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Restaurant On-site', $filterarr[2])) ? 'checked=checked':'';?> value="Restaurant On-site">
                        <i class="awe-icon awe-icon-check"></i>
                        Restaurant
                    </label>
                </li>
                <!--<li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('In-room Accessibility', $filterarr[2])) ? 'checked=checked':'';?> value="In-room Accessibility">
                        <i class="awe-icon awe-icon-check"></i>
                        In-room Accessibility
                    </label>
                </li>-->
               <!-- <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Roll-in Shower', $filterarr[2])) ? 'checked=checked':'';?> value="Roll-in Shower">
                        <i class="awe-icon awe-icon-check"></i>
                        Roll-in Shower
                    </label>
                </li>-->
                <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Internet Access Available', $filterarr[2])) ? 'checked=checked':'';?> value="Internet Access Available">
                        <i class="awe-icon awe-icon-check"></i>
                        Internet
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Breakfast', $filterarr[2])) ? 'checked=checked':'';?> value="Breakfast">
                        <i class="awe-icon awe-icon-check"></i>
                        Breakfast
                    </label>
                </li>
                <!--<li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Free Parking', $filterarr[2])) ? 'checked=checked':'';?> value="Free Parking">
                        <i class="awe-icon awe-icon-check"></i>
                        Free Parking
                    </label>
                </li>-->
               <!-- <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Fitness Center', $filterarr[2])) ? 'checked=checked':'';?> value="Fitness Center">
                        <i class="awe-icon awe-icon-check"></i>
                        Fitness Center
                    </label>
                </li>-->
                <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Parking', $filterarr[2])) ? 'checked=checked':'';?> value="Parking">
                        <i class="awe-icon awe-icon-check"></i>
                        Parking
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="service_include[]" <?php echo (isset($filterarr[2]) &&  in_array('Business Center', $filterarr[2])) ? 'checked=checked':'';?> value="Business Center">
                        <i class="awe-icon awe-icon-check"></i>
                        Smoking Area
                    </label>
                </li>
            </ul>
        </div>
        <!-- END / WIDGET -->
        <button id="hotel-filter" class="awe-btn primary pull-right hvr-rectangle-out" name="applyfilter"  value="Apply Filter">Apply Filter</button>
    </form>

</div>




<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANW-cybl9tojcY1sCD2CDLPRtxduunUz8&libraries=places&callback=initAutocomplete" async defer></script>
<script type="text/javascript">
 
/* sk social login/register - user type radio button show in popup 28-12-2017
<?php if(isset($social_register) && $social_register[0] != ''){
    if($social_register[0]->users_type == ''){ ?>
        $('#socialRegisterModel').modal('show');
        $('#user_id').val(<?php echo $social_register[0]->user_id; ?>)
   <?php }
} ?>*/


var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('id_destination')),
      {types: ['geocode']});

  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
  }

  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    console.log(componentForm);
    if (componentForm[addressType]) {
       $("#id_destination").val(place.address_components[0].long_name);
    }
  }
}

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      console.log(position.coords.latitude);
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accurautocompleteacy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>