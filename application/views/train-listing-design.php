        <!-- PRELOADER -->
        <div class="preloader"></div>
        <!-- END / PRELOADER -->


       
       <!-- HEADING PAGE -->
        <section class="awe-parallax category-heading-section-demo">
            <div class="awe-overlay"></div>
            <div class="container">
                <div class="category-heading-content category-heading-content__2 text-uppercase">
                    <!-- BREADCRUMB -->
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>
                            <li><span>Train</span></li>
                        </ul>
                    </div>
                    <!-- BREADCRUMB -->
                    <div class="find">
                        <h2 class="text-center">Find Your Train</h2>
                        <form action="" method="post" id="list-train-search" name="list_train_search">
                            <div class="form-group">
                                <div class="form-elements">
                                    <label>From</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-marker-1"></i>
                                        <input type="text" name="train_from" id="train_from_id" placeholder="City" value="<?php echo (isset($search_info['from']) && $search_info['from']!='')?$search_info['from']:''?>">
                                    </div>
                                </div>
                                <div class="form-elements">
                                    <label>To</label>
                                    <div class="form-item">
                                        <i class="awe-icon awe-icon-marker-1"></i>
                                        <input type="text" placeholder="City" name="train_to" id="flight_to_id" value="<?php echo (isset($search_info['to']) && $search_info['to']!='')?$search_info['to']:''?>">
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
                    </div>
                </div>
            </div>
        </section>
        <!-- END / HEADING PAGE -->

       
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

                    <div class="col-md-9 col-md-push-3">
                        <div class="filter-page__content">
                            <div class="filter-item-wrapper">
                                <!-- ITEM -->
                             <h3>TRAIN DETAILS</h3>
                            <div class="flight-item">
                                        <div class="item-media">
                                            <div class="image-cover">
                                                <img alt="" src="http://localhost/rumbostar-new/assets/images//flight/2.jpg" style="height: 100%; width: auto;">
                                            </div>
                                        </div>
                                        <div class="item-body">
                                            <div class="item-title">
                                                <h2>
                                                  ARGO PARAHYANGAN                                                </h2>
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
                                                                <li> BD <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GMR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> BANDUNG <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GAMBIR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span>19:25</span>
                                                            <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span>22:34</span>
                                                             <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="duration">
                                                            <span>03 h 12 m </span>
                                                        </td>
                                                    </tr>                                           
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="item-price-more">
                                                                                     <div class="price">
                                                <span class="amount">$5,923</span>
                                            </div>
                                            <a class="awe-btn" href="http://localhost/rumbostar-new/train-details/iybAr1xIwxNWlPniurj150qZx7XQfR7SV-YsDijMgtw/30A">View Details</a>
                                        </div>
                                    </div>
                                    <div class="flight-item">
                                        <div class="item-media">
                                            <div class="image-cover">
                                                <img alt="" src="http://localhost/rumbostar-new/assets/images//flight/2.jpg" style="height: 100%; width: auto;">
                                            </div>
                                        </div>
                                        <div class="item-body">
                                            <div class="item-title">
                                                <h2>
                                                  ARGO PARAHYANGAN                                                </h2>
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
                                                                <li> BD <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GMR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> BANDUNG <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GAMBIR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span>19:25</span>
                                                            <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span>22:34</span>
                                                             <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="duration">
                                                            <span>03 h 12 m </span>
                                                        </td>
                                                    </tr>                                           
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="item-price-more">
                                                                                     <div class="price">
                                                <span class="amount">$5,923</span>
                                            </div>
                                            <a class="awe-btn" href="http://localhost/rumbostar-new/train-details/iybAr1xIwxNWlPniurj150qZx7XQfR7SV-YsDijMgtw/30A">View Details</a>
                                        </div>
                                    </div>
                                    <div class="flight-item">
                                        <div class="item-media">
                                            <div class="image-cover">
                                                <img alt="" src="http://localhost/rumbostar-new/assets/images//flight/2.jpg" style="height: 100%; width: auto;">
                                            </div>
                                        </div>
                                        <div class="item-body">
                                            <div class="item-title">
                                                <h2>
                                                  ARGO PARAHYANGAN                                                </h2>
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
                                                                <li> BD <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GMR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> BANDUNG <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GAMBIR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span>19:25</span>
                                                            <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span>22:34</span>
                                                             <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="duration">
                                                            <span>03 h 12 m </span>
                                                        </td>
                                                    </tr>                                           
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="item-price-more">
                                                                                     <div class="price">
                                                <span class="amount">$5,923</span>
                                            </div>
                                            <a class="awe-btn" href="http://localhost/rumbostar-new/train-details/iybAr1xIwxNWlPniurj150qZx7XQfR7SV-YsDijMgtw/30A">View Details</a>
                                        </div>
                                    </div>
                                    <div class="flight-item">
                                        <div class="item-media">
                                            <div class="image-cover">
                                                <img alt="" src="http://localhost/rumbostar-new/assets/images//flight/2.jpg" style="height: 100%; width: auto;">
                                            </div>
                                        </div>
                                        <div class="item-body">
                                            <div class="item-title">
                                                <h2>
                                                  ARGO PARAHYANGAN                                                </h2>
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
                                                                <li> BD <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GMR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> BANDUNG <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GAMBIR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span>19:25</span>
                                                            <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span>22:34</span>
                                                             <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="duration">
                                                            <span>03 h 12 m </span>
                                                        </td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="route">
                                                            <ul>
                                                                <li> BD <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GMR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> BANDUNG <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GAMBIR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span>19:25</span>
                                                            <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span>22:34</span>
                                                             <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="duration">
                                                            <span>03 h 12 m </span>
                                                        </td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="route">
                                                            <ul>
                                                                <li> BD <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GMR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                            <ul>
                                                                <li> BANDUNG <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                <li>  GAMBIR <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                            </ul>
                                                        </td>
                                                        <td class="depart">
                                                            <span>19:25</span>
                                                            <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="arrive">
                                                            <span>22:34</span>
                                                             <span class="date">16 Jan</span>
                                                        </td>
                                                        <td class="duration">
                                                            <span>03 h 12 m </span>
                                                        </td>
                                                    </tr> 

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="item-price-more">
                                                                                     <div class="price">
                                                <span class="amount">$5,923</span>
                                            </div>
                                            <a class="awe-btn" href="http://localhost/rumbostar-new/train-details/iybAr1xIwxNWlPniurj150qZx7XQfR7SV-YsDijMgtw/30A">View Details</a>
                                        </div>
                                    </div>
                            
                                
                             </div>
                             
                                <!-- ITEM -->

                            <?php if(isset($searchinfo->schedule->return) && count($searchinfo->schedule->return)>0):?>
                                <h3> RETURN TRAIN DETAILS</h3>
                                 <div class="filter-item-wrapper">
                                    <?php foreach($searchinfo->schedule->return as $key => $returnschdule):?>
                                        <div class="flight-item">
                                            <div class="item-media">
                                                <div class="image-cover">
                                                    <img src="<?php echo site_url().ASSETS_IMAGES?>/flight/2.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="item-body">
                                                <div class="item-title">
                                                    <h2>
                                                      <?php echo (isset($returnschdule->train_name) && $returnschdule->train_name!='')? $returnschdule->train_name:''; ?>
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
                                                                    <li> <?php echo (isset($returnschdule->from) && $returnschdule->from!='')? $returnschdule->from:''; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                    <li>  <?php echo (isset($returnschdule->to) &&$returnschdule->to!='')? $returnschdule->to:''; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                </ul>
                                                                <ul>
                                                                    <li> <?php echo (isset($returnschdule->from_st_name)&& $returnschdule->from_st_name)?$returnschdule->from_st_name:''; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                    <li>  <?php echo $returnschdule->to_st_name; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                </ul>
                                                            </td>
                                                            <td class="depart">
                                                                <span><?php echo (isset($returnschdule->ETD) && $returnschdule->ETD)? $returnschdule->ETD:''; ?></span>
                                                                <span class="date"><?php $ddate=(isset($returnschdule->DD) && $returnschdule->DD!='')? $returnschdule->DD:''; 
                                                                echo date('d M', strtotime(str_replace('','', $ddate)));?></span>
                                                            </td>
                                                            <td class="arrive">
                                                                <span><?php echo (isset($returnschdule->ETA) && $returnschdule->ETA!='')?$returnschdule->ETA:''; ?></span>
                                                                 <span class="date"><?php $adate=(isset($returnschdule->AD) && $returnschdule->AD!='')?$returnschdule->AD:'';
                                                                echo date('d M', strtotime(str_replace('','',  $adate))); ?></span>
                                                            </td>
                                                            <td class="duration">
                                                                <span><?php 
                                                                $retd=(isset($returnschdule->ETD) && $returnschdule->ETD!='')?$schedule->ETD:'';
                                                               $reta=(isset($returnschdule->ETA) && $returnschdule->ETA!='')? $schedule->ETA:'';
                                                                echo getTimeDiff($retd,$reta)?></span>
                                                            </td>
                                                        </tr>                                           
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="item-price-more">
                                             <?php $train_no=(isset($schedule->train_no) && $schedule->train_no!='')? $schedule->train_no:''; ?>
                                                <div class="price">
                                                    <span class="amount"><?php echo $curr;?>5,923</span>
                                                </div>
                                                <a href="<?php echo site_url().'train-details/'.$session_id.'/'.$train_no;?>" class="awe-btn" class="awe-btn">View Details</a>
                                            </div>
                                        </div>
                                        <!-- END / ITEM -->                                 
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>
                            
                                
                      

                            <!-- PAGINATION -->
                            <div class="page__pagination">
                                <span class="pagination-prev"><i class="fa fa-caret-left"></i></span>
                                <span class="current">1</span>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#" class="pagination-next"><i class="fa fa-caret-right"></i></a>
                            </div>
                            <!-- END / PAGINATION -->
                        </div>
                    </div>                  
                    <?php $this->load->view('trainfilters',array("trainfilters"=>$search_info,"range_slide"=>$range_slide));?>
                </div>
            </div>
        </section>

         <script type="text/javascript">
            var fhand = '<?php echo (isset($range_slide_min) && $range_slide_min!='')?$range_slide_min:10000?>';
            var shand='<?php echo (isset($range_slide_max) && $range_slide_max!='')?$range_slide_max:100000000?>';
        </script>

