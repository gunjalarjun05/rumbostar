<?php //echo '<pre>';print_r($arr_flight_booking); ?>
 	<!-- 	<meta property="fb:app_id" content="124285848214697" />
        <meta property="og:url" content="http://drib.tech/fbsharetest/quiz.html" >
        <meta property="og:type" content="article" >
        <meta property="og:title" content="Are you the real Star Trek geek?" >
        <meta property="og:description" content="Prove your Star Trek geekhood! Are you wise like Yoda or Jar Jar Binks?" >
        <meta property="og:image" content="http://drib.tech/fbsharetest/quiz_landing.jpg" >
        <meta property="og:image:width" content="1200" >
        <meta property="og:image:height" content="630" >  $arr_flight_booking-->

<?php //echo '<pre>==='; print_r($customer_detl);exit; ?>
<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
					<div class="message_error"></div>
					<div class="message_success"></div>
					<?php //print_r($arr_flight_booking);exit;
					if(count($customer_detl)>0 && count($customer_detl[0])>0 && $customer_detl[0] != ''){ ?>					
						<div class="inner-sec">
							<div class="sec_details">
								<h3>Flight Booking Details</h3>
								<div class="social_shering">
								 <?php 
		                             $ShareUrl = urlencode(site_url());
		                             $Title = 'Rumbostar   - '. $customer_detl[0]->flight_name.'-'.$customer_detl[0]->flight_no.'    '.$customer_detl[0]->depart_from.'-'.$customer_detl[0]->depart_to.'  @'.$customer_detl[0]->depart_date ;
		                             $Media = '';//$resultd->largeThumbnailURL;
		                             $desc = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry[…]';
		                            ?> 
	                            <a href="javascript:void(0)" id="fbsharebutton" class="socibtn"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>


								<a href="javascript:void(0)" class="displaynone" onclick="shareinsocialmedia('http://twitter.com/home?status=<?php echo strip_tags($Title); ?>+<?php echo $ShareUrl; ?>+<?php echo $Media; ?>')" ><i class="fa fa-twitter" aria-hidden="true"></i></a>

							 <a class="twitter-share-button socibtn" href="https://twitter.com/share" data-size="small" data-url="http://exceptionaire.co/rumbostar" data-text="<?php  echo $Title ?>"  >Tweet</a>  

							
							 <!-- 588805674563-ulnaaq0mo5q6v3rbl1emdmkb459nblp1.apps.googleusercontent.com localhost api-->
								<span id="myBtn" data-onshare="shareState"  class="demo g-interactivepost socibtn"
							    data-clientid="588805674563-ulnaaq0mo5q6v3rbl1emdmkb459nblp1.apps.googleusercontent.com"
							    data-contenturl="http://exceptionaire.co/rumbostar"
							    data-calltoactionlabel="INVITE"
							    data-calltoactionurl="https://developers.google.com/+/web/share/interactive?invite=false"
							    data-cookiepolicy="single_host_origin"
							    data-prefilltext="<?php echo $Title; ?>"
							    data-callback='loggedIn'
							    >
							 <!--  <span class="icon">&nbsp;</span> -->
							  <span class="gplus"><i class="fab fa-google-plus-g"></i>Google+</span>
							</span>
						</div>

								<div class="cfix infowrapp">            
						            <p class="margin-bottom4">
						               
						                <label>Customer Name</label>
						                <span>: <?php echo ($customer_detl[0]->cust_name)?$customer_detl[0]->cust_name : 'N/A'; ?></span>
						                
						            </p>
						            
						           <!--  <p class="margin-bottom4" id="">
						              <span>
						                    <label>Customer Last Name</label>
						                    <span>: Right</span>
						                </span>
						               
						            </p> -->
						            <p class="margin-bottom4" id="">
						              <span>
						                    <label>Customer Email ID</label>
						                    <span>: <?php echo ($customer_detl[0]->cust_email)?$customer_detl[0]->cust_email : 'N/A'; ?></span>
						                </span>
						               
						            </p>
						            
						            <p class="margin-bottom4" id="">
						                <span>
						                    <label>Customer mobile number</label>
						                    <span>:
						                     <?php echo ($customer_detl[0]->country_code)?$customer_detl[0]->country_code : 'N/A'; ?> - 
						                     <?php echo ($customer_detl[0]->cust_phone)?$customer_detl[0]->cust_phone : 'N/A'; ?> </span>
						                </span>
						               
						            </p>
						             <p class="margin-bottom4" id="">
						                <span>
						                    <label>Flight Name</label>
						                    <span>: <?php echo ($customer_detl[0]->flight_name)?$customer_detl[0]->flight_name : 'N/A'; ?></span>
						                </span>
						               
						            </p>
						           <!--  <p class="margin-bottom4" id="">
						                <span>
						                    <label>Customer mobile number</label>
						                    <span>: 3246514684</span>
						                </span>
						               
						            </p> -->
						            <p class="margin-bottom4" id="">
						                <span>
						                    <label>Flight Type</label>
						                    <span>: <?php echo ($customer_detl[0]->flight_way)?$customer_detl[0]->flight_way : 'N/A'; ?></span>
						                </span>
						               
						            </p>
						            <p class="margin-bottom4" id="">
						                <span>
						                    <label>Trip Type</label>
						                    <span>: <?php  echo ($customer_detl[0]->trip_type)?$customer_detl[0]->trip_type : 'N/A'; ?> </span>
						                </span>
						               
						            </p>
						            <p class="margin-bottom4" id="">
						                <span>
						                    <label>Class</label>
						                    <span>: <?php echo ($customer_detl[0]->flight_class)?$customer_detl[0]->flight_class : 'N/A'; ?></span>
						                </span>
						               
						            </p>
						            <!-- <p class="margin-bottom4" id="">
						                <span>
						                    <label>Total passengers</label>
						                    <span class="passentype">: Adults - 4&nbsp;&nbsp;</span>
						                    <span class="passentype">childern - 5</span>

						                </span>
						               
						            </p> -->
						            
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Departure Date</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_date)?$customer_detl[0]->depart_date : 'N/A'; ?> </span>
						                </span>                
						          
						            </p>
						           <!--  <p class="margin-bottom4" id="">
						               <span>
						                    <label>Return Date</label>
						                    <span>: <?php echo ($arr_flight_booking[0]->depart_date)?$arr_flight_booking[0]->depart_date : 'N/A'; ?></span>
						                </span>                
						          
						            </p> -->
						            <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $customer_detl[0]->cust_id; ?>">

						             <input type="hidden" name="user_id" id="user_id" value="<?php echo $customer_detl[0]->user_id; ?>">
						        </div>
					    	</div>
					    	<?php 
					    	
					    	if(isset($customer_detl[0]->flight_way) && $customer_detl[0]->flight_way == 'depart'){ ?>
					        <div class="sec_details">
						        <h3>Departure</h3>
						        <div class="infowrapp" id="">
						        	<p class="margin-bottom4" id="">
						               <span>
						                    <label>From</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_from)?$customer_detl[0]->depart_from : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>To</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_to)?$customer_detl[0]->depart_to : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Flight name and no</label>
						                    <span>: <?php echo ($customer_detl[0]->flight_name)?$customer_detl[0]->flight_name : 'N/A'; ?>
						                    	- <?php echo ($customer_detl[0]->flight_no)?$customer_detl[0]->flight_no : 'N/A'; ?>
						                    </span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Flight logo</label>
						                    <span>: <i class="fa fa-plane" aria-hidden="true"></i></span>
						                </span>                
						            </p>
							        <p class="margin-bottom4" id="">
						               <span>
						                    <label>Departure location and time</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_time)?$customer_detl[0]->depart_time : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Arrival location and time</label>
						                    <span>: <?php echo ($customer_detl[0]->arrive_time)?$customer_detl[0]->arrive_time : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Duration</label>
									<?php 

							 		$deptTime = ($customer_detl[0]->depart_time)?$customer_detl[0]->depart_time : '0';
                          			$arriveTime = ($customer_detl[0]->arrive_time)?$customer_detl[0]->arrive_time : '0';
					                    if($deptTime != '' && $arriveTime != '')
				                          {
				                          	 $start = explode(':', $deptTime);
                           					 $end = explode(':', $arriveTime);
                            			 	$total_hours = $end[0] - $start[0] - ($end[1] < $start[1]);
				                            //echo  $duration = getTimeDiff($deptTime,$arriveTime);
				                            echo $total_hours;
				                          }else{
				                            echo $total_hours = '0';
				                          } ?>
				                          </span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Flight status</label>
						                    <span>: <?php  echo ($customer_detl[0]->flight_type)?$customer_detl[0]->flight_type : 'N/A';  ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Facilities provided</label>
						                    <span>: <?php '-';  ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Price </label>
						                    <span>: Rp <?php echo ($customer_detl[0]->total_idr)? number_format($customer_detl[0]->total_idr) : 'N/A'; ?> </span>
						                    
						                </span>                
						            </p>
							    </div>
							</div>
							<?php } ?>
							<?php if(isset($customer_detl[0]->flight_way) && $customer_detl[0]->flight_way == 'retrun'){ ?>
							<div class="sec_details">
							    <h3>Return</h3>
						        <div class="infowrapp" id="">
						        	<p class="margin-bottom4" id="">
						               <span>
						                    <label>From</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_from)?$customer_detl[0]->depart_from : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>To</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_to)?$customer_detl[0]->depart_to : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Flight name and no</label>
						                    <span>: <?php echo ($customer_detl[0]->flight_name)?$customer_detl[0]->flight_name : 'N/A'; ?>
						                    	- <?php echo ($customer_detl[0]->flight_no)?$customer_detl[0]->flight_no : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Flight logo</label>
						                    <span>: <i class="fa fa-plane" aria-hidden="true"></i></span>
						                </span>                
						            </p>
							        <p class="margin-bottom4" id="">
						               <span>
						                    <label>Departure location and time</label>
						                    <span>: <?php echo ($customer_detl[0]->depart_time)?$customer_detl[0]->depart_time : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Arrival location and time</label>
						                    <span>: <?php echo ($customer_detl[0]->arrive_time)?$customer_detl[0]->arrive_time : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Duration</label>
						                    <span>: <?php 
							 				$deptTime = ($customer_detl[0]->depart_time)?$customer_detl[0]->depart_time : '0';
                          					$arriveTime = ($customer_detl[0]->arrive_time)?$customer_detl[0]->arrive_time : '0';
					                    if($deptTime != 0 && $arriveTime != 0)
				                          {
				                            echo  $duration = getTimeDiff($deptTime,$arriveTime);
				                          }else{
				                            echo $duration = '0';
				                          } ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Flight status</label>
						                    <span>: <?php echo '-'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Facilities provided</label>
						                    <span>: <?php echo '-'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
						               <span>
						                    <label>Price per person</label>
						                    <span>: <?php echo '-'; ?></span>
						                </span>                
						            </p>
							    </div>
							    
							</div>
							<?php } ?>
							<div class="sec_details last">
								<h3>Passenger Details</h3>
								<div class="infowrapp">
									<div class="table-responsive gentable">
										<table class="table">
											<tr>
												<th>Title</th>
												<th>Passenger Name</th>
												<th>Gender</th>
												<th>Status</th>
												<th>Coach</th>
												<th>Seat No</th>
											</tr>
											<?php if(count($arr_flight_booking)>0){
					    			//echo '<pre>'; print_r($arr_flight_booking);
				    						foreach ($arr_flight_booking as $key => $value){ ?>
			    								<tr>
													<td><?php echo ($value->title)?$value->title : 'N/A'; ?></td>
													<td>
														<?php echo ($value->first_name)?$value->first_name : 'N/A'; ?> 
														<?php echo ($value->last_name)?$value->last_name : 'N/A'; ?>
									 			   	</td>

													<td><?php echo ($value->gender)?$value->gender:'N/A'; ?></td>
													<td><?php ?></td>
													<td><?php ?></td>
													<td><?php ?></td>
												</tr>				    	
											<?php }
					    						 } ?>
											
											<!-- <tr>
												<td>1</td>
												<td>Jhone Right</td>
												<td>Male</td>
												<td>CNF</td>
												<td>G5</td>
												<td>20</td>
											</tr>
											<tr>
												<td>1</td>
												<td>Jhone Right</td>
												<td>Male</td>
												<td>CNF</td>
												<td>G5</td>
												<td>20</td>
											</tr> -->
										</table>
									</div>
								</div>
							</div>
							<div class="sec_details last">
								<div class="infowrapp">
							    	<p class="margin-bottom4" id="">
						               <span class="tot_pri">
						                    <label>Total Price</label>
						                    <span>: Rp  <?php echo ($customer_detl[0]->total_idr)? number_format($customer_detl[0]->total_idr) : 'N/A'; ?></span>
						                </span>                
						            </p>
						            <p class="margin-bottom4" id="">
					                    <span class="canbook_btn">
					                    	<a data-toggle="modal" data-target="#cancel_bookmodal" class="ma-green-btn inline-block" id="">Cancel Booking</a>
					                    </span>           
						            </p>
							    </div>
							</div>    
						</div>
						<?php }else{ ?>
								<div class="inner-sec">
										<?php echo 'No Passenger book'; ?>
								</div>
						<?php } ?>
						<!-- Cancel Booking modal -->
						<div class="modal fade" id="cancel_bookmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									<h3 class="modal-title" id="lineModalLabel">Cancel booking</h3>
								</div>
								<div class="modal-body">
									
						            <!-- content goes here -->
									<form>
						              <div class="form-group">
						                <label for="">Date</label>
						                <input class="form-control awe-calendar hasDatepicker" name="birth_date" id="birth_date" value="" type="date">
						              </div>
						              <div class="form-group">
						                <label for="">Reason for cancellation
						                <span class="asterisk">*</span>
						               </label>
						                <textarea class="form-control"></textarea>
						              </div>
						              
						              <button type="submit" class="ma-green-btn inline-block">Submit</button>
						            </form>

								</div>
								
							</div>
						  </div>
						</div>
						 <div id="fb-root"></div>

						 


<!-- <a href="https://twitter.com/intent/tweet?text=&amp;url=http://exceptionaire.co/rumbostar&amp;via=rumbostar" class="twitter-share-button">Tweet</a> -->


						<!-- <a href="http://exceptionaire.co/rumbostar/" data-image="https://i.stack.imgur.com/br4Br.png" data-title="Article Title" data-desc="Some description for this article" class="fb_share"> 
						  <img src="https://i.stack.imgur.com/br4Br.png" alt="" width="50" height="50"> 
						</a> -->			


						<!-- <div id="bodyarea">
						    <div class="share_fb">Share on facebook</div>

						</div> -->

						<!-- <img src="/images/share_me.png" id="fbsharebutton"/> -->
						
									
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://plus.google.com/js/client:plusone.js"></script>
<script>

 function shareState(result)
        {
            //console.log('share state ' + JSON.stringify(result));
            if (result['action'] === 'shared')
            {
                // success!
                //alert('welcome');
               // console.log( result['post_id'] );

                var cust_id = $("#cust_id").val();
            	var userId = $("#user_id").val();
            	var booking_type = '0';
        		var datas = {'social_from': 'google', 'is_share': '1', 'cust_id':cust_id, 'userId':userId, 'post_id': result['post_id'], 'action':result['action'],'status':result['status'],'booking_type':booking_type };

        		$.ajax({
					url: site_url+"booking/flightBookingTickitShare",
					type: 'POST',
					dataType: 'json',	
					data:datas,		
					success:function(results){
						
						if(results.status == 'fail'){					
							$(".message_error").html(results.msg);
							$(".message_error").css('color','red');
							setTimeout(function() { $(".message_error").hide(); }, 5000);
							$(".message_success").html("");
							//location.reload();
						}

						if(results.status == 'success'){
							$(".message_success").html(results.msg);
							$(".message_error").css('color','green');
							setTimeout(function() { $(".message_success").hide(); }, 5000);
							$(".message_error").html("");							
							//location.reload();
						}
					}
				});

            }else{
            	console.log('fail');
            }
        }


window.onLoadCallback = function(){

gapi.auth2.init({
      client_id: '588805674563-ulnaaq0mo5q6v3rbl1emdmkb459nblp1.apps.googleusercontent.com'
    });

	/*var request = gapi.client.plus.activities.list({
	  'userId' : '588805674563-ulnaaq0mo5q6v3rbl1emdmkb459nblp1.apps.googleusercontent.com',
	  'collection' : 'public'
	});*/

	/*request.execute(function(resp) {
		alert('welcome');
	  var numItems = resp.items.length;
	  for (var i = 0; i < numItems; i++) {
	    console.log('ID: ' + resp.items[i].id + ' Content: ' +
	      resp.items[i].object.content);
	  }
	});*/
}

</script>
<script src="http://platform.twitter.com/widgets.js"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.twitterbutton.js" type="text/javascript"></script>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>

<script type="text/javascript">

var hrefs = $(this).attr('url'); 
var pathname = window.location.pathname; 
var result = pathname.substring(pathname.lastIndexOf("/") + 1);
console.log(result);

if(result == 'flight-booking-passenger'){
  $("#subMenuContainer").addClass("active");
  $("#subMenuContainer").addClass("open");
  $("#fixed_booking").addClass("active");
  $("#fixed_booking").css("color","#00AEEF");
  $("#submenu2").addClass("open collapse in");
}


window.fbAsyncInit = function() {
    FB.init({
        appId: '305550129959595', //316724998844961 local api
        xfbml      : true,
        version    : 'v2.1'       
    });
    
};

(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


$(document).ready(function(){
	$('#fbsharebutton').click(function(e){
	e.preventDefault();
	FB.ui({
	        method: 'share_open_graph',
	        action_type: 'og.shares',
	        action_properties: JSON.stringify({
	            object : {
	               'og:url': 'http://exceptionaire.co/rumbostar', // your url to share
	               'og:title': '<?php echo $Title; ?>',
	               'og:description': "<?php echo $desc; ?>",
	              // 'og:image': 'http://apps.investis.com/Dharmendra/fbPOC/south.jpg'
	            }
	        })
	    },
	    // callback
	    function(response) {
	    if (response && !response.error_message) {
	    	var cust_id = $("#cust_id").val();
	    	var userId = $("#user_id").val();
	    	var booking_type = '0';
	    	var datas = {'social_from': 'facebook', 'is_share': '1', 'cust_id':cust_id, 'userId':userId,'booking_type':booking_type}

	    	$.ajax({
				url: site_url+"booking/flightBookingTickitShare",
				type: 'POST',
				dataType: 'json',	
				data:datas,		
				success:function(results){
					console.log(results);
					if(results.status == 'fail'){					
						$(".message_error").html(results.msg);
						$(".message_error").css('color','red');
						setTimeout(function() { $(".message_error").hide(); }, 5000);
						$(".message_success").html("");
						//location.reload();
					}

					if(results.status == 'success'){
						$(".message_success").html(results.msg);
						$(".message_success").css('color','green');
						setTimeout(function() { $(".message_success").hide(); }, 5000);
						$(".message_error").html("");							
						//location.reload();
					}
				}
			});
	       	// alert('successfully posted. Status id : '+response);
		    }else{
		        alert('Something went error.');
		    }
		});
	});
});

/*$("#bodyarea").on('click', '.share_fb', function(event) {
    event.preventDefault();
    var that = $(this);
    var post = that.parents('article.post-area');
    $.ajaxSetup({ cache: true });
        $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
        FB.init({
          appId: '316724998844961',
          version: 'v2.3' // or v2.0, v2.1, v2.0
        });
        FB.ui({
            method: 'share',            
            title: 'Title Goes here',
            description: 'Description Goes here. Description Goes here. Description Goes here. Description Goes here. Description Goes here. ',
            href: 'https://exceptionaire.co/rumbostar/name:fsdfd',
          },
          function(response) {
            if (response && !response.error_code) {
              alert('Posting completed.');
            } else {
              alert('Error while posting.');
            }
        });
  });
});*/


/*window.fbAsyncInit = function() {
    FB.init({
        appId: '316724998844961',
        status: true,
        cookie: true,
        xfbml: true
    });
};

(function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];if   (d.getElementById(id)) {return;}js = d.createElement('script'); js.id = id; js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ //false));

/*function postToFeed(title, desc, url, image) {
    var obj = {method: 'feed',link: url, picture: image,name: title,description: desc};
    function callback(response) {alert(response);}
    FB.ui(obj, callback);


    FB.ui({
            method: 'share',
            title: 'Title Goes here',
            description: 'Description Goes here. Description Goes here. Description Goes here. Description Goes here. Description Goes here. ',
            href: 'https://exceptionaire.co/rumbostar/',
          },
          function(response) {
            if (response && !response.error_code) {
              alert('Posting completed.');
            } else {
              alert('Error while posting.');
            }
        });

}
*/
/*var fbShareBtn = document.querySelector('.fb_share');
fbShareBtn.addEventListener('click', function(e) {
    e.preventDefault();
    var pageURL = $(location).attr("href");

    //alert(pageURL);
    var title = fbShareBtn.getAttribute('data-title'),
        desc = fbShareBtn.getAttribute('data-desc'),
        url = "http://exceptionaire.co/rumbostar/",
        image = fbShareBtn.getAttribute('data-image');
    postToFeed(title, desc, url, image);

    return false;
});*/

/************************************************/


/*twttr.ready(function (twttr) {
    twttr.events.bind('tweet', function (event) {
         alert('Do something there');
    });
});*/

/*twttr.ready(function (twttr) {
	twttr.events.bind(
	  'tweet',
	  function (event) {
	   console.log('Do something there');
	  });
});*/


 window.twttr = (function (d,s,id) {
 var t, js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
 js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
 return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
 }(document, "script", "twitter-wjs"));

// On ready, register the callback...
twttr.ready(function (twttr) {
    twttr.events.bind('tweet', function (event) {
        console.log(event);
        console.log('welcomeeee');
    });
});

/*twttr.ready(function (twttr) {
  twttr.events.bind('tweet', function (event) {
    console.log("Tweet successful");
  });
   // other events that twitter supports
  twttr.events.bind('follow', function (event) {
    var followed_user_id = event.data.user_id;
    var followed_screen_name = event.data.screen_name;
    console.log("Followed User ID: "+followed_user_id );
    console.log("Followed Screen Name: "+followed_screen_name );
  });
  twttr.events.bind('retweet', function (event) {
    var retweeted_tweet_id = event.data.source_tweet_id;
    console.log("ReTweet successful for tweet ID: "+event.data.source_tweet_id);
  });
  twttr.events.bind('favorite', function(event) {
    var favorited_tweet_id = event.data.tweet_id;
    console.log("Tweet Favorited successfully for tweet ID: "+event.data.source_tweet_id);
  });
});*/





/*function reward_user( event ) {
	alert('dfsdfsd');
    if ( event ) {
        // do something
        alert( 'Tweeted' );
    }
}

window.twttr=(function(d,s,id){	
var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;
}(document,"script","twitter-wjs"));
*/

/*window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
    }(document, "script", "twitter-wjs"));*/

/*twttr.ready(function (twttr) {
    twttr.events.bind('tweet', reward_user);
    console.log('welcome');
});*/

/*var tweetUrlBuilder = function(o){
    return [
        'https://twitter.com/intent/tweet?tw_p=tweetbutton',
        '&url=', encodeURI(o.url),
        '&via=', o.via,
        '&text=', o.text
    ].join('');
};

$('.entypo-twitter').on('click', function(){
    var url = tweetUrlBuilder({
        url : 'http://exceptionaire.co/rumbostar',
        via : 'Rumbostar',
        text: 'How to make a custom share tweet button and know when the user tweeted'
    });
    window.open(url, 'Tweet', 'height=500,width=700');
})

// Called by the Twitter, many times during it's
// life-cycle. We only want to know when the user
// has tweeted, so the following filters are required.
var callback = function(e){
    if(e && e.data){
        var data;
        try{
            data = JSON.parse(e.data);
        }catch(e){
            // Don't care.
        }
        if(data && data.params && data.params.indexOf('tweet') > -1){
            alert('Thanks for the tweet!');
        }
    }
};

window.addEventListener ? window.addEventListener("message", callback, !1) : window.attachEvent("onmessage", callback)*/




function shareinsocialmedia(url){
  window.open(url,'sharein','toolbar=0,status=0,width=648,height=395');
  return true;
  }


</script>
<style type="text/css">
  #myBtn.demo {
    padding: 5px;
    background: #fff;
    cursor: pointer;
    line-height: 20px;
    border: 1px solid #e6e6e6;
    border-radius: 4px;
  }
  #myBtn.demo .icon {
    width: 20px;
    height: 20px;
    display: inline-block;
    background: url('../../images/branding/btn_icons_sprite.png') transparent 0 -40px no-repeat;
  }
  #myBtn.demo:hover {
    background-color: #cc3732;
    color: #fff;
    border: #dd4b39;
  }
  #myBtn.demo:hover .icon {
    background: url('../../images/branding/btn_icons_sprite.png') transparent 0 0px no-repeat;
  }
</style>