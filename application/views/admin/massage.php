<?php 
	$flashData = $this->session->flashdata('msg');
	if(isset($flashData) && $flashData !=''){
			if($this->session->flashdata('msg_type') == 'error'){
					?><div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $flashData;?>
					</div><?php
			}else{
				?><div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $flashData;?>
					</div><?php
			}
	}


?>


