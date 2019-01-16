<?php
	set_time_limit(180);
	include_once"class/curl.php";
	
	$curl		= new curl;
	 
	$post_data['akses_kode']= "9x6Vs0REJQR"; //isi disini
	$post_data['app'] ="flightint";
	//$post_data['action']="searchint";
	$post_data['action']="search_multi";
	$post_data['roundtrip'] = "return"; //oneway or return
	$post_data['from'] = "CGK";
	$post_data['to'] = "DPS";
	$post_data['depart'] = "2018-05-17";
	$post_data['return'] = "2018-05-18";
	$post_data['adult'] = "1";
	$post_data['child'] = "0";
	$post_data['infant']= "0";
	//$post_data['airline']= "1,2,3,4,5,6";

		
	foreach ($post_data as $key => $value) {
			$post_items[] = $key . '=' . $value;
	}
	$post_string= implode ('&', $post_items);
	$url		= "http://apidev.aeroticket.com/service/v2";
	$result		= $curl->post($url,$post_string);
	
	//print_r($result);
	$cResult	= json_decode($result);
	echo "<pre>";
	print_r($cResult);
?>
