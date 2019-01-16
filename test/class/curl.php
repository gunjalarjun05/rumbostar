<?php
class curl {

	function post($url='',$data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'AT2-JSN');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, '120');
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		if($result === false)
		{
			return curl_error($ch);
		}
		else
		{
			return $result;
		}
		curl_close($ch);
	}
}
?>