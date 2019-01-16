 <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Dashboard
		<small></small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="<?php echo site_url(ADMIN_CONTROLERS.'dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <!-- Info boxes -->
		<div class="row">
			<div class="col-md-12">
			</div>
		</div>
	  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Users</span>
			  <span class="info-box-number"><?php echo (isset($userCount))?$userCount:0;?></span>
			</div><!-- /.info-box-content -->
		  </div><!-- /.info-box -->
		</div><!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Agent</span>
			  <span class="info-box-number"><?php echo (isset($agentCount))?$agentCount:0;?></span>
			</div><!-- /.info-box-content -->
		  </div><!-- /.info-box -->
		</div><!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">User Booking</span>
			  <span class="info-box-number"><?php //echo (isset($propCount))?$propCount:0;?></span>
			</div><!-- /.info-box-content -->
		  </div><!-- /.info-box -->
		</div><!-- /.col -->

		<!-- fix for small devices only -->
		<div class="clearfix visible-sm-block"></div>

		<div class="col-md-3 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Agent Booking</span>
			  <span class="info-box-number"><?php //echo (isset($bkCount))?$bkCount:0;?></span>
			</div><!-- /.info-box-content -->
		  </div><!-- /.info-box -->
		</div><!-- /.col -->
		
	  </div><!-- /.row -->
		
	  <!-- Main row -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-md-8">
		  
 	  <!-- TABLE: LATEST ORDERS -->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Latest bookings</h3>
			  <div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			  </div>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="table-responsive">
				<table class="table no-margin">
				  <thead>
					<tr>
					  <th>ID</th>
					  <th>User</th>
					  <th>Check In</th>
					  <th>Check Out</th>
					  <th>Total Paid</th>
					</tr>
				  </thead>
				  <tbody>
					 <?php if(isset($bookingResc) && count($bookingResc)>0):?>
						<?php foreach($bookingResc as $resc):?>
							<tr>
							  <td><?php echo $resc->prop_booking_id;?></a></td>
							  <td><?php echo $resc->booking_name;?></td>
							  <td><?php echo $resc->check_in;?></a></td>
							  <td><?php echo $resc->check_out;?></td>
							   <td>$<?php echo $resc->total_price;?></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
					<tr>
						<td colspan="5">No Record Found</td>
					 </tr>
					 <?php endif;?>					
				  </tbody>
				</table>
			  </div><!-- /.table-responsive -->
			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
				<?php if(isset($bookingResc) && count($bookingResc)>0):?>
					<a href="<?php echo site_url('admin/booking/current_booking');?>" class="btn btn-sm btn-primary btn-flat pull-right">View Bookings</a>
				<?php endif;?>	
			</div><!-- /.box-footer -->
		  </div><!-- /.box -->
		</div><!-- /.col -->

	
		<?php /*
		<div class="col-md-4">
			<!-- PRODUCT LIST -->
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Website reviews</h3>
			  <div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			  </div>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <ul class="products-list product-list-in-box">
				
				<?php if(isset($webComResc) && count($webComResc)>0):?>
					<?php foreach($webComResc as $Wresc):?>
						<li class="item">
						  <div class="product-img">
							<img src="<?php echo site_url();?>assets/images/img/demo-thumb.jpg" alt="Product Image">
						  </div>
						  <div class="product-info">
							<a href="#" class="product-title"><?php echo $Wresc->fname." ".$Wresc->lname;?> <span class="label label-warning pull-right"><?php echo $Wresc->ratings;?></span></a>
							<span class="product-description">
							 <?php echo stripslashes($Wresc->reviews); ?>
							</span>
						  </div>
						</li><!-- /.item -->
					<?php endforeach;?>
					<?php else:?>
					<li class="item">No Record Found</li>
				 <?php endif;?>	
				
			  </ul>
			</div><!-- /.box-body -->
			<div class="box-footer text-center">
			  
			</div><!-- /.box-footer -->
		  </div><!-- /.box -->
		  
		</div><!-- /.col -->
		*/ ?>
		
	  </div><!-- /.row -->
	  
	  
	  
	  
	</section><!-- /.content -->
 </div><!-- /.content-wrapper -->


