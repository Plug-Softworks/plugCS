<?php
require './vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

function send_message($recepient, $message){


// $farmer = $_GET['recepient'];
// $message  = $_GET['client'];


set_include_path(get_include_path() . PATH_SEPARATOR . '/usr/share/php');


// Set your app credentials
$username   = "edaktari";
$apiKey     = "2ac340bb0eee0916e8dee724caa5739381e8c17c20cf7f3e50accb0c2bf48ebd";

// Initialize the SDK
$AT         = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms        = $AT->sms();

// Set the numbers you want to send to in international format
$recipients = $recepient;

// Set your message
$message    = $message;

// Set your shortCode or senderId
$from       = $AT->sms();

try {
    // Thats it, hit send and we'll take care of the rest
    $result = $sms->send([
        'to'      => $recipients,
        'message' => $message,
        'from'    => $from
    ]);

    print_r($result);
} catch (Exception $e) {
    // echo "Error: ".$e->getMessage();
}
}


?>