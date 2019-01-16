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
                <?php  //echo '<pre>'; 
                
                if(isset($airlineIfo->schedule->depart)){
                $i = 0;
               // for($i=0; $i<count($airlineIfo->schedule->depart); $i++) { 
               foreach ($airlineIfo->schedule->depart as $key => $departvalue) {
                    //print_r($departvalue);exit;
                    ?>
                    <div class="flight-item box-effect">
                        <div class="item-media">
                            <div class="image-cover">
                                <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $departvalue->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $departvalue->airline_name))] !=''):?>
                                <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $onewayvalue->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $onewayvalue->airline_name))];?>" >
                                <?php else:?>
                                <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                <?php endif;?>
                            </div>
                        </div>
                        <input type="hidden" id="flno_id" value="<?php echo $departvalue->fno;?>" />
                        <input type="hidden" id="flno_classid" value="<?php //echo $departvalue->class[0]->class_id;?>" />
                        <div class="item-body">
                            <div class="item-title">
                                <h2>
                                    <a href="#<?php echo $i."-name-".$departvalue->airline_name;?>"><?php echo $departvalue->airline_name; ?></a>
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
                                    <?php //echo '<pre>'; print_r($departvalue); ?>
                                        <td class="route">
                                        <ul>
                                            <li><?php echo $departvalue->from; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                            <li><?php echo $departvalue->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                        </ul>
                                        </td>
                                        <!-- <td><?php //echo $onewayvalue->class[0]->seat; ?></td> -->

                                        <td class="depart">
                                            <span class="time"><?php echo $departvalue->etd; ?>         
                                            </span>
                                            <span class="date">
                                            <?php $date = $departvalue->date;
                                             echo  date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $departvalue->eta; ?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($departvalue->etd , $departvalue->eta);
                                            ?> </span>
                                        </td>
                                    </tr>
                                    <?php $connectingUrl = '';?>
                                    <?php if($departvalue->type == 'connecting'): $k=2;?>
                                    <?php foreach ($departvalue->connecting_flight as $key => $value): ?>
                                    <?php
                                    $amp = ($k>2)?'&':'';
                                    //$connectingUrl .= $amp.'flightno_'.$k.'='.$result['airlineIfo'][$i]['connecting_flight'][$key]['fno'].'&class_id_'.$k.'='.$result['airlineIfo'][$i]['class'][0]->class_id;
                                    $connectingUrl .= $amp.'flightno_'.$k.'='.$departvalue->connecting_flight[$key]->fno.'&class_id_'.$k.'='.$departvalue->class[0]->class_id;
                                    ?>
                                    <tr>
                                        <td class="route">
                                            <ul>
                                                <li><?php echo $departvalue->connecting_flight[$key]->from;?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                <li><?php echo $departvalue->connecting_flight[$key]->to;?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                            </ul>
                                        </td>
                                       <!--  <td><?php echo $onewayvalue->connecting_flight[$key]->class[0]->seat; ?></td> -->
                                        <td class="depart">
                                            <span><?php echo $departvalue->connecting_flight[$key]->etd; ?></span>

                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $departvalue->connecting_flight[$key]->eta; ?></span>
                                            <span class="date"><?php $date=$departvalue->connecting_flight[$key]->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($departvalue->connecting_flight[$key]->etd , $departvalue->connecting_flight[$key]->eta);
                                            ?> </span>
                                        </td>  
                                    </tr>
                                    <?php $k++; endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <table class="item-table">
                                    <thead>
                                    <tr>                    
                                    <!-- <th class="duration">Class ID</th> -->
                                    <th class="depart">Class</th>
                                    <th class="depart">Class Name</th>
                                    <!-- <th class="arrive">Seat</th> -->
                                    <th class="duration">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php 
                                    if(isset($departvalue->class) && count($departvalue->class)>0){ $k=2;
                                    foreach ($departvalue->class as $key =>  $classarr){ 
                                    $amp = ($k>2)?'&':'';
                                    //echo '<pre>'; print_r($val); ?>
                                    <tr> 
                                    <!-- <input type="hidden" name="per_person_no"  id="per_person_no" value="<?php //echo $key; ?>"> -->
                                    <!-- <td class="route sub_class_<?php //echo $value->train_no;?>_<?php //echo $key ?>">    
                                    <?php //echo (isset($classarr->class_id)?$classarr->class_id: 'N/A'); ?></td> -->

                                    <td class="depart"><?php echo (isset($classarr->class)?$classarr->class: 'N/A'); ?></td>

                                    <td><?php echo ($classarr->class_name)?$classarr->class_name:'N/A'; ?></td>

                                    <!-- <td class="arrive"> <?php //echo (isset($classarr->seat)?$classarr->seat: 'N/A'); ?></td> -->

                                    <td class="arrive price_<?php //echo $value->train_no; ?>_<?php //echo $key ?>"> 
                                    <?php echo (isset($classarr->price)?$classarr->price: 'N/A'); ?>

                                    </td>                           
                                    <td>
                                    <div class="">            
                                        <a href="#top-sec" class="awe-btn scroll select-flight hvr-rectangle-out">SELECT</a>
                                    </div>
                                    </td>

                                    <!-- <td class="duration"><a href="#selected-results" class="awe-btn scroll select-train" data-train_id="<?php echo $value->train_no;?>" data-per_person_no="<?php echo $key; ?>">Select</a></td> -->
                                    </tr>
                                    <?php } 
                                    } ?>
                                    </tbody>
                                </table>
                        </div>
                        <div class="item-price-more">
                            <div class="price">
                            <span class="amount"><?php //sk echo $curr[$onewayvalue->class[0]->ccy]."<span class='only-ammount'>".number_format($onewayvalue->class[0]->price);?></span> 
                            </div>
                            <?php //if($onewayvalue->class[0]->seat != '-' && $onewayvalue->class[0]->seat >0){ ?>
                            <a href="#top-sec" class="awe-btn scroll select-flight hvr-rectangle-out">SELECT</a>
                            <?php //}else{ ?> 
                            <!-- <a href="#" class="awe-btn hvr-rectangle-out select_flight">SELECT</a>  -->
                            <?php //} ?>
                        </div>
                    </div>
                <?php
                } 
                $i++;
                }  ?>   
            </div>
        <?php //echo '66876678667';exit; ?>
            <div class="return less-width">
                <div class="return-page-head Arrival"><h1>Choose return flight</h1></div>
                <?php //echo '<pre>';
                //print_r($airlineIfo->schedule->return);exit;
                if(isset($airlineIfo->schedule->return)){
                    $i = 0;
                //for($i=0; $i<count($airlineIfo->schedule->return); $i++) { 
                    foreach ($airlineIfo->schedule->return as $key => $returnvalue) { ?>
                    <div class="flight-item box-effect">
                        <div class="item-media">
                        <div class="image-cover">
                        <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $returnvalue->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $returnvalue->airline_name))] !=''):?>
                        <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $returnvalue->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $returnvalue->airline_name))];?>" >
                        <?php else:?>
                        <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                        <?php endif;?>
                        </div>
                        </div>
                        <div class="item-body">
                            <input type="hidden" id="flno_id" value="<?php echo $returnvalue->fno;?>" />
                            <input type="hidden" id="flno_classid" value="<?php //echo $returnvalue->class[0]->class_id;?>" />
                            <div class="item-title">
                            <h2>
                            <!-- <a href="#<?php echo $i."-name-".$returnvalue->airline_name;?>"><?php echo $returnvalue->airline_name; ?></a></h2> -->
                            <a href="#<?php echo $i."-name-".$returnvalue->airline_name;?>"><?php echo $returnvalue->airline_name; ?></a></h2>
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
                                            <li><?php echo $returnvalue->from; ?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                            <li><?php echo $returnvalue->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                            </ul>
                                        </td>
                                       <!--  <td><?php //echo $airlineIfo->schedule->return[$i]->class[0]->seat; ?></td> -->
                                        <td class="depart">
                                            <span class="time"><?php echo $returnvalue->etd; ?></span>
                                            <span class="date"><?php $date=$returnvalue->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                        </td>
                                        <td class="arrive">
                                            <span><?php echo $returnvalue->eta; ?></span>
                                        </td>
                                        <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($returnvalue->etd , $returnvalue->eta);
                                            ?> </span>
                                        </td>
                                    </tr>
                                    <?php $connectingUrl = '';?>
                                     <?php if($returnvalue->type == 'connecting'): $k=2;?>
                                        <?php foreach ($returnvalue->connecting_flight as $key => $value): ?>
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
                            <table class="item-table">
                                    <thead>
                                    <tr>                    
                                    <!-- <th class="duration">Class ID</th> -->
                                    <th class="depart">Class</th>
                                    <th class="depart">Class Name</th>
                                    <!-- <th class="arrive">Seat</th> -->
                                    <th class="duration">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $connectingUrl = '';?>
                                    <?php 
                                    if(isset($returnvalue->class) && count($returnvalue->class)>0){ $k=2;
                                    foreach ($returnvalue->class as $key =>  $classarr){ 
                                    $amp = ($k>2)?'&':'';
                                    //echo '<pre>'; print_r($val); ?>
                                    <tr> 
                                    <!-- <input type="hidden" name="per_person_no"  id="per_person_no" value="<?php echo $key; ?>"> -->
                                    <!-- <td class="route sub_class_<?php //echo $value->train_no;?>_<?php //echo $key ?>">    
                                    <?php //echo (isset($classarr->class_id)?$classarr->class_id: 'N/A'); ?></td> -->

                                    <td class="depart"><?php echo (isset($classarr->class)?$classarr->class: 'N/A'); ?></td>

                                    <td><?php echo ($classarr->class_name)?$classarr->class_name:'N/A'; ?></td>

                                    <!-- <td class="arrive"> <?php //echo (isset($classarr->seat)?$classarr->seat: 'N/A'); ?></td> -->

                                    <td class="arrive price_<?php //echo $value->train_no; ?>_<?php //echo $key ?>"> 
                                    <?php echo (isset($classarr->price)?$classarr->price: 'N/A'); ?>

                                    </td>                           
                                    <td>
                                    <div class="">
                                    <!--   <div class="price">
                                    <span class="amount">RP <?php echo number_format($depart[0]["class"][0]["price"]);?><?php //echo $curr[$depart[$i]["connecting_flight"]["class"][0]["ccy"]]."".number_format($depart[$i]["class"][0]["price"]);?></span>
                                    </div> --> 
                                                              
                                    <a href="#top-sec" class="awe-btn scroll select-flight hvr-rectangle-out">SELECT</a>
                                    </div>
                                    </td>

                                    <!-- <td class="duration"><a href="#selected-results" class="awe-btn scroll select-train" data-train_id="<?php echo $value->train_no;?>" data-per_person_no="<?php echo $key; ?>">Select</a></td> -->
                                    </tr>
                                    <?php } 
                                    } ?>
                                    </tbody>
                                </table>

                        </div>
                        <div class="item-price-more">
                            <div class="price">
                            <span class="amount"><?php //sk echo $curr[$airlineIfo->schedule->return[$i]->class[0]->ccy]."<span class='only-ammount'>".number_format($airlineIfo->schedule->return[$i]->class[0]->price);?></span>
                            </div>
                            <?php //if($airlineIfo->schedule->return[$i]->class[0]->seat != '-' && $airlineIfo->schedule->return[$i]->class[0]->seat >0){ ?>
                            <!--sk <a href="#top-sec" class="awe-btn scroll select-flight hvr-rectangle-out">SELECT</a> -->
                        <?php //}else{ ?>
                             <!-- <a href="#" class="awe-btn hvr-rectangle-out select_flight">SELECT</a>  -->
                            <?php //} ?>
                        </div>
                    </div>
                <?php 
                    } 
                    $i++;
                }
                ?>
            </div>
        </div>
        <?php  
        $this->load->view('filters',array("search_info"=>$search_info,"range_slide_min"=>$range_slide_min,"range_slide_max"=>$range_slide_max));?>
    </div>
</section>
<?php
}else{  
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
                    <?php /*echo '<pre>';*/
                    //print_r($airlineIfo);exit;
                    //echo '<pre>';

                    if(isset($airlineIfo->schedule->depart)){
                   // for($i=0; $i<count($airlineIfo->schedule->depart); $i++) {
                    foreach ($airlineIfo->schedule->depart as $key => $onewayvalue) {
                     
                     ?>
                    <div class="filter-item-wrapper">
                        <!-- ITEM -->
                        <div class="flight-item box-effect">
                            <div class="item-media">
                                <div class="image-cover">
                                    <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $onewayvalue->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $onewayvalue->airline_name))] !=''):?>
                                    <img id="airline-image-cust" style="width:80% !important;" alt="<?php echo $onewayvalue->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $onewayvalue->airline_name))];?>" >
                                    <?php else:?>
                                    <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="item-body">
                                <div class="item-title">
                                    <h2>
                                   <!--  <a href="#<?php echo $i."-name-".$onewayvalue->airline_name;?>"><?php echo $onewayvalue->airline_name; ?></a> -->
                                   <a href="#<?php echo "-name-".$onewayvalue->airline_name;?>"><?php echo $onewayvalue->airline_name; ?></a>
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
                                                    <li><?php echo $onewayvalue->from; ?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                    <li><?php echo $onewayvalue->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                </ul>
                                            </td>
                                             <!-- <td>
                                           
                                                    
                                                </td> -->
                                            <td class="depart">
                                                <span><?php echo $onewayvalue->etd; ?></span>
                                                <span class="date"><?php $date=$onewayvalue->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                            </td>


                                            <td class="arrive">
                                                <span><?php echo $onewayvalue->eta; ?></span>
                                                <span class="date"></span>
                                            </td>
                                            <td class="duration">
                                                <span><?php 
                                                echo getTimeDiff($onewayvalue->etd , $onewayvalue->eta);
                                                ?> </span>
                                            </td>
                                        </tr>

                                        <?php $connectingUrl = '';?>
                                        <?php //echo '<pre>'; print_r($onewayvalue);
                                        if($onewayvalue->type == 'connecting'){ $k=2;?>
                                        <?php foreach ($onewayvalue->connecting_flight as $key => $value){ //echo '<pre>';  print_r($value);  
                                        $amp = ($k>2)?'&':'';                                      
                                        foreach ($value->class as $key => $connectVal) {
                                         //sk $connectingUrl .= $amp.'flightno_'.$k.'='.$value->fno.'&class_id_'.$k.'='.$onewayvalue->class[0]->class_id;
                                             // print_r($value->etd);
                                          ?>
                                           <tr>
                                            <td class="route">
                                            <ul>
                                            <li><?php echo $value->from;?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                            <li><?php echo $value->to;?> <i class="awe-icon awe-icon-arrow-right"></i></li>                      
                                            </ul>
                                            </td> 
                                           <!--  <td>

                                            </td>     -->          
                                            <td class="depart">
                                            <span><?php echo $value->etd; ?></span>

                                            </td>
                                             
                                            <td class="arrive">
                                            <span><?php echo $value->eta; ?></span>
                                            <span class="date"><?php $date=$value->date; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                            </td>
                                            <td class="duration">
                                            <span><?php 
                                            echo getTimeDiff($value->etd , $value->eta);
                                            ?> </span>
                                            </td>  
                                           
                                            <!-- <td class="flight_class">
                                            <?php //echo $value->class[0]->class_name; ?>
                                            </td>  -->   
                                           
                                            </tr>

                                     <?php   } 
                                        ?>
                                    
                                        <?php $k++; } ?>
                                        <?php }; ?>
                                    </tbody>

                                </table>

                               <table class="item-table">
                                    <thead>
                                    <tr>                    
                                    <!-- <th class="duration">Class ID</th> -->
                                    <th class="depart">Class</th>
                                    <th class="depart">Class Name</th>
                                    <!-- <th class="arrive">Seat</th> -->
                                    <th class="duration">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $connectingUrl = '';?>
                                    <?php 
                                    if(isset($onewayvalue->class) && count($onewayvalue->class)>0){ $k=2;
                                    foreach ($onewayvalue->class as $key =>  $classarr){ 
                                    $amp = ($k>2)?'&':'';
                                    //echo '<pre>'; print_r($classarr); ?>
                                    <tr> 
                                    <!-- <input type="hidden" name="per_person_no"  id="per_person_no" value="<?php echo $key; ?>"> -->
                                   <!--  <td class="route sub_class_<?php //echo $value->train_no;?>_<?php //echo $key ?>">    
                                    <?php //echo (isset($classarr->class_id)?$classarr->class_id: 'N/A'); ?></td> -->

                                    <td class="depart"><?php echo (isset($classarr->class)?$classarr->class: 'N/A'); ?></td>

                                    <td><?php echo ($classarr->class_name)?$classarr->class_name:'N/A'; ?></td>

                                   <!--  <td class="arrive"> <?php //echo (isset($classarr->seat)?$classarr->seat: 'N/A'); ?></td> -->

                                    <td class="arrive price_<?php //echo $value->train_no; ?>_<?php //echo $key ?>"> 
                                    <?php echo (isset($classarr->price)?$classarr->price: 'N/A'); ?>

                                    </td>                           
                                    <td>
                                    <div class="">
                                    <!--   <div class="price">
                                    <span class="amount">RP <?php echo number_format($depart[0]["class"][0]["price"]);?><?php //echo $curr[$depart[$i]["connecting_flight"]["class"][0]["ccy"]]."".number_format($depart[$i]["class"][0]["price"]);?></span>
                                    </div> -->  

                                    <?php 
                                    $connectingUrl .= $amp.'flightno_'.$k.'='.$onewayvalue->fno.'&class_id_'.$k.'='.$classarr->class_id;
                                    ?>                             
                                    <a class="awe-btn hvr-rectangle-out" href="<?php echo site_url().'flight-details/'.$session_id.'/'.$onewayvalue->fno.'/'.$classarr->class_id.'?'.$connectingUrl;?>" >View details</a>
                                    </div>
                                    </td>

                                    <!-- <td class="duration"><a href="#selected-results" class="awe-btn scroll select-train" data-train_id="<?php echo $value->train_no;?>" data-per_person_no="<?php echo $key; ?>">Select</a></td> -->
                                    </tr>
                                    <?php } 
                                    } ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="item-price-more">
                                <div class="price">
                                    <span class="amount"><?php //sk echo $curr[$onewayvalue->class[0]->ccy]."".number_format($onewayvalue->class[0]->price);?></span>
                                </div>
                                <?php //echo '<pre>'; print_r($onewayvalue->class[0]->seat);exit; ?>                             

                               <!--sk  <a class="awe-btn hvr-rectangle-out" href="<?php //echo site_url().'flight-details/'.$session_id.'/'.$onewayvalue->fno.'/'.$onewayvalue->class[0]->class_id.'?'.$connectingUrl;?>" >View details</a> -->
                              
                                <!-- <a class="awe-btn hvr-rectangle-out" href="<?php //echo site_url().'flight-details/'.$session_id.'/'.$onewayvalue->fno.'/'.$onewayvalue->class[0]->class_id.'?'.$connectingUrl;?>" >View details</a> -->

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

