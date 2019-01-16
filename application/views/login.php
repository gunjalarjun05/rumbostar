<section class="awe-parallax login-page-demo">
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="login-register-page__content">
         <?php $this->load->view('message');?>
            <div class="content-title">
                <span>Welcome back</span>
                <h2>EXPLORER!</h2>
            </div>

            <form method="post" action="" name="user_login_form" id="user-login-form" >
               <div style="color: #000;">
                <label>User Type</label>
                    <label for="radio-male">
                        <input type="radio" name="users_type" checked="checked"  id="radio-user" value="USER"/>
                       <!--  <i></i> -->
                       <span>User</span>
                    </label>
                    <label for="radio-female">
                        <input type="radio" name="users_type" id="radio-agent" value="AGENT"  />
                        <!-- <i></i> -->
                        <span>Agent</span> 
                    </label>
                </div>

                <div class="form-item">
                    <label>Email</label>
                    <input type="text" name="email" id="id-email">
                    <span class="form-error" id="id-error-email"><?php echo form_error('email'); ?></span>
                </div>
                <div class="form-item">
                    <label>Password</label>
                    <input type="password" name="password" id="id-password">
                    <span class="form-error" id="id-error-password"><?php echo form_error('password'); ?></span>
                </div>
                 <div id="error_password" class="form-error"></div>
                <div class="form-actions">
                    <input type="submit" id="login-btn" value="Log In">
                </div>
                 <a href="javascript:void(0);" id="forgot-password-link"  class="forgot-password" >Forgot Password ?</a>
                <div class="form-item social-media-login">
                    <div class="login_with_social_media">
                      <ul>
                        <li>
                          <a href="<?php echo $auth_url; ?>" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Sign in with Facebook</a>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-google-plus" title="Login With Google Plus" href="<?php echo create_social_media_url('google');?>">
                            <i class="fa fa-google-plus"></i> Sign in with Google</a>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-twitter" title="Login With Google Plus" href="<?php echo create_social_media_url('twitter');?>">
                            <i class="fa fa-twitter" aria-hidden="true"></i>Sign in with Twitter</a>
                        </li> 
                      </ul>
                    </div>
                </div>



            </form>

            <form method="post" action="" name="forgot_psw_form" id="forgot-psw-form" style="display: none;" >
                <div class="form-item">
                    <label>Email</label>
                    <input type="text" name="femail" id="id-femail">
                    <span class="form-error" id="id-error-femail"><?php echo form_error('email'); ?></span>
                </div>
                <div id="error_forgot_password" class="form-error"></div>
                 <a href="javascript:void(0);" id="back_login_form"  class="forgot-password" >Back</a>
                <div class="form-actions">
                    <input type="submit" id="login-btn" value="Submit">
                </div>
            </form>
            <div class="login-register-link" id="dont-have-account">
                Don't have an account yet? <a href="<?php echo site_url().'user-register'?>">Register Here</a>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>comman.js"></script>
<script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>user_management.js"></script>
