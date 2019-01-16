  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
  	<!-- sidebar: style can be found in sidebar.less -->
  	<section class="sidebar" >
  		<!-- Sidebar user panel -->
  		<div class="user-panel">
  			<div class="pull-left image">
  				<img src="<?php echo site_url();?>assets/images/img/placeholder.png" class="img-circle" alt="User Image">
  			</div>
  			<div class="pull-left info">
  				<p><?php echo ($this->session->userdata(ADMIN_SESSION.'fullname') !='')? $this->session->userdata(ADMIN_SESSION.'fullname'):'Admin';?></p>
  				<!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
  			</div>
  		</div>
  		<!-- sidebar menu: : style can be found in sidebar.less -->
  		<ul class="sidebar-menu">
  			<li class="header">MAIN NAVIGATION</li>
  			<li class="<?php echo active_menu('dashboard');?>">
  				<a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>">
  					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
  				</a>		  
  			</li>

  			<li class="<?php echo active_menu('user_management');?> treeview">
  				<a href="">
  					<i class="fa fa-users"></i>
  					<span>Users Management</span><i class="fa fa-angle-left pull-right"></i>
  				</a>
  				<ul class="treeview-menu">
  					<li class="<?php echo active_menu('end-users');?>">
  						<a href="<?php echo site_url(ADMIN_CONTROLERS.'user_management');?>">Users</a>
  					</li>
  				</ul>
  			</li>
        <li class="<?php echo active_menu('agent_management');?> treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Agent Management</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('end-agent');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'agent_management');?>">Agent</a>
            </li>
          </ul>
        </li>

        <li class="<?php echo active_menu('user_referral_management');?> treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Referral Code Management</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('end-agent');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'user_referral_management');?>"> User Referral Code</a>
            </li>
          </ul>
        </li>
  

         <li class="<?php echo active_menu('social_sharing_management');?> treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Social Sharing</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('flight_share');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'social_sharing_management/flight_social_share');?>">Flight</a>
            </li>
          </ul>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('hotel_share');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'social_sharing_management/hotel_social_share');?>">Hotel</a>
            </li>
          </ul>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('train_share');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'social_sharing_management/train_social_share');?>">Train</a>
            </li>
          </ul>
        </li>


        <li class="<?php echo active_menu('offer_management');?> treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Offer Management</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('flight_offer');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'offer_management/flight_offer');?>">Flight</a>
            </li>
          </ul>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('hotel_offer');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'offer_management/hotel_offer');?>">Hotel</a>
            </li>
          </ul>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('train_offer');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'offer_management/train_offer');?>">Train</a>
            </li>
          </ul>
        </li>


          <li class="<?php echo active_menu('booking_management');?> treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Booking Management</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('flight_booking');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'booking_management/flight_booking');?>">Flight</a>
            </li>
          </ul>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('hotel_booking');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'booking_management/hotel_booking');?>">Hotel</a>
            </li>
          </ul>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('train_booking');?>">
              <a href="<?php echo site_url(ADMIN_CONTROLERS.'booking_management/train_booking');?>">Train</a>
            </li>
          </ul>
        </li>


  		</ul>
  	</section>
  	<!-- /.sidebar -->
  </aside>
