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

        
        <section class="filter-page flight-listing-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-top">
                            <ul class="list-link">
                                <li><a href="#">Hotel</a></li>
                                <li class="current"><a href="#">Flight</a></li>
                                <li><a href="#">Train</a></li>
                            </ul>
                            <select class="awe-select">
                                <option>Best Match</option>
                                <option>Best Rate</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-push-3">
                        <div class="filter-page__content">

                        <?php for($i=0; $i<count($result['airlineIfo']); $i++) {?>
                            <div class="filter-item-wrapper">
                                <!-- ITEM -->
                                <div class="flight-item">
                                    <div class="item-media">
                                        <div class="image-cover">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>/Airline3.png" alt="">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="item-title">
                                        <h2>
                                        <a href="#"><?php echo $result['airlineIfo'][$i]['airline_name']; ?></a>
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
                                                        <li><?php echo $result['airlineIfo'][$i]['from']; ?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                        <li><?php echo $result['airlineIfo'][$i]['to']; ?> <i class="awe-icon awe-icon-arrow-right"></i></li>
                                                        </ul>
                                                    </td>
                                                    <td class="depart">
                                                    <span><?php echo $result['airlineIfo'][$i]['etd']; ?></span>
                                                    <span class="date"><?php $date=$result['airlineIfo'][$i]['date']; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                    </td>
                                                    <td class="arrive">
                                                    <span><?php echo $result['airlineIfo'][$i]['eta']; ?></span>
                                                    <span class="date"></span>
                                                    </td>
                                                    <td class="duration">
                                                    <span><?php 
                                                     echo getTimeDiff($result['airlineIfo'][$i]['etd'] , $result['airlineIfo'][$i]['eta']);
                                                    ?> </span>
                                                    </td>
                                                </tr>
                                                 <?php if($result['airlineIfo'][$i]['type'] == 'connecting'): ?>
                                                    <?php foreach ($result['airlineIfo'][$i]['connecting_flight'] as $key => $value): ?>
                                                        <tr>
                                                            <td class="route">
                                                                <ul>
                                                                    <li><?php echo $result['airlineIfo'][$i]['connecting_flight'][$key]['from'];?><i class="awe-icon awe-icon-arrow-right"></i></li>
                                                                    <li><?php echo $result['airlineIfo'][$i]['connecting_flight'][$key]['to'];?> <i class="awe-icon awe-icon-arrow-right"></i></li>                                                                    
                                                                </ul>
                                                            </td>
                                                            <td class="depart">
                                                             <span><?php echo $result['airlineIfo'][$i]['connecting_flight'][$key]['etd']; ?></span>
                                                               
                                                            </td>
                                                            <td class="arrive">
                                                                <span><?php echo $result['airlineIfo'][$i]['connecting_flight'][$key]['eta']; ?></span>
                                                                 <span class="date"><?php $date=$result['airlineIfo'][$i]['connecting_flight'][$key]['date']; echo date('d M', strtotime(str_replace('','', $date)));?></span>
                                                            </td>
                                                            <td class="duration">
                                                               <span><?php 
                                                             echo getTimeDiff($result['airlineIfo'][$i]['connecting_flight'][$key]['etd'] , $result['airlineIfo'][$i]['connecting_flight'][$key]['eta']);
                                                            ?> </span>
                                                            </td>                                                    
                                                        </tr>
                                                     <?php endforeach; ?>
                                               
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="item-price-more">
                                        <div class="price">
                                            <span class="amount"><?php echo $curr[$result['airlineIfo'][$i]['class'][0]->ccy]."".$result['airlineIfo'][$i]['class'][0]->price;?></span>
                                            exclude Fare
                                        </div>
                                        <a href="<?php echo site_url();?>flight-details" class="awe-btn">View details</a>
                                    </div>
                                </div>
                                <!-- END / ITEM -->
                            </div>
                            <?php } ?>

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
                    <?php $this->load->view('filters');?>
                </div>
            </div>
        </section>