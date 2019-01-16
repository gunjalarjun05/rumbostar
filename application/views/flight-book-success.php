<?php var_dump($result);
echo $result['customer']->customer_name;
?>
<!-- PRELOADER -->
<div class="preloader"></div>
<section class="product-detail flight-success-msg">
    <div class="container">
        <div class="col-md-12 col-sm-12">
        	<div class="message-content" id="boxscroll2">
        	    <p class="succ-msg"><i class="fa fa-check" aria-hidden="true"></i><?php echo'Your Fight Ticket Booked Successfully';?></p>
        	    <div class="col-md-12 col-sm-12 cust-details">
        	    	<p><span class="cust-det">Customer Name :</span> <span class="field-info"><?php echo(isset($result['customer']) && $result['customer']->customer_name !='') ? $result['customer']->customer_name:'';?></span></p>
        	    	<p><span class="cust-det">Customer Phone :</span> <span class="field-info"><?php echo(isset($result['customer']) && $result['customer']->customer_phone !='') ?  $result['customer']->customer_phone :'';?></span></p>
        	    	<p><span class="cust-det">Customer Email :</span> <span class="field-info"><?php echo(isset($result['customer']) && $result['customer']->customer_email !='') ?  $result['customer']->customer_email :'';?></span></p>
        	    </div> 
                <div id="passenger-info-content">
        	     <?php 
                        $totalpasenger = $result['passenger'];
						foreach($totalpasenger as $k=>$val){
                 ?>
        	    <div class="col-md-12 col-sm-12 passenger-info">
        	    	<p class="passenger-count"><i class="fa fa-user" aria-hidden="true"></i> Passenger One</p>
        	    	<div class="col-md-4">
        	    		<p><span class="cust-det">First Name :</span> <span class="field-info"><?php echo (isset($val->passengers_first_name)&& $val->passengers_first_name)? $val->passengers_first_name :''; ?></span></p>
        	    		<p><span class="cust-det">Last Name :</span> <span class="field-info"><?php echo (isset($val->passengers_last_name) && $val->passengers_last_name)? $val->passengers_last_name:'';?></span></p>
        	    		<p><span class="cust-det">ID Number :</span> <span class="field-info"><?php echo (isset($val->passengers_id_card) && $val->passengers_last_name)?$val->passengers_last_name:'';?></span></p>
        	    	</div>
        	    	<div class="col-md-4">
        	    		<p><span class="cust-det">Passport Number :</span> <span class="field-info"><?php echo (isset($val->passengers_id_card) && $val->passengers_id_card)?$val->passengers_id_card:'';?></span></p>
        	    		<p><span class="cust-det">Country Passport :</span> <span class="field-info">101</span></p>
        	    		<p><span class="cust-det">Passport Expire On :</span> <span class="field-info">102</span></p>
        	    	</div>
        	    	<div class="col-md-4">
        	    		<p><span class="cust-det">Date of Birth :</span> <span class="field-info"><?php echo (isset($val->passengers_dob) && $val->passengers_dob)?$val->passengers_dob:''; ?></span></p>
        	    		<p><span class="cust-det">Baggage :</span> <span class="field-info">4</span></p>
        	    	</div>
        	    </div>
				<?php } ?>
                </div>
        	    <div class="tatal-paid">
                    <div class="col-md-6 amount"><span><b>Total Paid :</b></span> <span>Rp<?echo (isset($result['price']->total) && $result['price']->total)? $result['price']->total:''; ?></span></div>
                    <div class="col-md-6 print"><a><i class="fa fa-print" aria-hidden="true"></i> print</a></div>
                </div>
        	</div>    
        </div>    
    </div>
</section>
        <script>
            $(document).ready(function() {
                //    $("html").niceScroll();  // The document page (html)
                $("#boxscroll2").niceScroll({touchbehavior:false,cursorcolor:"#00F",cursoropacitymax:0.7,cursorwidth:6,background:"#ccc",autohidemode:false});
            });
        </script>
