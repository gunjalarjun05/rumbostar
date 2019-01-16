<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>User Profile</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">User profile</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
		<div class="col-md-12"><?php $this->load->view('message');?></div>
			<div class="col-xs-12 col-sm-5 col-md-4 profile-left">
				<!-- Profile Image -->
				
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="<?php echo site_url('assets/images/img/placeholder.png');?>" alt="User profile picture">
						<h3 class="profile-username text-center">
						<?php echo $this->session->userdata(ADMIN_SESSION.'fullname');?></h3>
						<p class="text-muted text-center"><?php echo $this->session->userdata(ADMIN_SESSION.'emailid');?></p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Email </b> <a class="pull-right"><?php echo $this->session->userdata(ADMIN_SESSION.'email');?></a>
							</li>
							<li class="list-group-item">
								<b>Mobile </b> <a class="pull-right"><?php echo $this->session->userdata(ADMIN_SESSION.'mobileno');?></a>
							</li>
							<li class="list-group-item">
								<b>Status </b> <a class="pull-right">Active</a>
							</li>
						</ul>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->

			<div class="col-xs-12 col-sm-7 col-md-8 profile-right ">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#activity" data-toggle="tab">User Info</a></li>
						<li><a href="#settings" data-toggle="tab">Change password</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="activity">
							<form class="form-horizontal" id="userinfo_form" method="post">
								<div class="form-group">
									<label for="inputName" class="col-xs-12 col-sm-4 col-md-3 control-label">Name<span class="required-star">*</span></label>
									<div class="col-xs-12 col-sm-8 col-md-9">
										<input type="text" class="form-control validate[required] only-alphabets" value="<?php echo $userinfo[0]->users_name;?>" name="username" id="username" placeholder="Name">
										<div class="add-form-error-msg" id="error_username"></div>
									</div>
								</div>
								<div class="form-group">
									<label for="inputName" class="col-xs-12 col-sm-4 col-md-3 control-label">Emailid</label>
									<div class="col-xs-12 col-sm-8 col-md-9">
										<input type="text" class="form-control" value="<?php echo $userinfo[0]->users_email;?>" name="emailid" id="emailid" placeholder="Emailid" disabled>
									</div>
								</div>
								<div class="form-group">
									<label for="inputExperience" class="col-xs-12 col-sm-4 col-md-3 control-label">Mobile Number<span class="required-star">*</span></label>
									<div class="col-xs-12 col-sm-8 col-md-9">
										<input type="text" class="form-control" id="mobileno" name="mobileno" value="<?php echo $userinfo[0]->users_num;?>"  placeholder="Mobile Number">
										<div class="add-form-error-msg" id="error_mobileno"></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-offset-2 col-md-10">
										<button type="submit" class="btn btn-primary pull-right" value="profileupdate" name="userinfo" >Submit</button>
									</div>
								</div>
							</form>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="settings">
							<form id="change_password" name="change_password" class="form-horizontal" method="post">
								<div class="form-group">
									<label for="inputName" class="col-xs-12 col-sm-4 col-md-3 control-label">Old Password</label>
									<div class="col-xs-12 col-sm-8 col-md-9">
										<input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Old Password"  maxlength="6" >
										<div class="add-form-error-msg" id="error_oldpassword"></div>
										<div class="old-pass-error error"></div>
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-xs-12 col-sm-4 col-md-3 control-label">New Password</label>
									<div class="col-xs-12 col-sm-8 col-md-9 ">
										<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password"  maxlength="6" >
										<div class="add-form-error-msg" id="error_newpassword"></div>
									</div>
								</div>
								<div class="form-group">
									<label for="inputName" class="col-xs-12 col-sm-4 col-md-3  control-label">Confirm New Password</label>
									<div class="col-xs-12 col-sm-8 col-md-9">
										<input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm New Password"  maxlength="6">
										<div class="add-form-error-msg" id="error_cpassword"></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="hidden" name="hform" id="hform" value="1">
										<button type="submit" name="forgot_pass" id="forgot_pass" value="forgot_pass" class="btn btn-primary pull-right">Submit</button>
									</div>
								</div>
							</form>
							
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- /.nav-tabs-custom -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="<?php echo site_url()?>assets/js/admin/custome/user.js"></script>
