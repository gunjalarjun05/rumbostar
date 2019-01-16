<header class="main-header">
     <!-- Logo -->
        <a href="<?php echo site_url();?>admin/dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>R</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Rumbostar</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"></span>
                </a>
               
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo site_url();?>assets/images/img/placeholder.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo ($this->session->userdata(ADMIN_SESSION.'fullname') !='')? $this->session->userdata(ADMIN_SESSION.'fullname'):'Admin';?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo site_url();?>assets/images/img/placeholder.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo ($this->session->userdata(ADMIN_SESSION.'fullname') !='')? $this->session->userdata(ADMIN_SESSION.'fullname'):'Admin';?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url();?>admin/dashboard/profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url();?>admin/home/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </nav>
      </header>