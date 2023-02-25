<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
function call($phone, $phone2){
    $username = "edaktari";
    $apikey   = "2ac340bb0eee0916e8dee724caa5739381e8c17c20cf7f3e50accb0c2bf48ebd";

    // Initialize the SDK
    $AT       = new AfricasTalking($username, $apikey);

    // Get the voice service
    $voice    = $AT->voice();

    // Set your Africa's Talking phone number in international format
    $from     = "+254730731029";

    // Set the numbers you want to call to in a comma-separated list
    // $to       = $phone;
    $to = "$phone, $phone2";

    try {
        // Make the call
        $results = $voice->call([
            'from' => $from,
            'to'   => $to
        ]);

        print_r($results);
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }
}

call("+254794940160", "+254712261984");

?>