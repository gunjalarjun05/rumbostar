<?php echo $css;?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		 Flight Booking Management
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Flight Booking Management </a></li>
	  </ol>
	</section>
	<section class="content">
	  <?php $this->load->view(ADMIN_VIEWS.'massage');?>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Flight Booking Management</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			 <div class="enduser">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="w-50">#</th>
					<th class="w-150">Customer Name</th>
					<th class="w-150">Customer Mobile</th>
					<th class="w-100">Flight Way</th>
					<th class="w-100">Flight From</th>
					<th class="w-100">Flight To</th>
					<th class="w-150">Flight From Date</th>
					<th class="w-150">Flight To Date</th>					
					<th class="w-70">Amount</th>					
					
				 </tr>
				</thead>
				<tbody>
				  <?php if(count($bookingRec)>0):?>
						<?php $i=1; foreach($bookingRec as $key=>$bookingdata):

						$flight_from_date = date('d-m-Y', strtotime( $bookingdata->flight_from_date ));
						$flight_to_date = date('d-m-Y', strtotime( $bookingdata->flight_to_date ));
						?>
							<tr class="odd gradeX">
								<td class="w-50"><?php echo $i;?></td>
								<td class="w-150"><?php echo $bookingdata->cust_name;?></td>
								<td class="w-150"><?php echo $bookingdata->cust_phone;?></td>
								<td class="w-100"><?php echo $bookingdata->flight_way;?></td>
								<td class="w-100 center"><?php echo $bookingdata->depart_from;?></td>
								<td class="w-100 center"><?php echo $bookingdata->depart_to;?></td>
								<td class="w-150 center"><?php echo $flight_from_date;?></td>
								<td class="w-150 center"><?php echo $flight_to_date;?></td>
								<td class="w-70 center"><?php echo $bookingdata->booking_amount;?></td>
							</tr>
						<?php $i++; endforeach;?>
					<?php endif;?>
				</tbody>
				<tfoot>
				  <tr>
					<th class="w-50">#</th>
					<th class="w-150">Customer Name</th>
					<th class="w-150">Customer Mobile</th>
					<th class="w-100">Flight Way</th>
					<th class="w-100">Flight From</th>
					<th class="w-100">Flight To</th>
					<th class="w-150">Flight From Date</th>
					<th class="w-150">Flight To Date</th>					
					<th class="w-70">Amount</th>		
				  </tr>
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
</script>




