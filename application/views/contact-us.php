<!-- PRELOADER -->
<div class="preloader"></div>
<!-- END / PRELOADER -->
<section class="contact-us-section awe-parallax login-page-demo">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                 <div class="contact-page__map">
                  <div id="map" style="position: relative; overflow: hidden;"></div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-1">

                <div class="contact-page__form">
                    <div class="title">
                        <span>We would like to know you</span>
                        <h2>CONTACT US</h2>
                    </div>
                    <div class="descriptions">
                        <p><!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque id tempor dolor, id cursus sem. Vestibulum placerat non nibh et sodales. --> </p>
                    </div>
                    <?php $this->load->view(ADMIN_VIEWS.'massage');?>
                    <form class="contact-form" method="POST" id="contactinfo_form" name="contactinfo_form">
                        <div class="form-item">
                            <input type="text" placeholder="Your Name *" name="name" id="name">
                            <div class="add-form-error-msg" id="error_name"></div>
                        </div>
                        <div class="form-item">
                            <input type="text" placeholder="Your Email *" name="email" id="email">
                            <div class="add-form-error-msg" id="error_email"></div>
                        </div>
                        <div class="form-item">
                          <input type="text" placeholder="Your Subject" name="subject" id="subject">
                          <div class="add-form-error-msg" id="error_subject"></div>
                        </div>
                        <div class="form-item">
                          <input type="text" placeholder="Your Contact no" name="contactno" id="contactno">
                          <div class="add-form-error-msg" id="error_contactno"></div>
                        </div>
                        <div class="form-textarea-wrapper">
                            <textarea name="message" id="message" placeholder="Your Message"></textarea>
                            <div class="add-form-error-msg" id="error_message"></div>
                        </div>
                        <div class="form-actions form-item">
                            <input type="submit" value="Submit" name="regsubmit" class="submit-contact">
                        </div>
                        <div id="contact-content"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo site_url()?>assets/js/front/contactus.js"></script>
<script>
function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(51.5, -0.2),
    zoom: 10
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyB3oPdp3UoS5BXAFU_vp-3R-qnL5-UHLvA"></script>
