<!-- PRELOADER -->
<div class="preloader"></div>
<!-- END / PRELOADER -->
<!-- Full Page Image Background Carousel Header -->
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
                   <img src="<?php echo site_url().ASSETS_IMAGES?>slide2.jpg" class="img-responsive">
                
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
               <img src="<?php echo site_url().ASSETS_IMAGES?>slide3.jpg" class="img-responsive">
               
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
    <!-- END / HERO SECTION -->
		<!-- SEARCH TABS -->
<!-- SEARCH TABS -->
        <section class="tabbing-main-section">
            <div class="container">
                <div class="awe-search-tabs tabs">
                    <ul>
                        <li>
                            <a href="#awe-search-tabs-1">
                                <i class="awe-icon awe-icon-plane"></i>
                                <span>Flights</span>
                            </a>
                        </li>
                         <li>
                            <a href="#awe-search-tabs-2">
                                <i class="awe-icon awe-icon-hotel"></i>
                                <span>Hotels</span>
                            </a>
                        </li>

                         <li>
                            <a href="#awe-search-tabs-3">
                                <i class="awe-icon awe-icon-train"></i>
                                <span>Trains</span>
                            </a>
                        </li>
                        
                    </ul>
                    <div class="awe-search-tabs__content tabs__content">
                                 <div id="awe-search-tabs-1" class="search-flight">
                            <!--<h2>Search Flights</h2>-->
                         <form class="form-field-section" id="flight-search-form" method="post" action="<?php echo site_url('service/flight'); ?>">
                                <div class="form-group">
                                    <div class="form-elements">
                                        <label>From :</label>
                                        <div class="form-item">
                                          <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>plan1.png" alt="" class="form-icon-img"></span>
                                            <input id="flight_from_id" name="flight_from" type="text" placeholder="Ho Chi Minh, Hanoi, Vietnam">
                                        </div>
                                    </div>

                                    <div class="form-elements refresh-serch">
                                       <div class="form-item">
                                            <a href="javascript:void(0);" title="Refresh" id="refresh-btn"><img src="<?php echo site_url().ASSETS_IMAGES?>refresh-img.png" alt="Refresh"></a>
                                        </div>
                                    </div>
                                   

                                    <div class="form-elements">
                                        <label>To :</label>
                                        <div class="form-item dist ">
                                           <span class="show-icon"> <img src="<?php echo site_url().ASSETS_IMAGES?>plan2.png" alt="" class="form-icon-img"></span>
                                            <input type="text" name="flight_to" id="flight_to_id" placeholder="Ankara, Turkey">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-elements">
                                        <label>Depart on :</label>
                                        <div class="form-item">
                                             <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img"></span>
                                            <input type="text" name="depart" class="awe-calendar depart-on" placeholder="Check in">
                                        </div>
                                    </div>

                                    <div class="form-elements check-field">
                                       <div class="form-vertical form-required">
                                         <label for="radio-one">
                                            <input type="radio" name="exampleRadios" id="radio-one" value="oneway"/>
                                            <i></i> <span>One-way</span> </label>
                                          <label for="radio-two">
                                            <input type="radio" name="exampleRadios" id="radio-two" value="return"/>
                                            <i></i> <span>Return</span> </label>
                                        </div>
                                    </div>


                                    <div class="form-elements">
                                        <label>Return on :</label>
                                        <div class="form-item">
                                         <span class="show-icon">  <img src="<?php echo site_url().ASSETS_IMAGES?>claendar.png" alt="" class="form-icon-img"></span>
                                            <input type="text" class="awe-calendar return-on" name="return" placeholder="Check out">
                                        </div>
                                    </div>
                                   
                                </div>
                               
                                <div class="form-group submit-result">
                                     <div class="form-elements">
                                        <label>No. of Passengers:</label>
                                       <div class="form-item">
                                        <div class="category-list">
                                            <div class="adults comm">
                                                <span class="bind-span"><img src="<?php echo site_url().ASSETS_IMAGES?>adult-icon.png">
                                                <select class="select_css" name="adult" id="adult_id">
                                                    <option value="">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                                </span>
                                                <p>Adults <small>12+ years</small></p>
                                            </div>

                                            <div class="child comm">
                                                <span class="bind-span"><img src="<?php echo site_url().ASSETS_IMAGES?>child-icon.png">
                                                <select class="select_css" name="child">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                                </span>
                                                <p>Child <small>2-12+ years</small></p>
                                            </div>

                                            <div class="infant comm">
                                               <span class="bind-span"> <img src="<?php echo site_url().ASSETS_IMAGES?>infant-icon.png">
                                                <select class="select_css" name="infant">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                                </span>
                                                <p>Infant <small><=23 moths</small></p>
                                            </div>

                                         </div>
                                        </div>
                                         </div>
                                    <div class="form-elements">
                                       <div class="form-item">
                                         <input type="submit" value="Search Flights" class="submit-button" name="searchflight">
                                         </div>
                                        </div>
                                   

                                   
                                </div>
                            </form>
                            <!--<div class="col-lg-12 promo">
                                <div class="col-lg-4 airpat"><a href="#">Airline Partners</a></div>
                                 <div class="col-lg-8 fligttic"><a href="#">Promo Flight Ticket</a></div>

                            </div>-->


                        </div>
                        <!-- first tab end here-->

                        <form class="form-field-section" id="hotel-search-form" method="post" action="<?php echo site_url('hotel'); ?>">
                        <div id="awe-search-tabs-2" class="search-flight-hotel search-flight">
                            <form>
                                <div class="form-group col-md-3 col-sm-3 dest">
                                    <div class="form-elements">
                                        <label>Destinations</label>
                                        <div class="form-item">
                                            <i class="awe-icon awe-icon-marker-1"></i>
                                            <input type="text" name="destination" value="country, city, airport...">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-3 check-in">
                                    <div class="form-elements">
                                        <label>Check in</label>
                                        <div class="form-item">
                                            <i class="awe-icon awe-icon-calendar"></i>
                                            <input type="text" name="checkin" class="awe-calendar" value="Date">
                                        </div>
                                    </div>
                                    <div class="form-elements col-md-3 col-sm-3 check-out">
                                        <label>Check out</label>
                                        <div class="form-item">
                                            <i class="awe-icon awe-icon-calendar"></i>
                                            <input type="text" name="checkout" class="awe-calendar" value="Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-3 guest">
                                    <div class="form-elements">
                                        <label>Guest</label>
                                        <div class="form-item">
                                            <select name="guest" class="awe-select select_css">
                                                <option>All types</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-3 hotel_sub_btn">
                                    <input type="submit" value="Find by Hotel" name="searchotel">
                                </div>                           
                        </div>
                        </form>

                         <!-- second tab end here-->

                        <div id="awe-search-tabs-3" class="search-flight">
                            <h2>Search Train...</h2>
                        </div>
                         <!-- thired tab end here-->
                        
                    </div>
                </div>
            </div>
        </section>

                        
                        <div id="awe-search-tabs-3" class="search-flight">
                            <h2>Search Train...</h2>
                            
                        </div>
                         <!-- thired tab end here-->
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- END / SEARCH TABS -->
 <!-- MASONRY -->
        <section class="masonry-section-demo">
            <div class="container">
                <div class="destination-grid-content">
                    <div class="section-title">
                        <h3>Why Book Your Flight With Rumbostar.com?</h3>
                    </div>
                    <div class="row">
                        <div class="awe-masonry">
                            <!-- GALLERY ITEM -->
                            <div class="awe-masonry__item col-lg-3">
                               
                                    <div class="image-wrap image-cover">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>img/1.jpg" alt="">
                                    </div>
                               
                                <div class="item-title">
                                   <div class="text">
                                    <h2><a href="#">Reason 1</a></h2>
                                    <div class="kode-blog-content">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s […]</p>
                                    </div>       
                                </div>
                                   
                                </div>
                               
                            </div>
                            <!-- END / GALLERY ITEM -->
                            <!-- GALLERY ITEM -->
                            <div class="awe-masonry__item col-lg-3">
                               
                                    <div class="image-wrap image-cover">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>img/2.jpg" alt="">
                                    </div>
                               
                                <div class="item-title">
                                   <div class="text">
                                    <h2><a href="#">Reason 2</a></h2>
                                    <div class="kode-blog-content">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s […]</p>
                                    </div>       
                                </div>
                                   
                                </div>
                                
                            </div>
                            <!-- END / GALLERY ITEM -->
                            <!-- GALLERY ITEM -->
                            <div class="awe-masonry__item col-lg-3">
                                
                                    <div class="image-wrap image-cover">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>img/3.jpg" alt="">
                                    </div>
                               
                                 <div class="item-title">
                                   <div class="text">
                                    <h2><a href="#">Reason 3</a></h2>
                                    <div class="kode-blog-content">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s […]</p>
                                    </div>       
                                </div>
                                   
                                </div>
                              
                            </div>
                            
                            <!-- END / GALLERY ITEM -->
                            <!-- GALLERY ITEM -->
                            <div class="awe-masonry__item col-lg-3">
                                
                                    <div class="image-wrap image-cover">
                                        <img src="<?php echo site_url().ASSETS_IMAGES?>img/4.jpg" alt="">
                                    </div>
                               
                                 <div class="item-title">
                                   <div class="text">
                                    <h2><a href="#">Reason 4</a></h2>
                                    <div class="kode-blog-content">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s […]</p>
                                    </div>       
                                </div>
                                   
                                </div>
                                
                            </div>
                            <!-- END / GALLERY ITEM -->
                            
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <!-- END / MASONRY --
<!-- END / MASONRY -->
<section class="sale-flights-section-demo">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 left-main-sitebar">
                        <div class="sale-flights-tabs tabs">
                            <ul>
                                <li><a href="#sale-flights-tabs-1">Flight Promo</a></li>
                                <li><a href="#sale-flights-tabs-2">Hotel Promo</a></li>
                                <li><a href="#sale-flights-tabs-3">Train Promo</a></li>
                            </ul>
                            <div class="sale-flights-tabs__content tabs__content">
                                <div id="sale-flights-tabs-1">
                                    
                                    <!-- ITEM -->
                                <div class="trip-item">
                                    <div class="item-media">
                                        <div class="image-cover">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip/2.jpg" alt="">
                                        </div>
                                        <div class="trip-icon">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="item-title">
                                            <h2>
                                                <a href="#">Spectacular City Views</a>
                                            </h2>
                                        </div>
                                        <div class="item-list">
                                            <ul>
                                                <li>4 Attractions</li>
                                                <li>2 days, 1 night</li>
                                            </ul>
                                        </div>
                                        <div class="item-footer">
                                            <div class="item-rate">
                                                <span>7.5 Good</span>
                                            </div>
                                            <div class="item-icon">
                                                <i class="awe-icon awe-icon-gym"></i>
                                                <i class="awe-icon awe-icon-car"></i>
                                                <i class="awe-icon awe-icon-food"></i>
                                                <i class="awe-icon awe-icon-level"></i>
                                                <i class="awe-icon awe-icon-wifi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-price-more">
                                        <div class="price">
                                            Adult ticket
                                            <ins>
                                                <span class="amount">$200</span>
                                            </ins>
                                            <del>
                                                <span class="amount">$200</span>
                                            </del>
                                    
                                        </div>
                                        <a href="#" class="awe-btn">Book now</a>
                                    </div>
                                </div>
                                <!-- END / ITEM -->
                                <!-- ITEM -->
                                <div class="trip-item">
                                    <div class="item-media">
                                        <div class="image-cover">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip/3.jpg" alt="">
                                        </div>
                                        <div class="trip-icon">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="item-title">
                                            <h2>
                                                <a href="#">Romantic New York</a>
                                            </h2>
                                        </div>
                                        <div class="item-list">
                                            <ul>
                                                <li>4 Attractions</li>
                                                <li>2 days, 1 night</li>
                                            </ul>
                                        </div>
                                        <div class="item-footer">
                                            <div class="item-rate">
                                                <span>7.5 Good</span>
                                            </div>
                                            <div class="item-icon">
                                                <i class="awe-icon awe-icon-gym"></i>
                                                <i class="awe-icon awe-icon-car"></i>
                                                <i class="awe-icon awe-icon-food"></i>
                                                <i class="awe-icon awe-icon-level"></i>
                                                <i class="awe-icon awe-icon-wifi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-price-more">
                                        <div class="price">
                                            Adult ticket
                                            <ins>
                                                <span class="amount">$200</span>
                                            </ins>
                                            <del>
                                                <span class="amount">$200</span>
                                            </del>
                                    
                                        </div>
                                        <a href="#" class="awe-btn">Book now</a>
                                    </div>
                                </div>
                                <!-- END / ITEM -->
                                <!-- ITEM -->
                                <div class="trip-item">
                                    <div class="item-media">
                                        <div class="image-cover">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip/4.jpg" alt="">
                                        </div>
                                        <div class="trip-icon">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="item-title">
                                            <h2>
                                                <a href="#">NYC Family Fun Pass - Winter</a>
                                            </h2>
                                        </div>
                                        <div class="item-list">
                                            <ul>
                                                <li>4 Attractions</li>
                                                <li>2 days, 1 night</li>
                                            </ul>
                                        </div>
                                        <div class="item-footer">
                                            <div class="item-rate">
                                                <span>7.5 Good</span>
                                            </div>
                                            <div class="item-icon">
                                                <i class="awe-icon awe-icon-gym"></i>
                                                <i class="awe-icon awe-icon-car"></i>
                                                <i class="awe-icon awe-icon-food"></i>
                                                <i class="awe-icon awe-icon-level"></i>
                                                <i class="awe-icon awe-icon-wifi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-price-more">
                                        <div class="price">
                                            Adult ticket
                                            <ins>
                                                <span class="amount">$200</span>
                                            </ins>
                                            <del>
                                                <span class="amount">$200</span>
                                            </del>
                                    
                                        </div>
                                        <a href="#" class="awe-btn">Book now</a>
                                    </div>
                                </div>
                                <!-- END / ITEM -->
                                <!-- ITEM -->
                                <div class="trip-item">
                                    <div class="item-media">
                                        <div class="image-cover">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip/5.jpg" alt="">
                                        </div>
                                        <div class="trip-icon">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="item-title">
                                            <h2>
                                                <a href="#">NYC Land &amp; Sea</a>
                                            </h2>
                                        </div>
                                        <div class="item-list">
                                            <ul>
                                                <li>4 Attractions</li>
                                                <li>2 days, 1 night</li>
                                            </ul>
                                        </div>
                                        <div class="item-footer">
                                            <div class="item-rate">
                                                <span>7.5 Good</span>
                                            </div>
                                            <div class="item-icon">
                                                <i class="awe-icon awe-icon-gym"></i>
                                                <i class="awe-icon awe-icon-car"></i>
                                                <i class="awe-icon awe-icon-food"></i>
                                                <i class="awe-icon awe-icon-level"></i>
                                                <i class="awe-icon awe-icon-wifi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-price-more">
                                        <div class="price">
                                            Adult ticket
                                            <ins>
                                                <span class="amount">$200</span>
                                            </ins>
                                            <del>
                                                <span class="amount">$200</span>
                                            </del>
                                    
                                        </div>
                                        <a href="#" class="awe-btn">Book now</a>
                                    </div>
                                </div>
                                <!-- END / ITEM -->
                                <!-- ITEM -->
                                <div class="trip-item">
                                    <div class="item-media">
                                        <div class="image-cover">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip/1.jpg" alt="">
                                        </div>
                                        <div class="trip-icon">
                                            <img src="<?php echo site_url().ASSETS_IMAGES?>trip.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="item-body">
                                        <div class="item-title">
                                            <h2>
                                                <a href="#">Spectacular City Views</a>
                                            </h2>
                                        </div>
                                        <div class="item-list">
                                            <ul>
                                                <li>4 Attractions</li>
                                                <li>2 days, 1 night</li>
                                            </ul>
                                        </div>
                                        <div class="item-footer">
                                            <div class="item-rate">
                                                <span>7.5 Good</span>
                                            </div>
                                            <div class="item-icon">
                                                <i class="awe-icon awe-icon-gym"></i>
                                                <i class="awe-icon awe-icon-car"></i>
                                                <i class="awe-icon awe-icon-food"></i>
                                                <i class="awe-icon awe-icon-level"></i>
                                                <i class="awe-icon awe-icon-wifi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-price-more">
                                        <div class="price">
                                            Adult ticket
                                            <ins>
                                                <span class="amount">$200</span>
                                            </ins>
                                            <del>
                                                <span class="amount">$200</span>
                                            </del>
                                    
                                        </div>
                                        <a href="#" class="awe-btn">Book now</a>
                                    </div>
                                </div>
                                <!-- END / ITEM -->
                                </div>
                                <div id="sale-flights-tabs-2">
                                <div class="col-md-12">
                                   <h2>Coming Soon.........</h2>
                                </div>
                                

                                </div>
                                <!-- sECOND TAB-->
                                <div id="sale-flights-tabs-3">
                                <div class="col-md-12">
                                    <h2>Coming Soon.........</h2>
                                   
                                </div>
                                

                                </div>
                                <!--Threed tab -->
                            </div>
                        </div>
                    </div>

                    <div class="awe-services col-lg-4 patner-sect  right-main-sitebar">
                       <div class="col-md-12">
                                    <h2>Official Airline Partners</h2>
                                    <ul class="patnr-listing">
                                        <li><a href="#" alt="Air Asia" title="Air Asia"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline1.png" alt="Air Asia" title="Air Asia"></a></li>
                                             <li><a href="#" alt="Batik Air" title="Batik Air"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline2.png" alt="Batik Air" title="Batik Air"></a></li>
                                               <li><a href="#" alt="Citilink" title="Citilink"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline3.png" alt="Citilink" title="Citilink"></a></li>
                                                 <li><a href="#" alt="Garuda Indonesia" title="Garuda Indonesia"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline4.png" alt="Garuda Indonesia" title="Garuda Indonesia"></a></li>
                                                   <li><a href="#" alt="Lion Air" title="Lion Air"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline5.png"></a></li>
                                                     <li><a href="#" alt="Sriwijaya Air" title="Sriwijaya Air"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline6.png" alt="Sriwijaya Air" title="Sriwijaya Air"></a></li>
                                                       <li><a href="#" alt="Wings Air" title="Wings Air"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/Airline7.png" alt="Wings Air" title="Wings Air"></a></li>
                                                         
                                            <li class="viewmore"> <a href="#">View More</a></li>
                                          
                                      </ul>  
                                   
                                </div>
                            <div class="col-md-12 payment-pat">
                                    <h2>Payment Partners</h2>
                                    <ul class="patnr-listing">
                                        <li class=""><a href="#" alt="ATM Bersama" title="ATM Bersama"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/5.png"  alt="ATM Bersama" title="ATM Bersama"></a></li>
                                        <li class=""><a href="#" alt="BCA KlikPay" title="BCA KlikPay"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/6.png"  alt="BCA KlikPay" title="BCA KlikPay"></a></li>
                                        <li class=""><a href="#" alt="CIMB Clicks" title="CIMB Clicks"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/7.png" alt="CIMB Clicks" title="CIMB Clicks"></a></li>
                                        <li class=""><a href="#" alt="Mandiri clickpay" title="Mandiri clickpay"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/8.png"alt="Mandiri clickpay" title="Mandiri clickpay"></a></li>
                                        <li class=""><a href="#" alt="IB Muamalat" title="IB Muamalat"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/9.png" alt="IB Muamalat" title="IB Muamalat"></a></li>
                                        <li class=""><a href="#" alt="Visa / Master Card" title="Visa / Master Card"><img src="<?php echo site_url().ASSETS_IMAGES?>flight/10.png" alt="Visa / Master Card" title="Visa / Master Card"></a></li>
                                       <li class="viewmore"> <a href="#" alt="View More" title="View More">View More</a></li>
                                          
                                      </ul> 
                                </div>

                    </div>
                    
                </div>
            </div>
        </section>
