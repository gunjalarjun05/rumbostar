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
<?php 
//echo '<pre>';
//print_r($airlineIfo);exit;
if(isset($airlineIfo->schedule->return) && count($airlineIfo->schedule->return)>0){
?>
<section class="return-flight-details-sec" id="top-sec">
    <div class="container">
    <!-- page content -->
        <div class="col-md-9 col-md-push-3 return-details-sec">
            <div class="selected-results col-md-12 col-sm-12 rest-click" id="selected-results" style="display:none;">
                <div class="col-md-6 col-sm-6 oneway-flight" id="depature-selected" style="display:none">
                    <p class="flight-head">Selected Departure Flight</p>
                    <div class="Name"><h3 class="flight-name" id="depature-flt-name">Lufthansa : Hanoi - NYC</h3></div>
                    <div class="Depart"><p class="dept" ><b>Depart :</b> <span class="dept-time" id="depature-flt-date"> 10:25 14 Feb</span></p></div>
                    <div class="Price"><p class="flight-time"><b>Price :</b> <span class="flight-time" id="depature-flt-price"> $5,923</span></p></div>
                    <a  href="#line" class="awe-btn select-flight scroll onewaychange hvr-rectangle-out">CHANGE</a>   
                </div>
                <div class="col-md-6 col-sm-6 return-flight" id="return-selected" style="display:none">
                    <p class="flight-head">Selected Return Flight</p>
                    <div class="Name"><h3 class="flight-name" id="return-flt-name">Lufthansa : Hanoi - NYC</h3></div>
                    <div class="Depart"><p class="dept"><b>Depart :</b> <span class="dept-time" id="return-flt-date"> 10:25 14 Feb</span></p></div>
                    <div class="Price"><p class="flight-time"><b>Price :</b> <span class="flight-time" id="return-flt-price"> $5,923</span></p></div>         
                    <a href="#line" class="awe-btn select-flight scroll returnchange hvr-rectangle-out">CHANGE</a>        
                </div>
                <div class="col-md-12 col-sm-12 final-details">
                    <div class="finalprice"><p class="total-price"><b>Total Price :</b> <span class="flights-totl-price"> $5,923</span></p>
                    <a href="javascript:void(0);" class="awe-btn select-flight hvr-rectangle-out" id="proceed-btn">PROCEED</a>
                    </div>                    
                </div>
            </div>
            <div class="line" id="line"></div>
            <div class="responsive-section">
                <ul>   
                    <li><a class="Departute active-sec">Choose departure flight</a></li>
                    <li><a class="dash">/</a></li>
                    <li><a class="Arrival">Choose return flight</a></li>
                </ul>
            </div>

            <div class="oneway">
                <div class="return-page-head Departute"><h1>Choose departure flight</h1></div>  
                <?php  

                if(isset($airlineIfo->schedule->depart) && count($airlineIfo->schedule->depart)>0){
                for($i=0; $i<count($airlineIfo->schedule->depart); $i++) { ?>
                    <div class="flight-item box-effect">
                        <div class="item-media">
                            <div class="image-cover">
                                <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->depart[$i]->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->depart[$i]->airline_name))] !=''):?>
                                <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $airlineIfo->schedule->depart[$i]->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->depart[$i]->airline_name))];?>" >
                                <?php else:?>
                                <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                <?php endif;?>
                            </div>
                        </div>
                        <input type="hidden" id="flno_id" value="<?php echo $airlineIfo->schedule->depart[$i]->fno;?>" />
                        <input type="hidden" id="flno_classid" value="<?php echo $airlineIfo->schedule->depart[$i]->class[0]->class_id;?>" />
                        <div class="item-body">
                            <div class="item-title">
                                <h2>
                                    <a href="#<?php echo $i."-name-".$airlineIfo->schedule->depart[$i]->airline_name;?>"><?php echo $airlineIfo->schedule->depart[$i]->airline_name; ?></a>
                                </h2>
                            </div>
                            <table class="item-table">
                                <thead>
                                <tr>
                                    <th class="route">Route</th>
                                    <!-- <th class="seats">Seats</th> -->
                                    <th class="depart">Depart</th>
                                    <th class="arrive">Arrive</th>
                                    <th class="duration">Duration</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="route">
                                        <ul>
                                            <li><?php echo $airlineIfo->schedule->depart[$i]->from; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                            <li><?php echo $airlineIfo->schedule->depart[$i]->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                        </ul>
                                        </td>
                                        <!-- <td><?php echo $airlineIfo->schedule->depart[$i]->class[0]->seat; ?></td> -->
                                        <td class="depart">
                                            <span class="time"><?php echo $airlineIfo->schedule->depart[$i]->etd; ?></span>
                                            <span class="date"><?php $date=$airlineIfo->schedule->depart[$i]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $airlineIfo->schedule->depart[$i]->eta; ?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($airlineIfo->schedule->depart[$i]->etd , $airlineIfo->schedule->depart[$i]->eta);
                                            ?> </span>
                                        </td>
                                    </tr>
                                    <?php $connectingUrl = '';?>
                                    <?php if($airlineIfo->schedule->depart[$i]->type == 'connecting'): $k=2;?>
                                    <?php foreach ($airlineIfo->schedule->depart[$i]->connecting_flight as $key => $value): ?>
                                    <?php
                                    $amp = ($k>2)?'&':'';
                                    //$connectingUrl .= $amp.'flightno_'.$k.'='.$result['airlineIfo'][$i]['connecting_flight'][$key]['fno'].'&class_id_'.$k.'='.$result['airlineIfo'][$i]['class'][0]->class_id;
                                    $connectingUrl .= $amp.'flightno_'.$k.'='.$airlineIfo->schedule->depart[$i]->connecting_flight[$key]->fno.'&class_id_'.$k.'='.$airlineIfo->schedule->depart[$i]->class[0]->class_id;
                                    ?>
                                    <tr>
                                        <td class="route">
                                            <ul>
                                                <li><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->from;?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                <li><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->to;?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                            </ul>
                                        </td>
                                       <!--  <td><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->class[0]->seat; ?></td> -->
                                        <td class="depart">
                                            <span><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->etd; ?></span>

                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->eta; ?></span>
                                            <span class="date"><?php $date=$airlineIfo->schedule->depart[$i]->connecting_flight[$key]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($airlineIfo->schedule->depart[$i]->connecting_flight[$key]->etd , $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->eta);
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
                            <span class="amount"><?php echo $curr[$airlineIfo->schedule->depart[$i]->class[0]->ccy]."<span class='only-ammount'>".number_format($airlineIfo->schedule->depart[$i]->class[0]->price);?></span> 
                            </div>
                            <?php //if($airlineIfo->schedule->depart[$i]->class[0]->seat != '-' && $airlineIfo->schedule->depart[$i]->class[0]->seat >0){ ?>
                            <a href="#top-sec" class="awe-btn scroll select-flight hvr-rectangle-out">SELECT</a>
                            <?php //}else{ ?> 
                            <!-- <a href="#" class="awe-btn hvr-rectangle-out select_flight">SELECT</a>  -->
                            <?php //} ?>
                        </div>
                    </div>
                <?php
                } 
                }  ?>   
            </div>
        <?php //echo '66876678667';exit; ?>
            <div class="return less-width">
                <div class="return-page-head Arrival"><h1>Choose return flight</h1></div>
                <?php 
                //echo 'wqwqw';exit;
                if(isset($airlineIfo->schedule->return) && count($airlineIfo->schedule->return)>0){
                for($i=0; $i<count($airlineIfo->schedule->return); $i++) { ?>
                    <div class="flight-item box-effect">
                        <div class="item-media">
                        <div class="image-cover">
                        <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->return[$i]->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->return[$i]->airline_name))] !=''):?>
                        <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $airlineIfo->schedule->return[$i]->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->return[$i]->airline_name))];?>" >
                        <?php else:?>
                        <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                        <?php endif;?>
                        </div>
                        </div>
                        <div class="item-body">
                            <input type="hidden" id="flno_id" value="<?php echo $airlineIfo->schedule->return[$i]->fno;?>" />
                            <input type="hidden" id="flno_classid" value="<?php echo $airlineIfo->schedule->return[$i]->class[0]->class_id;?>" />
                            <div class="item-title">
                            <h2><a href="#<?php echo $i."-name-".$airlineIfo->schedule->return[$i]->airline_name;?>"><?php echo $airlineIfo->schedule->return[$i]->airline_name; ?></a></h2>
                            </div>

                            <table class="item-table">
                                <thead>
                                    <tr>
                                        <th class="route">Route</th>
                                        <!-- <th class="seats">Seats</th> -->
                                        <th class="depart">Depart</th>
                                        <th class="arrive">Arrive</th>
                                        <th class="duration">Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="route">
                                            <ul>
                                            <li><?php echo $airlineIfo->schedule->return[$i]->from; ?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                            <li><?php echo $airlineIfo->schedule->return[$i]->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                            </ul>
                                        </td>
                                       <!--  <td><?php echo $airlineIfo->schedule->return[$i]->class[0]->seat; ?></td> -->
                                        <td class="depart">
                                            <span class="time"><?php echo $airlineIfo->schedule->return[$i]->etd; ?></span>
                                            <span class="date"><?php $date=$airlineIfo->schedule->return[$i]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $airlineIfo->schedule->return[$i]->eta; ?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($airlineIfo->schedule->return[$i]->etd , $airlineIfo->schedule->return[$i]->eta);
                                            ?> </span>
                                        </td>
                                    </tr>
                                    <?php $connectingUrl = '';?>
                                     <?php if($airlineIfo->schedule->return[$i]->type == 'connecting'): $k=2;?>
                                        <?php foreach ($airlineIfo->schedule->return[$i]->connecting_flight as $key => $value): ?>
                                        <?php
                                        $amp = ($k>2)?'&':'';
                                        //$connectingUrl .= $amp.'flightno_'.$k.'='.$result['airlineIfo'][$i]['connecting_flight'][$key]['fno'].'&class_id_'.$k.'='.$result['airlineIfo'][$i]['class'][0]->class_id;
                                        $connectingUrl .= $amp.'flightno_'.$k.'='.$airlineIfo->schedule->return[$i]->connecting_flight[$key]->fno.'&class_id_'.$k.'='.$airlineIfo->schedule->return[$i]->class[0]->class_id;
                                    ?>
                                    <tr>
                                        <td class="route">
                                            <ul>
                                                <li><?php echo $airlineIfo->schedule->return[$i]->connecting_flight[$key]->from;?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                <li><?php echo $airlineIfo->schedule->return[$i]->connecting_flight[$key]->to;?> <i class="awe-icon awe-icon-arrow-right"></i></li>                      
                                            </ul>
                                        </td>
                                        <!-- <td><?php echo $airlineIfo->schedule->return[$i]->connecting_flight[$key]->class[0]->seat; ?></td> -->
                                        <td class="depart">
                                            <span><?php echo $airlineIfo->schedule->return[$i]->connecting_flight[$key]->etd; ?></span>
                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $airlineIfo->schedule->return[$i]->connecting_flight[$key]->eta; ?></span>
                                            <span class="date"><?php $date=$airlineIfo->schedule->return[$i]->connecting_flight[$key]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($airlineIfo->schedule->return[$i]->connecting_flight[$key]->etd , $airlineIfo->schedule->return[$i]->connecting_flight[$key]->eta);
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
                            <span class="amount"><?php echo $curr[$airlineIfo->schedule->return[$i]->class[0]->ccy]."<span class='only-ammount'>".number_format($airlineIfo->schedule->return[$i]->class[0]->price);?></span>
                            </div>
                            <?php //if($airlineIfo->schedule->return[$i]->class[0]->seat != '-' && $airlineIfo->schedule->return[$i]->class[0]->seat >0){ ?>
                            <a href="#top-sec" class="awe-btn scroll select-flight hvr-rectangle-out">SELECT</a>
                        <?php //}else{ ?>
                             <!-- <a href="#" class="awe-btn hvr-rectangle-out select_flight">SELECT</a>  -->
                            <?php //} ?>
                        </div>
                    </div>
                <?php 
                    }
                }
                ?>
            </div>
        </div>
        <?php  
        $this->load->view('filters',array("search_info"=>$search_info,"range_slide_min"=>$range_slide_min,"range_slide_max"=>$range_slide_max));?>
    </div>
</section>
<?php
}else{  //echo 'hiieqeqqweqwewqewqei';exit;
?>
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
                    <p class="api-errors"><?php echo (isset($errorMsg) && $errorMsg!='')?$errorMsg:'';?></p>
                    <div class="clearfix"></div>                     
                    <?php /*echo '<pre>';
                    print_r($airlineIfo);exit;*/
                    //echo '<pre>';

                    if(isset($airlineIfo->schedule->depart) && count($airlineIfo->schedule->depart)>0){
                    for($i=0; $i<count($airlineIfo->schedule->depart); $i++) {
                       // print_r();exit;
                     ?>
                    <div class="filter-item-wrapper">
                        <!-- ITEM -->
                        <div class="flight-item box-effect">
                            <div class="item-media">
                                <div class="image-cover">
                                    <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->depart[$i]->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->depart[$i]->airline_name))] !=''):?>
                                    <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $airlineIfo->schedule->depart[$i]->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $airlineIfo->schedule->depart[$i]->airline_name))];?>" >
                                    <?php else:?>
                                    <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="item-body">
                                <div class="item-title">
                                    <h2>
                                    <a href="#<?php echo $i."-name-".$airlineIfo->schedule->depart[$i]->airline_name;?>"><?php echo $airlineIfo->schedule->depart[$i]->airline_name; ?></a>
                                    </h2>
                                </div>
                                <table class="item-table">
                                    <thead>
                                    <tr>
                                        <th class="route">Route</th>  
                                        <!-- <th class="seats">Seats</th> -->        
                                        <th class="depart">Depart</th>
                                        <th class="arrive">Arrive</th>
                                        <th class="duration">Duration</th>
                                        <!-- <th class="flight_class">Class</th> -->
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="route">
                                                <ul>
                                                    <li><?php echo $airlineIfo->schedule->depart[$i]->from; ?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                    <li><?php echo $airlineIfo->schedule->depart[$i]->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                </ul>
                                            </td>
                                             <!-- <td>
                                             <?php if($airlineIfo->schedule->depart[$i]->class[0]->seat == '-'){
                                            echo $seats = '0';
                                            }else{
                                             echo  $airlineIfo->schedule->depart[$i]->class[0]->seat;
                                                } ?>
                                                    
                                                </td> -->
                                            <td class="depart">
                                                <span><?php echo $airlineIfo->schedule->depart[$i]->etd; ?></span>
                                                <span class="date"><?php $date=$airlineIfo->schedule->depart[$i]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                            </td>


                                            <td class="arrive">
                                                <span><?php echo $airlineIfo->schedule->depart[$i]->eta; ?></span>
                                                <span class="date"></span>
                                            </td>
                                            <td class="duration">
                                                <span><?php 
                                                echo getTimeDiff($airlineIfo->schedule->depart[$i]->etd , $airlineIfo->schedule->depart[$i]->eta);
                                                ?> </span>
                                            </td>
                                        </tr>

                                        <?php $connectingUrl = '';?>
                                        <?php if($airlineIfo->schedule->depart[$i]->type == 'connecting'): $k=2;?>
                                        <?php foreach ($airlineIfo->schedule->depart[$i]->connecting_flight as $key => $value): ?>                                           
                                        <?php
                                        $amp = ($k>2)?'&':'';
                                        //$connectingUrl .= $amp.'flightno_'.$k.'='.$result['airlineIfo'][$i]['connecting_flight'][$key]['fno'].'&class_id_'.$k.'='.$result['airlineIfo'][$i]['class'][0]->class_id;
                                        $connectingUrl .= $amp.'flightno_'.$k.'='.$airlineIfo->schedule->depart[$i]->connecting_flight[$key]->fno.'&class_id_'.$k.'='.$airlineIfo->schedule->depart[$i]->class[0]->class_id;
                                        ?>
                                        <tr>
                                        <td class="route">
                                        <ul>
                                        <li><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->from;?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                        <li><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->to;?> <i class="awe-icon awe-icon-arrow-right"></i></li>                      
                                        </ul>
                                        </td> 
                                       <!--  <td><?php if($airlineIfo->schedule->depart[$i]->class[0]->seat == '-'){
                                            echo $seats = '0';
                                            }else{
                                             echo  $airlineIfo->schedule->depart[$i]->class[0]->seat;
                                                } ?></td>     -->          
                                        <td class="depart">
                                        <span><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->etd; ?></span>

                                        </td>
                                         
                                        <td class="arrive">
                                        <span><?php echo $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->eta; ?></span>
                                        <span class="date"><?php $date=$airlineIfo->schedule->depart[$i]->connecting_flight[$key]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="duration">
                                        <span><?php 
                                        echo getTimeDiff($airlineIfo->schedule->depart[$i]->connecting_flight[$key]->etd , $airlineIfo->schedule->depart[$i]->connecting_flight[$key]->eta);
                                        ?> </span>
                                        </td>  
                                        <!-- <td class="flight_class">
                                        <?php echo $value->class[0]->class_name; ?>
                                        </td>  -->   
                                       
                                        </tr>
                                        <?php $k++; endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="item-price-more">
                                <div class="price">
                                    <span class="amount"><?php echo $curr[$airlineIfo->schedule->depart[$i]->class[0]->ccy]."".number_format($airlineIfo->schedule->depart[$i]->class[0]->price);?></span>
                                </div>
                                <?php //echo '<pre>'; print_r($airlineIfo->schedule->depart[$i]->class[0]->seat);exit;?>
                                <?php //if($airlineIfo->schedule->depart[$i]->class[0]->seat == '-'){ //echo 'dfsdf';exit; ?>
                               <!--  <a class="awe-btn hvr-rectangle-out view_details" href="#">View details</a> -->
                                <?php //}else{ ?>                                
                                <a class="awe-btn hvr-rectangle-out" href="<?php echo site_url().'flight-details/'.$session_id.'/'.$airlineIfo->schedule->depart[$i]->fno.'/'.$airlineIfo->schedule->depart[$i]->class[0]->class_id.'?'.$connectingUrl;?>" >View details</a>

                                <!-- <input type="hidden" name="session_id" id="flight_session_data" value="<?php echo site_url().'flight-details/'.$session_id.'/'.$airlineIfo->schedule->depart[$i]->fno.'/'.$airlineIfo->schedule->depart[$i]->class[0]->class_id.'?'.$connectingUrl;?>">
                                <a class="awe-btn hvr-rectangle-out" href="#"  data-toggle="modal" data-target="#myModal" >View details</a> -->
                                <?php //} ?>
                            </div>
                        </div>
                        <!-- END / ITEM -->
                    </div>
                    <?php
                    }
                    }
                    ?>
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


    <!-- Modal start-->
    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Guest login</h4>
    </div>
    <div class="modal-body">
    <form>
    <label>Email : </label>
    <input type="text" name="emailid" value="" placeholder="Email Id">
    <div></div>
    <button type="button" class="btn btn-primary">Send</button>
    </form>
    </div>
    <div class="modal-footer">     

    </div>
    </div>
    </div>
    </div> -->
    <!-- model end -->

</section>
<?php
//echo '4234233243243243243243243234==='; 
//print_r($airlineIfo);exit; 
}
?>


<style type="text/css">
.image-cover img{
width: 80% !important;
}
</style>
<script type="text/javascript">

$(".select_flight").click(function(){
alert('Seats are not available. Please change date.');
});

$(".view_details").click(function(){
alert('Seats are not available. Please change date.');
});

var sessionId = '<?php echo $session_id;?>';
var fhand = '<?php echo (isset($range_slide_min) && $range_slide_min!='')?$range_slide_min:10000?>';
var shand='<?php echo (isset($range_slide_max) && $range_slide_max!='')?$range_slide_max:100000000?>';
var pushArr = [];
var flight_oncePrice = '';
var flight_twoPrice = '';
$(document).ready(function(){ 
var addr_flag = 1; 
$(".scroll").click(function(event){     
$('html,body').animate({scrollTop:$(this.hash).offset().top -100},1000);
});

$(".Departute").click(function(){
$(".oneway").addClass('full-width');
$(".return").addClass('less-width');
$(".oneway").removeClass('less-width');
});

$(".Arrival").click(function(){
$(".oneway").addClass('less-width');
$(".return").addClass('full-width');
$(".return").removeClass('less-width');
});

$(".oneway .select-flight").click(function(){
$(".oneway").addClass('less-width');
$(".return").addClass('full-width');
$(".return").removeClass('less-width'); 
$(".responsive-section ul li a").toggleClass('active-sec'); 

var currentParent = $(this).parent();
var currentItem = $(this).parent().parent();

$("#depature-flt-name").html(currentItem.find(".item-title a").text());
$("#depature-flt-date").html(currentItem.find(".depart .time").text()+ " "+currentItem.find(".depart .date").text() );
$("#depature-flt-price").html('Rp'+currentParent.find(".price .only-ammount").text());
$(".flights-totl-price").html('Rp'+currentParent.find(".price .only-ammount").text());
pushArr[0] = currentItem.find("#flno_id").val();
pushArr[1] = currentItem.find("#flno_classid").val();
flight_oncePrice = parseInt(currentParent.find(".price .only-ammount").text().replace(/,/g,''));
flight_twoPrice = parseInt(currentParent.find(".price .only-ammount").text().replace(/,/g,''));

//finalPrice = addCommas(flight_oncePrice + flight_twoPrice); sk

finalPrice = addCommas(flight_oncePrice);
$(".flights-totl-price").html('Rp'+finalPrice);
$("#depature-selected").fadeIn(1000);
$("#selected-results").fadeIn(1000);
}); 

$(".return .select-flight").click(function(){

var currentParent = $(this).parent();
var currentItem = $(this).parent().parent();

$(".oneway").addClass('full-width');
$(".oneway").removeClass('less-width');
$(".return").removeClass('full-width');
$(".return").addClass('less-width'); 

$("#return-flt-name").html(currentItem.find(".item-title a").text());
$("#return-flt-date").html(currentItem.find(".depart .time").text()+ " "+currentItem.find(".depart .date").text() );
$("#return-flt-price").html('Rp'+currentParent.find(".price .only-ammount").text());

pushArr[2] = currentItem.find("#flno_id").val();
pushArr[3] = currentItem.find("#flno_classid").val();
flight_twoPrice = parseInt(currentParent.find(".price .only-ammount").text().replace(/,/g,''));
if(flight_oncePrice==''){

}
finalPrice = addCommas(flight_oncePrice + flight_twoPrice);
$(".flights-totl-price").html('Rp'+finalPrice);

$("#return-selected").fadeIn(1000);
$("#selected-results").fadeIn(1000);
}); 


$(".onewaychange").click(function(){
$(".oneway").addClass('full-width');
$(".return").addClass('less-width');
$(".oneway").removeClass('less-width');
$(".responsive-section ul li a").toggleClass('active-sec'); 
});

$(".returnchange").click(function(){
$(".oneway").addClass('less-width');
$(".return").addClass('full-width');
$(".return").removeClass('less-width');
$(".responsive-section ul li a").toggleClass('active-sec');  
});

$(".responsive-section ul li").click(function(){
$(".responsive-section ul li a").toggleClass('active-sec');
});
//sk just add else #proceed-btn function for when user select departch flight and click on proceed button 27-12-2017
$("#proceed-btn").click(function(){
var url ='#';//?flightno_2=TK 1959&class_id_2=DIT2
console.log(pushArr);
if(pushArr.length ==4 && pushArr[0] != undefined && pushArr[1] != undefined){  //alert(pushArr);
url = site_url+'flight-details/'+sessionId+'/'+pushArr[0]+'/'+pushArr[1]+'?flightno_2='+pushArr[2]+'&class_id_2='+pushArr[3];
window.location.href = url;
}else{
    alert('please select both side flight.');
/*url = site_url+'flight-details/'+sessionId+'/'+pushArr[0]+'/'+pushArr[1]+'?flightno_2='+pushArr[2]+'&class_id_2='+pushArr[3]; 
window.location.href = url;*/
}

});
});

function addCommas(nStr){
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


$("#mybookings").click(function() {
    var hrefs = $(this).attr('href'); 
    if(hrefs == '#bookings')
    {
    window.location.href = "<?php echo site_url(); ?>booking/my-flight-booking";
    }
});

$("#settings").click(function(){
    var hrefs = $(this).attr('href');   
    if(hrefs == '#setting')
    { 
    window.location.href = "<?php echo site_url(); ?>user/referred-code";
    }
});
</script>

