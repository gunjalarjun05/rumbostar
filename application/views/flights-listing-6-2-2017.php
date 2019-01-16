<!-- HEADING PAGE -->
  <section id="Carousel" class="carousel slide carousel-fade mainslider">
        <!-- Indicators -->
                <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                  <img src="<?php echo site_url().ASSETS_IMAGES?>slide1.jpg" class="img-responsive">
                
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                   <img src="<?php echo site_url().ASSETS_IMAGES?>/slide2.jpg" class="img-responsive">
                
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
               <img src="<?php echo site_url().ASSETS_IMAGES?>/slide3.jpg" class="img-responsive">
               
            </div>
            
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#Carousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#Carousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </section>
        <!-- END / HEADING PAGE -->

        
        <section class="filter-page flight-listing-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-top">
                            <ul class="list-link">
                                <li class="current"><a href="<?php echo site_url('flight');?>">Flight</a></li>
                                <li><a href="<?php echo site_url('hotel');?>">Hotel</a></li>
                                <li><a href="<?php echo site_url('train');?>">Train</a></li>
                            </ul>
                            <select class="awe-select" onchange="filght_sort_change(this,'<?php echo $pageid;?>')">
                                <option value="">Sort By</option>
                                <option value="1" <?php echo ($this->uri->segment(3) == 1)?'selected=selected':'' ?>>Name A-Z</option>
                                <option value="2" <?php echo ($this->uri->segment(3) == 2)?'selected=selected':'' ?>>Name Z-A</option>
                                <option value="3" <?php echo ($this->uri->segment(3) == 3)?'selected=selected':'' ?>>Price Low to High</option>
                                <option value="4" <?php echo ($this->uri->segment(3) == 4)?'selected=selected':'' ?>>Price High to Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-push-3">
                        <div class="filter-page__content">
                        <?php 
                            if(isset($errorMsg) && $errorMsg!=''){
                                echo $errorMsg;
                            }

                            if(isset($result['airlineIfo']) && count($result['airlineIfo'])>0){
                                for($i=0; $i<count($result['airlineIfo']); $i++) { ?>
                                
                                    <div class="filter-item-wrapper">
                                        <!-- ITEM -->
                                        <div class="flight-item">
                                            <div class="item-media">
                                                <div class="image-cover">
                                                    <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $result['airlineIfo'][$i]->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $result['airlineIfo'][$i]->airline_name))] !=''):?>
                                                    <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $result['airlineIfo'][$i]->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $result['airlineIfo'][$i]->airline_name))];?>" >
                                                    <?php else:?>
                                                    <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                            <div class="item-body">
                                                <div class="item-title">
                                                <h2>
                                                <a href="#<?php echo $i."-name-".$result['airlineIfo'][$i]->airline_name;?>"><?php echo $result['airlineIfo'][$i]->airline_name; ?></a>
                                                </h2>
                                                </div>
                                                <table class="item-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="route">Route</th>
                                                            <th class="depart">Depart</th>
                                                            <th class="arrive">Arrive</th>
                                                            <th class="duration">Duration</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="route">
                                                                <ul>
                                                                <li><?php echo $result['airlineIfo'][$i]->from; ?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li><?php echo $result['airlineIfo'][$i]->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                </ul>
                                                            </td>
                                                            <td class="depart">
                                                            <span><?php echo $result['airlineIfo'][$i]->etd; ?></span>
                                                            <span class="date"><?php $date=$result['airlineIfo'][$i]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                            </td>
                                                            <td class="arrive">
                                                            <span><?php echo $result['airlineIfo'][$i]->eta; ?></span>
                                                            <span class="date"></span>
                                                            </td>
                                                            <td class="duration">
                                                            <span><?php 
                                                             echo getTimeDiff($result['airlineIfo'][$i]->etd , $result['airlineIfo'][$i]->eta);
                                                            ?> </span>
                                                            </td>
                                                        </tr>
                                                        <?php $connectingUrl = '';?>
                                                         <?php if($result['airlineIfo'][$i]->type == 'connecting'): $k=2;?>
                                                            <?php foreach ($result['airlineIfo'][$i]->connecting_flight as $key => $value): ?>
                                                                <?php
                                                                    $amp = ($k>2)?'&':'';
                                                                    //$connectingUrl .= $amp.'flightno_'.$k.'='.$result['airlineIfo'][$i]['connecting_flight'][$key]['fno'].'&class_id_'.$k.'='.$result['airlineIfo'][$i]['class'][0]->class_id;
                                                                    $connectingUrl .= $amp.'flightno_'.$k.'='.$result['airlineIfo'][$i]->connecting_flight[$key]->fno.'&class_id_'.$k.'='.$result['airlineIfo'][$i]->class[0]->class_id;
                                                                ?>
                                                                <tr>
                                                                    <td class="route">
                                                                        <ul>
                                                                            <li><?php echo $result['airlineIfo'][$i]->connecting_flight[$key]->from;?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                            <li><?php echo $result['airlineIfo'][$i]->connecting_flight[$key]->to;?> <i class="awe-icon awe-icon-arrow-right"></i></li>                                                                    
                                                                        </ul>
                                                                    </td>
                                                                    <td class="depart">
                                                                     <span><?php echo $result['airlineIfo'][$i]->connecting_flight[$key]->etd; ?></span>
                                                                       
                                                                    </td>
                                                                    <td class="arrive">
                                                                        <span><?php echo $result['airlineIfo'][$i]->connecting_flight[$key]->eta; ?></span>
                                                                         <span class="date"><?php $date=$result['airlineIfo'][$i]->connecting_flight[$key]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                                    </td>
                                                                    <td class="duration">
                                                                       <span><?php 
                                                                     echo getTimeDiff($result['airlineIfo'][$i]->connecting_flight[$key]->etd , $result['airlineIfo'][$i]->connecting_flight[$key]->eta);
                                                                    ?> </span>
                                                                    </td>                                                    
                                                                </tr>
                                                             <?php $k++; endforeach; ?>
                                                       
                                                        <?php endif; ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="item-price-more">
                                                <div class="price">
                                                    <span class="amount"><?php echo $curr[$result['airlineIfo'][$i]->class[0]->ccy]."".number_format($result['airlineIfo'][$i]->class[0]->price);?></span>
                                                </div>
                                                <a class="awe-btn" href="<?php echo site_url().'flight-details/'.$session_id.'/'.$result['airlineIfo'][$i]->fno.'/'.$result['airlineIfo'][$i]->class[0]->class_id.'?'.$connectingUrl;?>" >View details</a>
                                            </div>
                                        </div>
                                        <!-- END / ITEM -->
                                    </div>


                                    <?php

                                    }
                                 } ?>

                                <!-- PAGINATION -->
                                <div class="page__pagination pull-right">
                                    <?php echo (isset($no_of_pages) && $no_of_pages!='')?$no_of_pages:'';?>
                                </div>

                                <!-- END / PAGINATION -->
                            </div>
                    </div>
                    <?php $this->load->view('filters',array("search_info"=>$search_info,"range_slide_min"=>$range_slide_min,"range_slide_max"=>$range_slide_max));?>
                </div>
            </div>
        </section>
        <style type="text/css">
            .image-cover img{
                width: 80% !important;
            }
        </style>
        <script type="text/javascript">
            var fhand = '<?php echo (isset($range_slide_min) && $range_slide_min!='')?$range_slide_min:10000?>';
            var shand='<?php echo (isset($range_slide_max) && $range_slide_max!='')?$range_slide_max:100000000?>';
        </script>
