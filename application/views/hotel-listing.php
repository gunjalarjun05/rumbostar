<!-- PRELOADER -->
<div class="preloader"></div>
<script src="http://connect.facebook.net/en_US/sdk.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- END / PRELOADER -->
<section class="awe-parallax category-heading-section-demo" style="background-position: 50% 12px;">
    <div class="hotel-bred-sec">
        <div class="container">
                <!-- BREADCRUMB -->
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo site_url();?>">Home</a></li>
                <li><span>Hotels</span></li>
            </ul>
        </div>
        <!-- BREADCRUMB -->
        </div>
    </div>
    <div class="awe-overlay"></div>
    <div class="container hotel-list-page">
        <div class="category-heading-content category-heading-content__2 text-uppercase">
            <div class="find">
                <h2 class="text-center">Find Your Hotel</h2>
            </div>
        </div>
        </div>
    </section>
    <section class="filter-page hotel-listing-cls">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-top">
                        <ul class="list-link">
                            <li><a href="<?php echo site_url('flight');?>">Flight</a></li>
                            <li class="current"><a href="<?php echo site_url('hotel');?>">Hotel</a></li>
                            <li><a href="<?php echo site_url('train');?>">Train</a></li>
                        </ul>
                        <div class="awe-select-wrapper">
                            <select class="awe-select" onchange="hotel_sort_change(this,'<?php echo $pageid;?>')">
                                <option value="">Sort By</option>
                                <option value="1" <?php echo ($this->uri->segment(3) == 1)?'selected=selected':'' ?>>Name A-Z</option>
                                <option value="2" <?php echo ($this->uri->segment(3) == 2)?'selected=selected':'' ?>>Name Z-A</option>
                                <option value="3" <?php echo ($this->uri->segment(3) == 3)?'selected=selected':'' ?>>Price Low to High</option>
                                <option value="4" <?php echo ($this->uri->segment(3) == 4)?'selected=selected':'' ?>>Price High to Low</option>
                            </select>
                            <i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-push-3">
                        <div class="filter-page__content">
                            <div class="filter-item-wrapper">
                                <?php if(isset($errorMsg) && $errorMsg!=''):?>
                                    <div><?php echo $errorMsg;?></div>
                                <?php endif;?>
                                <?php if(isset($result) && count($result)>0):?>
                                  
                                  <?php  //echo '<pre>';
                                  //print_r($result);
                                  ?>


                                <?php  
                                  foreach($result as $resultd):?>
                                  <?php  //echo '<pre>';
                                  //print_r($resultd);
                                  ?>
                                  <!-- ITEM -->
                                  <div class="hotel-item box-effect">
                                    <div class="item-media">
                                      <div class="image-cover">
                                  <!-- <img src="<?php echo (file_exists($resultd->largeThumbnailURL))? $resultd->largeThumbnailURL:site_url().ASSETS_IMAGES.'/no-img.jpg'; ?>" alt="<?php echo (isset($resultd->name) && $resultd->name!='')? $resultd->name:''; ?>" >  -->

                                    <img src="<?php echo ($resultd->largeThumbnailURL)? $resultd->largeThumbnailURL:site_url().ASSETS_IMAGES.'/no-img.jpg'; ?>" alt="<?php echo (isset($resultd->name) && $resultd->name!='')? $resultd->name:''; ?>" >
                                    </div>
                                    </div>
                                    <div class="item-body">
                                       <div class="item-title">
                                        <h2>
                                         <a href="<?php echo site_url().'hotel-details/'.$session_id.'/'.$resultd->hotelId;?>"><?php echo (isset($resultd->name) && $resultd->name !='')? $resultd->name:''; ?></a>
                                     </h2>
                                 </div>
                                 <div class="item-hotel-star">
                                     <!--<input id="input-3-xs" name="input-3" value="<?php echo (isset($resultd->review_rating->reviewOverall) && $resultd->review_rating->reviewOverall!='')? $resultd->review_rating->reviewOverall:''; ?>" class="rating-loading all-listrate" data-size="xs">-->
                                     <input id="input-3-xs" name="input-3" value="<?php echo $resultd->review_rating->reviewOverall; ?>" class="rating-loading all-listrate" data-size="xs">
                                 </div>
                                 <div class="item-address">
                                    <i class="awe-icon awe-icon-marker-2"></i>
                                    <?php $address=(isset($resultd->address) && $resultd->address!='')? $resultd->address:'';
                                          $cityname=(isset($resultd->cityName) && $resultd->cityName!='')? $resultd->cityName:'';
                                          echo $address.", ".$cityname; ?> 
                                </div>
                                <div class="item-desciption">
                                <?php echo  (isset($resultd->shortDescription) && $resultd->shortDescription!='')? $resultd->shortDescription:'';
                                   ?> 
                                  
                                </div>
                                <div class="item-footer">
                                    <div class="item-rate">
                                     <span><?php echo (count($resultd->amenities)>0)?implode(",",$resultd->amenities):''; ?></span>
                                 </div>                                           
                             </div>
                         </div>
                         <div class="item-price-more">
                           <div class="price">
							           <?php
                             $curren=(isset($curr['IDR']) && $curr['IDR']!='')? $curr['IDR']:'';
                             $offer = get_hotel_city_offer($resultd->cityName,$resultd->price);
              							if($offer['discounted_price'] > 0){ ?>
              							  <del><?php echo $curren."".$offer['actual_price'];?></del>
              								<span class="damount"> <?php echo $curren."".$offer['discounted_price']; ?></span>
              								<?php }else {?>
              							   <span class="amount"> <?php echo $curren."".$offer['actual_price'];?></span>
              							   <?php } ?>
              							</div>
                        <?php $hotelid=(isset($resultd->hotelId) && $resultd->hotelId!='')? $resultd->hotelId:'';?>

                                                
                        <a href="<?php echo site_url().'hotel-details/'.$session_id.'/'.$hotelid;?>" class="awe-btn hvr-rectangle-out">View Details</a>
                        <div class="share-icon">
                          <ul>
                            <?php 
                             $ShareUrl = urlencode(site_url());
                             $Title = $resultd->name.' '.$resultd->shortDescription;
                             $Media = $resultd->largeThumbnailURL;
                             $desc = $resultd->shortDescription;
                            ?>   

                              <li class="fb">
                               <!-- <a href="javascript:void(0)" onclick="shareinsocialmedia('http://www.facebook.com/share.php?u=<?php echo $ShareUrl;?>&title=<?php echo $Title;?>')">
                               <i class="fa fa-facebook" aria-hidden="true"></i></a>  -->  

                               <!-- <a href="javascript:void(0)" class="share" data-url="<?php echo site_url().'hotel-details/'.$session_id.'/'.$hotelid;?>" ><i class="fa fa-facebook" aria-hidden="true"></i></a> -->

                                <a href="javascript:void(0)" data-id="<?php echo $resultd->hotelId ?>" class="fbsharebutton"><i class="fa fa-facebook" aria-hidden="true"></i></a>

                                <input type="hidden" name="hotel_id" id="hotel_id" data-id="<?php echo $resultd->hotelId?>">

                                <input type="hidden" name="hotel_name" id="hotel_name-<?php echo $resultd->hotelId?>" value="<?php echo strip_tags($Title) ?>">
                                <input type="hidden" name="hotel_desc" id="hotel_desc-<?php echo $resultd->hotelId?>" value="<?php echo strip_tags($desc) ?>">

                                <input type="hidden" name="hotel_media" id="hotel_media-<?php echo $resultd->hotelId?>" value="<?php echo $Media ?>">

                                <input type="hidden" name="hote_url" id="hotel_url-<?php echo $resultd->hotelId?>" value="<?php echo $ShareUrl ?>">

                              </li>

                            
                            <li class="tw"><a href="javascript:void(0)" onclick="shareinsocialmedia('http://twitter.com/home?status=<?php echo strip_tags($Title); ?>+<?php echo $ShareUrl; ?>+<?php echo $Media; ?>')" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                              <li class="gplus">
                              <!--  <g:plus action="share"></g:plus> -->
                              <!--  <a href="javascript:void(0)" onclick="shareinsocialmedia('https://plus.google.com/share?url=<?php echo site_url().'hotel-details/'.$session_id.'/'.$hotelid;?>')"> -->

                              <a  href="javascript:void(0)" id="myBtn"  class="demo g-interactivepost"
                              data-clientid="588805674563-ulnaaq0mo5q6v3rbl1emdmkb459nblp1.apps.googleusercontent.com"
                              data-contenturl="http://exceptionaire.co/rumbostar/hotel-details/NghPdGDepe8IvpLzJvOD0jMpWW5-SELnT-fvyrNOMb8/476989 <?php //echo site_url().'hotel-details/'.$session_id.'/'.$hotelid;?>"
                              data-calltoactionlabel="INVITE"
                              data-calltoactionurl="https://developers.google.com/+/web/share/interactive?invite=false"
                              data-cookiepolicy="single_host_origin"
                              data-prefilltext="<?php echo strip_tags($Title); ?>"
                              >
                            <!-- <span class="icon">&nbsp;</span> -->
                           

                              <!-- <a onclick="shareinsocialmedia('https://plus.google.com/share?url=<?php echo strip_tags($Title); ?>+<?php echo $ShareUrl; ?>')" href=""> -->

                             <!--  <a href="javascript:void(0)" class="g-interactivepost"
                              data-contenturl="https://plus.google.com/pages/"
                              data-contentdeeplinkid="/pages"
                              data-clientid="xxxxx.apps.googleusercontent.com"
                              data-cookiepolicy="single_host_origin"
                              data-prefilltext="Engage your users today, create a Google+ page for your business."
                              data-calltoactionlabel="CREATE"
                              data-calltoactionurl="http://plus.google.com/pages/create"
                              data-calltoactiondeeplinkid="/pages/create">  -->
                              <!-- <a href="javascript:void(0)" onclick="
                              shareinsocialmedia('https://plus.google.com/share?url=<?php echo $ShareUrl; ?>+<?php echo strip_tags($Title); ?>')"> -->
                              <i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                          </ul>
                        </div>
                    </div>
                </div>
                <!-- END / ITEM -->
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <!-- PAGINATION -->
    <div class="page__pagination pull-right">
        <?php echo (isset($no_of_pages) && $no_of_pages!='')?$no_of_pages:'';?>
    </div>
    <!-- END / PAGINATION -->
</div>
</div>
<div class="col-md-3 col-md-pull-9">
    <?php $this->load->view('hotel-filters',array("filterarr"=>$filterInputs,'search_info'=>$search_info));?>
</div>
</div>
</div>
</section>





<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=135698087212324';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANW-cybl9tojcY1sCD2CDLPRtxduunUz8&libraries=places&callback=initAutocomplete" async defer></script>


<script src="http://platform.twitter.com/widgets.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.twitterbutton.js" type="text/javascript"></script>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>

<script>	



window.fbAsyncInit = function() {
    FB.init({
        appId: '316724998844961', 
        xfbml      : true,
        version    : 'v2.1'       
    });
    
};

(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


$(document).ready(function(){

$('.fbsharebutton').click(function(e){
  var hotelId = $(this).attr('data-id');
  
  var hotel_name = $("#hotel_name-"+hotelId).val();
  var hotel_desc = $("#hotel_desc-"+hotelId).val();
  var hote_image = $("#hotel_media-"+hotelId).val();
  var hote_url = $("#hotel_url-"+hotelId).val();
   
e.preventDefault();

FB.ui({
            method: 'share_open_graph',
            action_type: 'og.shares',
            action_properties: JSON.stringify({
                object : {
                   'og:url': 'http://exceptionaire.co/rumbostar', // your url to share
                   'og:title': hotel_name,
                   'og:description': hotel_desc,
                   'og:image': hote_image
                }
            })
            },
            // callback
            function(response) {
            if (response && !response.error_message) {                
               // alert('successfully posted. Status id : '+response);
            } else {
               // alert('Something went error.');
            }
        });

});
});




	/*window.fbAsyncInit = function() {
    FB.init({
      appId      : '135698087212324',
      //status     : true,
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = '//connect.facebook.net/en_US/sdk.js';
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   
$(document).on('click','.share',function(){
    var link = $(this);
    var action = link.data('url');
    var tipId = link.attr('id');
  FB.ui(
    {
     
      method: 'feed',
      display: 'popup',
     // href: 'http://isecuritysolution.com/',
      name: 'dddddddddddd',
      link: action,
      picture: '',
      caption: 'Rumbostar',
      description: 'test'
      //redirect_uri:'https://www.facebook.com/dialog/return/close#_=_'
    },
    function(response, show_error) {
      window.close();      
    }
  );
});*/


/********************************************************************************************/

  
	/*window.fbAsyncInit = function() {
    FB.init({
      appId      : '150711062129929', //442288292615529
      xfbml      : true,
      status     : true,
      cookie     : true,
      version    : 'v2.6'
    });
    FB.AppEvents.logPageView();
  };
	function shareFb(hotel_name,hotel_desc,image,url){
		str_desc = hotel_desc.replace(/<{1}[^<>]{1,}>{1}/g," ");
		FB.ui({
			method: 'feed',
			display: 'popup',
      href: url,
			//href: site_url,
			name: hotel_name,
      link: url,
			//link: site_url,
      //picture: 'http://exceptionaire.co/rumbostar/assets/images/samplee.jpg',
			picture: image,
			caption: 'Rumbostar',
			description: str_desc
	
 }, function(response){
 });
}*/
	
    $(document).on('ready', function(){ var addr_flag = 1;
        $('.all-listrate').rating({displayOnly: true, step: 0.5});
         
        $('.rating-loading').rating({showClear: false,showCaption: false }).on('rating.change', function(event, value) {
			$(".hidden_rating").val(value);
		});


    });
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
         // flag = 0;
      autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
      var place = autocomplete.getPlace();

      for (var component in componentForm) {
      }

      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          console.log(place.address_components[0].long_name); 
        $("#id_destination").val(place.address_components[0].long_name);
        
        addr_flag = 1; 
         // $("#lng").val(place.geometry.location.lng());
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

$( "#mybookings" ).click(function() {
  var hrefs = $(this).attr('href'); 
   if(hrefs == '#bookings')
   {
       window.location.href = "<?php echo site_url(); ?>booking/my-flight-booking";
   }
});

$("#settings").click(function(){
    var hrefs = $(this).attr('href');   
    if(hrefs == '#setting')
    { 
        window.location.href = "<?php echo site_url(); ?>user/referred-code";
    }
});



function shareinsocialmedia(url){

  window.open(url,'sharein','toolbar=0,status=0,width=648,height=395');
  return true;
  }
</script>

