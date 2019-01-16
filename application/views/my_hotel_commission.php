<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
						<div class="inner-sec">
							
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

if(result == 'hotel-commission'){
  $("#agentCom").css("color","#00AEEF");
  $("#agentcommissionMenu").addClass("open");  
  $("#subtwo").addClass("open collapse in");  
  
}
	
</script>