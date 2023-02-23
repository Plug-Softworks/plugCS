<?php 
function makePayment($phone, $amount){

$consumerKey     	 ="fd5c2bdacf33356542fb1c371c0f89e1";
$consumerSecret    ="f0e1463763d23f369a2b85c090d6c18d";
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.connect.stanbicbank.co.ke/api/sandbox/auth/oauth2/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'client_id=fd5c2bdacf33356542fb1c371c0f89e1&client_secret=f0e1463763d23f369a2b85c090d6c18d&scope=payments&grant_type=client_credentials',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
    ),
));




$response = curl_exec($curl);
$accessToken   	= json_decode($response);
// print($accessToken->access_token);
curl_close($curl);



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.connect.stanbicbank.co.ke/api/sandbox/mpesa-checkout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"dbsReferenceId": "REW21331DR5F1",
"billAccountRef": "3333562174",
"amount": "'.$amount.'",
"mobileNumber": "'.$phone.'",
"corporateNumber": "740757",
"bankReferenceId": "REW21331DR5F1",
"txnNarrative": "ttsteeeee"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$accessToken->access_token,
    'Content-Type: application/json'
  ),
));

$response       = curl_exec($curl);
$information    	= json_decode($response);


curl_close($curl);
print_r($information );
}

makePayment('254712471091', '1.00');
?>