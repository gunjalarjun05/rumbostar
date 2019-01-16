<div class="top-header">
       <nav class="navbar navbar-default">
         <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
             </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav left-menu">
        <!--<li class="active"><a href="#">My Account </a></li>-->
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USD <span class="caret"></span></a>
            <ul class="dropdown-menu">
                    <li><a href="#" title="IDR">IDR &nbsp;&nbsp; Rupiah Indonesia</a></li>
                    <li><a href="#" title="MYR">MYR &nbsp;&nbsp; Ringgit Malaysia</a></li>
                    <li><a href="#" title="USD">USD &nbsp;&nbsp; Dollar United States</a></li>
                    <li><a href="#" title="SGD">SGD &nbsp;&nbsp; Dollar Singapore</a></li>
            </ul>
        </li>
        <li class="dropdown lang-change">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">English <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#" title="English">English</a></li>
                 <li><a href="#" title="Indonesia">Indonesia</a></li>
              </ul>
        </li>
      </ul>
    
      <ul class="nav navbar-nav navbar-right">
            <li><a title="Contact Us" href="<?php echo site_url('contact-us');?>">Contact Us</a></li>
            <li><a href="#">View Order</a></li>
            <li><a href="#">How to Order</a></li>
            <li><a href="#">Check In</a></li>            
            
       </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
<div class="clearfix"></div>
<!-- Top header section -->

<!-- Main header section -->
<header class="header-section sticky_header">
<div class="container" id="con">
  <div class="row">
    <div class="col-lg-4 logo">
        <a title="Rumbostar" href="<?php echo site_url();?>">
            <img src="<?php echo site_url().ASSETS_IMAGES?>logo-main.png" alt="Rumbostar" title="Rumbostar">
        </a>
    </div>
   
    <div class="col-lg-8" id="main-menu-section">
         <div class="col-lg-6 menu-item">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url();?>flight">Flight</a></li>              
           <li><a href="<?php echo site_url();?>hotel">Hotel</a></li>
               <li><a href="<?php echo site_url();?>train">Train</a></li>                
            </ul>
      </div>

    <div class="col-lg-6 checkin navbar-right">
        <ul class="nav navbar-nav navbar-right">
          <?php if($this->session->userdata(USER_SESSION.'is_logged_in') != true):?>
           <li class="login-user"><a title="Log In" href="<?php echo site_url().'user-login'?>">Log In</a></li>
            <li class="dropdown regi-user"><a title="Register" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Register <span class="caret"></span></a>
              <ul class="dropdown-menu register-dropdown">
              <li><a href="<?php echo site_url().'user-register'?>" title="User Register">User Register</a></li>
              <li><a href="<?php echo site_url().'agent-register'?>" title="Agent Register">Agent Register</a></li>
              </ul> 
            </li>
          <?php endif;?>
           <?php if($this->session->userdata(USER_SESSION.'is_logged_in') == true):?>
            <li class="dropdown myaccount">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $this->session->userdata(USER_SESSION.'name'); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="user-profile">My Account</a></li>
                 <li><a href="user-profile">My Profile</a></li>
                 <li><a href="user-profile">My Bookings</a></li>
                  <li><a href="user-profile">Settings</a></li>
                   <li><a href="user/log-out" title="Logout">Logout</a></li> 
                </ul>
            </li>
           <?php endif;?>
         </ul>
    </div>

    </div>

    </div>
    </div>
</header>
