<section class="user-dashboard-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12"><?php $this->load->view('message');?></div>
      <div class="col-md-12">
      <?php $this->load->view('user-left-menu');?>
        <div class="col-md-8 col-sm-8 info-right-sec">
          <div class="inner-sec">	
            <div class="tab-content" id="bookings">
              <h3>Flight Bookings</h3>
              <div class="hotel-item flightid">
                <div class="table-responsive">
                  <table class="table booktable">
                    <tr>
                      <th>Flight Name</th>
                      <th>Flight Image</th>
                      <th>Rout</th>
                      <th>Flight Way</th>
                      <th>Depart</th>     
                      <th>Arrive</th>
                      <th>Duration</th>
                      <th>Price</th>
                      <th>Details</th>
                    </tr>
                      <?php if(isset($flight_booking_dtl) && count($flight_booking_dtl)>0){
                      foreach ($flight_booking_dtl as $value) { //echo '<pre>'; print_r($value->flight_no); ?>
                      <tr>
                        <td><?php echo ($value->flight_name)?$value->flight_name: 'N/A'; ?></td>
                        <td>
                        <img src="<?php echo site_url() ?>assets/images/flight/Airline8.png"> 
                        </td>
                        <td><?php echo $value->depart_from; ?> &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp; <?php echo $value->depart_to; ?></td>
                        <td><?php echo ($value->flight_way)?$value->flight_way : 'N/A'; ?></td>

                        <td><?php echo ($value->depart_time)?$value->depart_time : '0'; ?></td>

                        <td><?php echo ($value->arrive_time)?$value->arrive_time : '0'; ?> </td>
                        <td>
                        <?php                         
                          $deptTime = ($value->depart_time)?$value->depart_time : '';
                          $arriveTime = ($value->arrive_time)?$value->arrive_time : '';
                          
                          if($deptTime != '' && $arriveTime != '')
                          {
                            $start = explode(':', $deptTime);
                            $end = explode(':', $arriveTime);
                            $total_hours = $end[0] - $start[0] - ($end[1] < $start[1]);
                          //echo $total_hours . ' hours';

                            echo  $duration = $total_hours .' hr';
                          }else{
                            
                            //echo 'hiii';
                            echo $duration = '0';
                          } ?>                          
                         </td>
                        <td><?php echo ($value->total_idr)? number_format($value->total_idr) : '0' ?></td>
                        <td>
                        <?php if($value->flight_no!= ''){
                          $flightno = $value->flight_no;
                          }else{
                           $flightno = '0'; 
                            } ?>
                        <a href="<?php echo site_url('booking/flight-booking-passenger/'.encode_string($value->user_id).'/'.encode_string($value->cust_id).'/'.encode_string($flightno));?>" class="awe-btn hvr-rectangle-out">View Details</a>
                        </td>

                      </tr>
                    <?php }
                    } ?>
                  </table>
                </div>
              </div>                        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>
<script type="text/javascript">
/*$(document).ready(function(){
$(".my-bookings-sec a").click(function(){
$(".booking-submenu").fadeToggle('500');
});
});
*/
var hrefs = $(this).attr('url'); 
var pathname = window.location.pathname; 
var result = pathname.substring(pathname.lastIndexOf("/") + 1);
//console.log(result);

if(result == 'my-flight-booking'){
  $("#subMenuContainer").addClass("active");
  $("#subMenuContainer").addClass("open");
  $("#fixed_booking").addClass("active");
  $("#fixed_booking").css("color","#00AEEF");
  $("#submenu2").addClass("open collapse in");
}
/*   if(result == 'my-hotel-booking'){
$("#subMenuContainer").addClass("active");
$("#subMenuContainer").addClass("open");
$("#hotelbooks").addClass("active");
$("#myprofile").removeClass("active");
$("#mywallets").removeClass("active");
$("#subMemuContainerSetting").removeClass("active");
//var a = $('a#actHotelMy');        
//act.style('color', '#00AEEF', 'important');
$("#actHotelMy").css('color', '#00AEEF', 'important');        
}
*/
/*  if(result == '#profile')
{
window.location.href = "<?php echo site_url(); ?>user-profile";
}*/

</script>

