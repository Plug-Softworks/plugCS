<?php
// Save this code in checkBalance.php. Configure the callback URL for your phone number
// to point to the location of this script on the web
// e.g http://www.myawesomesite.com/checkBalance.php

// First read in a couple of POST variables passed in with the request

// This is a unique ID generated for this call
$sessionId = $_POST['sessionId'];
// Check to see whether this call is active
$isActive  = $_POST['isActive'];
    // The call is active
    if ($isActive == 1)  {
        // This is the First request we are receiving. Prompt for the account number
        // Compose the response
        $text = "Welcome to nairobi county sevices end all entries with hash, Press 1 for  emergency service,Press 2 for parking services,Press 3 for business permits,Press 4 for to report incidence, Press 5 for social services such as  hiring places";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

        header('Content-type: text/plain');
        echo $response;
    }

    // Print the response onto the page so that our gateway can read it
 
else {
    // Read in call details (duration, cost). This flag is set once the call is completed.
    // Note that the gateway does not expect a response in thie case

    $duration     = $_POST['durationInSeconds'];
    $currencyCode = $_POST['currencyCode'];
    $amount       = $_POST['amount'];

    // You can then store this information in the database for your records
}

