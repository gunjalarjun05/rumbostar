
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
                <li><a href="#" onclick="currencyChange('USD','IDR',10);" title="IDR">IDR &nbsp;&nbsp; Rupiah Indonesia</a></li>
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
    
    <select class="dropdown-menu" onchange="javascript:window.location.href='<?php echo base_url(); ?>home/switchLang/'+this.value;">
      <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
      <option value="indonesian" <?php if($this->session->userdata('site_lang') == 'indonesian') echo 'selected="selected"'; ?>>Indonesia</option>   
  </select>



      <ul class="nav navbar-nav navbar-right">
            <li><a title="Contact Us" href="<?php echo site_url('contact-us');?>">Contact Us</a></li>
            <li><a href="#">View Order</a></li>
            <li><a href="#">How to Order</a></li>
            <li><a href="#">Check In</a></li>
            <?php if($this->session->userdata(USER_SESSION.'user_type') != 'AGENT'){?>
            <li><a href="#" data-toggle="modal" data-target="#call_an_agentModel" id="call_an_agent">Call an Agent</a></li>    
            <?php } ?>        
            
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
    <div class="col-lg-3 col-md-3 col-sm-3 logo">
        <a title="Rumbostar" href="<?php echo site_url();?>">
            <img src="<?php echo site_url().ASSETS_IMAGES?>logo-main.png" alt="Rumbostar" title="Rumbostar">
        </a>
    </div>
   
    
         <div class="col-lg-6 col-md-6 col-sm-6" id="main-menu-section">
           <div class="menu-item">
              <ul class="nav navbar-nav">
                  <li><a href="<?php echo site_url();?>flight/top" class="hvr-rectangle-out">Flight</a></li>              
                  <li><a href="<?php echo site_url();?>hotel/top" class="hvr-rectangle-out">Hotel</a></li>
                  <li><a href="<?php echo site_url();?>train/top" class="hvr-rectangle-out">Train</a></li>    
                   <?php if($this->session->userdata(USER_SESSION.'is_logged_in') == true):?>
                  <!-- <li><a href="<?php echo site_url();?>notifications" class="hvr-rectangle-out">Notifications</a></li> -->

                  <!-- <li><a href="<?php echo site_url();?>refer-a-friend" class="hvr-rectangle-out">Refer A Friend</a></li> -->
                  <?php endif;?>       
                </ul>
            </div>    
      </div>

    <div class="col-lg-3  col-md-3 col-sm-3" id="main-menu-section">
      <div class="checkin navbar-right">
        <ul class="nav navbar-nav navbar-right">
          <?php if($this->session->userdata(USER_SESSION.'is_logged_in') != true):?>
           <li class="login-user"><a title="Log In" href="<?php echo site_url().'user-login'?>" class="hvr-rectangle-out">Log In</a></li>
            <li class="dropdown regi-user"><a title="Register" href="#" class="dropdown-toggle hvr-rectangle-out" data-toggle="dropdown" role="button">Register <span class="caret"></span></a>
              <ul class="dropdown-menu register-dropdown">
              <li><a href="<?php echo site_url().'user-register'?>" title="User Register">User Register</a></li>
              <li><a href="<?php echo site_url().'agent-register'?>" title="Agent Register">Agent Register</a></li>
              </ul> 
            </li>
          <?php endif;?>
           <?php if($this->session->userdata(USER_SESSION.'is_logged_in') == true):?>
            <?php //print_r($this->session->userdata); ?>
            <li class="dropdown myaccount">
              <a href="#" class="dropdown-toggle hvr-rectangle-out" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $this->session->userdata(USER_SESSION.'name'); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <!-- <li><a href="user-profile">My Account</a></li> -->
                 <li><a id="myprofilea" href="<?php echo site_url(); ?>user-profile">My Profile</a></li>
                 <li><a id="mybookings" data-toggle="tab" href="#bookings">My Bookings</a></li>
                  <li><a id="settings" data-toggle="tab" href="#setting">Settings</a></li>
                   <li><a href="<?php echo site_url(); ?>user/log-out" title="Logout">Logout</a></li> 
                </ul>
            </li>
           <?php endif;?>
         </ul>
    </div>
  </div>    

    </div>
    </div>
</header>


<!-- Modal -->
<div id="call_an_agentModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agent Contact List</h4>
            </div>
            <div class="modal-body">      
                <div class="table-responsive referral_table">
                    <table class="table" id="agent_data">
                    <thead>
                        <tr>
                            <th>Agent Name</th>
                            <th>Email</th>
                            <th>Contact No</th>                        
                        </tr>
                        </thead>
                        <tbody>
                             
                            
                            
                        </tbody>
                    </table>
                </div>           
            </div>
            <div class="modal-footer">       
            </div>
        </div>
    </div>
</div>
<!-- model end -->

<script type="text/javascript">

$("#call_an_agent").click(function(){
$.ajax({
        type: 'POST',
        url: "<?php echo site_url(); ?>service/agentDetails",  
        data: {'user_type':'agent'},      
        dataType: "json",
        success: function(resultDatas) {
         console.log(resultDatas); 
           $('#agent_data tbody').empty();
          var codecontry = '';
          var name = '';
          $.each(resultDatas, function( index, value ) {   
              if(value.first_name !=null && value.last_name != null){
                name = value.first_name+ ' ' + value.last_name;
              }else{
                name = 'N/A';
              }
              var elem = '<tr>';                                 
                  elem += '<td>'+name+'</td>';
                  elem +='<td>'+value.users_email+'</td>';  
                  if(value.country_code != null){
                    codecontry = value.country_code; }
                   else{ 
                    codecontry = '-'; 
                  }            
                  elem +='<td>'+ codecontry + '  '+ value.users_num +
                  '</td>'+
                  '</tr>';
                   $('#agent_data tbody').append(elem);            
        });            
      }       
  });
});


function currencyChange(fromcurr, tocurr, amount){
  var data = {'fromcurr':fromcurr, 'tocurr':tocurr, 'amount':amount}
  $.ajax({
        type: 'POST',
        url: "<?php echo site_url(); ?>home/currencyConverter",
        data: data,
        dataType: "json",
        success: function(resultData) {
         console.log(resultData);  
       }
  });
   
}


$( "#mybookings" ).click(function() {
  var hrefs = $(this).attr('href');  
  console.log(hrefs);
  window.location.href = "<?php echo site_url(); ?>booking/my-flight-booking";
   $("#subMenuContainer").addClass("active");
   $("#subMenuContainer").addClass("open");
   $("#myprofile").removeClass("active");  
   
});

$("#settings").click(function(){
    var hrefs = $(this).attr('href');   
    if(hrefs == '#setting')
    { 
      window.location.href = "<?php echo site_url(); ?>user/referred-code";
    }
});
</script>