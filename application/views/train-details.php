<!-- PRELOADER -->
<div class="preloader"></div>
<!-- BREADCRUMB -->
<section class="train-details">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url('train'); ?>">Train</a></li>
                <li><span>Train Detail</span></li>
            </ul>
        </div>
    </div>
</section>
<!-- BREADCRUMB -->
<section class="product-detail selected-flight-dets">
    <div class="container">
	<div class="col-md-12"><?php $this->load->view('message');?></div>
        <div class="row">
         <?php //echo '<pre>'; print_r($train_details->detail_info);exit;
        if(isset($train_details->error_msg) && $train_details->error_msg!= ''){ ?>
            <div class="col-md-6 col-sm-6 flight-booking-details">
                <p><b><?php echo $train_details->error_msg; ?></b></p>
           </div>
       <?php }else if(isset($train_details->detail_info->depart->train_name)){
            //foreach ($train_details as $key => $value) {
            //  echo '<pre>'; print_r($value);
           // }exit;
        ?>

              <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Depature</h3>                    
                     <div class="final-flight-ammount">Rp - <?php echo isset($train_details->detail_info->depart->price->total)?number_format($train_details->detail_info->depart->price->total):'N/A'; ?></div>
                </div>
               
                <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic">                        
                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/train.png'; ?>" alt="">                     
                        </div>                        
                        <div class="flight-name">
                            <p class="fl-name"><?php echo (isset($train_details->detail_info->depart->train_name))?$train_details->detail_info->depart->train_name:'';?> - <?php echo (isset($train_details->detail_info->depart->train_no))?$train_details->detail_info->depart->train_no: 'N/A'; ?>  : <?php echo (isset($train_details->detail_info->depart->from) && $train_details->detail_info->depart->from!='')?$train_details->detail_info->depart->from:'';?> - <?php echo (isset($train_details->detail_info->depart->to) && $train_details->detail_info->depart->to!='')?$train_details->detail_info->depart->to:'';?>
                                
                            </p>

                            <p class="fl-economy"><?php echo (isset($train_details->detail_info->depart->class))? $train_details->detail_info->depart->class: 'N/A' ?></p>                            
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head">Depature<br>
                    <?php echo (isset($train_details->detail_info->depart->ETD)?$train_details->detail_info->depart->ETD: 'N/A'); ?><br>
                    <?php 
                        $departdated=(isset($train_details->detail_info->depart->DD) && $train_details->detail_info->depart->DD!='')? date('D',strtotime($train_details->detail_info->depart->DD)):'';

                        $departdaten=(isset($train_details->detail_info->depart->DD) && $train_details->detail_info->depart->DD!='')? date('d M Y',strtotime($train_details->detail_info->depart->DD)):''; 
                       echo $departdated." ".$departdaten ;
                    ?>
                    </span>
                    <span><?php echo (isset($train_details->detail_info->depart->from) && $train_details->detail_info->depart->from!='')?$train_details->detail_info->depart->from:'';?></span></p>
                    <p class="flight-check-out"><span class="head">Arrivel<br>
                    <?php echo (isset($train_details->detail_info->depart->ETA)?$train_details->detail_info->depart->ETA: 'N/A'); ?><br>
                    <?php 
                        $departdated=(isset($train_details->detail_info->depart->AD) && $train_details->detail_info->depart->AD!='')? date('D',strtotime($train_details->detail_info->depart->AD)):'';

                        $departdaten=(isset($train_details->detail_info->depart->AD) && $train_details->detail_info->depart->AD!='')? date('d M Y',strtotime($train_details->detail_info->depart->AD)):''; 
                       echo $departdated." ".$departdaten ;
                    ?>
                    </span><span><?php echo (isset($train_details->detail_info->depart->to) && $train_details->detail_info->depart->to!='')?$train_details->detail_info->depart->to:'';?></span></p>
                    <p> <span class="head">
                    Duration  
                    <?php
                    if(isset($train_details->detail_info->depart->ETD)){
                      $departDatetime = $train_details->detail_info->depart->ETD;
                    }else{
                       $departDatetime = '00:00'; 
                    }
                    if(isset($train_details->detail_info->depart->ETA)){
                        $departArriveTime = $train_details->detail_info->depart->ETA;
                    }else{
                         $departArriveTime = '00:00';
                    }                    
                     echo $duration = getTimeDiff($departDatetime,$departArriveTime); 
                     ?>
                    </span></p>
                   <!--  <p><span class="head"> Per Person Price : Adult: <?php echo
                    isset($train_details->detail_info->depart->price->adult->price)?$train_details->detail_info->depart->price->adult->price: 'N/A'; ?></p> -->
                </div>

            
               <!--  <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic">
                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/train.png'; ?>" alt="">   
                        </div>
                        <div class="flight-name">
                            <p class="fl-name">Indiana</p>
                            <p class="fl-economy">ecomany</p>
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head">Depature<br>
                    12 pm</span><span>1.00PM</span></p>
                    <p class="flight-check-out"><span class="head">Arrivel</span>
                    <span>2 pm</span></p>
                    
                </div> --> 
            </div>
        </div>
        <?php } ?>           
        <?php if(isset($train_details->detail_info->return) && $train_details->detail_info->return->train_name !=''){
      // echo '<pre>'; print_r($train_details->detail_info->return); 
            ?>
        <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Return</h3>                    
                     <div class="final-flight-ammount"> Rp <?php  echo (isset($train_details->detail_info->return->price->total)?number_format ($train_details->detail_info->return->price->total): '0'); ?></div>
                </div>               
                <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic">                        
                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/train.png'; ?>" alt="">                     
                        </div>
                        <div class="flight-name">
                            <p class="fl-name"><?php echo isset($train_details->detail_info->return->train_name)?$train_details->detail_info->return->train_name:'N/A'; ?> - <?php echo (isset($train_details->detail_info->return->train_no))?$train_details->detail_info->return->train_no: 'N/A';?> : <?php echo (isset($train_details->detail_info->return->from) && $train_details->detail_info->return->from!='')?$train_details->detail_info->return->from:'';?> - <?php echo (isset($train_details->detail_info->return->to) && $train_details->detail_info->return->to!='')?$train_details->detail_info->return->to:'';?>
                                
                            </p>
                            <p class="fl-economy"><?php echo (isset($train_details->detail_info->return->class))? $train_details->detail_info->return->class: 'N/A' ?></p>
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head">Depature<br>
                     <?php echo (isset($train_details->detail_info->return->ETD)?$train_details->detail_info->return->ETD: 'N/A'); ?><br>
                    <?php 
                        $returndated=(isset($train_details->detail_info->return->DD) && $train_details->detail_info->return->DD!='')? date('D',strtotime($train_details->detail_info->return->DD)):'';

                        $returndaten=(isset($train_details->detail_info->return->DD) && $train_details->detail_info->depart->DD!='')? date('d M Y',strtotime($train_details->detail_info->return->DD)):''; 
                       echo $returndated." ".$returndaten ;
                    ?>
                    </span><span><?php echo (isset($train_details->detail_info->depart->from) && $train_details->detail_info->return->from!='')?$train_details->detail_info->return->from:'';?></span> </p>
                    <p class="flight-check-out"><span class="head">Arrivel <br>
                    <?php echo (isset($train_details->detail_info->return->ETA)?$train_details->detail_info->return->ETA: 'N/A'); ?><br>
                    <?php 
                        $returndatedArr=(isset($train_details->detail_info->return->AD) && $train_details->detail_info->return->AD!='')? date('D',strtotime($train_details->detail_info->return->AD)):'';

                        $returndatenArr=(isset($train_details->detail_info->return->AD) && $train_details->detail_info->return->AD!='')? date('d M Y',strtotime($train_details->detail_info->return->AD)):''; 
                       echo $returndatedArr." ".$returndatenArr ;
                    ?></span><span><?php echo (isset($train_details->detail_info->return->to) && $train_details->detail_info->return->to!='')?$train_details->detail_info->return->to:'';?></span></p>


                    <p> <span class="head">
                    Duration  
                    <?php
                    if(isset($train_details->detail_info->return->ETD)){
                      $returnDatetime = $train_details->detail_info->return->ETD;
                    }else{
                       $returnDatetime = '00:00'; 
                    }
                    if(isset($train_details->detail_info->return->ETA)){
                        $returnArriveTime = $train_details->detail_info->return->ETA;
                    }else{
                         $returnArriveTime = '00:00';
                    }                    
                     echo $duration = getTimeDiff($returnDatetime,$returnArriveTime); 
                     ?>
                    </span></p>
                    
                </div>            
                <!-- <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic">
                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/train.png'; ?>" alt="">   
                        </div>
                        <div class="flight-name">
                            <p class="fl-name">Indiana</p>
                            <p class="fl-economy">ecomany</p>
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head">Depature<br>
                    12 pm</span><span>1.00PM</span></p>
                    <p class="flight-check-out"><span class="head">Arrivel</span>
                    <span>2 pm</span></p>                   
                </div>  -->
            </div>
        </div>
        <?php } ?>

        <div class="col-md-12 col-sm-12 passengers-details-sec">
            <div class="passengers-details-content">
                <h3>Customer Details</h3>
                
                <form class="passengers-details" action="<?php echo site_url('booking/train_book');?>" method="POST" id="train-passen-user-form" name="passen_user_form">
                <div class="cust-info">
                <?php //echo '<pre>'; print_r($this->session->userdata());exit; ?>
                        <div class="form-item col-md-3 col-sm-3">
                            <label>Customer Name</label>
                            <?php if($this->session->userdata(USER_SESSION.'user_type') == 'USER'){ ?>
                            <input type="text" name="guest_name" id="guest-name" placeholder="Customer Name" value="<?php echo ($this->session->userdata(USER_SESSION.'name')?$this->session->userdata(USER_SESSION.'name') : '') ?>">
                            <?php }else{ ?>
                                <input type="text" name="guest_name" id="guest-name" placeholder="Customer Name" value="">
                               <?php } ?>

                            <div class="add-form-error-msg" id="error_guest_name"><?php echo form_error('guest_name'); ?></div>
                        </div>
                        <?php //echo '<pre>'; print_r($countries_data);exit; ?>
                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Phone</label>
                            <div id="country_flag" class='iti-flag '></div>
                            <span id="country_sortName" class=""></span> 
                            <?php if($this->session->userdata(USER_SESSION.'user_type') == 'USER'){ ?>
                            <select name="countriesCode" id="countriesSelects">
                                <option value="">Country Code</option>   
                               <?php if(isset($countries_data)){ 
                                   foreach($countries_data as $contryVal){?>
                                   <option id="<?php echo $contryVal->sortname ?>"  value="<?php echo $contryVal->country_code; ?>" <?php echo ($this->session->userdata(USER_SESSION.'country_code') == $contryVal->country_code)?'selected': ''; ?> id="">
                                       <?php echo $contryVal->country_code; ?>
                                   </option> 
                                   <?php } } ?>
                            </select>
                            <?php }else{?> 
                            <select name="countriesCode" id="countriesSelects">
                                <option value="">Country Code</option>   
                               <?php if(isset($countries_data)){ 
                                   foreach($countries_data as $contryVal){?>
                                   <option id="<?php echo $contryVal->sortname ?>"  value="<?php echo $contryVal->country_code; ?>"  id="">
                                       <?php echo $contryVal->country_code; ?>
                                   </option> 
                                   <?php } } ?>
                            </select>
                            <?php } ?>

                            <?php if($this->session->userdata(USER_SESSION.'user_type') == 'USER' && $this->session->userdata(USER_SESSION.'contact_no') != ''){ ?>
                            <input type="text" name="guest_phone" id="guest-phone" placeholder="Customer Number" value="<?php echo $this->session->userdata(USER_SESSION.'contact_no'); ?>">
                            <?php }else{ ?>
                            <input type="text" name="guest_phone" id="guest-phone" placeholder="Customer Number" value="">
                            <?php } ?>
                           <div id="error_guest_phone"></div>
                        </div>

                        <div class="form-item col-md-3 col-sm-3">
                            <label>Customer Email</label>
                            <?php if($this->session->userdata(USER_SESSION.'user_type') == 'USER' && $this->session->userdata(USER_SESSION.'emailid') != ''){ ?>
                            <input type="text" name="guest_email" id="guest-email" placeholder="Email" value="<?php echo $this->session->userdata(USER_SESSION.'emailid');?>" readonly>
                            <?php }else{ ?>
                            <input type="text" name="guest_email" id="guest-email" placeholder="Email" value="">
                            <?php } ?>
                            <div id="error_guest_email"></div>
                             
                        </div>
                    </div>
                    
                    <h3>Passenger Details</h3>
                    <div class="col-md-12 col-sm-12 table-responsive details-sec">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="w-80">Title</th>
                            <th class="w-150">Passenger Type</th>
                            <th class="w-150">First Name</th>
                            <th class="w-150">Last Name</th>
                             <th class="w-150">Phone</th>
                            <th class="w-150">ID Number</th>
                            <!-- <th class="w-150">Passport Number</th> -->
                            <th class="w-150">Gender</th>
                            <!-- <th class="w-150">Berth Preference</th> -->
                            <th class="w-150">Date of Birth</th>
                            <!-- <th class="w-150">Option for Senior Citizen Concession</th> -->
                            <th class="w-150">Nationality</th>
                            <!-- <th class="w-150">ID Card Type</th> -->
                            <th class="w-150">Passport No</th>
                            <th class="w-150">Passport Expire On</th>              
                            <th class="w-80">Baggage</th>
                          </tr>
                        </thead>
                        <tbody>
                        

                             <?php 
                   // echo '<pre>'; print_r($train_details->search_info);
                        if(isset($train_details->error_msg) && $train_details->error_msg != ''){
                        echo '<p><b>'.$train_details->error_msg.'</b></p>';
                        }else{
                            $totalpasenger = $train_details->search_info->adult + $train_details->search_info->child + $train_details->search_info->infant;  
                        //echo '<pre>'; print_r($totalpasenger);exit;
                        for($i=0;$i<$totalpasenger;$i++){ ?>

                                <tr>
                                    <td class="w-80">
                                        <select name="name_type[]" id="name-type" class="select-sec">
                                            <option value="mr">Mr.</option>
                                            <option value="mrs">Mrs.</option>
                                            <option value="ms">Ms.</option>
                                        </select>
                                    </td>
                                    <td class="w-80">
                                        <select name="person_type[]" id="person-type" class="select-sec">
                                            <option value="adult">adult</option>
                                            <option value="child">child</option>
                                            <option value="infant">infant</option>
                                        </select>
                                    </td>
                                    <td class="w-150">
                                    <input type="text" name="first_name[]" id="first-name-<?php echo $i ?>" data-id="<?php echo $i ?>" data-name="first_name" placeholder="First Name" class="fname-cls first_name">
                                    <div class="add-form-error-msg" id="error_first_name_<?php echo $i ?>"></div>
                                   
                                    </td>
                                    <td class="w-150">
                                     <input type="text" name="last_name[]" id="last-name-<?php echo $i ?>" data-id="<?php echo $i ?>" data-name="last_name" placeholder="Last Name" class="fname-cls last_name">
                                    <div class="add-form-error-msg" id="error_last_name_<?php echo $i ?>"></div>
                                    
                                    </td>
                                    
                                    <td class="w-150">
                                     <input type="text" name="id_card[]" id="phone-<?php echo $i ?>" data-id="<?php echo $i ?>" data-name="id_card" placeholder="Phone" class="fname-cls last_name">
                                    <div class="add-form-error-msg" id="error_phone_<?php echo $i ?>"></div>
                                    
                                    </td>
                                    
                                    <td class="w-150">
                                    <input type="text" name="id_number[]" id="id-number-<?php echo $i ?>" data-id="<?php echo $i ?>" data-name="id_number"  placeholder="ID Number" class="fname-cls id_number">
                                    <div class="add-form-error-msg" id="error_id_number_<?php echo $i ?>"></div>
                                    
                                    </td>
                                    <!-- <td class="w-80">
                                    <input type="text" placeholder="Passport No">
                                    
                                    </td> -->                                         
                                    <td class="w-80">
                                     <select  id="gender-<?php echo $i ?>"  name="gender[]" class="fname-cls select-sec" data-name="gender" data-id="<?php echo $i ?>">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>  
                                    <div></div>                                  
                                    </td>

                                  <!--   <td class="w-150">
                                        <select id="berth-preference-<?php echo $i ?>" name="berth_preference[]" class="fname-cls select-sec" data-name="berth_preference" data-id="<?php echo $i ?>">
                                            <option value="">Berth Preference</option>
                                            <option value="LB">Lower</option>
                                            <option value="MB">Middle</option>
                                            <option value="UB">Upper</option>
                                            <option value="SL">Side Lower</option>
                                            <option value="SU">Side Upper</option>
                                        </select>
                                    </td> -->

                                    <td class="date-of-birth w-150">
                                        <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                        <input type="text" name="date_of_birth[]" class="birth_date_pick fname-cls date_of_birth" data-id="<?php echo $i ?>" data-name="date_of_birth" id="date-of-birth-<?php echo $i ?>" placeholder="Date of Birth" readonly>
                                        <div class="add-form-error-msg" id="error_date_of_birth_<?php echo $i ?>"></div>
                                    </td>

                                    <!-- <td class="w-150">
                                         <select id="senior-citizen-<?php echo $i ?>" name="senior_citizen[]" class="select-sec">                                            <option value="">select</option>
                                            <option value="1">Avail Concession</option>
                                            <option value="2">Forgo 50% Concession</option>
                                            <option value="3">Forgo Full Concession</option>     
                                        </select>
                                    </td>                                
                                     -->

                                    <td class="nationality w-150">

                                    <select name=country_name[] id="country-passport-<?php echo $i ?>" class="fname-cls country_name" data-id="<?php echo $i ?>" data-name="country_name" style="max-width: 143px !important;">
                                         <option value="Indonesia" selected>Indonesia</option> 
                                        <?php foreach($countries_data as $values){?>
                                        <option value="<?php echo $values->country_name; ?>"><?php echo ucfirst($values->country_name); ?>        
                                                </option>
                                       <?php } ?>

                                    </select>
                                    <!-- <select class="select-sec">
                                        <option>Indian</option>
                                        <option>Indian</option>
                                        <option>Indian</option>
                                    </select> -->
                                        
                                    </td>

                                   <!--  <td class="w-150">                         
                                         <select id="id-card-type-<?php echo $i ?>" name="id_card_type[]" class=" select-sec" data-name="id_card_type" data-id="<?php echo $i ?>">
                                            <option value="">select</option>
                                            <option value="passport">Passport/Travel document</option> 
                                        </select>
                                    </td> -->

                                    <td class="w-150">
                                         <input type="text" name="id_card_no[]" id="id-card-no-<?php echo $i ?>" data-id="<?php echo $i ?>" data-name="id_card_no"  placeholder="Passport no" class="fname-cls id_card_no">
                                         <div class="add-form-error-msg" id="error_id_card_no_<?php echo $i ?>"></div>
                                    </td>

                                    <td class="expiry-date w-150">
                                        <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                        <input type="text" name="pass_expire_date[]" class="prv_date_pick fname-cls pass_expire_date" data-id="<?php echo $i ?>" data-name="pass_expire_date"  id="pass-expire-date-<?php echo $i ?>" placeholder="Passport Expire On" readonly>
                                         <div class="add-form-error-msg" id="error_pass_expire_date_<?php echo $i ?>"></div>
                                    </td>
                                   
                                   
                                    <td class="buggage w-80">
                                        <select name="buggage_count[]" id="buggage_count" class="fname-cls select-sec">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </td>                            
                                </tr>
                            <?php }
                            } ?>
                        </tbody>
                      </table>
                    </div>
                   
                   <div class="form-item sub-btn">
                      <div class="col-md-6 total-price-sec"><p class="total_price">Total Price : 
                      <?php

                      if(isset($train_details->detail_info->depart->price->total) && $train_details->detail_info->depart->price->total != '' &&  isset($train_details->detail_info->return->price->total) && $train_details->detail_info->return->price->total != ''){
                      
                         $retprice = (($train_details->detail_info->depart->price->total)+($train_details->detail_info->return->price->total));
                     echo 'Rp - ';
                     echo  number_format($retprice);
                     
                      }else if(isset($train_details->detail_info->return->price->total)){ 
                        echo 'Rp - ';
                         echo   (isset($train_details->detail_info->return->price->total)?number_format ($train_details->detail_info->return->price->total): '0'); 
                      }else{
                        echo 'Rp - ';
                        echo  ($train_details->detail_info->depart->price->total)? number_format($train_details->detail_info->depart->price->total): '0';
                      }
                   
                    ?>

                        <?php                       
                     // if(isset($dchildPrice) && isset($dadultPrice) && isset($rchildPrice) && isset($radultPrice)){
                       //  echo $curr.number_format($dchildPrice+$dadultPrice+$rchildPrice+$radultPrice);
                     // }  ?>
                      <span>
                                              
                      </span></div>
                      <?php //echo '<pre>'; print_r($train_details); ?>
                    <input type="hidden" id="total-amount" name="total_amount" value="<?php echo
                    isset($train_details->detail_info->depart->price->total)? number_format($train_details->detail_info->depart->price->total): '0'; ?>">
                      <input type="hidden" id="currency-code" name="currency_code" value="$">  
                    <?php if(isset($train_details->detail_info->depart)){ ?>
                            <input type="hidden" id="train-name" name="train_name" value="<?php echo isset($train_details->detail_info->depart->train_name)?$train_details->detail_info->depart->train_name: '';?>">
                    <?php }
                       else if(isset($train_details->detail_info->return)){ ?>
                            <input type="hidden" id="train-name-return" name="train_name_return" value="<?php echo isset($train_details->detail_info->return->train_name)?$train_details->detail_info->return->train_name: '';?>">
                       <?php } ?>
                     
                    <?php if(isset($train_details->detail_info->depart)){ ?>
                        <input type="hidden" name="train_class" id="train_class"
                      value="<?php echo isset($train_details->detail_info->depart->class)?$train_details->detail_info->depart->class: '';?>">
                     <?php } else if(isset($train_details->detail_info->return)){  ?>   
                     <input type="hidden" name="return_train_class" id="retrun_train_class"
                      value="<?php echo isset($train_details->detail_info->return->class)?$train_details->detail_info->return->class: '';?>">
                   <?php } ?>

                     <?php if($this->session->userdata(USER_SESSION.'is_logged_in')  == true){?>
                      <input type="hidden" name="user_type" value="<?php echo $this->session->userdata(USER_SESSION.'user_type')?>">
                      <?php }else{ ?>
                       <input type="hidden" name="user_type" value="GUEST">
                       <?php } ?>

                       <?php $arrget = json_encode($inputArray); ?>
                      <input type="hidden" id="get-data-dtl" name="get_data_dtl" value='<?php echo $arrget; ?>' />

                    
                      <?php if($this->session->userdata(USER_SESSION.'is_logged_in')  == true){?>                      
                      <div class="col-md-6"><button type="submit" name="trainpay" id="trainpay" value="Trainpay">Book Now</button></div>
                      <?php }else{ ?>
                        <div class="col-md-6">
                           <button type="submit" name="guest_login" id="guest_login" value="guest">Continue as Guest</button>
                           OR
                           <a class="sub-btn button" href="<?php echo site_url(); ?>user-login" name="login" id="login" value="login">Login & Continue</a>
                       </div>
                       <?php } ?>
                      
                                              
                     
                    </div>
                </form>
            </div>
        </div>
       
    </div>  
</div>
</section>
             
<script type="text/javascript">
     // following code set country flags using css
    var countryShortName = '';
    if($('#countriesSelects').val() != ''){
        var shortNames = $('#countriesSelects').find('option:selected').attr('id');  
       // alert(shortNames);
        var shortName = shortNames; //$("#country_sortName").attr('class');   
        countryShortName = shortName.toLowerCase();
        $("#country_flag").addClass(countryShortName);
    }

    $("#countriesSelects").change(function() {
        $("#country_flag").removeClass(countryShortName);
        if($('#countriesSelects').val() != ''){     
            var shortNames = $('#countriesSelects').find('option:selected').attr('id');            
            var countryShortNames = shortNames.toLowerCase();
            $("#country_flag").addClass(countryShortNames); 
        }
    });
    // following code set country flags using css end
</script> 
