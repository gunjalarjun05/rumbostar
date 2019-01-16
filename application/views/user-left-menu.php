<div class="col-md-4 col-sm-4 info-left-sec">
	<ul class="nav nav-tabs" id="toggle">
		<li id="myprofile"><a id="myactp" data-toggle="tab" href="#profile">My Profile</a></li>
		<!--<li><a data-toggle="tab" href="#account">My Account</a></li>-->
		<li class="my-bookings-sec"  id="subMenuContainer">
			<a id="mybookings" data-toggle="tab" href="#bookings" class="hidesec" >My Bookings</a>
			<ul class="booking-submenu dropdown-menu" id="dropdown" role="menu">
				
				<li ><a data-toggle="collapse" id="fixed_booking" data-target="#submenu2">Fixed Bookings</a>
					<ul  id="submenu2" class="collapse submenu2"> 
						<li><a href="<?php echo site_url('booking/my-flight-booking');?>">Flight</a></li>
						<li><a href="<?php echo site_url('booking/my-hotel-booking');?>">Hotel</a></li>
						<li><a href="<?php echo site_url('booking/my-train-booking');?>">Train</a></li>
						
					</ul>
				</li>				
				<li ><a data-toggle="collapse" id="cancelled_booking" data-target="#subone">Cancelled Booking</a>
					<ul  id="subone" class="collapse submenu2"> 
						<li><a href="<?php echo site_url('booking/cancel-flight-booking');?>">Flight</a></li>
						<li><a href="<?php echo site_url('booking/cancel-hotel-booking');?>">Hotel</a></li>
						<li><a href="<?php echo site_url('booking/cancel-train-booking');?>">Train</a></li>
						
					</ul>
				</li>
				<?php //echo "<pre>"; print_r($this->session->userdata(USER_SESSION.'user_type')); exit;
				if($this->session->userdata(USER_SESSION.'user_type') == 'AGENT'){ ?>
				<li id="flightbooks"><a  id="mycust" href="<?php echo site_url();?>user/customer-details">My Customer</a></li>
				<?php } ?>
			</li>
		</ul>
	    </li>
	    <?php 
			if($this->session->userdata(USER_SESSION.'user_type') == 'AGENT'){ ?>
	    <li id="agentcommissionMenu"> <a id="agentCom" data-toggle="collapse" data-target="#subtwo">My Commission</a>
			<ul  id="subtwo" class="collapse submenu2"> 
				<li><a href="<?php echo site_url('user/flight-commission');?>">Flight</a></li>
				<li><a href="<?php echo site_url('user/hotel-commission');?>">Hotel</a></li>
				<li><a href="<?php echo site_url('user/train-commission');?>">Train</a></li>
				
				
			</ul>
		</li>
		<?php } ?>
		<!-- <li>
			<a href="<?php echo site_url();?>user/my-wallet">My Wallet</a>	
		</li> -->
	    <li id="notili"><a id="notific" data-toggle="tab" href="#setting" class="hidesec">Notification</a></li>
	    <li id="settingSumenulist"><a id="sett" data-toggle="collapse" data-target="#subthree">Setting</a>
			<ul id="subthree" class="collapse submenu2"> 
				<?php //echo "<pre>"; print_r($this->session->userdata(USER_SESSION.'user_type')); exit;
				if($this->session->userdata(USER_SESSION.'user_type') == 'USER'){ ?>
					<li><a class="myref" href="<?php echo site_url('user/referred-code');?>">My Referral Friends</a></li>
				<?php }else{  //echo 'sdfsdf'; ?>
				<!-- <li><a href="#">Agent ID</a></li> -->
				<?php }	?>
				
				<li><a class="chPass" href="<?php echo site_url('user/change-password');?>">Change Password</a></li>
			</ul>
	    </li>
	  </ul>
</div>
				
<script type="text/javascript">
	$(document).ready(function(){
		$(".my-bookings-sec a.hidesec").click(function(){
			$(".booking-submenu").fadeToggle('500');
		});
	});
</script>


<script type="text/javascript">
$(document).ready(function(){

	$('#toggle .my-bookings-sec').on('click', function(){
		$(this).removeClass('open').addClass('open');
	});
});

// $( "#mybookings" ).click(function() {
//   var href = $(this).attr('href');
  
//   if(href == "#bookings")
//   {
//   	$("#subMenuContainer").addClass("active");
//   	$("#subMenuContainer").addClass("open");
//  	$("#myprofile").removeClass("active");	
//  	$("#settingsli").removeClass("active");	
//   }  
// });

//  $("#settingsmy").click(function(){
// 	var href = $(this).attr('href');	
// 	console.log(href);
// 	  if(href == "#setting")
// 	  {
// 	  	window.location.href = "<?php echo site_url(); ?>user-profile/setting";
// 	  	$("#settingsli").addClass("active");	  	
// 	 	$("#myprofile").removeClass("active");	
// 	 	$("#subMenuContainer").removeClass("active");
// 	 	$("#subMenuContainer").removeClass("open");
// 	  } 
//   });

$( "#myactp" ).click(function() {
  var href = $(this).attr('href');
  console.log(href);
  $("#profile").addClass("active in");
  window.location.href = "<?php echo site_url(); ?>user-profile";
 /* $("#bookings").removeClass("active in");
  $("#subMenuContainer").removeClass("open");*/
  //$("#profile").removeClass("active in");
 });

$("#wallettaba").click(function(){
 var hrefs = $(this).attr('href');
  console.log(hrefs);
  if(hrefs == "#wallet"){
  	window.location.href = "<?php echo site_url(); ?>user-profile/wallet";
  }  
});


</script>
