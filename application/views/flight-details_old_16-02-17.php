<!-- PRELOADER -->
<div class="preloader"></div>
<section class="product-detail hotel-booking-details">
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Depart</h3>
                    <?php  
                        $dchildPrice = (isset($flight_details->depart_detail->price->child->total_idr) && $flight_details->depart_detail->price->child->total_idr !=0)?$flight_details->depart_detail->price->child->total_idr:0;
                        $dadultPrice = (isset($flight_details->depart_detail->price->adult->total_idr) && $flight_details->depart_detail->price->adult->total_idr !=0)?$flight_details->depart_detail->price->adult->total_idr:0;
                    ?>
                     <div class="final-flight-ammount"><?php echo $curr.number_format(($dadultPrice+$dchildPrice));?></div>
                </div>
                <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic"><?php if(isset($flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))] !=''):?>
                                                                        <img style="width:80% !important;" alt="<?php echo $flight_details->depart_detail->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $flight_details->depart_detail->airline_name))];?>" >
                                                                    <?php else:?>
                                                                        <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                                                    <?php endif;?> </div>
                        <div class="flight-name">
                            <p class="fl-name"><?php echo (isset($flight_details->depart_detail->airline_name) && $flight_details->depart_detail->airline_name!='')? $flight_details->depart_detail->airline_name:'';?> : <?php echo (isset($flight_details->search_info->from) && $flight_details->search_info->from!='')?$flight_details->search_info->from:'';?> - <?php echo (isset($flight_details->search_info->to) && $flight_details->search_info->to!='') ? $flight_details->search_info->to:'';?></p>
                            <p class="fl-economy"><?php echo (isset($flight_details->depart_detail->class_name) && $flight_details->depart_detail->class_name!='')?$flight_details->depart_detail->class_name:''; ?></p>                            
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head"><?php echo $flight_details->depart_detail->etd;?><br><?php
                                                                    $departdated=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('D',strtotime($flight_details->depart_detail->date)):'';
                                                                    $departdaten=(isset($flight_details->depart_detail->date) && $flight_details->depart_detail->date!='')? date('d M Y',strtotime($flight_details->depart_detail->date)):''; 
                                                                    echo $departdated." ".$departdaten ;
                                                                    ?></span><span><?php echo (isset($flight_details->depart_detail->from) && $flight_details->depart_detail->from!='')? $flight_details->depart_detail->from:''; ?></span></p>
                    <p class="flight-check-out"><span class="head"><?php echo $flight_details->depart_detail->eta;?><br><?php $arrivalDate = get_arrival_date($flight_details->depart_detail->date,$flight_details->depart_detail->etd,$flight_details->depart_detail->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $flight_details->depart_detail->to;?></span></p>
                    
                </div>
               
                <?php if($flight_details->depart_detail->type == 'connecting'):?>
                    <?php foreach($flight_details->depart_detail->connecting_flight as $key=>$values):?>

                        <div class="booking-flight-det col-md-12 col-sm-12">
                            <div class="content">
                                <div class="flight-pic"><?php if(isset($flightImages[strtolower(str_replace(" ", "_", $values->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $values->airline_name))] !=''):?>
                                                                            <img style="width:80% !important;" alt="<?php echo $values->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $values->airline_name))];?>" >
                                                                        <?php else:?>
                                                                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                                                        <?php endif;?> </div>
                                <div class="flight-name">
                                    <p class="fl-name"><?php echo $values->airline_name;?></p>
                                    <p class="fl-economy"><?php echo $values->class_name;?></p>
                                </div>
                            </div>
                        </div>

                         <div class="booking-flight-info col-md-12 col-sm-12">
                            <p class="flight-check-in"><span class="head"><?php echo $values->etd;?><br><?php echo date('D',strtotime($values->date))." ". date('d M Y',strtotime($values->date));?></span><span><?php echo $values->from;?></span></p>
                            <p class="flight-check-out"><span class="head"><?php echo $values->eta;?><br><?php $arrivalDate = get_arrival_date($values->date,$values->etd,$values->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $values->to;?></span></p>
                            
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <?php  
            $rchildPrice = 0;
            $radultPrice = 0;
        ?>
        <?php if(isset($flight_details->return_detail) && $flight_details->return_detail!=''):?>
         <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Return</h3>
                    <?php  
                        $rchildPrice = (isset($flight_details->depart_detail->price->child->total_idr) && $flight_details->depart_detail->price->child->total_idr !=0)?$flight_details->depart_detail->price->child->total_idr:0;
                        $radultPrice = (isset($flight_details->depart_detail->price->adult->total_idr) && $flight_details->depart_detail->price->adult->total_idr !=0)?$flight_details->depart_detail->price->adult->total_idr:0;
                    ?>
                     <div class="final-flight-ammount"><?php echo $curr.number_format($radultPrice+$rchildPrice);?></div>
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
                    <p class="flight-check-in"><span class="head"><?php echo $flight_details->return_detail->etd;?><br><?php
                                                                    $departdated=(isset($flight_details->return_detail->date) && $flight_details->return_detail->date!='')? date('D',strtotime($flight_details->return_detail->date)):'';
                                                                    $departdaten=(isset($flight_details->return_detail->date) && $flight_details->return_detail->date!='')? date('d M Y',strtotime($flight_details->return_detail->date)):''; 
                                                                    echo $departdated." ".$departdaten ;
                                                                    ?></span><span><?php echo (isset($flight_details->return_detail->from) && $flight_details->return_detail->from!='')? $flight_details->return_detail->from:''; ?></span></p>
                    <p class="flight-check-out"><span class="head"><?php echo $flight_details->return_detail->eta;?><br><?php $arrivalDate = get_arrival_date($flight_details->return_detail->date,$flight_details->return_detail->etd,$flight_details->return_detail->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $flight_details->return_detail->to;?></span></p>
                    
                </div>
               
                <?php if($flight_details->return_detail->type == 'connecting'):?>
                    <?php foreach($flight_details->return_detail->connecting_flight as $key=>$values):?>

                        <div class="booking-flight-det col-md-12 col-sm-12">
                            <div class="content">
                                <div class="flight-pic"><?php if(isset($flightImages[strtolower(str_replace(" ", "_", $values->airline_name))]) && $flightImages[strtolower(str_replace(" ", "_", $values->airline_name))] !=''):?>
                                                                            <img style="width:80% !important;" alt="<?php echo $values->airline_name; ?>" src="<?php echo site_url().ASSETS_IMAGES."/flight/".$flightImages[strtolower(str_replace(" ", "_", $values->airline_name))];?>" >
                                                                        <?php else:?>
                                                                            <img src="<?php echo site_url().ASSETS_IMAGES.'/flight/Airline8.png'; ?>" alt="">
                                                                        <?php endif;?> </div>
                                <div class="flight-name">
                                    <p class="fl-name"><?php echo $values->airline_name;?></p>
                                    <p class="fl-economy"><?php echo $values->class_name;?></p>
                                </div>
                            </div>
                        </div>

                         <div class="booking-flight-info col-md-12 col-sm-12">
                            <p class="flight-check-in"><span class="head"><?php echo $values->etd;?><br><?php echo date('D',strtotime($values->date))." ". date('d M Y',strtotime($values->date));?></span><span><?php echo $values->from;?></span></p>
                            <p class="flight-check-out"><span class="head"><?php echo $values->eta;?><br><?php $arrivalDate = get_arrival_date($values->date,$values->etd,$values->eta); echo date('D',strtotime($arrivalDate))." ".$arrivalDate;?></span><span><?php echo $values->to;?></span></p>
                            
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    <?php endif; ?>
        <div class="col-md-12 col-sm-12 passengers-details-sec">
            <div class="passengers-details-content">
                <h3>Customer Details</h3>
                <form class="passengers-details">
                    <div class="cust-info">
                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Name</label>
                            <input type="text" name="guest_name" id="guest-name" placeholder="Customer Name">
                        </div>

                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Phone</label>
                            <input type="text" name="guest_phone" id="guest-phone" placeholder="Customer Number">
                        </div>

                        <div class="form-item col-md-4 col-sm-4">
                            <label>Customer Email</label>
                            <input type="text" name="guest_email" id="guest-email" placeholder="Email">
                        </div>
                    </div>


                    <h3>Passenger Details</h3>

                    <div class="col-md-12 col-sm-12 table-responsive details-sec">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="w-80">Title</th>
                            <th class="w-150">Firstname</th>
                            <th class="w-150">Lastname</th>
                            <th class="w-150">ID Number</th>
                            <th class="w-150">Passport Number</th>
                            <th class="w-150">Country Passport </th>
                            <th class="w-150">Passport Expire On</th>
                            <th class="w-150">Date of Birth</th>
                            <th class="w-80">Baggage</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $totalpasenger = $flight_details->search_info->adult + $flight_details->search_info->child;
                        for($i=0;$i<$totalpasenger;$i++){
                            ?>
                                <tr>
                                    <td class="w-80">
                                        <select name="" class="select-sec">
                                            <option value="">Mr.</option>
                                            <option value="">Mrs.</option>
                                            <option value="">Ms.</option>
                                        </select>
                                    </td>
                                    <td class="w-150"><input type="text" name="" placeholder="John"></td>
                                    <td class="w-150"><input type="text" name="" placeholder="Cena"></td>
                                    <td class="w-150"><input type="text" name="" placeholder="121341"></td>
                                    <td class="w-150"><input type="text" name="" placeholder="115615516"></td>
                                    <td class="nationality w-150"><input type="text" name="" placeholder="America"></td>
                                    <td class="expiry-date w-150">
                                        <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                        <input type="text" name="" placeholder="" class="awe-calendar"></td>
                                    <td class="date-of-birth w-150">
                                        <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                        <input type="text" name="" placeholder="" class="awe-calendar"></td>
                                    <td class="buggage w-80">
                                        <select name="" class="select-sec">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                            <option value="">6</option>
                                            <option value="">7</option>
                                            <option value="">8</option>
                                        </select>
                                    </td>                            
                                </tr>
                            <?php
                        }

                        ?>
                        
                        </tbody>
                      </table>
                    </div>
                    
                   <div class="form-item sub-btn">
                      <div class="col-md-6 total-price-sec"><p class="total_price">Total Price : <span><?php echo $curr.number_format($dchildPrice+$dadultPrice+$rchildPrice+$radultPrice);?></span></p></div>
                      <div class="col-md-6"><button type="submit" name="hotelpay" value="pay">Book Now</button></div>
                    </div>
                </form>
            </div>
        </div>

        </div>
       
    </section>
