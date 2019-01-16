<!-- Modal for permistion -->
<div class="modal fade" id="add-edit-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Agent</h4>
			</div>
			<form class="form-horizontal" id="user_form" name="user_form" method="post"> 
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12">
							<label for="inputName" class="control-label">Name<span class="required-star">*</span></label>
							<input type="text" class="form-control only-alphabets" id="name" name="name" placeholder="Name" autocomplete="off">
							<div class="add-form-error-msg" id="error_fname"></div>
						</div>
					</div>
					<div class="add-user-fields">
						<div class="form-group">
							<div class="col-md-12">
								<label for="inputEmail" class="control-label">Email<span class="required-star">*</span></label>
								<input type="text" class="form-control" id="emailid" name="emailid" placeholder="Email" autocomplete="off">
								<div class="add-form-error-msg" id="error_emailid"></div>
							</div>
						</div>					
						<div class="form-group">
							<div class="col-md-12">
								<label for="inputEmail" class="control-label">Password<span class="required-star">*</span></label>
								<input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
								<div class="add-form-error-msg" id="error_pass"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label for="inputEmail" class="control-label">Confirm Password<span class="required-star">*</span></label>
								<input type="password" class="form-control" id="cpass" name="cpass" placeholder="Confirm Password">
								<div class="add-form-error-msg" id="error_cpass"></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<label for="inputEmail" class="control-label">Mobile Number<span class="required-star">*</span></label>
							<div class="input-group">							
								<span class="input-group-addon">
								<div id="country_flag" class='iti-flag '></div>
								<select id="countriesSelect">
									<option value="">Country code</option>
								</select>
								</span>
								<input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile Number" autocomplete="off">
							</div>
							<div class="add-form-error-msg" id="error_mobile_no"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="userid" name="userid" value="">
					<input type="hidden" id="usertype" name="usertype" value="<?php echo $usertype;?>">
					<input type="hidden" id="add_form" name="add_form" value="add">
					<div class="add-form-error-msg" id="submit_error"></div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit"  name="add_edit_user" id="add_edit_user_btn" value="add" class="btn btn-primary pull-right">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/css/intlTelInput.css"> <!-- //sk add line for select flag as per country -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/js/intlTelInput.min.js"></script>
<script type="text/javascript">
		// following code set country flags using css
	var countryShortName = '';
	/*if($('#countriesSelect').val() != ''){
		var shortName = $("#country_sortName").attr('class');	
		countryShortName = shortName.toLowerCase();
		$("#country_flag").addClass(countryShortName);
	}*/

	$("#countriesSelect").change(function() {
		$("#country_flag").removeClass(countryShortName);
		if($('#countriesSelect').val() != ''){  	
			var shortNames = $('#countriesSelect').find('option:selected').attr('id'); 
			var countryShortNames = shortNames.toLowerCase();
			$("#country_flag").addClass(countryShortNames); 
		}
	});
	// following code set country flags using css end
</script>
