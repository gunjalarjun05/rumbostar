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
<tr><td><span>Order Number:</span></td><td><span><?php echo $result->order_id;?></span></td></tr>
<tr><td><span>Transaction Id:</span></td><td><span><?php echo $result->transaction_id;?></span></td></tr>
<tr><td><span>Transaction Status:</span></td><td><span><?php echo $result->transaction_status;?></span></td></tr>
<tr><td><span>Payment Type:</span></td><td><span><?php echo $result->payment_type;?></span></td></tr>	
<tr><td><span>Amount:</span></td><td><span><?php echo $result->gross_amount;?></span></td></tr>	
</table>
</div>
</div>
</section>

