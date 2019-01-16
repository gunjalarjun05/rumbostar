<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en"  class="errorbody">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- MAIN STYLE -->

<link rel="stylesheet" type="text/css" href="http://exceptionaire.co/rumbostar/assets/css/front/style.css">
	<link rel="stylesheet" type="text/css" href="http://exceptionaire.co/rumbostar/assets/css/front/animate.css"> 
	<link rel="stylesheet" type="text/css" href="http://exceptionaire.co/rumbostar/assets/css/front/media.css">
</head>
<body>
	<section class="page-not-found">
	<div class="overlay-show">&nbsp;</div>
	<div class="container">
	<div class="row row1">
	 <div class="col-md-12">
	  <h3 data-wow-duration="2s" class="center capital f1 wow fadeInLeft animated animated" style="visibility: visible;-webkit-animation-duration: 2s; -moz-animation-duration: 2s; animation-duration: 2s;">Something went Wrong!</h3>
		<h1 data-wow-duration="2s" class="center wow fadeInRight animated animated" id="error" style="visibility: visible;-webkit-animation-duration: 2s; -moz-animation-duration: 2s; animation-duration: 2s;"><?php echo $heading; ?></h1>
		<p data-wow-delay="2s" class="center wow bounceIn animated animated" style="visibility: visible;-webkit-animation-delay: 2s; -moz-animation-delay: 2s; animation-delay: 2s;">
		<?php echo $message; ?>
			
		</p>
			</div>
				</div>

				 <div class="row">
                    <div class="col-md-12">
                        <div data-wow-delay="2800ms" class="wow fadeIn animated animated" id="cflask-holder" style="visibility: visible;-webkit-animation-delay: 2800ms; -moz-animation-delay: 2800ms; animation-delay: 2800ms;">
                            <span data-wow-delay="3000ms" class="wow tada  animated animated" style="visibility: visible;-webkit-animation-delay: 3000ms; -moz-animation-delay: 3000ms; animation-delay: 3000ms;">
                               <a href="http://exceptionaire.co/rumbostar/" alt="Rumbostar" title="Rumbostar" class="logoerror"><img src="http://exceptionaire.co/rumbostar/assets/images/logo-main.png"></a>
                                <i data-wow-delay="3300ms" class="bubble" style="visibility: visible;-webkit-animation-delay: 3300ms; -moz-animation-delay: 3300ms; -o-animation-delay: 3000ms; animation-delay: 3300ms;"></i> 
                                <i class="bubble" id="b1"></i>
                                <i class="bubble" id="b2"></i>
                                <i class="bubble" id="b3"></i>

                            </span>
                        </div>
                    </div>
                </div>

<div class="row"> <!--Links Start-->
                    <div class="col-md-12">
                        <div class="links-wrapper">
                            <ul class="links col-md-12">
                                <li data-wow-delay="4400ms" class="wow fadeInRight animated" style="visibility: visible;-webkit-animation-delay: 4400ms; -moz-animation-delay: 4400ms; animation-delay: 4400ms;"><a href="http://exceptionaire.co/rumbostar/"><i class="fa fa-home fa-2x"></i></a></li>
                                <li data-wow-delay="4300ms" class="wow fadeInRight animated" style="visibility: visible;-webkit-animation-delay: 4300ms; -moz-animation-delay: 4300ms; animation-delay: 4300ms;"><a href="#."><i class="fa fa-facebook fa-2x"></i></a></li>
                                <li data-wow-delay="4200ms" class="wow fadeInRight animated" style="visibility: visible;-webkit-animation-delay: 4200ms; -moz-animation-delay: 4200ms; animation-delay: 4200ms;">
                                    <a href="#."><i class="fa fa-twitter fa-2x"></i></a>
                                </li>
                                <li data-wow-delay="4200ms" class="wow fadeInLeft animated" style="visibility: visible;-webkit-animation-delay: 4200ms; -moz-animation-delay: 4200ms; animation-delay: 4200ms;">
                                    <a href="#."><i class="fa fa-pinterest fa-2x"></i></a>
                                </li>
                                <li data-wow-delay="4200ms" class="wow fadeInLeft animated" style="visibility: visible;-webkit-animation-delay: 4200ms; -moz-animation-delay: 4200ms; animation-delay: 4200ms;">
                                    <a href="#."><i class="fa fa-youtube fa-2x"></i></a>
                                </li>
                                </ul>

                        </div>
                    </div>

                </div>
	</div>
	</section>
	


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://exceptionaire.co/rumbostar/assets/js/front/lib/wow.js"></script>
<script type="text/javascript" src="http://exceptionaire.co/rumbostar/assets/js/front/lib/countUp.js"></script> 

	

	<script type="text/javascript">  
            "use strict";
            var wow = new WOW(
            {
                animateClass: 'animated',
                offset:       100
            }
        );
            wow.init();
        </script>
        <script type="text/javascript">
            "use strict";
            var count = new countUp("error", 0, 404, 0, 3);

            window.onload = function() {
                // fire animation
                count.start();
            }
        </script>
</body>
</html>