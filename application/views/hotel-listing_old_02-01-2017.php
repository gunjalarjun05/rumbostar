<!-- PRELOADER -->
<div class="preloader"></div>
<!-- END / PRELOADER -->
<section class="awe-parallax category-heading-section-demo" style="background-position: 50% 12px;">
            <div class="awe-overlay"></div>
            <div class="container">
                <div class="category-heading-content category-heading-content__2 text-uppercase">
                    <!-- BREADCRUMB -->
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="<?php echo site_url();?>">Home</a></li>
                            <li><span>Hotels</span></li>
                        </ul>
                    </div>
                    <!-- BREADCRUMB -->
                    <div class="find">
                        <h2 class="text-center">Find Your Hotel</h2>
                        <form action="<?php echo site_url('hotel');?>" method="post">
                            <div class="form-group">
                                <div class="form-elements">
                                    <label>Location</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-marker-1"></i>
                                        <input type="text" name="destination" id="id_destination" placeholder="City.." value="<?php echo (isset($search_info->city) && $search_info->city!='')?$search_info->city:'';?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>Check in</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-calendar"></i>
                                        <input type="text" name="checkin" id="id_checkin" class="awe-calendar" placeholder="Date" value="<?php echo (isset($search_info->ci) && $search_info->ci!='' )? $search_info->ci:'';?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>Check out</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-calendar"></i>
                                        <input type="text" name="checkout" id="id_checkout" class="awe-calendar" placeholder="Date" value="<?php echo (isset($search_info->co) && $search_info->co!='') ? $search_info->co:'';?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>Budget</label>
                                    <div class="form-item">
                                        <div class="awe-select-wrapper">
                                        <select class="awe-select" name="guest" id="id_guest">
                                        <option value="" >All types</option>
                                        <option value="1" <?php echo (isset($search_info->adult) && $search_info->adult == 1)?'selected=selected':'';?> >1</option>
                                        <option value="2" <?php echo (isset($search_info->adult) && $search_info->adult == 2)?'selected=selected':'';?>>2</option>
                                        <option value="3" <?php echo (isset($search_info->adult) && $search_info->adult == 3)?'selected=selected':'';?>>3</option>
                                        </select><i class="fa fa-caret-down"></i></div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input value="Find My Hotel" type="submit">
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </section>
        <section class="filter-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-top">
                            <ul class="list-link">
                                <li><a href="<?php echo site_url('flight');?>">Flight</a></li>
                                <li class="current"><a href="<?php echo site_url('hotel');?>">Hotel</a></li>
                                <li><a href="<?php echo site_url('train');?>">Train</a></li>
                            </ul>
                            <div class="awe-select-wrapper"><select class="awe-select">
                                <option>Best Match</option>
                                <option>Best Rate</option>
                            </select><i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-push-3">
                        <div class="filter-page__content">
                            <div class="filter-item-wrapper">
                            <?php if(isset($errorMsg) && $errorMsg!=''):?>
                                <div><?php echo $errorMsg;?></div>
                            <?php endif;?>
                             <?php if(isset($result) && count($result)>0):?>
                                 <?php  foreach($result as $resultd):?>
                                  <!-- ITEM -->
                                  <div class="hotel-item">
                                      <div class="item-media">
                                         <div class="image-cover">
                                            <img src="<?php echo $resultd->largeThumbnailURL; ?>" alt="<?php echo $resultd->name; ?>"  style="height: 100%; width: auto;">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                     <div class="item-title">
                                        <h2>
                                           <a href="#"><?php echo $resultd->name; ?></a>
                                       </h2>
                                   </div>
                                   <div class="item-hotel-star">
                                       <input id="input-3-xs" name="input-3" value="<?php echo $resultd->review_rating->reviewOverall; ?>" class="rating-loading all-listrate" data-size="xs">
                                   </div>
                                   <div class="item-address">
                                    <i class="awe-icon awe-icon-marker-2"></i>
                                    <?php echo $resultd->address.', '.$resultd->cityName;  ?> 
                                </div>
                                <div class="item-footer">
                                    <div class="item-rate">
                                       <span><?php echo (count($resultd->amenities)>0)?implode(",",$resultd->amenities):''; ?></span>
                                   </div>                                           
                               </div>
                           </div>
                           <div class="item-price-more">
                             <div class="price">
                                one night from
                                <span class="amount"><?php echo $curr['IDR']."".number_format($resultd->price); ?></span>
                            </div>
                            <a href="<?php echo site_url().'hotel-details/'.$session_id.'/'.$resultd->hotelId;?>" class="awe-btn">Book now</a>
                        </div>
                    </div>
                    <!-- END / ITEM -->
                <?php endforeach;?>
            <?php endif;?>
        </div>


        <!-- PAGINATION -->
        <div class="page__pagination pull-right">
            <?php echo (isset($no_of_pages) && $no_of_pages!='')?$no_of_pages:'';?>
        </div>
        <!-- END / PAGINATION -->
    </div>
</div>
<div class="col-md-3 col-md-pull-9">
    <?php $this->load->view('hotel-filters',array("filterarr"=>$filterInputs));?>
</div>
</div>
</div>
</section>
        
<script>
    $(document).on('ready', function(){
        $('.all-listrate').rating({displayOnly: true, step: 0.5});
    });
</script> 
