
  <section class="awe-parallax register-page-demo">
            <div class="awe-overlay"></div>
            <div class="container">
                <div class="login-register-page__content">
                 <?php $this->load->view('message');?>
                    <div class="content-title">
                        <span>Don’t stay at home</span>
                        <h2>JOIN US !</h2>
                    </div>
                    <!-- only-alphabets -->
                    <form method="POST" id="user-reg-form" name="user_reg_form">
                        <div class="form-item">
                            <label>Name<span class="asterisk">*</span></label>
                            <input type="text" name="name" id="id-name" class=" disableCopyPast disabledMouseClick" value="<?php echo set_value('name'); ?>">
                            <span class="form-error" id="id-error-name"><?php echo form_error('name'); ?></span>
                        </div>
                        <div class="form-item">
                            <label>Email<span class="asterisk">*</span></label>
                            <input type="text" name="email" id="id-email" value="<?php echo set_value('email'); ?>">
                             <span class="form-error" id="id-error-email"><?php echo form_error('email'); ?></span>
                        </div>
                         <div class="form-item">
                            <label>Contact Number<span class="asterisk">*</span></label>
                            <input type="text" name="number" class="only-numbers disableCopyPast disabledMouseClick" id="id-number" value="<?php echo set_value('number'); ?>">
                           <span class="form-error" id="id-error-number"> <?php echo form_error('number'); ?></span>
                        </div>
                        <div class="form-item">
                            <label>Password<span class="asterisk">*</span></label>
                            <input type="password" name="password" id="id-password">
                             <span class="form-error" id="id-error-password"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="form-item">
                            <label>Confirm password<span class="asterisk">*</span></label>
                            <input type="password" name="conpassword" id="id-conpassword">
                            <span class="form-error" id="id-error-conpassword"><?php echo form_error('conpassword'); ?></span>
                        </div>
                        <a href="#" class="terms-conditions">By registering,you accept 
                        terms &amp; conditions</a>
                        <div class="form-actions">
                            <input type="submit" name="regsubmit" value="Register">
                        </div>

                        <div class="form-item social-media-login registration-page">
                            <div class="login_with_social_media">
                              <ul class="social-buttons">
                                    <li>
                                        <a class="btn btn-block btn-social btn-facebook" title="Login With Facebook" href="<?php 
                                            require 'application/libraries/Facebook.php';
                                            $facebook = new Facebook();
                                            echo $facebook->login_url();?>">
                                        <i class="fa fa-facebook"></i> Sign in with Facebook</a>  
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
                    <div class="login-register-link">
                        Already have Account? <a href="<?php echo site_url().'user-login'?>">Log in HERE</a>
                    </div>
                </div>
            </div>
    </section>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>comman.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>user_management.js"></script>
