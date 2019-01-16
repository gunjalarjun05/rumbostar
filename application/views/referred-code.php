<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
				<div class="col-md-12">
					<?php $this->load->view('user-left-menu');?>
					<div class="col-md-8 col-sm-8 info-right-sec">
						<div class="inner-sec">
						<div class="btn_div pull-right"><a class="btn btn-default colblue" href="<?php echo base_url('refer-a-friend'); ?>">Refer A Friend</a></div>
							<div id="message_error" style="color:red"></div>
							<div id="message_success" style="color: green"></div>
							<div class="table-responsive referral_table">
							<table class="table">
							    <thead>
							      <tr>
							        <th>First name</th>
							        <th>Last name</th>
							        <th>Email</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    <?php if(isset($myFriends) && count($myFriends) >0){
							    		foreach ($myFriends as $value) { ?>	
							      <tr>
							        <td><?php echo ($value->first_name)?$value->first_name: 'N/A';?></td>
							        <td><?php echo ($value->last_name)?$value->last_name: 'N/A';?></td>
							        <td><?php echo ($value->email_id)?$value->email_id: 'N/A';?></td>
							       
							        <td>
							         <?php if($value->parent_user_id ==''){ ?>
							        <a href="#" class="refer_friend_resend" data-id="<?php echo $value->id; ?>">Resend</a>
							         <?php } ?>
							        </td>
							       
							      </tr>
							      <?php } } ?>
							    </tbody>
							  </table>
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

if(result == 'referred-code'){	
	$("#subthree").addClass("open collapse in");
	$("#sett").css("color", "#00AEEF");
	$(".myref").css("color","#00AEEF");	
}

	$(".refer_friend_resend").click(function(){

		var invite_id = $(this).attr("data-id");
		console.log(invite_id);
		
		var datas = {'invite_id':invite_id}

		$.ajax({
			url: site_url+"user/referral_code",
			type: 'POST',
			dataType: 'json',	
			data:datas,		
			success:function(results){
				console.log(results);
				if(results.status == 'fail'){					
					$("#message_error").html(results.msg);
					setTimeout(function() { $("#message_error").hide(); }, 5000);
					$("#message_success").html("");
					//location.reload();
				}

				if(results.status == 'success'){
					$("#message_success").html(results.msg);
					setTimeout(function() { $("#message_success").hide(); }, 5000);
					$("#message_error").html("");
					//location.reload();
				}
			}
		});
		
	});
</script>