<?php echo $css;?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Offer</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i>Home</a></li>
			<li><a href="javascript:void(0)">Add Offer</a></li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" id="offer-general-info" name="offer_general_info" method="post">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Hotel Offer Information</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>					
					</div>
				</div>
				<div class="box-body">
					<div class="box-primary">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<label for="name">City <span class="required-star">*</span></label>
								<div class="form-item">
                                     <i class="awe-icon awe-icon-marker-1"></i>
                                     <input name="destination" class="form-control" id="id_destination" type="text" placeholder="City" value="<?php echo (isset($arrOfferRes[0]->hotel_city) && $arrOfferRes[0]->hotel_city !='') ? $arrOfferRes[0]->hotel_city : set_value('offer_price'); ?>">
								</div>
								<div class="add-form-error-msg" id="error_destination"><?php echo form_error('destination');?></div>	
							</div>
							<div class="form-group margine-zero">
								<div class="form-group margine-zero">
								<label for="name">Offer Price <span class="required-star">*</span></label>
								<input type="text" class="form-control" id="offer-price" name="offer_price" placeholder="Offer Price" value="<?php echo (isset($arrOfferRes[0]->offer_amount) && $arrOfferRes[0]->offer_amount !='') ? $arrOfferRes[0]->offer_amount: set_value('offer_price'); ?>">
								<div class="add-form-error-msg" id="error_offer_name"><?php echo form_error('offer_price');?></div>
							</div>
							<div class="form-group margine-zero">
								<label for="Emailid "> Offer Start Date <span class="required-star">*</span></label>
								<input type="text" class="form-control prv_date_pick" id="start-date" name="start_date" placeholder="Start Date" readonly value="<?php echo (isset($arrOfferRes[0]->offer_start_date) && $arrOfferRes[0]->offer_start_date !='') ? $arrOfferRes[0]->offer_start_date: set_value('start_date'); ?>">
								<div class="add-form-error-msg" id="error_start_date"><?php echo form_error('start_date');?></div>
							</div>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
							<!--<div class="form-group margine-zero">
								<label for="name">Hotel Name <span class="required-star">*</span></label>
								<input type="text" class="form-control" id="offer-price" name="offer_price" placeholder="Offer Price" value="<?php echo (isset($arrOfferRes[0]->offer_amount) && $arrOfferRes[0]->offer_amount !='') ? $arrOfferRes[0]->offer_amount: set_value('offer_price'); ?>">
								<div class="add-form-error-msg" id="error_offer_name"><?php echo form_error('offer_price');?></div>
							</div>-->
							<div class="form-group margine-zero">
								<label for="name">Offer Name<span class="required-star">*</span></label>
								<input type="text" class="form-control" id="offer" name="offer_name" placeholder="Offer Name" value="<?php echo (isset($arrOfferRes[0]->offer_name) && $arrOfferRes[0]->offer_name !='') ? $arrOfferRes[0]->offer_name: set_value('offer_name'); ?>">
								<div class="add-form-error-msg" id="error_offer_name"><?php echo form_error('offer_name');?></div>
							</div>
							<div class="form-group margine-zero">
								<label for="name">Offer in<span class="required-star">*</span></label>
								<select name="offer_in" id=offer-in" class="form-control" style="width: 100%;">
									<option value="0" <?php if(isset($arrOfferRes) && ($arrOfferRes[0]->offer_in == '0')) {?> 'selected=selected'<?php } ?>>%</option>
									<option value="1" <?php if(isset($arrOfferRes) && ($arrOfferRes[0]->offer_in == '1')) {?> 'selected=selected'<?php } ?>>Price</option>
								</select>
								<div class="add-form-error-msg" id="error_offer_name"><?php echo form_error('offer_in');?></div>
							</div>
							<div class="form-group margine-zero">
								<label for="Emailid ">  Offer End Date <span class="required-star">*</span></label>
								<input type="text" class="form-control prv_date_pick" id="end-date" name="end_date" placeholder="end date" readonly value="<?php echo (isset($arrOfferRes[0]->offer_end_date) && $arrOfferRes[0]->offer_end_date !='') ? $arrOfferRes[0]->offer_end_date: set_value('end_date'); ?>">
								<div class="add-form-error-msg" id="error_end_date"><?php echo form_error('end_date');?></div>
							</div>
						</div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<input type="submit" id="hotel_setting" name="hotel_setting" value="Add" class="btn btn-primary">
							</div>
						</div>
					</div>	
					<div class="clearfix"></div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php echo $js;?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANW-cybl9tojcY1sCD2CDLPRtxduunUz8&libraries=places&callback=initAutocomplete" async defer></script>
<script>

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
  autocomplete.addListener('place_changed',fillInAddress);
}
	
function fillInAddress() {
  var place = autocomplete.getPlace();
    $("#id_destination").val(place.address_components[0].long_name);
    //$.ajax({
	//	url:site_url+'offer_management/city_hotel_result',
		//data:{city_name:place.address_components[0].long_name},
		//type:'post',
		//success:function(data){
			//alert('success');	
		//}
//	});
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
	
$(".prv_date_pick").each(function(){
	$(this).datepicker({
      dateFormat: "dd-mm-yy",
      changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            minDate: 0,
      }); 
});

$("#offer-general-info").submit(function(){
var validArr = [];


	if($("#start-date").val()!='' && $("#end-date").val() !='' && $("#start-date").val()  ==  $("#end-date").val()){
		$("#error_end_date").html("Date must be in the future.");
		validArr[0] = false;		
	}
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){
			$(".gif-loader").hide();
			return false;
		}
	}
});
</script>
