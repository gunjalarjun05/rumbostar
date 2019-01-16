<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Library Name : Social_media
	Description	: This library containg social media login,sharing post using php sdk and restfull api
*/
include_once(APPPATH."third_party/midtrans/Veritrans.php"); 

class Midtrans{
	var $CI;
	public function __construct(){
		 $this->CI =& get_instance();
		  $this->CI->load->library('session');

		  
	}

	public function pay($data){
		
		Veritrans_Config::$serverKey = MIDTRANS_SERVER_KEY;
		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => 145000, // no decimal allowed for creditcard
		);

// Optional
		$item1_details = array(
			'id' => 'a1',
			'price' => 50000,
			'quantity' => 2,
			'name' => "Apple"
			);

// Optional
		$item2_details = array(
			'id' => 'a2',
			'price' => 45000,
			'quantity' => 1,
			'name' => "Orange"
			);

// Optional
		$item_details = array ($item1_details, $item2_details);

// Optional
		$billing_address = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'address'       => "Mangga 20",
			'city'          => "Jakarta",
			'postal_code'   => "16602",
			'phone'         => "081122334455",
			'country_code'  => 'IDN'
			);

// Optional
		$shipping_address = array(
			'first_name'    => "Obet",
			'last_name'     => "Supriadi",
			'address'       => "Manggis 90",
			'city'          => "Jakarta",
			'postal_code'   => "16601",
			'phone'         => "08113366345",
			'country_code'  => 'IDN'
			);

// Optional
		$customer_details = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'email'         => "andri@litani.com",
			'phone'         => "081122334455",
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
			);

// Fill transaction details
		$transaction = array(
			'transaction_details' => $transaction_details,
			'customer_details' => $customer_details,
			'item_details' => $item_details,
			);

		try {
  // Redirect to Veritrans VTWeb page
			header('Location: ' . Veritrans_VtWeb::getRedirectionUrl($transaction));
		}
		catch (Exception $e) {
			echo $e->getMessage();
			if(strpos ($e->getMessage(), "Access denied due to unauthorized")){
				echo "<code>";
				echo "<h4>Please set real server key from sandbox</h4>";
				echo "In file: " . __FILE__;
				echo "<br>";
				echo "<br>";
				echo htmlspecialchars('Veritrans_Config::$serverKey = \'<your server key>\';');
				die();
			}

		}

	}		

}
