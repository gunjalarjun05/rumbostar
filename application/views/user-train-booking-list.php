
<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
						<div class="inner-sec">	
							<div class="tab-content" id="bookings">
							      <h3>Train Bookings</h3>
							      
									<div class="hotel-item flightid">
		                                <div class="table-responsive">
		                                    <table class="table booktable">
		                                        <tr>
		                                            <th>Train Name</th>
		                                           
		                                            <th>Rout</th>
		                                            <th>Depart</th>
		                                            <th>Arrive</th>
		                                            <th>Duration</th>
		                                            <th>Price</th>
		                                            <th>Details</th>
		                                        </tr>
		                                        <tr>
		                                            <td>cvvf</td>
		                                           
		                                            <td>Mumbai&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Kolkata</td>
		                                            <td>19.30</td>
		                                            <td>20.25</td>
		                                            <td>55 min</td>
		                                            <td>$5555</td>
		                                            <td><a href="<?php echo site_url('booking/train-booking-passenger');?>" class="awe-btn hvr-rectangle-out">View Details</a></td>
		                                            
		                                        </tr>
		                                        <tr>
		                                           <td>cvvf</td>
		                                           
		                                            <td>kolkata&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Mumbai</td>
		                                            <td>2.25</td>
		                                            <td>3.20</td>
		                                            <td>55 min</td>
		                                            <td>$52496</td>
		                                            <td><a href="<?php echo site_url('booking/train-booking-passenger');?>" class="awe-btn hvr-rectangle-out">View Details</a></td>
		                                        </tr>
		                                         
		                                        
		                                    </table>
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
  var hrefs = $(this).attr('url'); 
  var pathname = window.location.pathname; 
  var result = pathname.substring(pathname.lastIndexOf("/") + 1);
  console.log(result);

  if(result == 'my-train-booking'){
  $("#subMenuContainer").addClass("active");
  $("#subMenuContainer").addClass("open");
  $("#fixed_booking").addClass("active");
  $("#fixed_booking").css("color","#00AEEF");
  $("#submenu2").addClass("open collapse in");
  
}
  </script>