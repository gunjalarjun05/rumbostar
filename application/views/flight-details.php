<!-- PRELOADER -->
<div class="preloader"></div>
<section class="product-detail selected-flight-dets">
        <div class="container">
		<div class="col-md-12"><?php $this->load->view('message');?></div>
        <div class="row">
        <?php //echo '<pre>'; print_r($this->session->userdata());
        if(isset($flight_details->error_msg) && $flight_details->error_msg!= ''){ ?>
            <div class="col-md-6 col-sm-6 flight-booking-details">
                <p><b><?php echo $flight_details->error_msg; ?></b></p>
           </div>
       <?php }else{ ?> 
            <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Depart</h3>
                    <?php 
                       $dchildPrice = (isset($flight_details->depart_detail->price->child->total_idr) && $flight_details->depart_detail->price->child->total_idr !=0)?$flight_details->depart_detail->price->child->total_idr:0;
                       $dadultPrice = (isset($flight_details->depart_detail->price->adult->total_idr) && $flight_details->depart_detail->price->adult->total_idr !=0)?$flight_details->depart_detail->price->adult->total_idr:0;
                       $dinfantPrice = (isset($flight_details->depart_detail->price->infant->total_idr) && $flight_details->depart_detail->price->infant->total_idr !=0)?$flight_details->depart_detail->price->infant->total_idr:0;
                    ?>
                     <div class="final-flight-ammount"><?php echo $curr.number_format(($dadultPrice+$dchildPrice+$dinfantPrice));?></div>
                </div>
                <?php   //echo '<pre>'; print_r($flight_details->depart_detail->airline_name);  ?>
                <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic">
                        <?php 
                    if(isset($flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))] !=''):?>
                            <img style="width:80% !important;" alt="<?php echo $flight_details->depart_detail->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))];?>" >
                    <?php else:?>
                        <?php  //echo 'welcome'; ?>
                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                         <?php endif;?> 
                        </div>
                        <div class="flight-name">
                            <p class="fl-name"><?php echo (isset($flight_details->depart_detail->airline_name) && $flight_details->depart_detail->airline_name!='')? $flight_details->depart_detail->airline_name:'';?> : <?php echo (isset($flight_details->search_info->from) && $flight_details->search_info->from!='')?$flight_details->search_info->from:'';?> - <?php echo (isset($flight_details->search_info->to) && $flight_details->search_info->to!='') ? $flight_details->search_info->to:'';?></p>
                            <p class="fl-economy"><?php echo (isset($flight_details->depart_detail->class_name) && $flight_details->depart_detail->class_name!='')?$flight_details->depart_detail->class_name:''; ?></p>                            
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head"><?php echo $flight_details->depart_detail->etd;?><br>
                    <?php
                        $departdated=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('D',strtotime($flight_details->depart_detail->date)):'';
                        $departdaten=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('d M Y',strtotime($flight_details->depart_detail->date)):''; 
                       echo $departdated." ".$departdaten ;
                    ?></span><span><?php echo (isset($flight_details->depart_detail->from) && $flight_details->depart_detail->from!='')? $flight_details->depart_detail->from:''; ?></span></p>
                    <p class="flight-check-out"><span class="head"><?php echo $flight_details->depart_detail->eta;?><br><?php $arrivalDate = get_arrival_date($flight_details->depart_detail->date,$flight_details->depart_detail->etd,$flight_details->depart_detail->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $flight_details->depart_detail->to;?></span></p>
                    <p> <span>
                    Duration : 
                        <?php echo $duration = getTimeDiff($flight_details->depart_detail->etd,$flight_details->depart_detail->eta); ?>
                    </span></p>
                </div>
               
                <?php if($flight_details->depart_detail->type == 'connecting'):?>
                    <?php foreach($flight_details->depart_detail->connecting_flight as $key=>$values):?>

                        <div class="booking-flight-det col-md-12 col-sm-12">
                            <div class="content">
                                <div class="flight-pic">
                                <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $values->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $values->airline_name))] !=''):?>
                                        <img style="width:80% !important;" alt="<?php echo $values->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $values->airline_name))];?>" >
                                <?php else:?>
                                        <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                        <?php endif;?>
                                </div>
                                <div class="flight-name">
                                    <p class="fl-name"><?php echo $values->airline_name;?></p>
                                    <p class="fl-economy"><?php echo $values->class_name;?></p>
                                </div>
                            </div>
                        </div>

                         <div class="booking-flight-info col-md-12 col-sm-12">
                            <p class="flight-check-in"><span class="head"><?php echo $values->etd;?><br><?php echo date('D',strtotime($values->date))." ". date('d M Y',strtotime($values->date));?></span><span><?php echo $values->from;?></span></p>
                            <p class="flight-check-out"><span class="head"><?php echo $values->eta;?><br><?php $arrivalDate = get_arrival_date($values->date,$values->etd,$values->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $values->to;?></span></p>
                            <p> <span>
                            Duration : 
                                <?php echo $duration = getTimeDiff($values->etd,$values->eta); ?>
                            </span></p>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <?php } ?>


        <?php  
            $rchildPrice = 0;
            $radultPrice = 0;
            $rinfantPrice= 0;
        ?>
        <?php if(isset($flight_details->return_detail) && $flight_details->return_detail!=''):?>
         <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Return</h3>
                    <?php  
                        $rchildPrice = (isset($flight_details->return_detail->price->child->total_idr) && $flight_details->return_detail->price->child->total_idr !=0)?$flight_details->return_detail->price->child->total_idr:0;
                        $radultPrice = (isset($flight_details->return_detail->price->adult->total_idr) && $flight_details->return_detail->price->adult->total_idr !=0)?$flight_details->return_detail->price->adult->total_idr:0;
                        $rinfantPrice = (isset($flight_details->return_detail->price->infant->total_idr) && $flight_details->return_detail->price->infant->total_idr !=0)?$flight_details->return_detail->price->infant->total_idr:0;
                    ?>
                     <div class="final-flight-ammount"><?php echo $curr.number_format($radultPrice+$rchildPrice+$rinfantPrice);?></div>
                </div>
                <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic">
                            <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $flight_details->return_detail->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $flight_details->return_detail->airline_name))] !=''):?>
                                <img style="width:80% !important;" alt="<?php echo $flight_details->return_detail->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $flight_details->return_detail->airline_name))];?>" >
                            <?php else:?>
                                <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                            <?php endif;?>
                         </div>
                        <div class="flight-name">
                            <p class="fl-name"><?php echo (isset($flight_details->return_detail->airline_name) && $flight_details->return_detail->airline_name!='')? $flight_details->return_detail->airline_name:'';?> : <?php echo (isset($flight_details->search_info->to) && $flight_details->search_info->to!='')?$flight_details->search_info->to:'';?> - <?php echo (isset($flight_details->search_info->from) && $flight_details->search_info->from!='') ? $flight_details->search_info->from:'';?></p>
                            <p class="fl-economy"><?php echo (isset($flight_details->return_detail->class_name) && $flight_details->return_detail->class_name!='')?$flight_details->return_detail->class_name:''; ?></p>


                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head">
                    <?php echo $flight_details->return_detail->etd;?><br>
                    <?php
                        $departdated=(isset($flight_details->return_detail->date) && $flight_details->return_detail->date!='')? date('D',strtotime($flight_details->return_detail->date)):'';
                            $departdaten=(isset($flight_details->return_detail->date) && $flight_details->return_detail->date!='')? date('d M Y',strtotime($flight_details->return_detail->date)):''; 
                            echo $departdated." ".$departdaten ;
                            ?></span><span><?php echo (isset($flight_details->return_detail->from) && $flight_details->return_detail->from!='')? $flight_details->return_detail->from:''; ?></span></p>
                    <p class="flight-check-out"><span class="head"><?php echo $flight_details->return_detail->eta;?><br><?php $arrivalDate = get_arrival_date($flight_details->return_detail->date,$flight_details->return_detail->etd,$flight_details->return_detail->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $flight_details->return_detail->to;?></span></p>
                    <p> <span>
                    Duration : 
                    <?php echo $duration = getTimeDiff($flight_details->return_detail->etd,$flight_details->return_detail->eta); ?>
                    </span></p>
                    
                </div>
               
                <?php if($flight_details->return_detail->type == 'connecting'):?>
                    <?php foreach($flight_details->return_detail->connecting_flight as $key=>$values):?>

                        <div class="booking-flight-det col-md-12 col-sm-12">
                            <div class="content">
                                <div class="flight-pic">
                                    <?php if(isset($flightImages[strtolower(str_replace(" ", "_", $values->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $values->airline_name))] !=''):?>
                                        <img style="width:80% !important;" alt="<?php echo $values->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $values->airline_name))];?>" >
                                    <?php else:?>
                                        <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                        <?php endif;?> 
                                </div>
                                <div class="flight-name">
                                    <p class="fl-name"><?php echo $values->airline_name;?></p>
                                    <p class="fl-economy"><?php echo $values->class_name;?></p>
                                </div>
                            </div>
                        </div>

                         <div class="booking-flight-info col-md-12 col-sm-12">
                            <p class="flight-check-in"><span class="head"><?php echo $values->etd;?><br><?php echo date('D',strtotime($values->date))." ". date('d M Y',strtotime($values->date));?></span><span><?php echo $values->from;?></span></p>
                            <p class="flight-check-out"><span class="head"><?php echo $values->eta;?><br><?php $arrivalDate = get_arrival_date($values->date,$values->etd,$values->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $values->to;?></span></p>
                            <p> <span>
                            Duration : 
                            <?php echo $duration = getTimeDiff($values->etd,$values->eta); ?>
                            </span></p>
                            
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    <?php endif; ?>

        <?php
         if(isset( $flight_details->session_id) && $flight_details->session_id !=''){ ?>
        <div class="col-md-12 col-sm-12 passengers-details-sec">

            <div class="passengers-details-content">
                <h3>Customer Details</h3>
                <?php //echo '<pre>'; print_r($this->session->userdata()) ?>
                <form class="passengers-details" action="<?php echo site_url('booking/add_book');?>" method="POST" id="passen-user-form" name="passen_user_form">
                <?php //print_r(form_error());exit; ?>
                <div class="cust-info">
                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Name</label>
                            <input type="text" name="guest_name" id="guest-name" placeholder="Customer Name" value="<?php echo ($this->session->userdata(USER_SESSION.'name')?$this->session->userdata(USER_SESSION.'name') : '') ?>">
                            <div class="add-form-error-msg" id="error_guest_name"><?php echo form_error('guest_name'); ?></div>
                        </div>

                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Phone</label>
                            <div id="country_flag" class='iti-flag '></div>
                            <span id="country_sortName" class=""></span> 
                            <select name="countriesCode" id="countriesSelects">
                                <option value="">Country Code</option>
                                <?php if(isset($countries_data)){ 
                                   foreach($countries_data as $contryVal){?>
                                   <option id="<?php echo $contryVal->sortname ?>" value="<?php echo $contryVal->country_code; ?>"><?php echo $contryVal->country_code; ?></option>
                                <?php } }?>
                            </select>
                            <input type="text" name="guest_phone" id="guest-phone" placeholder="Customer Number" value="<?php echo ($this->session->userdata(USER_SESSION.'contact_no' )?$this->session->userdata(USER_SESSION.'contact_no') : '') ?>">
                            <div class="add-form-error-msg" id="error_guest_phone"><?php echo form_error('guest_phone');?></div>
                        </div>

                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Email</label>
                            <input type="text" name="guest_email" id="guest-email" placeholder="Email" value="<?php echo ($this->session->userdata(USER_SESSION.'emailid')?$this->session->userdata(USER_SESSION.'emailid') : '') ?>">
                             <div class="add-form-error-msg" id="error_guest_email"></div>
                        </div>

                        <?php                         
                        if($this->session->userdata(USER_SESSION.'is_logged_in') == '1'){ ?>
                          <div class="form-item col-md-4 col-sm-4 coupone_code" style="display: none">
                            <label>Coupon Code</label>
                            <input type="text" name="coupone_code" id="coupone_code" placeholder="Coupon Code" value="">
                             <!-- <div class="add-form-error-msg" id="error_guest_email"> -->
                             </div>
                        </div>
                        <?php }
                        ?>
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
                            <th class="w-150">ID Number</th>
                            <th class="w-150">Gender</th>
                            <th class="w-150">Passport Number</th>
                            <th class="w-150">Country Passport </th>
                            <th class="w-150">Passport Expire On</th>
                            <th class="w-150">Date of Birth</th>
                            <!-- <th class="w-80">Baggage</th> sk - client req.remove Baggage -->
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if(isset($flight_details->error_msg) && $flight_details->error_msg != ''){
                        echo '<p><b>'.$flight_details->error_msg.'</b></p>';
                        }else{

                            $totalpasenger = $flight_details->search_info->adult + $flight_details->search_info->child + $flight_details->search_info->infant;  
                       
                        for($i=0;$i<$totalpasenger;$i++){
                            ?>
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
                                    <input type="text" name="id_number[]" id="id-number-<?php echo $i ?>" data-id="<?php echo $i ?>" data-name="id_number"  placeholder="ID Number" class="fname-cls id_number">
                                    <div class="add-form-error-msg" id="error_id_number_<?php echo $i ?>"></div>
                                    </td>
                                     <td class="w-80">
                                     <select  id="gender-<?php echo $i ?>"  name="gender[]" class="fname-cls select-sec" data-name="gender" data-id="<?php echo $i ?>">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>  
                                    <div></div>                                  
                                    </td>
                                    <td class="w-150">
                                    <input type="text" name="passport_number[]" id="passport-number-<?php echo $i ?>" placeholder="Passport Number" data-id="<?php echo $i ?>" data-name="passport_number" class="passport-cls fname-cls">
                                    <div class="add-form-error-msg" id="error_passport_number_<?php echo $i ?>"></div>
                                    </td>
                                    <td class="nationality w-150">
                                    <select name=country_passport[] id="country-passport-<?php echo $i ?>" class="fname-cls country_passport" data-id="<?php echo $i ?>" data-name="country_passport" style="max-width: 143px !important;">
                                        <option value="">Select Country</option>
                                        <?php foreach($countries_data as $values){?>
                                                <option value="<?php echo $values->country_name; ?>"><?php echo ucfirst($values->country_name); ?>        
                                                </option>
                                       <?php } ?>

                                    </select>
                                    <!-- <input type="text" name="country_passport[]" id="country-passport-<?php echo $i ?>" placeholder="Country Passport" class="fname-cls"> -->
                                    <div class="add-form-error-msg" id="error_country_passport_<?php echo $i ?>"></div>
                                    </td>
                                    <td class="expiry-date w-150">
                                        <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                        <input type="text" name="pass_expire_date[]" class="prv_date_pick fname-cls pass_expire_date" data-id="<?php echo $i ?>" data-name="pass_expire_date"  id="pass-expire-date-<?php echo $i ?>" placeholder="Passport Expire On" readonly>
                                         <div class="add-form-error-msg" id="error_pass_expire_date_<?php echo $i ?>"></div>
                                    </td>
                                   <td class="date-of-birth w-150">
                                        <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                        <input type="text" name="date_of_birth[]" class="birth_date_pick fname-cls date_of_birth" data-id="<?php echo $i ?>" data-name="date_of_birth" id="date-of-birth-<?php echo $i ?>" placeholder="Date of Birth" readonly>
                                        <div class="add-form-error-msg" id="error_date_of_birth_<?php echo $i ?>"></div>
                                    </td>
                                   <!--  <td class="buggage w-80">
                                        <select name="buggage_count[]" id="buggage_count" class="select-sec">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </td> sk - client req.  remove Baggage-->                            
                                </tr>
                            <?php
                        } }
                        ?>
                        </tbody>
                      </table>
                    </div>
                   
                   <div class="form-item sub-btn">
                      <div class="col-md-6 total-price-sec"><p class="total_price">Total Price : <span>
                      <?php                       
                      if(isset($dchildPrice) && isset($dadultPrice) && isset($rchildPrice) && isset($radultPrice)){
                         echo $curr.number_format($dchildPrice+$dadultPrice+$rchildPrice+$radultPrice);
                      }  ?>                          
                      </span></p></div>
                       <?php //print_r($flight_details->error_msg);exit;
                       if(isset($flight_details->error_msg) && $flight_details->error_msg != ''){echo '<p><b>'.$flight_details->error_msg.'</b></p>'; }else{ ?>
                          <input type="hidden" id="total-amount" name="total_amount" value="<?php if(isset($dchildPrice) && isset($dadultPrice) && isset($rchildPrice) && isset($radultPrice)){ echo number_format($dchildPrice+$dadultPrice+$rchildPrice+$radultPrice+$dinfantPrice+$rinfantPrice); }?>">
                          <input type="hidden" id="currency-code" name="currency_code" value="<?php echo $curr ?>">
                          <?php $arrget = json_encode($inputArray); ?>
                          <input type="hidden" id="get-data-dtl" name="get_data_dtl" value='<?php echo $arrget; ?>' />

                          <?php if($this->session->userdata(USER_SESSION.'is_logged_in')  == true){?>
                          <input type="hidden" name="user_type" value="<?php echo $this->session->userdata(USER_SESSION.'user_type')?>">
                          <?php }else{ ?>
                           <input type="hidden" name="user_type" value="GUEST">
                           <?php } ?>
                           <?php if(isset($flight_details)){?>
                          <input type="hidden" id="flight-name" name="flight_name" value="<?php echo (isset($flight_details->depart_detail->airline_name) && $flight_details->depart_detail->airline_name!='')? $flight_details->depart_detail->airline_name:'';?>">
                          <?php 
                          if(isset($flight_details->depart_detail->class_name) && $flight_details->depart_detail->class_name != ''){ ?>
                        <input type="hidden" name="flight_class" id="flight_class"
                          value="<?php echo $flight_details->depart_detail->class_name; ?>">
                         <?php }else if(isset($flight_details->return_detail->class_name) && $flight_details->return_detail->class_name!=''){ ?>
                        <input type="hidden" name="flight_class" id="flight_class"
                          value="<?php echo $flight_details->return_detail->class_name; ?>">
                        <?php } ?>
                       
                        <input type="hidden" name="dept_flight_no" id="dept_flight_no" value="<?php echo ($flight_details->depart_detail->fno!='')?$flight_details->depart_detail->fno:'0'?>">
                        <?php } ?>
                     <?php } ?>
                    <?php
                    //  echo '<pre>'; print_r($flight_details->depart_detail->class_name);exit;
                      //echo (isset($flight_details->return_detail->class_name) && $flight_details->return_detail->class_name!='')?$flight_details->return_detail->class_name:''; ?>

                    <!--  sk else condition use for guest user book flight without login 2-1-2018 -->

                      <?php if($this->session->userdata(USER_SESSION.'is_logged_in')  == true){?>
                      <div class="col-md-6"><button type="submit" name="flightpay" id="flightpay" value="pay">Book Now</button></div>
                      <?php }else{?>
                       <div class="col-md-6">
                       <button type="submit" name="guest_login" id="guest_login" value="guest">Continue as Guest</button>
                       OR
                        <a class="sub-btn button" href="<?php echo site_url(); ?>user-login/book" name="login" id="login" value="login">Login & Continue</a>
                       </div>                        
                      <?php }?>                      
                    </div>
                </form>
            </div>
            <?php } ?>
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


    var dept_flight_no = $("#dept_flight_no").val();
    var datas = {'flighno': dept_flight_no};
    $.ajax({
        url: '<?php echo site_url('check_flight_coupon');?>',
        type: 'POST',
        dataType: 'json',   
        data:datas,     
        success:function(results){
            //console.log(results[0]);
            var arrLenght = results.length;
            if(arrLenght>0 && results[0].travel_id != ''){
                 $(".coupone_code").show();
            }
        }
    });
</script>