<div class="login-box">
      <div class="login-logo">
        <a href=""><b>Rumbostar</b></a>
      </div><!-- /.login-logo -->
       <?php $this->load->view(ADMIN_VIEWS.'massage');?>
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form  method="POST" name="admin_login_form" id="admin-login-form">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" id="id-email" placeholder="Email">
            <span class="fa fa-envelope-o form-control-feedback"></span>
            <span class=" form-error" id="id-error-email"><?php echo form_error('email'); ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="id-password" name="password" placeholder="Password">
            <span class="fa fa-lock form-control-feedback"></span>
            <span class=" form-error" id="id-error-password"><?php echo form_error('password'); ?></span>
          </div>
          <div class="row">
            <div class="col-xs-9">
              <div class="checkbox icheck">
                      <div id="error_password" class="form-error"></div>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="login-btn" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
           <a href="javascript:void(0);" id="forgot-password-link">I forgot my password</a><br>
        </form>
        <form  method="POST" action="" name="forgot-psw-form" id="forgot-psw-form" style="display: none;">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="femail" id="femail" placeholder="Email">
            <span class="fa fa-envelope-o form-control-feedback"></span>
            <span class="form-error" id="id-error-femail"><?php echo form_error('email'); ?></span>
          </div>
          <div class="row">
            <div class="col-xs-9">
              <div class="checkbox icheck">
                      <div id="error_password" class="form-error"></div>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="login-btn" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
            <a href="javascript:void(0);" id="back_login_form">Back</a><br/>
        </form>
      </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
