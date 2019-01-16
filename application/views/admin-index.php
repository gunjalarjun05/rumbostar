<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		 <!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- page title specific to the page -->
        <title><?php echo $title;?></title>
        <link rel="icon" type="image/png" href="favicon32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo site_url();?>assets/images/favicon32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo site_url();?>assets/images/favicon.ico" />
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/admin/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/admin/jquery-jvectormap-1.2.2.css">
		<!-- Theme style -->
		
		<?php echo load_css('admin/AdminLTE.min.css,admin/_all-skins.min.css');?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery 2.1.4 -->
		<link rel="stylesheet" type='text/css' href="<?php echo site_url();?>assets/css/admin/custome-admin.css">
		<script src="<?php echo site_url();?>assets/js/admin/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo site_url();?>assets/js/admin/bootstrap.min.js"></script>
		<!--jQuery validation engine js and css---->
		<script src="<?php echo site_url()?>assets/js/admin/jquery.validate.min.js"></script>
        
    </head>
    <script>
	var site_url = '<?php echo site_url();?>admin/';
	function alert_fadeOut(){
			$(".alert").fadeOut(10000);
		}
	</script>
    <body class="hold-transition skin-blue sidebar-mini">
		
		<div class="wrapper">
			<?php echo $header?>
			<?php echo $left_bar?>
			<?php echo $content?>
			<?php echo $footer?>
			<?php echo $right_bar?>
		</div>
		<script type="text/javascript">
			$(window).load(function(){
				alert_fadeOut();
			});	
		</script>
		<!-- FastClick -->
		<script src="<?php echo site_url();?>assets/js/admin/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo site_url();?>assets/js/admin/app.min.js"></script>
		<!-- Sparkline -->
		<script src="<?php echo site_url();?>assets/js/admin/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="<?php echo site_url();?>assets/js/admin/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/admin/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll 1.3.0 -->
		<script src="<?php echo site_url();?>assets/js/admin/jquery.slimscroll.min.js"></script>
		<!-- ChartJS 1.0.1 -->
		<script src="<?php echo site_url();?>assets/js/admin/Chart.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo site_url();?>assets/js/admin/demo.js"></script>
		<div class="gif-loader"><img src="<?php echo site_url('assets/images/balls.gif');?>" ></div>
		
    </body>
</html>
