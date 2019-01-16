<!-- DataTables -->
<?php echo $css;?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		 Flight Social Share Management
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'social_sharing_management/flight_social_share');?>">Flight Social Share Management </a></li>
	  </ol>
	</section>
	<section class="content">
	  <?php $this->load->view(ADMIN_VIEWS.'massage');?>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Flight Social Share Management</h3>
			  <a  data-toggle="modal" data-target="#myModal" href="#" id="add-offer-btn" name="add_offer_btn" class="btn btn-primary btn-xs pull-right">Flight Discount </a> 

			  <a href="<?php echo site_url(ADMIN_CONTROLERS.'social_sharing_management/flight_discount_list');?>" id="add-offer-btn" name="add_offer_btn" class="btn btn-primary btn-xs pull-right" style="margin-right: 10px;">Assigned User Discount List </a>
			  
			</div><!-- /.box-header -->
			<div class="box-body">
			 <div class="enduser">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="w-50">#</th>
					<th class="w-150">Flight Name</th>
					<th class="w-80">User Name</th>
					<th class="w-80">User Email</th>
					<th class="w-150">Share From</th>
					<th class="w-100">User ID</th>
					<!--<th class="w-150">Action</th> -->
				 </tr>
				</thead>
				<tbody>
				  <?php //echo '<pre>';
				  //print_r($flightShareRes);
				   $emailarr = array();
				   $flightArr = array();
				   $flightNoArr = array();
				   $userIdArr = array();
				   $custIdArr = array();
				  if(count($flightShareRes)>0):?>
						<?php $i=1; foreach($flightShareRes as $key=>$sharedata):?>
							<tr class="odd gradeX">
								<td class="w-50"><?php echo $i;?></td>
								<td class="w-50"><?php echo $sharedata->flight_name;?></td>
								<td class="w-50"><?php echo $sharedata->cust_name;?></td>
								<td class="w-150"><?php echo $sharedata->cust_email;?></td>
								<td class="w-150"><?php echo $sharedata->share_by;?></td>
								 <td class="w-150 center"><?php echo $sharedata->user_id;?></td> 
								<!-- <td class="w-150 center">	
									<?php //if(($offerdata->offer_end_date) >= date("Y-m-d")):?>
									<select name="offerstatus" id=offerstatus" onchange="change_offer_status('<?php //echo $offerdata->offer_id;?>',this)">
										<option value="1" <?php //echo ($offerdata->offer_status== '1')?'selected=selected':'';?>>Active</option>
										<option value="0" <?php //echo ($offerdata->offer_status== '0')?'selected=selected':'';?>>Not Active</option>
									</select> -->
									<?php //else:
									//echo 'EXPIRED';
									?>
									<?php //endif;?>
									<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
								<!-- 	<a href="javascript:void(0)" onclick="delete_offer('<?php //echo encode_string($offerdata->offer_id);?>','<?php //echo $offerdata->offer_type;?>')" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
									<a href="<?php //echo site_url(ADMIN_CONTROLERS.'offer_management/add_flight_offer/'.encode_string($offerdata->offer_id))?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->														
								</td>
							</tr>
							<?php 

								  array_push($emailarr, $sharedata->cust_email);
								  array_push($flightArr,$sharedata->flight_name);
								  array_push($flightNoArr, $sharedata->flight_no);
								  array_push($userIdArr, $sharedata->user_id);
								  array_push($custIdArr, $sharedata->cust_id);
								 ?>
						<?php $i++; endforeach;?>
					<?php endif;				
					?>
				</tbody>
				<tfoot>
				  <!-- <tr>
					<th class="w-50">#</th>
					<th class="w-50">Flight Name</th>
					<th class="w-50">Flight Code</th>
					<th class="w-150">Offer</th>
					<th class="w-150">Start Date</th>
					<th class="w-100">End Date</th>
					<th class="w-150">Action</th>
				  </tr> -->
				</tfoot>
			  </table>
			 </div>
			</div>
		  </div>
		</div>
	  </div>

	 

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Flight Discount From</h4>
      </div>
      <div class="modal-body">
      <div class="message_error"></div>
	  <div class="message_success"></div>
      <form name="userDiscountform" method="#">
      <div class="form-group">
      	<label>Flight :</label>
      <?php   $flighRes = array_unique($flightArr);
      		   $custIdRes = array_unique($custIdArr);
      		    $userIdRes = array_unique($userIdArr);
  				sort($custIdRes);
      		   //print_r($custIdRes);
      		   $flightuniqno = array_unique($flightNoArr);
      		   $flight =array_combine($flightuniqno,$flighRes);  ?>
      	<select class="form-control" name="flight_id" id="flight_name_user">
      	<option value="">Select Flight</option>
      	<?php       			
      		foreach ($flight as $key => $value) { ?>  
      		<option data-id="<?php echo $value; ?>" value="<?php echo $key; ?>"><?php echo $value; ?></option>
  		<?php }
      	 ?>   	
      	</select>
      	<div class="error_msg" id="flight_no_error"></div>
      	</div>
      	<div class="form-group">
      		<label>Email:</label>
      		<input id="user_email" class="form-control" name="user_email" value="">
      	<div class="error_msg" id="email_error"></div>
      	</div>
      <div class="form-group">
      	<label>Discount:</label>
      	<input type="text" class="form-control" name="discount" id="discount" value="">
      	<div class="error_msg" id="discount_error"></div>
      	</div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="userDiscount">Send</utton>
      </div>
    </div>

  </div>
</div>




	</section>
 </div>
 <?php echo $js;?>
 <?php	  
   $res = array_unique($emailarr);   
   sort($res);

  
   $userComb =array_combine($userIdRes,$res);
?>
 <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script>
$( function() {
  	var emaillisttarr = <?php echo json_encode($res); ?>;
  	var userIDArr = <?php echo json_encode($userIdRes); ?>;

  	console.log(emaillisttarr);   
  	 $( "#user_email" ).autocomplete({  
	      source: emaillisttarr
		//source: $.each(emaillisttarr, function(index, value){ [{value:value,id:index}]
		//})

	      /*select: function(event, ui) {
	      	alert(ui.item.id);
	      	           if (ui != null && ui.item != null) {
	                $("#hiddenSelectedSpeciesId").val(ui.item.id);
	            }
	        },
*/
	   

	});

   
});

function ValidateEmail_front(email) {	
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	return expr.test(email);
}

$("#userDiscount").click(function(){

	var emailId = $("#user_email").val();
	var discount = $("#discount").val();
	var flighno = $("#flight_name_user").val();

	var flightName = $('#flight_name_user option:selected').data('id');;
	//var user_id = $("#user_id").val();
	//var cust_id = $("#cust_id").val();
	console.log(flightName);
	if(flighno == ''){
		$("#flight_no_error").html("Please Select Flight.");
		$("#flight_no_error").css("color", 'red');
		return false;
	}else{
		$("#flight_no_error").html("");
	}

	if(emailId == ''){
		$("#email_error").html("Please enter Email id");
		$("#email_error").css("color", 'red');
		return false;
	}else if(!ValidateEmail_front(emailId)){			
			$("#email_error").css('color','red');
			$("#email_error").html("Please enter valid email.");
			return false;
		}else{
		$("#email_error").html("");
	}

	if(discount == ''){
		$("#discount_error").html("Please enter discount amount.");
		$("#discount_error").css("color", 'red');
		return false;
	}else{
		$("#discount_error").html("");
	}
var datas = {'flighno': flighno, 'emailId': emailId, 'discount': discount, 'flightName': flightName};
	$.ajax({
		url: '<?php echo site_url(ADMIN_CONTROLERS.'social_sharing_management/flight_discount');?>',
		type: 'POST',
		dataType: 'json',	
		data:datas,		
		success:function(results){
			console.log(results);
			if(results.status == 'fail'){					
				$(".message_error").html(results.msg);
				$(".message_error").css('color','red');
				setTimeout(function() { $(".message_error").hide(); }, 10000);
				$(".message_success").html("");				
				//location.reload();
			}

			if(results.status == 'success'){
				$(".message_success").html(results.msg);
				$(".message_success").css('color','green');
				setTimeout(function() { $(".message_success").hide(); }, 5000);
				$(".message_error").html("");
				var emailId = $("#user_email").val("");
				var discount = $("#discount").val("");
				var flighno = $("#flight_name_user").val("");
				//$('#myModal').modal().hide();					
				//location.reload();
			}
		}
	});

});



$(document).ready(function() {
	$("#example1").DataTable({
		responsive: true
	});
	$("#example1").parent().addClass("table-responsive").addClass('dt-col-12');
	$(".table-responsive").parent().addClass('dt-row');
	$("#example1_length").parent().parent().addClass("table-cust-filter");
	$("#example1_length").parent().addClass("padd-bott").addClass('show_entries');
	$("#example1_filter").parent().addClass("padd-bott").addClass('search_inputs');
	$("#example1_info").parent().parent().addClass("cust-pagination");
	$("#example1_info").parent().addClass("cust-pagination-entries").addClass('cust-pagination-entries-one');
	$("#example1_paginate").parent().addClass("cust-pagination-entries").addClass('cust-pagination-entries-two');
});


function change_offer_status(offerid,status){
	var status_s = status.value;
	var commanObj = new comman_ajax_function();
	commanObj.dataObj = {id:offerid,status:status_s};
	commanObj.ajax_call(site_url+'offer_management/change_offer_status');		
}

function delete_offer(offerid){
	var result = confirm("Are you sure you want to delete this?");
	if (result) {
		//Logic to delete the item
		var commanObj = new comman_ajax_function();
		commanObj.dataObj = {id:offerid};
		commanObj.ajax_call(site_url+'offer_management/delete');		
	}	
}

</script>


<style type="text/css">
	.ui-autocomplete{z-index: 2147483647!important;}
</style>

