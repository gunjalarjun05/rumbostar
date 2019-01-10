<?php


//$url = 'http://localhost/abhijeet/curl/curldata.php';
$url = 'https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/mealplans/generate?diet=vegetarian&exclude=shellfish%2C+olives&targetCalories=2000&timeFrame=day';

       $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
   // curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Mashape-Key: VLnwtLFLEcmsh1uAeQuPgf14IDFvp1DxB1ejsnZgth5ONUAKYh',
    'Accept: application/json'
    ));

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '0'); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $body = curl_exec($ch);
    $info = curl_getinfo($ch);
    $error = curl_errno($ch);
     print_r('Curl error: ' . curl_error($ch));

    curl_close($ch); 
    print_r($body);
?>
