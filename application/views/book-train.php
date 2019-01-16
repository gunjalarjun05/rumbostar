<!-- PRELOADER -->
<div class="preloader"></div>
<section class="product-detail hotel-booking-details">
	
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6 flight-booking-details">
                <div class="booking-details-container">
                <div class="flight-booking-head col-md-12 col-sm-12">
                    <h3>Depart Train</h3>
                </div>
                <div class="booking-flight-det col-md-12 col-sm-12">
                    <div class="content">
                        <div class="flight-pic"><img src="<?php echo site_url().ASSETS_IMAGES?>/flight/2.jpg"></div>
                        <div class="flight-name">
                            <p class="fl-name">KERETA KENCANG</p>
                            <p class="fl-economy">Economy</p>
                            <p class="fl-operated">Rp100000</p>
                        </div>
                    </div>
                </div>
                <div class="booking-flight-info col-md-12 col-sm-12">
                    <p class="flight-check-in"><span class="head">19:25 <br>Fri, 10 Feb</span><span>Jakarta (CGK) <br> Soekarno Hatta Intl Airport</span></p>
                    <p class="flight-check-out"><span class="head">05:55<br>Sat, 11 Feb</span><span>Amsterdam (AMS) <br> Schiphol</span></p>
                    
                </div>
            </div>
        </div>

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
                            <th class="w-150">Passenger Type</th>
                            <th class="w-150">Date of Birth</th>
                            
                          </tr>
                        </thead>
                        <tbody>
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
                            <td class="nationality w-150">
                                <select name="" class="select-sec">
                                    <option value="">Adult</option>
                                    <option value="">Child</option>
                                    <option value="">Infant</option>
                                </select>
                            </td>
                            <td class="date-of-birth w-150">
                                <span class="show-icon"><img src="<?php echo site_url().ASSETS_IMAGES?>/claendar.png" alt="" class="form-icon-img"></span>    
                                <input type="text" name="" placeholder="" class="awe-calendar"></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <div class="form-item sub-btn">
                        <button type="submit" name="hotelpay" value="pay">Make Payment</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
       
    </section>
