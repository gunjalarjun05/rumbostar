
<div class="col-md-3 col-md-pull-9">
    <div class="page-sidebar">
        <form method="post" action="<?php echo site_url('flight');?>" id="appy-flight-filters" name="appy_flight_filters" class="form-field-section">
            <div class="sidebar-title">
                <h2>FLIGHT FILTER</h2>
               <!--<div class="clear-filter">
                    <a href="#">Clear all</a>
                </div>-->
            </div>
            <!-- WIDGET -->
            <?php //echo '<pre>';
            //print_r($search_info);exit;
            ?>
            <div class="widget widget_has_radio_checkbox_text">
                <h3>Flight Type</h3>
                <div class="widget_content">
					<!-- <div class="flight-radio-btns1">						
						<label for="radio-domestic">
							<input type="radio" name="flightRadios" id="radio-domestic" value="domestic" <?php //echo ((isset($search_info['flightRadios']) && $search_info['flightRadios'] =='domestic'))?'checked=checked':'';?> >
							<i></i>
							Domestic
						</label>
						<label for="radio-international">
							<input type="radio" name="flightRadios" id="radio-international" value="international" <?php //echo ((isset($search_info['flightRadios']) && $search_info['flightRadios'] =='international'))?'checked=checked':'';?>>
							<i></i>
							International
						</label>
					 </div> -->
					   <?php //echo '<pre>'; print_r($search_info);exit; ?>
             <input type="hidden" name="flightRadios" id="radio-domestic" value="<?php echo $search_info['flightRadios']; ?>">


					<div class="flight-radio-btns">						
						<label for="radio-one">
							<input type="radio" name="exampleRadios" id="radio-one" value="oneway" <?php echo ((isset($search_info['roundtrip']) && $search_info['roundtrip'] =='oneway'))?'checked=checked':'';?> >
							<i></i>
							Oneway
						</label>
						<label for="radio-two">
							<input type="radio" name="exampleRadios" id="radio-two" value="return" <?php echo ((isset($search_info['roundtrip']) && $search_info['roundtrip'] =='return'))?'checked=checked':'';?>>
							<i></i>
							Return
						</label>
					  </div>

                     
            <div class="flight-radio-btns">
                <label for="radio-three">
                   <input type="radio" name="exampleFlightType" checked="checked" id="radio-three" value="connecting"/> 
                    <i></i> Connecting
                </label>
                <label for="radio-four" >
                    <input type="radio" name="exampleFlightType" id="radio-four" value="direct"/>
                    <i></i> Direct 
                </label>
                <label for="radio-five" >
                  <input type="radio" name="exampleFlightType" id="radio-five" value="transit"/>
                  <i></i> Transit 
                </label>
            </div> 	


					 <!--  style="display:none;" sk add if condition if click on  domestic radio button show input text box QA-issue resolved and without login click on domestic 12-12-2017 -->
                     <?php  //sk comment line fliter page no show domestic radio and airline textbox also client req.                    
                     if($search_info['flightRadios'] =='domestic'){ ?>
                        <!--  <label class="from"  id="id_domesticairline" >
                            Airline
                           <span class="form-item db">
                                <input type="text" id="flight_domestic_airline" name="flight_domestic_airline" value="<?php echo (isset($search_info['flight_domestic_airline']) && $search_info['flight_domestic_airline']!='')?$search_info['flight_domestic_airline']:'';?>">

                            </span>
                        </label> -->
                    <?php } ?>

                    <label class="from"  id="id_domesticairline" style="display:none;" >
                            Airline
                           <span class="form-item db">
                                <input type="text" id="flight_domestic_airline" name="flight_domestic_airline" value="<?php echo (isset($search_info['flight_domestic_airline']) && $search_info['flight_domestic_airline']!='')?$search_info['flight_domestic_airline']:'';?>">
                            </span>
                        </label>


                    <label class="from">
                        From
                        <span class="form-item db">
                            <i class="awe-icon awe-icon-marker-1"></i>
                            <input type="text" id="flight_from_id" name="flight_from" value="<?php echo (isset($search_info['from_i']) && $search_info['from_i']!='')?$search_info['from_i']:'';?>">
                        </span>
                    </label>

                    <label class="refresh-serch on-page">
                        <a href="javascript:void(0);" title="Toggle" id="refresh_btn_flight"><img src="<?php echo site_url().ASSETS_IMAGES?>refresh-img.png" alt="Toggle"></a>
                    </label>

                    <label class="to">
                        To
                        <span class="form-item db">
                            <i class="awe-icon awe-icon-marker-1"></i>
                            <input type="text" id="flight_to_id" name="flight_to" value="<?php echo (isset($search_info['to_i']) && $search_info['to_i']!='')?$search_info['to_i']:'';?>">
                        </span>
                        <div id="to_flight_error"></div>
                    </label>
                    <label class="from">
                        Depart on
                        <span class="form-item db">
                            <input type="text" name="depart" class="awe-calendar depart-on" placeholder="Check in" id="depart_on" value="<?php echo (isset($search_info['depart']) && $search_info['depart']!='')? date('d-m-Y',strtotime($search_info['depart'])):'';?>">
                        </span>
                    </label>
                    <label class="from"  id="id_returnradio" style="display:none;">
                        Return on
                        <span class="form-item db">
                            <input type="text" name="return" class="awe-calendar return-on" placeholder="Check out" id="return_on" value="<?php echo (isset($search_info['return']) && $search_info['return']!='')? date('d-m-Y',strtotime($search_info['return'])):'';?>">
                        </span>
                        <div id="return_on_flight_error"></div>
                    </label>
                     
                     <label class="pasenger-head">No. of Passengers:</label>
                     <div class="passenger">
                     <select class="select_css" name="adult" id="adult_id">
                     <option value="1" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 1)?'selected=selected':'';?>>1</option>
                     <option value="2" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 2)?'selected=selected':'';?>>2</option>
                     <option value="3" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 3)?'selected=selected':'';?>>3</option>
                     <option value="4" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 4)?'selected=selected':'';?>>4</option>
                     <option value="5" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 5)?'selected=selected':'';?>>5</option>
                     <option value="6" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 6)?'selected=selected':'';?>>6</option>
                     <option value="7" <?php echo (isset($search_info['adult']) && $search_info['adult'] == 7)?'selected=selected':'';?>>7</option>
                     </select>
                     <p>Adults <small>12+ years</small></p>
                     </div>
                     
                     <div class="adult">
                     <select class="select_css" name="child" id="id_child">
						<?php if(isset($search_info['adult']) && count($search_info['adult'])>0){
							$noOfChild = 7- $search_info['adult'] ; 
							for($i=0;$i<=$noOfChild;$i++){
								?><option value="<?php echo $i;?>" <?php echo (isset($search_info['child']) && $search_info['child'] == $i)?'selected=selected':'';?>><?php echo $i;?></option><?php
							}
						}
						?>
                     </select>
                     <p>Child <small>2-12+ years</small></p>
                     </div>
                     
                     <div class="child">
                    
                      <select class="select_css" name="infant" id="id_infant">
                      <?php  
							for($i=0;$i<=$search_info['adult'];$i++){
								?><option value="<?php echo $i;?>" <?php echo (isset($search_info['infant']) && $search_info['infant'] == $i)?'selected=selected':'';?>><?php echo $i;?></option><?php
							}
						?>
                      </select>
                      <p>Infant <small>0-2 years</small></p>
                      </div>
                      <div class="clearfix"></div>
                </div>
            </div>
            <!-- END / WIDGET -->

            <!-- WIDGET -->
            <div class="widget widget_price_filter">
                <h3>Price Level</h3>
                <div class="price-slider-wrapper">
                    <div class="price-slider" id="price_slider"></div>
                    <div class="price_slider_amount">
                    <input type="hidden" id="range-slide-min" name="range_slide_min" value="<?php echo (isset($range_slide_min) && $range_slide_min!='')?$range_slide_min:'';?>">
                    <input type="hidden" id="range-slide-max" name="range_slide_max" value="<?php echo (isset($range_slide_max) && $range_slide_max!='')?$range_slide_max:'';?>">
                        <div class="price_label">
                            <span class="from"></span> - <span class="to"></span>
                        </div>
                    </div>
                </div>
            </div>
           <!-- <input type="hidden" name="depart" value="<?php //echo (isset($search_info['depart']) && $search_info['depart']!='')?$search_info['depart']:'';?>">
            <input type="hidden" name="return" value="<?php //echo (isset($search_info['return']) && $search_info['return']!='')?$search_info['return']:'';?>">
            <input type="hidden" name="adult" value="<?php //echo (isset($search_info['adult']) && $search_info['adult']!='')?$search_info['adult']:'';?>">
            <input type="hidden" name="child" value="<?php //echo (isset($search_info['child']) && $search_info['child']!='')?$search_info['child']:'';?>">
            <input type="hidden" name="infant" value="<?php//echo (isset($search_info['infant']) && $search_info['infant']!='')?$search_info['infant']:'';?>">-->
            <button id="flight-filter" class="awe-btn primary pull-right hvr-rectangle-out" name="applyfilter" value="Apply Filter">Apply Filter</button>
            <!-- END / WIDGET -->

        </form>
    </div>
</div>

<script type="text/javascript">
/*$('#flight_domestic_airline').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(site_url+'service/get_domestic_airlines', { q: term }, function(data){ 
          $('#flight_from_id').val("");
          $('#flight_to_id').val("");
          response(data); 
        });
    }
});*/
    /*$("#radio-domestic").click(function(){
        $("#id_domesticairline").removeAttr("style");
        
    });*/
</script>