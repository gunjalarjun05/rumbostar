<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rumbostar</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
<style type="text/css">
.Robotofont {font-family: 'Roboto', sans-serif;}
</style>

</head>
<body class="Robotofont">
  <div class="email-template">
    <div class="bg_wrapp" style="width: 600px; height: auto; min-height: 300px; float: left; background-color: #fff; border: 1px solid #f2f2f2; box-shadow: 2px 2px 4px #eee; padding: 10px 0px; margin: 20px 0px;">
      <!-- header-top-strip-start -->
      <div class="top-strip" style="width: 100%; height: auto; min-height: 40px; background-color: #fff; float: left; margin-bottom: 10px;">

      <div class="top-strip-data" style="width: 100%; height: auto; float: left; text-align: center;">
         <img src="<?php echo site_url();?>assets/images/logo-main.png" alt="logo" style="width: auto; height: auto; margin: 10px auto;">

      </div>

      </div>
      <!-- header-top-strip-end -->

      <!-- header-start -->
      <div class="header" style="width: 100%; height: auto; min-height: 40px; padding: 3px 0px; background-color: #000; float: left;">

          <div class="header-data" style="width: 100%;height:auto;float:left; ">
          <!-- white-line -->
          <div class="white-line" style="width: 100%; height: 2px; background-color: #fff; float: left;">
          </div><!-- white-line end-->

          <div class="heading-data" style="width: 100%; height: auto; min-height: 30px; background-color: rgb(0, 0, 0); float: left; color: rgb(255, 255, 255); font-size: 24px; line-height: 30px; text-align: center; padding: 5px 0px 10px;"> 
            Contactus Details
          </div>

          <!-- white-line -->
          <div class="white-line" style="width: 100%; height: 2px; background-color: #fff; float: left;">
          </div><!-- white-line end-->

          </div>
      </div>
      <!-- header-end -->


<!--email-text-data -->
<div class="email-text" style="width: 100%; height: auto; min-height: 40px; float: left;">
<div style="width: 100%; height: auto; min-height: 40px; float: left; padding: 10px 21px;">
 <div style="min-height: 40px; padding: 10px 28px 20px; background-color: rgb(255, 255, 255); float: left; border-image: none; width: 87%; text-align: left;"> 
   <!--<div style="width: 100%;height: auto;min-height: 20px;float: left;">
         <div style="width: 100%;height: auto;min-height: 20px;float: left;">
          Hi, 
         </div>
         <div style="width: 100%;height: auto;min-height: 20px;float: left;margin-bottom: 10px;">  
           <b style="font-size: 16px;"><?php echo (isset($to) && $to !='') ? $to:'';?> </b>
         </div>

        </div>-->
        <div style="width: 100%; height: auto; min-height: 40px; float: left;">
         <div style="width: 100%; height: auto; min-height: 20px; float: left; margin-bottom: 5px; ">
          <?php echo (isset($welcomemsg) && $welcomemsg !='') ? $welcomemsg:'';?>
         </div>
        <!-- <div style="width: 100%;height: auto;min-height: 40px;float: left;margin-bottom: 10px;">  
           <b style="font-size: 16px;"> October 1, 2016 - October 4, 2016 </b>
         </div>-->
        </div>
        <?php if(isset($mailInfoKey) && $mailInfoKey !='' && count($mailInfoKey)>0): ?>
          <?php if(isset($midelHeader) && $midelHeader !=''):?>
          <div style="width: 100%;height: auto;min-height: 20px;float: left;margin-bottom: 5px;">
            <div style="font-size: 20px;text-transform: uppercase;"><?php echo (isset($midelHeader) && $midelHeader !='') ? $midelHeader:'';?></div>
            <br>
          </div>        
        <?php endif;?>
          <?php foreach($mailInfoKey as $key=>$result): ?>
          <div style="width: 100%;height: auto;min-height: 20px;float: left;margin-bottom: 5px;">
            <div style="font-size: 14px;width: auto;float: left;padding-right: 5px;"> <?php echo (isset($key) && $key!='')? str_replace('_',' ',$key):'';?> :</div>
            <span style="font-size: 14px;"> <?php echo (isset($result) && $result!='')?$result:'';?></span> <br>
          </div>
          <?php endforeach; ?>
        <?php endif; ?> 

         <div style="width: 100%;height: auto;min-height: 20px;float: left;">
          <?php echo (isset($footerMsg) && $footerMsg !='') ? $footerMsg:'';?>
         </div>  
        <div style="width: 100%;height: auto;min-height: 40px;float: left;">           
            <div style="width: 100%;height: auto;float: left;">
            <strong>Kind regards,</strong>
            </div>
            <div style="width: 100%;height: auto;float: left;">
             <strong>The Rumbostar Management Team</strong>
            </div>
            <div style="width: 100%;height: auto;float: left;">
            </div>
            <br>
            <a href="<?php echo site_url();?>">
              <?php echo site_url();?>
            </a>
        </div>

    </div>

</div>
</div>
<!--email-text-data end-->

<!-- envolope-bg-wrapper-start -->
<div class="envolop-bg" style="width: 100%; float: left; margin-top: 0px; background: rgb(0, 0, 0) none repeat scroll 0% 0%; padding: 15px 0px;">
   <!-- contact-data -->
   <div class="contact-data" style="width: 100%; height: auto; float: left; padding-top: 0px;">
     <!-- adress -->
     <div style="width: 100%;height: auto;float: left;"></div>
     <!-- adress -->
     <!-- social -->
     <div style="width: 100%;height: auto;float: left;">
      <div style="width: 160px;height: auto;float: none;margin: 0px auto;">
         <div style="width: 40px;height: 40px;float: left;margin: 0px auto;margin-left: 10px;">   
         </div>
      </div>       
     </div>
     <!-- social-end -->
   </div>
   <!-- contact-data -->
</div>

<!-- envolope-bg-wrapper-end -->

<div class="clearfix"></div>
</div>
<!-- bg-wrapp-end -->

</div>
<!-- jQuery -->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="Hello World"></script>

</body>
</html>
