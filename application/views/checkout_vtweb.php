<html>
<head>
	<title>Checkout</title>
</head>
<body>
	<div style="padding-left: 10px;">
	<h1>Checkout</h1>
	 <input type="radio" id="p1" name="paytype" value="Paypal">Paypal<br>
     <input type="radio" id="p2" name="paytype" value="Midtrans">Midtrans<br>

     <input type="hidden" id="u1" value="<?php echo site_url()?>paypal_checkout" />
     <input type="hidden" id="u2" value="<?php echo site_url()?>vtweb_checkout" />

	<form action="" method="POST" id="paymentForm">
		
	<br><button class="btn btn-info" onclick="selectPayment();" type="button">Pay</button>
	</form>
</div>
</body>
</html>
<script type="text/javascript">
function selectPayment(){
if (document.getElementById('p1').checked) {
 document.getElementById('paymentForm').action = document.getElementById('u1').value;
 document.getElementById("paymentForm").submit();
} else if (document.getElementById('p2').checked) { 
 document.getElementById('paymentForm').action = document.getElementById('u2').value;
 document.getElementById("paymentForm").submit();
} else {
alert("Please select payment type.");	
}
}	
</script>
