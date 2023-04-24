<?php 
  $text = "kindly select your Business category, Press 1 for General, Press 2 for Informal sector, Press 3 for Transport sector, Press 4 for agriculture";
  $response  = '<?xml version="1.0" encoding="UTF-8"?>';
  $response .= '<Response>';
  $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getBusinessDetails">';
  $response .= '<Say>';
  $response .= '<speak>';
  $response .= $text;
  $response .= '</speak>';
  $response .= '</Say>';
  $response .= '</GetDigits>';
  $response .= '</Response>';

?>

// $response .= '<Response>';
            // $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=finishEmergecy">';
            // $response .= '<Say playBeep="true">'.$text.'</Say>';
            // $response .= '</GetDigits>';
            // $response .= '<Record/>';
            // $response .= '</Response>';

            $text = "Kindly share your location and the emergency after  the tone , then press hash when done";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=finishEmergecy">';
            $response .= '<Say playBeep="true">'.$text.'</Say>';
            $response .= '</GetDigits>';
            $response .= '<Record/>';
            $response .= '</Response>';


            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
    $response .= '<Response>';
    $response .= '<Dial record="true" sequential="true" phoneNumbers="+254794940160"  />';
    $response .= '</Response>';