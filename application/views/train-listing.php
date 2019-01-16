        <!-- PRELOADER -->
        <div class="preloader"></div>
        <!-- END / PRELOADER -->


       <?php //echo '<pre>'; print_r($searchinfo); ?>
       <!-- HEADING PAGE -->
        <section class="awe-parallax category-heading-section-demo">
            <div class="bred-sec">
                <div class="container">
                <!-- BREADCRUMB -->
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>
                            <li><span>Train</span></li>
                        </ul>
                    </div>
                <!-- BREADCRUMB -->
                </div>
            </div>

            <div class="awe-overlay"></div>
            <div class="container train-listing-container">
                <div class="category-heading-content category-heading-content__2 text-uppercase">
                <div class="find">
                  <h2 class="text-center">Find Your Train</h2>
                </div>
                    <!-- BREADCRUMB -->
                <!--<div class="breadcrumb">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>
                            <li><span>Train</span></li>
                        </ul>
                    </div> -->
                    <!-- BREADCRUMB -->
                   <!-- <div class="find">
                        <h2 class="text-center">Find Your Train</h2>
                        <form action="" method="post" id="list-train-search" name="list_train_search">
                            <div class="form-group">
                                <div class="form-elements">
                                    <label>From</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-marker-1"></i>
                                        <input type="text" name="train_from" id="train_from_id" placeholder="City" value="<?php echo (isset($search_info['from_i']) && $search_info['from_i']!='')?$search_info['from_i']:''?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>To</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-marker-1"></i>
                                        <input type="text" placeholder="City" name="train_to" id="flight_to_id" value="<?php echo (isset($search_info['to_i']) && $search_info['to_i']!='')?$search_info['to_i']:''?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>Depart on</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-calendar"></i>
                                        <input type="text" name="train_depart" id="train_depart_id" class="awe-calendar" value="<?php echo (isset($search_info['depart']) && $search_info['depart']!='')?date('d-m-Y',strtotime($search_info['depart'])):''?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>Return on</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-calendar"></i>
                                        <input type="text" name="train_return" id="train_return_id" class="awe-calendar" value="<?php echo (isset($search_info['return']) && $search_info['return']!='')?date('d-m-Y',strtotime($search_info['return'])):''?>">
                                    </div>
                                </div>
                                <input type="hidden" name="filter_train_adult" value="<?php echo (isset($search_info['adult']) && $search_info['adult']!='')?date('d-m-Y',strtotime($search_info['adult'])):''?>">
                                <div class="form-actions">
                                    <input type="submit" name="applayfilter" id="applayfilter_id" value="Search Train">
                                </div>
                            </div>
                        </form>
                    </div>-->
                </div>
            </div>
        </section>
        <!-- END / HEADING PAGE -->
        <?php 
        if(isset($searchinfo->schedule->return) && count($searchinfo->schedule->return)>0){ ?>

            <section class="return-flight-details-sec return-train-details-sec">
                <div class="container">
                    <!-- page content -->
                    <div class="col-md-9 col-md-push-3 return-details-sec">
                        <div class="selected-results col-md-12 col-sm-12 rest-click" id="selected-results" style="display:none;">
                         <div class="col-md-6 col-sm-6 oneway-flight" id="depature-selected" style="display:none">
                            <p class="flight-head">Selected Departure Train</p>
                            <div class="Name"><h3 class="flight-name" id="depature-flt-name">Lufthansa : Hanoi - NYC</h3></div>
                            <div class="Depart"><p class="dept"><b>Depart :</b> <span class="dept-time" id="depature-flt-date"> 10:25 14 Feb</span></p></div>
                            <div class="person">
                                <p><b>No-of Adult :</b> <span id="no-of-adults"></span> <b>Per Adult Price :</b><span id="per-adult-price"></span></p>
                                <p class="child_title"><b>No-of Child :</b> <span id="no-of-child"></span>
                                <b> Per Child Price :</b><span id="per-child-price"></span>
                                </p>
                                <p class="infant_title"><b>No-of Infant :</b> <span id="no-of-infant"></span>
                                <b> Per Infant Price :</b><span id="per-infant-price"></span>
                                </p>
                            </div>
                            <div class="Price"><p class="flight-time"><b>Price :</b> <span class="flight-time" id="depature-flt-price"> $5,923</span></p></div>
                            <a href="#line" class="awe-btn select-train scroll onewaychange">CHANGE</a>    
                        </div>
                        <div class="col-md-6 col-sm-6 return-flight" id="return-selected" style="display:none">
                            <p class="flight-head">Selected Return Train</p>
                            <div class="Name"><h3 class="flight-name" id="return-flt-name">Lufthansa : Hanoi - NYC</h3></div>
                            <div class="Depart"><p class="dept"><b>Depart :</b> <span class="dept-time" id="return-flt-date"> 10:25 14 Feb</span></p></div>
                             <div class="person">
                                <p><b>No-of Adult :</b> <span id="re-no-of-adults"></span> <b>Per Adult Price :</b><span id="re-per-adult-price"></span></p>
                                <p class="child_title"><b>No-of Child :</b> <span id="re-no-of-child"></span>
                                <b> Per Child Price :</b><span id="re-per-child-price"></span>
                                </p>
                                <p class="infant_title"><b>No-of Infant :</b> <span id="re-no-of-infant"></span>
                                <b> Per Infant Price :</b><span id="re-per-infant-price"></span>
                                </p>
                            </div>

                            <div class="Price"><p class="flight-time"><b>Price :</b> <span class="flight-time" id="return-flt-price"> $5,923</span></p></div><a href="#line" class="awe-btn select-train scroll returnchange hvr-rectangle-out">CHANGE</a>        
                        </div>
                        <div class="col-md-12 col-sm-12 final-details">
                            <div class="finalprice"><p class="total-price"><b>Total Price :</b> <span class="train-totl-price"> $5,923</span></p>
                                <a href="javascript:void(0);" class="awe-btn select-train hvr-rectangle-out" id="proceed-btn">PROCEED</a>
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

                 <!-- following section use for train type "retun" selected depart train and retrun train list start smita -->
                <div class="oneway">
                    <div class="return-page-head Departute"><h1>Choose departure Train</h1></div>   
                     <?php 
                     //echo '<pre>'; print_r($searchinfo->search_info);
                        if(isset($searchinfo->schedule->depart) && $searchinfo->schedule->depart != ''){
                             foreach ($searchinfo->schedule->depart as $value) {
                             //print_r($value); 
                         ?>
                        <div class="flight-item">
                        <div class="item-media">
                            <div class="image-cover">
                                <img src="<?php echo base_url(); ?>assets/images/flight/2.jpg" alt="" style="height: 100%; width: auto;">
                            </div>
                        </div>                                           
                        <div class="item-body">
                            <div class="item-title">                          
                                <h2> <a href="#" class="trains_name_<?php echo $value->train_no; ?>"><?php echo (isset($value->train_name)?$value->train_name: 'N/A').'-'. (isset($value->train_no)?$value->train_no: 'N/A') ?></a>
                                 <input type="hidden" id="train_no" value="<?php echo $value->train_no;?>" />
                                 </h2>
                              </div>
                              <table class="item-table train-det">
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
                                                <li> <?php echo (isset($value->from)?$value->from: 'N/A') ?>
                                                    <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                    <li>  <?php echo (isset($value->to)?$value->to: 'N/A') ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                </ul>
                                                <ul>
                                                    <li> <?php echo (isset($value->from_st_name)?$value->from_st_name: 'N/A') ?>
                                                        <i class="awe-icon awe-icon-arrow-right"></i>
                                                        <in
                                                        </li>
                                                        <li> <?php echo (isset($value->to_st_name)?$value->to_st_name: 'N/A') ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                    </ul>
                                                </td>
                                                <td class="depart">
                                                    <span class="trains_dept_time_<?php echo $value->train_no; ?>"><?php echo (isset($value->ETD)?$value->ETD: 'N/A') ?></span>
                                                    <span class="date trains_dept_date_<?php echo $value->train_no; ?>"><?php  $date=$value->DD; echo date('d M', strtotime(str_replace('','', $date)));?>
                                                        
                                                    </span>
                                                </td>
                                                <td class="arrive">
                                                    <span><?php echo (isset($value->ETA)?$value->ETA: 'N/A') ?></span>
                                                    <span class="date"><?php  $date=$value->AD; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                </td>
                                                <td class="duration">
                                                   <span><?php 
                                                 echo getTimeDiff($value->ETD , $value->ETA);
                                                ?></span>
                                               </td>
                                           </tr>
                                       </tbody>
                                   </table>  

                                   <div class="train-pricing table-responsive">
                                    <table class="item-table">
                                        <thead>
                                            <tr>
                                                <th class="route">Sub-Class</th>
                                                <th class="depart">Class</th>
                                                <th class="arrive">Seat</th>
                                                <th class="duration">Adult Price</th>
                                                <th class="duration">Child Price</th>
                                                <th class="duration">Infant Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                            if(isset($value->Availability) && count($value->Availability)>0){
                                            foreach ($value->Availability as $key =>  $vals){  ?>
                                           <tr> 
                                           <input type="hidden" name="per_person_no"  id="per_person_no" value="<?php echo $key; ?>">
                                            <td class="route sub_class_<?php echo $value->train_no;?>_<?php echo $key ?>">    
                                            <?php echo (isset($vals->sub_class)?$vals->sub_class: 'N/A'); ?></td>
                                            
                                            <td class="depart"><?php echo (isset($vals->class)?$vals->class: 'N/A'); ?></td>
                                            <td class="arrive"> <?php echo (isset($vals->seat)?$vals->seat: 'N/A'); ?></td>
                                            <td class="arrive adult_price_<?php echo $value->train_no; ?>_<?php echo $key ?>"> <?php echo (isset($vals->adult_price)?$vals->adult_price: 'N/A'); ?>
                                                <input type="hidden" name="adult_no" class="adult_no_<?php echo $value->train_no; ?>" value="<?php echo isset($searchinfo->search_info->adult)?$searchinfo->search_info->adult: '0'; ?>">
                                            </td>
                                            <td class="duration child_price_<?php echo $value->train_no; ?>_<?php echo $key; ?>"><?php echo (isset($vals->child_price)?$vals->child_price: 'N/A'); ?>
                                                <input type="hidden" name="child_no" class="child_no_<?php echo $value->train_no; ?>" value="<?php echo isset($searchinfo->search_info->child)?$searchinfo->search_info->child: '0'; ?>">  
                                            </td>
                                            <td class="duration infant_price_<?php echo $value->train_no; ?>_<?php echo $key; ?>">
                                            <?php echo (isset($vals->infant_price)?$vals->infant_price: 'N/A'); ?>
                                                <input type="hidden" name="infant_no" class="infant_no_<?php echo $value->train_no; ?>" value="<?php echo (isset($searchinfo->search_info->infant)?$searchinfo->search_info->infant: '0');?>">
                                            </td>
                                            
                                            <td class="duration"><a href="#selected-results" class="awe-btn scroll select-train" data-train_id="<?php echo $value->train_no;?>" data-per_person_no="<?php echo $key; ?>">Select</a></td>
                                        </tr>
                                         <?php } 
                                            } ?>
                                     <!--    <tr>
                                            <td class="route">B</td>
                                            <td class="depart"> Bisnis</td>
                                            <td class="arrive"> 56</td>
                                            <td class="arrive"> 100000</td>
                                            <td class="duration">0</td>
                                            <td class="duration">100000</td>
                                            
                                            <td class="duration"><a href="#selected-results" class="awe-btn">Select</a></td>
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                        
                    </div>
                    <?php } } ?>
                </div>

                <div class="return less-width">
                    <div class="return-page-head Arrival"><h1>Choose return Train</h1></div>
                    <?php 
                      //echo '<pre>'; //print_r($searchinfo->schedule->return);exit;
                        if(isset($searchinfo->schedule->return) && $searchinfo->schedule->return != ''){
                             foreach ($searchinfo->schedule->return as $valReturn) {
                            // print_r($valReturn);                             
                         ?>
                    <div class="flight-item">
                        <div class="item-media">
                            <div class="image-cover">
                                <img src="<?php echo base_url(); ?>assets/images/flight/2.jpg" alt="" style="height: 100%; width: auto;">
                            </div>
                        </div>
                        <div class="item-body">
                            <div class="item-title">
                                <h2><a href="#" class="retrun_trains_name_<?php echo $valReturn->train_no; ?>">
                                <?php echo (isset($valReturn->train_name)?$valReturn->train_name:'N/A').'-'.(isset($valReturn->train_no)?$valReturn->train_no:'N/A') ?></a></h2>
                                 <input type="hidden" id="retrun_train_id" value="<?php echo $valReturn->train_no;?>" />
                              </div>
                              <table class="item-table train-det">
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
                                                <li> <?php echo (isset($valReturn->from)?$valReturn->from:'N/A')?> 
                                                    <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                    <li>  <?php echo (isset($valReturn->to)?$valReturn->to:'N/A')?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                </ul>
                                                <ul>
                                                    <li> <?php echo (isset($valReturn->from_st_name)?$valReturn->from_st_name:'N/A')?> 
                                                        <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                        <li>  <?php echo (isset($valReturn->to_st_name)?$valReturn->to_st_name:'N/A')?>  <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                    </ul>
                                                </td>
                                                <td class="depart">
                                                     <span class="trains_retun_time_<?php echo $valReturn->train_no; ?>"><?php echo (isset($valReturn->ETD)?$valReturn->ETD:'N/A')?></span>
                                                    <span class="date trains_retrun_date_<?php echo $valReturn->train_no; ?>"><?php  $date=$valReturn->DD; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                </td>
                                                <td class="arrive">
                                                    <span><?php echo (isset($valReturn->ETA)?$valReturn->ETA:'N/A')?></span>
                                                    <span class="date"><?php  $date=$valReturn->AD; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                </td>
                                                <td class="duration">
                                                   <span><?php 
                                                 echo getTimeDiff($valReturn->ETD , $valReturn->ETA); ?> </span>
                                               </td>
                                           </tr>                                           
                                       </tbody>
                                   </table>                                   
                                   <div class="train-pricing table-responsive">
                                    <table class="item-table">
                                        <thead>
                                            <tr>
                                                <th class="route">Sub-Class</th>
                                                <th class="depart">Class</th>
                                                <th class="arrive">Seat</th>
                                                <th class="duration">Adult Price</th>
                                                <th class="duration">Child Price</th>
                                                <th class="duration">Infant Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(isset($valReturn->Availability) && count($valReturn->Availability)>0){
                                            foreach ($valReturn->Availability as $key => $valsRe){
                                                ?>
                                           <tr>
                                            <input type="hidden" name="per_person_no"  id="per_person_no" value="<?php echo $key; ?>">
                                            <td class="route re_sub_class_<?php echo $valReturn->train_no;?>_<?php echo $key ?>"><?php echo (isset($valsRe->sub_class)? $valsRe->sub_class: 'N/A') ?></td>
                                            <td class="depart"> <?php echo (isset($valsRe->class)? $valsRe->class: 'N/A') ?></td>
                                            <td class="arrive"> <?php echo (isset($valsRe->seat)? $valsRe->seat: 'N/A') ?></td>
                                            <td class="arrive re_adult_price_<?php echo $valReturn->train_no; ?>_<?php echo $key ?>"> <?php echo (isset($valsRe->adult_price)? $valsRe->adult_price: 'N/A') ?>
                                              <input type="hidden" name="re_adult_no" class="re_adult_no_<?php echo $valReturn->train_no; ?>" value="<?php echo isset($searchinfo->search_info->adult)?$searchinfo->search_info->adult: '0'; ?>">  

                                            </td>

                                            <td class="duration re_child_price_<?php echo $valReturn->train_no; ?>_<?php echo $key ?>"><?php echo (isset($valsRe->child_price)? $valsRe->child_price: 'N/A') ?>
                                              <input type="hidden" name="re_child_no" class="re_child_no_<?php echo $valReturn->train_no; ?>" value="<?php echo isset($searchinfo->search_info->child)?$searchinfo->search_info->child: '0'; ?>">

                                            </td>

                                            <td class="duration re_infant_price_<?php echo $valReturn->train_no; ?>_<?php echo $key ?>"><?php echo (isset($valsRe->infant_price)? $valsRe->infant_price: 'N/A') ?>
                                            
                                            <input type="hidden" name="re_infant_no" class="re_infant_no_<?php echo $valReturn->train_no; ?>" value="<?php echo (isset($searchinfo->search_info->infant)?$searchinfo->search_info->infant: '0');?>">
                                            </td>
                                            
                                            <td class="duration"><a href="#selected-results" class="awe-btn scroll select-train" data-retrun_train_id="<?php echo $valReturn->train_no;?>" data-per_person_no="<?php echo $key; ?>">Select</a></td>
                                        </tr>
                                        <?php } } ?>
                                       <!--  <tr>
                                            <td class="route">B</td>
                                            <td class="depart"> Bisnis</td>
                                            <td class="arrive"> 56</td>
                                            <td class="arrive"> 100000</td>
                                            <td class="duration">0</td>
                                            <td class="duration">100000</td>
                                            
                                            <td class="duration"><a href="#selected-results" class="awe-btn">Select</a></td>
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
        <?php $this->load->view('trainfilters',array("trainfilters"=>$search_info,"range_slide"=>$range_slide));?>
        <!-- following section use for retun select train type depart train and retrun train show end smita -->
            </section>
        <?php }else{?>

            <section class="filter-page train-listing-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-top">
                            <ul class="list-link">
                                <li><a href="<?php echo site_url('flight');?>">Flight</a></li>
                                <li><a href="<?php echo site_url('hotel');?>">Hotel</a></li>
                                <li class="current"><a href="<?php echo site_url('train');?>">Train</a></li>
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

                    <!-- following section use for oneway select train type depart train show start smita -->
                    <div class="col-md-9 col-md-push-3">
                        <div class="filter-page__content">
                            <div class="filter-item-wrapper">
                            <?php //echo '<pre>'; print_r($searchinfo->schedule->depart->Availability);
                            if(isset($searchinfo->schedule->depart) && count($searchinfo->schedule->depart)>0):?>
                                <?php foreach($searchinfo->schedule->depart as $key => $schedule):?>
                                    <div class="flight-item">
                                        <div class="item-media">
                                            <div class="image-cover">
                                                <img src="<?php echo site_url().ASSETS_IMAGES?>/flight/2.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="item-body">
                                            <div class="item-title">
                                                <h2>
                                                  <?php  echo (isset($schedule->train_name) && $schedule->train_name!='')?$schedule->train_name:''; ?>
                                                </h2>
                                               
                                            </div>
                                            <table class="item-table train-det">
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
                                                                <li> <?php echo (isset($schedule->from) && $schedule->from!='')? $schedule->from:'' ; ?> 
                                                                <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  <?php echo $schedule->to; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> <?php echo (isset($schedule->from_st_name) && $schedule->from_st_name!='')? $schedule->from_st_name:''; ?> 
                                                                <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  <?php echo $schedule->to_st_name; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span><?php echo (isset($schedule->ETD) && $schedule->ETD!='')?$schedule->ETD:''; ?></span>
                                                            <span class="date"><?php $ddate=(isset($schedule->DD) && $schedule->DD!='')?$schedule->DD:''; 
                                                            echo date('d M', strtotime(str_replace('','', $ddate)));?></span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span><?php echo (isset($schedule->ETA) && $schedule->ETA!='')? $schedule->ETA:''; ?></span>
                                                             <span class="date"><?php $adate=$schedule->AD;
                                                            echo date('d M', strtotime(str_replace('','',  $adate))); ?></span>
                                                        </td>
                                                        <td class="duration">
                                                         <?php $etd=(isset($schedule->ETD) && $schedule->ETD!='')?$schedule->ETD:'';
                                                           $eta=(isset($schedule->ETA) && $schedule->ETA!='')? $schedule->ETA:'';?>
                                                            <span><?php echo getTimeDiff($etd,$eta) ?></span>
                                                        </td>
                                                    </tr>                                           
                                                </tbody>
                                            </table>                                   
                            <div class="train-pricing">
                                <table class="item-table">
                                    <thead>
                                        <tr>
                                            <th class="route">Sub-Class</th>
                                            <th class="depart">Class</th>
                                            <th class="arrive">Seat</th>
                                            <th class="duration">Adult Price</th>
                                            <th class="duration">Child Price</th>
                                            <th class="duration">Infant Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                $subStr = '';
                                $z=1;
                                if(count($schedule->Availability)):?>
                                    <?php foreach($schedule->Availability as $key=>$avlResc):?>
                                         <tr>
                                            <td class="route"><?php echo $avlResc->sub_class;?></td>
                                            <td class="depart"> <?php echo $avlResc->class;?></td>
                                            <td class="arrive"> <?php echo $avlResc->seat;?></td>
                                            <td class="arrive"> <?php echo $avlResc->adult_price;?></td>
                                            <td class="duration"><?php echo $avlResc->child_price;?></td>
                                            <td class="duration"><?php echo $avlResc->infant_price;?></td>
                                            <?php
                                                $subStrNew = 'sub_class_1='.$avlResc->sub_class.'&train_name_1='.$schedule->train_name;
                                                
                                            ?>
                                            <?php if($avlResc->seat > '0' && $avlResc->seat != '-'){ ?>
                                            <td class="duration">
                                               <a href="<?php echo site_url().'train-details/'.$session_id.'/'.$schedule->train_no.'?'.$subStrNew;?>" class="awe-btn">View Details</a>
                                            </td>
                                            <?php }else{ ?>
                                             <td class="duration">
                                                 <a href="#" class="awe-btn view_details">View Details</a> 
                                             </td>
                                               <?php } ?>

                                        </tr>
                                        <?php
                                            $subStr .= 'sub_class_'.$z.'='.$avlResc->sub_class.'&train_name_'.$z.'='.$schedule->train_name;
                                            $subStr .= '&';
                                            $z++;
                                        ?>
                                    <?php endforeach;?>
                                <?php endif;?>                                                                                                  
                                    </tbody>
                                </table>
                            </div>  
                                        </div>
                                       <!--<div class="item-price-more">
                                            <div class="price">
                                                <span class="amount"><?php echo $curr;?>5,923</span>
                                            </div>
                                            <?php $train_no=(isset($schedule->train_no) && $schedule->train_no!='')? $schedule->train_no:'';
                                            $sub_class=(isset($schedule->Availability->sub_class) && $schedule->Availability->sub_class!='')? $schedule->Availability->sub_class:'';
                                             ?>
                                            <a href="<?php echo site_url().'train-details/'.$session_id.'/'.$train_no.'?'.$subStr;?>" class="awe-btn">View Details</a>
                                        </div> -->                                     
                                                                              
                                    </div>
                                    <!-- END / ITEM -->
                             
                                <?php endforeach;?>
                            <?php endif;?>
                             </div>
                        </div>
                    </div>  
                    <!-- following section use for oneway select train type depart train show start smita -->                
                    <?php $this->load->view('trainfilters',array("trainfilters"=>$search_info,"range_slide"=>$range_slide));?>
                </div>
            </div>
        </section>
    <?php  } ?>    

<script type="text/javascript">

$(".view_details").click(function(){
alert('Seats are not available. Please change date.');
});
    
$( "#mybookings" ).click(function() {
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



var sessionId = '<?php echo $session_id;?>';
var fhand = '<?php echo (isset($range_slide_min) && $range_slide_min!='')?$range_slide_min:10000?>';
var shand='<?php echo (isset($range_slide_max) && $range_slide_max!='')?$range_slide_max:100000000?>';


var pushArr = [];
var flight_oncePrice = '';
var flight_twoPrice = '';
var sumvalue = '';
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

    $(".oneway .select-train").click(function(){        
        $(".oneway").addClass('less-width');
        $(".return").addClass('full-width');
        $(".return").removeClass('less-width'); 
        $(".responsive-section ul li a").toggleClass('active-sec'); 
        
        var currentParent = $(this).parent();
        var currentItem = $(this).parent().parent();
        
        var trainNo = $(this).data('train_id');
        var per_person_no = $(this).data('per_person_no');
            
        $("#depature-flt-name").html($('.trains_name_'+trainNo).text());
        $('#depature-flt-date').html($('.trains_dept_time_'+trainNo).text() + ' '+ $('.trains_dept_date_'+trainNo).text());

        var adult_price_per_person = $('.adult_price_'+trainNo+'_'+per_person_no).text();
        var child_price_per_person =  $('.child_price_'+trainNo+'_'+per_person_no).text();
        var infant_price_per_person = $('.infant_price_'+trainNo+'_'+per_person_no).text();

        var no_of_adults = $('.adult_no_'+trainNo).val();
        var no_of_child = $('.child_no_'+trainNo).val();
        var no_of_infant = $('.infant_no_'+trainNo).val();
        $('.child_title').hide();
        $('.infant_title').hide();
        var total_adult_price = (adult_price_per_person * no_of_adults);
        var total_child_price = (child_price_per_person * no_of_child);
        var total_infant_price = (infant_price_per_person * no_of_infant);
        
        $("#no-of-adults").html(no_of_adults);
        if(no_of_child >0){
            $("#no-of-child").html(no_of_child);
            $('#per-child-price').html(addCommas('Rp'+child_price_per_person)); 
            $('.child_title').show();
        }
        if(no_of_infant >0){
            $("#no-of-infant").html(no_of_infant);
            $('#per-infant-price').html(addCommas('Rp'+infant_price_per_person));
            $('.infant_title').show();
        }  
        $('#per-adult-price').html(addCommas('Rp'+adult_price_per_person));
         sumvalue =  (total_adult_price + total_child_price + total_infant_price);
        
        $("#depature-flt-price").html(addCommas('Rp'+sumvalue));
        var totalDepartTrainRp = (sumvalue + sumvalue);
        console.log(totalDepartTrainRp);
        //$(".train-totl-price").html(addCommas('Rp'+totalDepartTrainRp));
        //$("#depature-flt-price").html('Rp'+currentParent.find(".price .only-ammount").text());
       // $(".train-totl-price").html('Rp'+currentParent.find(".price .only-ammount").text());
       //$("#depature-flt-name").html(currentItem.find(".item-title a").text());
        //$("#depature-flt-date").html(currentItem.find(".depart .time").text()+ " "+currentItem.find(".depart .date").text() );

      //sk this values add in following pushArr session_id = LuKFB1sWZkMKtelp3tkiqnGN9QeKeclKqb36AsdDypU, train_id = 10501 , sub_class_1=C ,rain_name_1 = ARGO%20PARAHYANGAN%20PREMIUM

    //alert($('.sub_class_'+trainNo+'_'+per_person_no).text());
        pushArr[0] = trainNo;       
        pushArr[1] = $('.sub_class_'+trainNo+'_'+per_person_no).text().trim();

        var trainNameOnly = $('.trains_name_'+trainNo).text();
        var arr = trainNameOnly.split('-');        
        pushArr[2] = arr[0];
        
       // pushArr[1] = currentItem.find("#rain_name_1").val();
       // flight_oncePrice = parseInt(currentParent.find(".price .only-ammount").text().replace(/,/g,''));
       // flight_twoPrice = parseInt(currentParent.find(".price .only-ammount").text().replace(/,/g,''));
        
        finalPrice = addCommas(sumvalue);
        $(".train-totl-price").html('Rp'+finalPrice);
        $("#depature-selected").fadeIn(1000);
        $("#selected-results").fadeIn(1000);
    }); 

    $(".return .select-train").click(function(){
       
        var currentParent = $(this).parent();
        var currentItem = $(this).parent().parent();
        
        $(".oneway").addClass('full-width');
        $(".oneway").removeClass('less-width');
        $(".return").removeClass('full-width');
        $(".return").addClass('less-width'); 

        var retrunTrainNo =$(this).data('retrun_train_id');
        var retrun_perPerson_No = $(this).data('per_person_no');
       
        $("#return-flt-name").html($('.retrun_trains_name_'+retrunTrainNo).text());

        $('#return-flt-date').html($('.trains_retun_time_'+retrunTrainNo).text() + ' '+ $('.trains_retrun_date_'+retrunTrainNo).text());



        var re_adult_price_per_person = $('.re_adult_price_'+retrunTrainNo+'_'+retrun_perPerson_No).text();

        var re_child_price_per_person =  $('.re_child_price_'+retrunTrainNo+'_'+retrun_perPerson_No).text();

        var re_infant_price_per_person = $('.re_infant_price_'+retrunTrainNo+'_'+retrun_perPerson_No).text();       

        var re_no_of_adults = $('.re_adult_no_'+retrunTrainNo).val();
        var re_no_of_child = $('.re_child_no_'+retrunTrainNo).val();
        var re_no_of_infant = $('.re_infant_no_'+retrunTrainNo).val();      
        $('.child_title').hide();
        $('.infant_title').hide();
        var re_total_adult_price = (re_adult_price_per_person * re_no_of_adults);
        var re_total_child_price = (re_child_price_per_person * re_no_of_child);
        var re_total_infant_price = (re_infant_price_per_person * re_no_of_infant);

        $("#re-no-of-adults").html(re_no_of_adults);
        if(re_no_of_child >0){
            $("#re-no-of-child").html(re_no_of_child);
            $('#re-per-child-price').html(addCommas('Rp'+re_child_price_per_person)); 
            $('.child_title').show();
        }
        if(re_no_of_infant >0){
            $("#re-no-of-infant").html(re_no_of_infant);
            $('#re-per-infant-price').html(addCommas('Rp'+re_infant_price_per_person));
            $('.infant_title').show();
        } 

        $('#re-per-adult-price').html(addCommas('Rp'+re_adult_price_per_person));
        var return_sumvalue =  (re_total_adult_price + re_total_child_price + re_total_infant_price);

        $("#return-flt-price").html(addCommas('Rp'+return_sumvalue));
        //$("#return-flt-name").html(currentItem.find(".item-title").text());
        //$("#return-flt-date").html(currentItem.find(".depart .time").text()+ " "+currentItem.find(".depart .date").text() );
       // $("#return-flt-price").html('Rp'+currentParent.find(".price .only-ammount").text());

        pushArr[3] = $('.re_sub_class_'+retrunTrainNo+'_'+retrun_perPerson_No).text().trim();   

        var retrainNameOnly = $('.retrun_trains_name_'+retrunTrainNo).text().trim();
        var Retarr = retrainNameOnly.split('-');     
        pushArr[4] = Retarr[0];       
        pushArr[5] = retrunTrainNo;
       // pushArr[3] = currentItem.find("#flno_id").val();
        //pushArr[4] = currentItem.find("#flno_classid").val();
        flight_twoPrice = parseInt(currentParent.find(".price .only-ammount").text().replace(/,/g,''));
        if(flight_oncePrice==''){

        }
        console.log('deptsumvalue=='+sumvalue);
        console.log('return_sumvalue=='+return_sumvalue);

        //following if condition use  for if user select depart train and retrun train are diff. then exceute if condition and else only user select retrun train. sk 22-1-2018
        if(sumvalue != ''){
         finalPrice = addCommas(sumvalue + return_sumvalue);
         $(".train-totl-price").html('Rp'+finalPrice);   
        }else{
         finalPrice = addCommas(return_sumvalue);
         $(".train-totl-price").html('Rp'+finalPrice);    
        }
        

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
        if(pushArr.length == 6){          
     
      url = site_url+'train-details/'+sessionId+'/'+pushArr[0]+'?sub_class_1='+pushArr[1]+'&train_name_1='+pushArr[2]+'&train_no_2='+pushArr[5]+'&sub_class_2='+pushArr[3]+'&train_name_2='+pushArr[4];       
            window.location.href = url;
        }/*else if(){

             url = site_url+'train-details/'+sessionId+'/'+pushArr[0]+'?sub_class_1='+pushArr[1]+'&train_name_1='+pushArr[2]+'&sub_class_2='+pushArr[1]+'&train_name_2='+pushArr[2];        
           window.location.href = url;
        }*/else{ 
          
           url = site_url+'train-details/'+sessionId+'/'+pushArr[0]+'?sub_class_1='+pushArr[1]+'&train_name_1='+pushArr[2]+'&sub_class_2='+pushArr[3]+'&train_name_2='+pushArr[4];        
           window.location.href = url;
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

</script>

