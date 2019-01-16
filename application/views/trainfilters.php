<div class="col-md-3 col-md-pull-9 train-filter">
    <div class="page-sidebar">
        <form method="post" action="<?php echo site_url('train');?>" id="appy-train-filters" name="appy_train_filters" class="form-field-section">
            <div class="sidebar-title">
                <h2>TRAIN FILTER</h2>
               <!--<div class="clear-filter">
                    <a href="#">Clear all</a>
                </div>-->
            </div>
            <!-- WIDGET -->
            <div class="widget widget_has_radio_checkbox_text">
                <h3>TRAIN TYPE</h3>
                <div class="widget_content">
                    <div class="flight-radio-btns">                     
                        <label for="radio-one">
                            <input type="radio" name="train_roundtrip" id="radio-one" value="oneway" <?php echo ((isset($search_info['roundtrip']) && $search_info['roundtrip'] =='oneway'))?'checked=checked':'';?> >
                            <i></i>
                            Oneway
                        </label>
                        <label for="radio-two">
                            <input type="radio" name="train_roundtrip" id="radio-two" value="return" <?php echo ((isset($search_info['roundtrip']) && $search_info['roundtrip'] =='return'))?'checked=checked':'';?>>
                            <i></i>
                            Return
                        </label>
                      </div>    
                    <label class="from">
                        From
                        <span class="form-item db">
                            <i class="awe-icon awe-icon-marker-1"></i>
                            <input type="text" id="train_from_id" name="train_from" value="<?php echo (isset($search_info['from_i']) && $search_info['from_i']!='')?$search_info['from_i']:'';?>">
                        </span>
                    </label>
                    <label class="refresh-serch on-page">
                        <a href="javascript:void(0);" title="Toggle" id="refresh_btn_train"><img src="<?php echo site_url().ASSETS_IMAGES?>refresh-img.png" alt="Toggle"></a>
                    </label>
                    <label class="to">
                        To
                        <span class="form-item db">
                            <i class="awe-icon awe-icon-marker-1"></i>
                            <input type="text" id="train_to_id" name="train_to" value="<?php echo (isset($search_info['to_i']) && $search_info['to_i']!='')?$search_info['to_i']:'';?>">
                            <div id="to_train_error"></div>
                        </span>
                    </label>
                    <label class="from">
                        Depart on
                        <span class="form-item db">
                            <input type="text" name="train_depart" class="awe-calendar depart-on" id="depart_on" placeholder="Check in" value="<?php echo (isset($search_info['depart']) && $search_info['depart']!='')? date('d-m-Y',strtotime($search_info['depart'])):'';?>">
                        </span>
                    </label>
                    <label class="from"  id="id_returnradio" style="<?php echo ((isset($search_info['roundtrip']) && $search_info['roundtrip'] =='oneway'))?'display:none':'display:block'?>;">
                        Return on
                        <span class="form-item db">
                            <input type="text" id="return_on" name="train_return" class="awe-calendar return-on" placeholder="Check out" value="<?php echo (isset($search_info['return']) && $search_info['return']!='')? date('d-m-Y',strtotime($search_info['return'])):'';?>">
                            <div id="return_on_train_error"></div>
                        </span>
                    </label>
                     
                     <label class="pasenger-head">No. of Passengers:</label>
                     <div class="passenger">
                     <select class="select_css" name="train_adult" id="adult_id">
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
                     <select class="select_css" name="train_child" id="id_child">
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
                    
                      <select class="select_css" name="train_infant" id="id_infant">
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
            <!--<input type="hidden" name="train_from" value="<?php echo (isset($search_info['from']) && $search_info['from']!='')?$search_info['from']:''?>">
            <input type="hidden" name="train_to" value="<?php echo (isset($search_info['to']) && $search_info['to']!='')?$search_info['to']:''?>">
            <input type="hidden" name="train_depart" value="<?php echo (isset($search_info['depart']) && $search_info['depart']!='')?date('d-m-Y',strtotime($search_info['depart'])):''?>">
            <input type="hidden" name="train_return" value="<?php echo (isset($search_info['return']) && $search_info['return']!='')?date('d-m-Y',strtotime($search_info['return'])):''?>">-->
                               
           <!-- <input type="hidden" name="depart" value="<?php //echo (isset($search_info['depart']) && $search_info['depart']!='')?$search_info['depart']:'';?>">
            <input type="hidden" name="return" value="<?php //echo (isset($search_info['return']) && $search_info['return']!='')?$search_info['return']:'';?>">
            <input type="hidden" name="adult" value="<?php //echo (isset($search_info['adult']) && $search_info['adult']!='')?$search_info['adult']:'';?>">
            <input type="hidden" name="child" value="<?php //echo (isset($search_info['child']) && $search_info['child']!='')?$search_info['child']:'';?>">
            <input type="hidden" name="infant" value="<?php//echo (isset($search_info['infant']) && $search_info['infant']!='')?$search_info['infant']:'';?>">-->
            <button id="train-filter" class="awe-btn primary pull-right hvr-rectangle-out" name="applayfilter" value="Apply Filter">Apply Filter</button>
            <!-- END / WIDGET -->

        </form>
    </div>
</div>
