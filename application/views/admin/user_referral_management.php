<!-- DataTables -->
<?php echo $css;?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		 Referral Code Management
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i>Home</a></li>
		<li><a href="#">Referral Code Management</a></li>
	  </ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
	  <?php $this->load->view(ADMIN_VIEWS.'massage');?>
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Referral Code Management</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			 <div class="enduser">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th class="w-50">#</th>
					<!-- <th class="w-50">User ID</th> -->
					<th class="w-150">Refer User Name</th>
					<th class="w-150">Referal User Name</th>
					<th class="w-100">Referal Email Id</th>
					<th class="w-100">Referral Code</th>
					<!-- <th class="w-80">Status</th>
					<th class="w-150">User Updated</th> -->
					
				 </tr>
				</thead>
				<tbody>
				  <?php //echo '<pre>';
						//print_r($referalUserList);exit;
				  if(count($referalUserList)>0):?>
						<?php $i=1; foreach($referalUserList as $key=>$userdata):?>
							<tr class="odd gradeX">
								<td class="w-50"><?php echo $i;?></td>
								<td class="w-50"><?php echo $userdata->refer_first_name;?> <?php echo $userdata->refer_last_name;?> </td>
								<td class="w-150"><?php echo $userdata->referal_firstname;?> <?php echo $userdata->referal_lastname;?></td>
								<td class="w-150"><?php echo $userdata->referal_email_id;?></td>
								<td class="w-150 center"><?php echo $userdata->referral_code;?></td>
								<!-- <td class="w-150 center"><?php //echo ($userdata->my_referral_code)?$userdata->my_referral_code: '0'?></td>
								<td class="center"><?php //echo ($userdata->users_status== 'ACTIVE')?'Active':'Not Active';?></td>
								<td class="w-150 center "><?php //$date=$userdata->users_updated_date;
								//echo date('d-m-Y H:i:s', strtotime(str_replace('-','/', $date))); ?>
								</td> -->
								
							</tr>
						<?php $i++; endforeach;?>
					<?php endif;?>
				</tbody>
				<tfoot>
				 <!--  <tr>
					<th>#</th>
					<th>User ID</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Contact Number</th>
					<th>Status</th>
					<th>User Updated</th>
					<th>Action</th>
				  </tr> -->
				</tfoot>
			  </table>
			 </div>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
 </div><!-- /.content-wrapper -->

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




