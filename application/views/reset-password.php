<section class="awe-parallax login-page-demo">
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="login-register-page__content">
         <?php $this->load->view('message');?>
            <div class="content-title">
                <h2>Reset Password</h2>
            </div>
            <form method="post" action="" name="reset_password_form" id="reset-password-form" >
                <div class="form-item">
                    <label>New Password</label>
                    <input type="password" name="newpswd" id="id-newpswd">
                    <span class="form-error" id="id-error-newpswd"><?php echo form_error('newpswd'); ?></span>
                </div>
                <div class="form-item">
                    <label>Confirm Password</label>
                    <input type="password" name="cnewpswd" id="id-cnewpswd">
                    <span class="form-error" id="id-error-cnewpswd"><?php echo form_error('cnewpswd'); ?></span>
                </div>
                 <div id="error_reset_password" class="form-error"></div>                
                <div class="form-actions">
                    <input type="submit" id="update-btn" name="reset_pswd" value="Update">
                </div>
            </form>            
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>comman.js"></script>
<script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>user_management.js"></script>
