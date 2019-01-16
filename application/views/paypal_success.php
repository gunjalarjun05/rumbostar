<div class="preloader"></div>
<section class="product-detail hotel-success-msg">
    <div class="container">
        <div class="col-md-12 col-sm-12">
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
    text-align: left;
}
</style>
<table>
<tr><th colspan="2" style="text-align: center;">Transaction Details</th></t>
<tr><td><span>Customer Name:</span><span></td><td><?php echo $result['item_name'];?></span></td></tr>	
<tr><td><span>Mobile:</span></td><td><span><?php echo $result['item_number'];?></span></td></tr>	
<tr><td><span>Email Id:</span></td><td><span><?php echo $result['cm'];?></span></td></tr>	
<tr><td><span>Transaction Id:</span></td><td><span><?php echo $result['tx'];?></span></td></tr>	
<tr><td><span>Status:</span></td><td><span><?php echo $result['st'];?></span></td></tr>	
<tr><td><span>Currency:</span></td><td><span><?php echo $result['cc'];?></span></td></tr>	
<tr><td><span>Amount:</span></td><td><span><?php echo $result['amt'];?></span></td></tr>	
</table>
</div>
</div>
</section>

