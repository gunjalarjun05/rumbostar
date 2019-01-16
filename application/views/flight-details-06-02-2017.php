<!-- PRELOADER -->
<div class="preloader"></div>
  <!-- BREADCRUMB -->
  <section class="flight-details flight-breadcum-sec">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo site_url();?>">Home</a></li>
                <li><a href="<?php echo site_url('flight');?>">Flight</a></li>
                <li><span>Flight Detail</span></li>
            </ul>
        </div>
    </div>
</section>
<!-- BREADCRUMB -->
<section class="product-detail flight-details">
	<?php if(isset($errorMsg) && $errorMsg!=''){ ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12"><?php echo $errorMsg;?></div>
			</div>
		</div>
	<?php }else if(isset($flight_details->depart_detail) && count($flight_details->depart_detail)>0){ ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-detail__info">
                    <div class="product-title">
                        <h2><?php echo (isset($flight_details->depart_detail->airline_name) && $flight_details->depart_detail->airline_name!='')? $flight_details->depart_detail->airline_name:'';?> : <?php echo (isset($flight_details->search_info->from) && $flight_details->search_info->from!='')?$flight_details->search_info->from:'';?> - <?php echo (isset($flight_details->search_info->to) && $flight_details->search_info->to!='') ? $flight_details->search_info->to:'';?></h2>
                    </div>
                            <!--<div class="product-address">
                                <span>9579 Wishing Mount, Wynot, ND,  US. | +1-888-8765-1234</span>
                            </div>
                            <div class="product-email">
                                <i class="fa fa-envelope"></i>
                                <a href="#">Send Email Inquiry</a>
                            </div>-->

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="product-tabs tabs">
                            <ul>
                                <li>
                                    <a href="#tabs-1">Initiative</a>
                                </li>
                                <!--<li>
                                    <a href="#tabs-2">Services on-flight</a>
                                </li>
                                <li>
                                    <a href="#tabs-3">Good to know</a>
                                </li>
                                <li>
                                    <a href="#tabs-4">Review &amp; rating</a>
                                </li>-->
                            </ul>
                            <div class="product-tabs__content">
                                <div id="tabs-1">
                                    <div class="initiative">
                                        <!-- ITEM -->
                                        <div class="initiative__item">
                                            <div class="initiative-top">
                                                <div class="title">
                                                    <div class="from-to">
                                                        <span class="from"><?php echo (isset($flight_details->search_info->from) && $flight_details->search_info->from !='')? $flight_details->search_info->from:'';?></span>
                                                        <i class="awe-icon awe-icon-arrow-right"></i>
                                                        <span class="to"><?php echo (isset($flight_details->search_info->to) && $flight_details->search_info->to!='')?$flight_details->search_info->to:'';?></span>
                                                    </div>
                                                    <div class="time"><?php
                                                    $departdate=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('l',strtotime($flight_details->depart_detail->date)):'';
                                                    $departdaten=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('d M Y',strtotime($flight_details->depart_detail->date)):'';
                                                    echo $departdate." ".$departdaten; ?></div> 
                                                </div>
                                                <div class="price">
                                                    <span class="amount"><?php echo $curr.number_format($flight_details->depart_detail->price->adult->total_idr);?></span>
                                                    <a href="<?php echo site_url('flight');?>" id="listing-to-back">Choose other</a>
                                                </div>
                                            </div>
                                            <table class="initiative-table">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <div class="item-thumb">
                                                                <div class="image-thumb">
                                                                    <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))] !=''):?>
                                                                        <img style="width:80% !important;" alt="<?php echo $flight_details->depart_detail->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))];?>" >
                                                                    <?php else:?>
                                                                        <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                                                    <?php endif;?>                                                                    
                                                                </div>
                                                                <div class="text">
                                                                    <span><?php echo (isset($flight_details->depart_detail->airline_name) && $flight_details->depart_detail->airline_name!='') ? $flight_details->depart_detail->airline_name:'';?></span>
                                                                    <p><?php echo (isset($flight_details->depart_detail->fno) && $flight_details->depart_detail->fno!='')? $flight_details->depart_detail->fno:'' ;?></p>
                                                                    <span><?php echo (isset($flight_details->depart_detail->class_name) && $flight_details->depart_detail->class_name!='')?$flight_details->depart_detail->class_name:''; ?></span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <div class="item-body">
                                                                <div class="item-from">
                                                                    <h3><?php echo (isset($flight_details->depart_detail->from) && $flight_details->depart_detail->from!='')? $flight_details->depart_detail->from:''; ?></h3>
                                                                    <span class="time"><?php echo $flight_details->depart_detail->etd;?></span>
                                                                    <span class="date"><?php
                                                                    $departdated=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('D',strtotime($flight_details->depart_detail->date)):'';
                                                                    $departdaten=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('d M Y',strtotime($flight_details->depart_detail->date)):''; 
                                                                    echo $departdated." ".$departdaten ;
                                                                    ?></span>
                                                                    <p class="desc"><?php echo (isset($flight_details->depart_detail->from) && $flight_details->depart_detail->from!='')? $flight_details->depart_detail->from:'';?></p>
                                                                </div>
                                                                <div class="item-time">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    <span><?php echo getTimeDiff($flight_details->depart_detail->etd , $flight_details->depart_detail->eta);?></span>
                                                                </div>
                                                                <div class="item-to">
                                                                    <h3><?php echo $flight_details->depart_detail->to;?></h3>
                                                                    <span class="time"><?php echo $flight_details->depart_detail->eta;?></span>
                                                                    <span class="date"><?php $arrivalDate = get_arrival_date($flight_details->depart_detail->date,$flight_details->depart_detail->etd,$flight_details->depart_detail->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span>
                                                                    <p class="desc"><?php echo $flight_details->depart_detail->to;?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php if($flight_details->depart_detail->type == 'connecting'):?>
                                                        <?php foreach($flight_details->depart_detail->connecting_flight as $key=>$values):?>
                                                           <tr>
                                                            <th>
                                                                <div class="item-thumb">
                                                                    <div class="image-thumb">
                                                                        <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $values->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $values->airline_name))] !=''):?>
                                                                            <img style="width:80% !important;" alt="<?php echo $values->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $values->airline_name))];?>" >
                                                                        <?php else:?>
                                                                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                                                        <?php endif;?> 
                                                                    </div>
                                                                    <div class="text">
                                                                        <span><?php echo $values->airline_name;?></span>
                                                                        <p><?php echo $values->fno;?></p>
                                                                        <span><?php echo $values->class_name;?></span>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="item-body">
                                                                    <div class="item-from">
                                                                        <h3><?php echo $values->from;?></h3>
                                                                        <span class="time"><?php echo $values->etd;?></span>
                                                                        <span class="date"><?php echo date('D',strtotime($values->date))." ". date('d M Y',strtotime($values->date));?></span>
                                                                        <p class="desc"><?php echo $values->from;?></p>
                                                                    </div>
                                                                    <div class="item-time">
                                                                        <i class="fa fa-clock-o"></i>
                                                                        <span><?php echo getTimeDiff($values->etd , $values->eta);?></span>
                                                                    </div>
                                                                    <div class="item-to">
                                                                        <h3><?php echo $values->to;?></h3>
                                                                        <span class="time"><?php echo $values->eta;?></span>
                                                                        <span class="date"><?php $arrivalDate = get_arrival_date($values->date,$values->etd,$values->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span>
                                                                        <p class="desc"><?php echo $values->to;?></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                <?php endif;?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END / ITEM -->
                                    <!-- ITEM -->

                                    <!-- END / ITEM -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="detail-sidebar">
                        <!--<div class="call-to-book">
                            <i class="awe-icon awe-icon-phone"></i>
                            <em>Call to book</em>
                            <span>+1-888-8765-1234</span>
                        </div>-->
                        <div class="booking-info">
                            <h3>Booking info</h3>
                            <div class="form-group">
                                <div class="form-elements form-adult">
                                    <label>Adult</label>
                                    <div class="form-item">
                                        <select class="awe-select">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                    </div>
                                    <span>12 yo and above</span>
                                </div>
                                <div class="form-elements form-kids">
                                    <label>Kids</label>
                                    <div class="form-item">
                                        <select class="awe-select">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                    </div>
                                    <span>11 and under</span>
                                </div>
                            </div>
                            <div class="form-baggage-weight">
                                <label>Extra baggage weight / person</label>
                                <div class="form-item">
                                    <select class="awe-select">
                                        <option>15 kg - $20</option>
                                        <option>15 kg - $20</option>
                                    </select>
                                </div>
                                <div class="form-item">
                                    <select class="awe-select">
                                        <option>25 kg - $40</option>
                                        <option>25 kg - $40</option>
                                    </select>
                                </div>
                                <span>Cabin 7kg/person for free</span>
                            </div>
                            <div class="price">
                                <em>Total for this booking</em>
                                <span class="amount">$5,923</span>
                            </div>
                            <div class="form-submit">
                                <div class="add-to-cart">
                                    <button type="submit">
                                        Book now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
