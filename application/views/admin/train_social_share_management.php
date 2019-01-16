<!-- DataTables -->
<?php echo $css;?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		 Train Social Share Management
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Train Social Share Management </a></li>
	  </ol>
	</section>
	<section class="content">
	  <?php $this->load->view(ADMIN_VIEWS.'massage');?>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Train Social Share Management</h3>
			 <!--  <a href="<?php //echo site_url(ADMIN_CONTROLERS.'social_sharing_management/add_Train_offer');?>" id="add-offer-btn" name="add_offer_btn" class="btn btn-primary btn-xs pull-right">Add Train Discount </a> -->
			</div><!-- /.box-header -->
			<div class="box-body">
			 <div class="enduser">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="w-50">#</th>
					<th class="w-150">Train Name</th>
					<th class="w-80">Train Code</th>
					<th class="w-80">Share From</th>
					<th class="w-150">Start Date</th>
					<th class="w-100">End Date</th>
					<th class="w-150">Action</th>
				 </tr>
				</thead>
				<tbody>
				  <?php //if(count($offerRes)>0):?>
						<?php //$i=1; foreach($offerRes as $key=>$offerdata):?>
							<tr class="odd gradeX">
								<td class="w-50"><?php //echo $i;?></td>
								<td class="w-50"><?php //echo $offerdata->Train_name;?></td>
								<td class="w-50"><?php //echo $offerdata->Train_code;?></td>
								<td class="w-150"><?php //echo $offerdata->offer_name;?></td>
								<td class="w-150"><?php //echo $offerdata->offer_start_date;?></td>
								<td class="w-150 center"><?php //echo $offerdata->offer_end_date;?></td>
								<td class="w-150 center">	
									<?php //if(($offerdata->offer_end_date) >= date("Y-m-d")):?>
									<select name="offerstatus" id=offerstatus" onchange="change_offer_status('<?php //echo $offerdata->offer_id;?>',this)">
										<option value="1" <?php //echo ($offerdata->offer_status== '1')?'selected=selected':'';?>>Active</option>
										<option value="0" <?php //echo ($offerdata->offer_status== '0')?'selected=selected':'';?>>Not Active</option>
									</select>
									<?php //else:
									//echo 'EXPIRED';
									?>
									<?php //endif;?>
									<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
									<a href="javascript:void(0)" onclick="delete_offer('<?php //echo encode_string($offerdata->offer_id);?>','<?php //echo $offerdata->offer_type;?>')" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
									<a href="<?php //echo site_url(ADMIN_CONTROLERS.'offer_management/add_Train_offer/'.encode_string($offerdata->offer_id))?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>														
								</td>
							</tr>
						<?php //$i++; endforeach;?>
					<?php //endif;?>
				</tbody>
				<tfoot>
				  <!-- <tr>
					<th class="w-50">#</th>
					<th class="w-50">Train Name</th>
					<th class="w-50">Train Code</th>
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
	</section>
 </div>
 <?php echo $js;?>
<script>
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




