<?php //echo '<pre>';
//print_r($this->session->userdata);exit;
?>

<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
			
			<?php $this->load->view('user-left-menu');?>

			<div class="col-md-8 col-sm-8 info-right-sec">
			<div class="inner-sec">	
			<div class="tab-content">
			<div id="account" class="tab-pane fade">
				<h3>My Account</h3>
				<p></p>
			</div>
			<div id="profile" class="tab-pane fade in active">
				<h3>My Profile</h3>
				<div class="col-md-12 col-sm-12 user-details"> 		
					<div class="User-content">
						<section id="user_profile" class="ma-card-profile cfix">
							<!-- <div class="traveller-info-img">
							<img alt="" class="margin-bottom5" id="profile_editpersonal_img" src="https://imgak.mmtcdn.com/mima/images/add-image.png">
							</div> -->

							<div class="flL traveller-info-details">
								<p class="traveller-info-detail cfix margin-bottom10">
									<span class="flL width255  margin-rt20 elipses">
										<span id="profile_pers_name" title="getProfileName()"> 
										<?php echo ($userinfoView[0]->first_name.' '.$userinfoView[0]->last_name)?$userinfoView[0]->first_name.' '.$userinfoView[0]->last_name: 'N/A' ?>
										</span>
									</span>
									<a data-toggle="tab" href="#edit_profile" class="ma-green-btn proedit" id="profile_cotr_pers_editbutton">Edit</a>
								</p>        
								<div class="cfix infowrapp">            
									<p class="margin-bottom4">
									<span>Gender</span>
									<span>: <?php echo ($userinfoView[0]->gender)?$userinfoView[0]->gender: 'N/A'; ?></span>
									</p>
									<p class="margin-bottom4" id="profile_cotr_pers_mobile2">
									<span>
									<span>Phone</span>
									<span>: <?php echo ($userinfoView[0]->country_code)? $userinfoView[0]->country_code: 'N/A'; ?> - <?php echo ($userinfoView[0]->users_num)? $userinfoView[0]->users_num:'N/A'; ?></span>
									</span>
									</p>
									<!-- <p class="margin-bottom4" id="profile_cotr_pers_country">
									<span>
									<span>country code</span>
									<span>: <?php echo ($userinfoView[0]->country_code)? $userinfoView[0]->country_code: 'N/A'; ?> </span>
									</span>

									</p> -->

									<p class="margin-bottom4" id="profile_cotr_pers_email2">
									<span>
									<span>Email</span>
									<span>: <?php echo ($userinfoView[0]->users_email)? $userinfoView[0]->users_email: 'N/A'; ?></span>
									</span>

									</p>
									<p class="margin-bottom4" id="profile_cotr_pers_birthdate">
									<span>
									<span>Birth Date:</span>
									<span>:  <?php echo ($userinfoView[0]->birth_date)? $userinfoView[0]->birth_date: 'N/A'; ?></span>
									</span>

									</p>
									<?php if($this->session->userdata(USER_SESSION.'user_type') == 'AGENT'){ ?>
									<p class="margin-bottom4" id="profile_cotr_pers_agent_code">
									<span>
									<span>Agent ID:</span>
									<span>:  <?php 
									//print_r($userinfoView[0]->agent_id);exit;
									echo ($userinfoView[0]->agent_id)? $userinfoView[0]->agent_id: 'N/A'; ?></span>
									</span>

									</p>
									<?php } ?>
									<p class="margin-bottom4" id="profile_cotr_pers_passportno">
									<span>
									<span>Passport number</span>
									<span>: <?php echo ($userinfoView[0]->passport_no)? $userinfoView[0]->passport_no: 'N/A'; ?></span>
									</span>

									</p>
									<p class="margin-bottom4" id="profile_cotr_pers_cardtype">
									<span>
									<span>Card Type</span>
									<span>: <?php echo ($userinfoView[0]->card_type)? $userinfoView[0]->card_type: 'N/A'; ?></span>
									</span>

									</p>
									<p class="margin-bottom4" id="profile_cotr_pers_cardno">
									<span>
									<span>Card Number</span>
									<span>: <?php echo ($userinfoView[0]->card_number)? $userinfoView[0]->card_number: 'N/A'; ?> </span>
									</span>

									</p>
									<p class="margin-bottom4" id="profile_cotr_pers_cardhoname">
									<span>
									<span>Card Holder Name</span>
									<span>:<?php echo ($userinfoView[0]->card_holder_name)? $userinfoView[0]->card_holder_name: 'N/A'; ?></span>
									</span>

									</p>
									<p class="margin-bottom4" id="profile_cotr_pers_carexpdate">
									<span>
									<span>Expiry Date</span>
									<span>: <?php echo ($userinfoView[0]->card_expiry_date)? $userinfoView[0]->card_expiry_date: 'N/A'; ?></span>
									</span>
									</p>
									<!--  <p class="margin-bottom4" id="profile_cotr_pers_address">
									<span>
									<span>Address</span>
									<span>: Baner, pune, Maharashtra, India.</span>
									</span> 
									</p> -->
								</div>        
							</div>
						</section>
					</div>
				</div>
			</div>

			<div id="edit_profile" class="tab-pane fade" aria-expanded="">
				<h3>Edit Profile</h3>
					<div class="col-md-12 col-sm-12 user-details"> 		
					<div class="User-content">
						<section id="user_edit_profile" class="ma-card-profile cfix">
						<!-- 	<div class="traveller-info-img">
								<img alt="" class="margin-bottom5" id="profile_editpersonal_img" src="https://imgak.mmtcdn.com/mima/images/add-image.png">
								<a class="upload-btn-comp ma-green-btn inline-block" id="profile_editpersonal_uploadimg">Upload</a>
								<P class="upload_text">Upload Image</P>
								<input id="sortpicture" type="file" name="sortpic" />
								<button id="upload">Upload</button>
							</div> -->
							<div class="cfix infowrapp"> 
								<form class="proeditform user-details-sec" id="userinfo_form" action="" method="POST"> 	
									<div class="row">
										<div class="form-group paddright">
											<label for="name" control-label">First Name <span class="asterisk">*</span></label>
											<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $userinfo[0]->first_name;?>" />
											<div class="add-form-error-msg" id="error_first_name"></div>
										</div>

										<div class="form-group paddleft">
											<label for="name" control-label">Last Name <span class="asterisk">*</span></label>
											<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $userinfo[0]->last_name;?>" />
											<div class="add-form-error-msg" id="error_last_name"></div>
										</div>
									</div>

									<div class="row">
										<div class="form-group paddright">
											<label for="name" control-label">Email <span class="asterisk">*</span></label>
											<?php if($this->session->userdata(USER_SESSION.'user_from') == 'twitter' && $this->session->userdata(USER_SESSION.'emailid') == '' || $this->session->userdata(USER_SESSION.'user_from') == 'facebook' && $this->session->userdata(USER_SESSION.'emailid') == ''){ ?>
											<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $userinfo[0]->users_email;?>" />
											<?php }else{ ?>
											<input placeholder="Email" class="form-control"  value="<?php echo $userinfo[0]->users_email;?>" name="email" id="email" type="text" style="pointer-events: none;">
											<?php } ?>
											<div class="add-form-error-msg" id="error_email"></div>
										</div>
										<div class="form-group paddleft">
											<label for="name" control-label">Country Code <span class="asterisk">*</span></label>
											<div id="country_flag" class='iti-flag '></div>
											<span id="country_sortName" class="<?php echo ($userinfo[0]->sortname)?>"></span> 
											<select name="countries" id="countriesSelects" class="selectpicker form-control" data-style="btn-primary">
												<option value="">Country code</option>
												<?php 
												if(count($countrries_codedata)>0){
												foreach ($countrries_codedata as $value){ ?>    
												<option id="<?php echo $value->sortname; ?>" value="<?php echo $value->country_code ?>" <?php echo $userinfo[0]->country_code == $value->country_code ? 'selected':'';?>> 
												<?php echo $value->country_code ?> 
												</option>	      	
												<?php }
												}?> 
											</select>
											<div class="add-form-error-msg" id="error_country_code" ></div>
										</div>
									</div>
									<div class="row">
										<div class="form-group paddright">
											<label for="name" control-label">Contact No <span class="asterisk">*</span> </label>
											<input type="text" class="form-control only-numbers" value="<?php echo ($userinfo[0]->users_num)?$userinfo[0]->users_num : '' ;?>"  name="phone" id="phone" placeholder="Mobile"/>
											<div class="add-form-error-msg" id="error_phone"></div>
										</div>

										<div class="form-group paddleft">
											<label for="name" control-label">Birth Date <span class="asterisk">*</span></label>
											<span class="show-icon" id="birthdate_cal">
											<img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img"></span>
											<input type="text" class="form-control awe-calendar" name="birth_date" id="birth_date" placeholder="Birth Date" value="<?php echo $userinfo[0]->birth_date;?>"/>
											<div class="add-form-error-msg"  id="error_birth_date"></div>
										</div>
									</div>
									<div class="row">
										<div class="form-group paddright">
											<label class="required">Gender <span class="asterisk">*</span></label>
											<span class="radiodiv"> 
											<input name="gender" type="radio" id="radio-male" value="male" <?php echo ($userinfo[0]->gender == 'male'? 'checked' : '');?> >
											<label>Male</label>
											<input name="gender" type="radio" id="radio-female" value="female" <?php echo ($userinfo[0]->gender == 'female'? 'checked' : '');?> >
											<label>Female</label>
											</span>
											<div class="add-form-error-msg"  id="error_gender"></div>
										</div>
										<div class="form-group paddleft">
											<label for="name" control-label">Passport No <span class="asterisk">*</span></label>
											<input type="text" class="form-control only-numbers" name="passport_no" value="<?php echo $userinfo[0]->passport_no;?>" name="passport_no" id="passport_no"  placeholder="Passport No"/>
											<div class="add-form-error-msg" id="error_passport_no"></div>
										</div>
									</div>

									<div class="row">
										<div class="form-group paddright">
											<label class="required">Card Type <span class="asterisk">*</span></label>
											<select  name="card_type"  id="card_type" class="selectpicker form-control" data-style="btn-primary">
											<option value="">Select card type</option>
											<?php if(count($cardsDetails) >0){ 
											foreach ($cardsDetails as $val) { ?>
											<option value="<?php echo $val->code;?>" <?php echo $userinfo[0]->card_id == $val->code ? 'selected':'';?> >
											<?php echo $val->card_type;?>
											</option>
											<?php }
											} ?> 	
											</select>
											<div class="add-form-error-msg"  id="error_card_type"></div>
										</div>

										<div class="form-group paddleft">
											<label for="name" control-label">Card No <span class="asterisk">*</span></label>
											<input type="text" class="form-control" name="card_number" value="<?php echo $userinfo[0]->card_number;?>" placeholder="Card Number" id="card_number" placeholder="Card No"/>
											<div class="add-form-error-msg" id="error_card_number"></div>
										</div>
									</div>

									<div class="row">
										<div class="form-group paddright">
											<label class="required">Card Holder Name <span class="asterisk">*</span></label>
											<input type="text" class="form-control" value="<?php echo $userinfo[0]->card_holder_name;?>" name="card_holder_name" id="card_holder_name" placeholder="Card Holder Name"/>
											<div class="add-form-error-msg" id="error_card_holder_name"></div>
										</div>
										<div class="form-group paddleft">
											<label for="name" control-label">Expiry Date <span class="asterisk">*</span></label>
											<input type="text" class="form-control" name="expiry" id="expiry" value="<?php echo $userinfo[0]->card_expiry_date;?>" placeholder="MM/YYYY" inputmode="numeric" />
											<div class="add-form-error-msg" id="error_expiry_date"></div>
										</div>
									</div>
									<input type="submit" value="Save" class="save_btn ma-green-btn inline-block" name="userdata">
								</form>
							</div>
						</section>
					</div>
				</div>	
			</div>			

			<!-- <div id="bookings" class="tab-pane fade" aria-expanded="">
				<h3>My Booking</h3>
			</div> -->
			 <div id="wallet" class="tab-pane fade">
				<h3>Wallet</h3>
				<div class="wallet-setting">
					<div class="total-wallet-balance">
						<label>Total Balance : </label>
						<div class="balance-amount">
						<?php echo (isset($userinfo[0]->wallet_balance) && $userinfo[0]->wallet_balance!='')?$userinfo[0]->wallet_balance:'0';?> Rp</div>
					</div>
					<form class="password-settng-sec" action="<?php echo site_url('user/add_balance');?>" id="my-wallet-form" name="" method="POST">
						<div class="form-item">
							<label>Add Balance : </label>
							<input placeholder="Add Balance" name="add_balance" id="add_balance" type="text">
							<div class="add-form-error-msg" id="error_add_balance"></div>   
						</div>	
						<div class="form-item sub-sec">
							<input type="hidden" name="bform" id="bform" value="1">
							<button type="submit" name="add_balance_submit" id="add_balance_submit" value="add_balance" class="submit-info">Add</button>
						</div>	                 						 
					</form> 
				</div>

				<div class="col-md-12 col-sm-12 table-responsive wallet-info">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Serial No</th>
								<th>Amount</th>
								<th>Transaction Type</th>
								<th>Booking Id</th>
								<th>Total Amount</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; if(count($blhistory)>0):?>
							<?php foreach($blhistory as $key=>$result):?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $result->amount?></td>
								<td><?php echo $result->transaction_type?></td>
								<td><?php echo ($result->booking_id!=0)?$result->booking_id:'-';?></td>
								<td><?php echo $result->final_amount?></td>
								<td><?php echo $result->added_date?></td>
							</tr>
							<?php $i++; endforeach;?>
							<?php endif;?>					      				
						</tbody>
					</table>
				</div>
			</div> 				
			</div> 					    
			</div>
			</div>	
			</div>
			</div>	
		</div>	
	</div>
</section>
<script src="<?php echo site_url()?>assets/js/front/user.js"></script>
<script src="<?php echo site_url()?>assets/js/front/comman.js"></script>
<script type="text/javascript">

$('#upload').on('click', function() {
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    alert(form_data);                             
    $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    alert(php_script_response); // display response from the PHP script, if any
                }
     });
});



$(document).ready(function(){
	setTimeout(function(){
		$('.updateInfo').hide();
	},3000);
});

//this following code use for user login and dropdown menu click show sub menu , sub menu activation 12-12-2017
var hrefs = $(this).attr('url'); 
var pathname = window.location.pathname; 
var result = pathname.substring(pathname.lastIndexOf("/") + 1);
console.log(result);

if(result == 'user-profile'){
	$("#myprofile").addClass("active");
	$("#myactp").css("color","#00AEEF"); 

}

$("#profile_cotr_pers_editbutton").click(function(){

 //var newURLString = window.location.href +"/edit";
 //window.location.href = newURLString;  
	//$("#edit_profile").addClass("open");
});

if(result == 'mybook')
{
	$("#subMenuContainer").addClass("active");
	$("#subMenuContainer").addClass("open");
	$("#submenu2").addClass("collapse in");
	
	$("#myprofile").removeClass("active"); 
	$("#bookings").addClass("active in");  
	$("#bookings").attr("aria-expanded", "true");
	$("#profile").removeClass("active in"); 
}

if(result == 'setting'){
	$("#subthree").addClass("open collapse in");
	$("#sett").css("color", "#00AEEF");	
}

if(result == 'wallet'){
	$("#mywallets").addClass("active");
	$("#wallet").addClass("active in");
	$("#myprofile").removeClass("active");	
	$("#subMenuContainer").removeClass("active");
	$("#subMenuContainer").removeClass("open");	 
	$("#profile").removeClass("active in");
	$("#bookings").removeClass("active in");
}


$(document).ready(function() {
	//card number format set here start
	$(".versionPlugin").text("1.4");
	$("h2, h3").click(function(){
		$(this).next("article").slideToggle();
	});

	$("#cardNumber1").ForceBankingCard(); 	    
	$("#card_number").ForceBankingCard({
		cardsValidate: ["Visa", "MasterCard"]
	});
	$("#card_number").val('<?php echo $userinfo[0]->card_number;?>');
	//card number format set here end

	// expiry date show in format start
	payform.expiryInput(document.getElementById('expiry'));
	setTimeout(function(){
	$('.updateInfo').hide();

	},3000);
	// expiry date show in format end

	// following code set country flags using css
	var countryShortName = '';
	if($('#countriesSelects').val() != ''){
		var shortName = $("#country_sortName").attr('class');	
		countryShortName = shortName.toLowerCase();
		$("#country_flag").addClass(countryShortName);
	}

	$("#countriesSelects").change(function() {
		$("#country_flag").removeClass(countryShortName);
		if($('#countriesSelects').val() != ''){  	
			var shortNames = $('#countriesSelects').find('option:selected').attr('id'); 
			var countryShortNames = shortNames.toLowerCase();
			$("#country_flag").addClass(countryShortNames); 
		}
	});
	// following code set country flags using css end
});

</script>
<style type="text/css">
#birthdate_cal{
background: #f2f2f2 none repeat scroll 0 0 !important;
border-right: 1px solid #b7b7b7 !important;
display: block;
left: 3px;
margin: 0px !important;
padding: 0px;
position: absolute;
top: 37.7%;
bottom: 1px;
height: 38px;
}	
</style>