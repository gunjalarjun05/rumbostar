<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url().ASSETS_IMAGES?>favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo site_url().ASSETS_IMAGES?>favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url().ASSETS_IMAGES?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo site_url().ASSETS_IMAGES?>favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url().ASSETS_IMAGES?>favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/css/intlTelInput.css"> <!-- //sk add line for select flag as per country -->
    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>lib/awe-booking-font.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>lib/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>lib/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>lib/jquery-ui.css">

    <!-- REVOLUTION DEMO -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url();?>assets/revslider-demo/css/settings.css">
    <!-- MAIN STYLE -->
		<?php echo (isset($headerCss) && $headerCss !='') ? $headerCss : ''; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>demo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>media.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>hover.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>animate.css">
    <!-- CSS COLOR -->
    <link id="colorreplace" rel="stylesheet" type="text/css" href="<?php echo site_url().FRONT_ASSETS_CSS;?>colors/blue.css">
    
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/countUp.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/wow.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/bootstrap.min.js"></script>
    <script type="text/javascript">
     	var site_url  = '<?php echo site_url();?>';
     	function alert_fadeOut(){
			$(".alert").fadeOut(10000);
		}
    </script>  
    
    </head>

    <body>
		
	    <div id="page-wrap">
			<?php echo $header?>
			<?php echo $left_bar?>
			<?php echo $content?>
			<?php echo $footer?>
			<?php echo $right_bar?>
		</div>
		<!-- LOAD JQUERY -->
    
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/jquery.owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/theia-sticky-sidebar.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/jquery.magnific-popup.min.js"></script>
    <script type='text/javascript' src="<?php echo site_url().FRONT_ASSETS_JS;?>lib/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo site_url().FRONT_ASSETS_JS;?>scripts.js"></script>
    <script type='text/javascript' src="<?php echo site_url().FRONT_ASSETS_JS;?>jquery.nicescroll.js"></script>
    <script type='text/javascript' src="<?php echo site_url().FRONT_ASSETS_JS;?>jquery.ForceBankingCard.js"></script>
     <script src="<?php echo site_url().FRONT_ASSETS_JS;?>payform.js" charset="utf-8"></script>
    
    
	<?php echo (isset($footerJs) && $footerJs !='') ? $footerJs : ''; ?>
	<span id="top-link-block" class="affix">
		<a class="well well-sm" href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
			<i class="fa fa-chevron-up" aria-hidden="true"></i>
		</a>
	</span>
		<!-- <script type="text/javascript">
		var menu = $('.sticky_header');
    	var origOffsetY = menu.offset().top; 
			$(window).scroll(function() { 
				if ($(document).scrollTop() > 50) {
					$('.top_header').addClass('shrink');
				} else {
					$('.top_header').removeClass('shrink');
				}
				 scroll();
			});
			$(".share-sideicon").click(function(){
				$("#share-sideicon-box").toggle();
			});			
			alert_fadeOut();
		</script> -->
<script type="text/javascript">
    $(window).scroll(function() {
        var sticky = $('.header-section'),
            scroll = $(window).scrollTop();
        if (scroll > 50) sticky.addClass('fixed-head');
        else sticky.removeClass('fixed-head');
    });
</script>
		
    </body>
</html>
