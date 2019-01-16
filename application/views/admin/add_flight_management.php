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
					<h3 class="box-title">Flight Offer Information</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>					
					</div>
				</div>
				<div class="box-body">
					<div class="box-primary">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<label for="name">Flight Name<span class="required-star">*</span></label>
								<select name="flight_name" id="flight-name"  class="form-control" style="width: 100%;">
									<option value="">Select</option>
									<?php if(count($arr_flight_name)>0){
										foreach($arr_flight_name as $k=>$val){
											echo'code'.$val->al_name.'---'.$val->al_code;
											 ?>
										<option value="<?php echo $val->al_name.'---'.$val->al_code?>" <?php if(isset($arrOfferRes) && ($arrOfferRes[0]->flight_code == $val->al_code)) { ?> selected = "selected" <?php } ?> ><?php echo $val->al_name.' --- '.$val->al_code ?></option>
										<?php 
										} 
									}
									?>
								</select>
								<div class="add-form-error-msg" id="error_flight_name"><?php echo form_error('flight_name');?></div>	
							</div>
							<div class="form-group margine-zero">
								<label for="name">Offer Price<span class="required-star">*</span></label>
								<input type="text" class="form-control" id="offer-price" name="offer_price" placeholder="Offer Price" value="<?php echo (isset($arrOfferRes[0]->offer_amount) && $arrOfferRes[0]->offer_amount !='') ? $arrOfferRes[0]->offer_amount: set_value('offer_price'); ?>">
								<div class="add-form-error-msg" id="error_offer_price"><?php echo form_error('offer_price');?></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<label for="name">Offer Name<span class="required-star">*</span></label>
								<input type="text" class="form-control" id="offer" name="offer_name" placeholder="Offer Name" value="<?php echo (isset($arrOfferRes[0]->offer_name) && $arrOfferRes[0]->offer_name !='') ? $arrOfferRes[0]->offer_name: set_value('offer_name'); ?>">
								<div class="add-form-error-msg" id="error_offer_name"><?php echo form_error('offer_name');?></div>
							</div>
							<div class="form-group margine-zero">
								<label for="name">Offer in<span class="required-star">*</span></label>
								<select name="offer_in" id="offer-in" class="form-control" style="width: 100%;">
									<option value="0" <?php if(isset($arrOfferRes) && ($arrOfferRes[0]->offer_in == '0')) {?> 'selected=selected'<?php } ?>>%</option>
									<option value="1" <?php if(isset($arrOfferRes) && ($arrOfferRes[0]->offer_in == '1')) {?> 'selected=selected'<?php } ?>>Price</option>
								</select>
								<div class="add-form-error-msg" id="error_offer_in"><?php echo form_error('offer_in');?></div>
							</div>
							
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<label for="Emailid "> Offer Start Date <span class="required-star">*</span></label>
								<input type="text" class="form-control prv_date_pick" id="start-date" name="start_date" placeholder="Start Date" readonly value="<?php echo (isset($arrOfferRes[0]->offer_start_date) && $arrOfferRes[0]->offer_start_date !='') ? $arrOfferRes[0]->offer_start_date: set_value('start_date'); ?>">
								<div class="add-form-error-msg" id="error_start_date"><?php echo form_error('start_date');?></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<label for="Emailid ">  Offer End Date <span class="required-star">*</span></label>
								<input type="text" class="form-control prv_date_pick" id="end-date" name="end_date" placeholder="end date" readonly value="<?php echo (isset($arrOfferRes[0]->offer_end_date) && $arrOfferRes[0]->offer_end_date !='') ? $arrOfferRes[0]->offer_end_date: set_value('end_date'); ?>">
								<div class="add-form-error-msg" id="error_end_date"><?php echo form_error('end_date');?></div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xm-12">
							<div class="form-group margine-zero">
								<input type="submit" id="flight-setting" name="flight_setting" value="Add" class="btn btn-primary">
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
<script>
$(".prv_date_pick").each(function(){
	$(this).datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      minDate: 0,
      }); 
});
</script>

<script type="text/javascript">
	
	$(function () {
    $("#start-date").datepicker({
        numberOfMonths: 1,
        minDate : 0,
        onSelect: function (selected) {
            var dt = new Date(selected);
            //dt.setDate(dt.getDate() + 1);
            $("#end-date").datepicker("option", "minDate", dt);
        }
    });
    $("#end-date").datepicker({
        numberOfMonths: 1,
        
    });
});


$("#offer-general-info").submit(function(){
var validArr = [];
	
	if($("#flight-name").val() == ''){		
		$("#error_flight_name").html("The flight name field is required.");
		validArr[0] = false;
	}

	if($("#offer-price").val() == ''){
		$("#error_offer_price").html("The offer price field is required.");
		validArr[1] = false;		
	}

	if($("#offer").val() == ''){		
		$("#error_offer_name").html("The offer name field is required.");
		validArr[2] = false;
	}
	
	
	if($("#offer-in").val() == ''){
		$("#error_offer_in").html("The offer in field is required.");
		validArr[3] = false;	
	}

	if($("#start-date").val() == ''){
		$("#error_start_date").html("The start date field is required.");
		validArr[4] = false;
	}

	if($("#end-date").val() == ''){
		$("#error_end_date").html("The end date field is required.");
		validArr[4] = false;
	}else{

		if($("#start-date").val()!= '' && $("#end-date").val() != '' && $("#start-date").val()  ==  $("#end-date").val()){
		$("#error_end_date").html("Date must be in the future.");
		validArr[4] = false;		
		}

		if($("#start-date").val()!= '' && $("#end-date").val() != '' && $("#start-date").val()  >  $("#end-date").val()){
		$("#error_end_date").html("Date must be in the future.");
		validArr[4] = false;
		}
	}

	

	
	for(i=0;i<validArr.length;i++){
		if(validArr[i] == false){
			$(".gif-loader").hide();
			return false;
		}
	}
});


	
</script>
