<?php 

    // This is the second request from Africa's Talking
    // Save this code in getBalance.php. Configure the events URL for your phone number
    // to point to the location of this script on the web
    // e.g http://www.myawesomesite.com/getBalance.php

    // You can replace this array with an actual database table
    require_once __DIR__ .'/sms.php';
    require_once __DIR__ .'/obects/Stanbick.php';

    $stanbic = new Stanbic();
    $token =  $stanbic->getToken();   
    $balanceArr = array(
	    '1234' => 100,
		'1235' => 150,
		'1236' => 190,
	);

    // Read the dtmf digits
    $action = @$_GET['action'];
    $option = $_POST['dtmfDigits'];
    $recepient = $_POST['callerNumber'];



    if($action == "listemergencies"){       
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Dial   phoneNumbers="+254790175477"  />';
        $response .= '</Response>';
        

    }else if($action == "getparkingLocation"){
        $text = "your parking charges will amount  to  500 shilings,  press  1 to continue to payment, Press 2 to exit ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=finishparking">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
 
    }else if($action == "getBookingMonth"){ //allow user to enter date  
        $text = "enter the  month you would like to book the facility,  example use 1 for january ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getDate">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($action == "getDate"){ //allow user to enter date  
        $text = "enter  the date  you would like to book the facility example, enter value from 1 to 31 ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=finishGrounds">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($action == "getuseridNumber"){ //allow user to enter date  
        $text = "enter  your national ID number followed by a hash to continue";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=showApplicationFee">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($action == "showApplicationFee"){ //allow user to enter date  
        $text = "you will be required to pay 200 shillings to process your application, press 1 to continue,  press 2 to exit";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getBusinessCategory">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }
    
    
    
    else if($action == "finishGrounds"){ //allow user to enter date  
        $text = "your booking has been recorded sucessfuly you will get a confrimation status and how to make payment thank you ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>'.$text.'</Say>';
        $response .= '</Response>';
        send_message($recepient, "your booking has been received you will be sent a  confirmation message on its availability");

    }
    
    
    
    else if($action == "getWard"){
        $text = "kindly select your ward, Press 1 for mugumoini, Press 2 for South B, Press 3 for Nairobi West, Press 4 for south C";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getuseridNumber">';
        // $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getBusinessCategory">';

        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($action == "socialServices"){
        if($option == 1){ // couty grounds 
            $text = "kindly select a ground to hire   type, Press 1 to carniovore grounds  , Press 2 to hire Rama grounds, press 3 jakaranda grounds";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getBookingMonth">';
            $response .= '<Say>';
            $response .= '<speak>';
            $response .= $text;
            $response .= '</speak>';
            $response .= '</Say>';
            $response .= '</GetDigits>';
            $response .= '</Response>';

        }else if($option == 2){ //couty halls 
            $text = "kindly select a hall to hire   type, Press 1 to hire jericho , Press 2 to hire Tom mboya social hall, press 3 to hire kangemi hall";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getBookingMonth">';
            $response .= '<Say>';
            $response .= '<speak>';
            $response .= $text;
            $response .= '</speak>';
            $response .= '</Say>';
            $response .= '</GetDigits>';
            $response .= '</Response>';
    

        }else if($option == 3){ //couty stadium 
            $text = "kindly select a stadium  type, Press 1 to hire city stadium , Press 2 to hire Nyayo national stadium, press 3 to hire kasarani stadium";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getBookingMonth">';
            $response .= '<Say>';
            $response .= '<speak>';
            $response .= $text;
            $response .= '</speak>';
            $response .= '</Say>';
            $response .= '</GetDigits>';
            $response .= '</Response>';
    

        }   
        
        else{ 
            $text = "Thank you for conatacting Nairobi county services";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<Say>'.$text.'</Say>';
            $response .= '</Response>';

        }

    }   
    
    
    
    
    else if($action == "getBusinessCategory"){
        if($option == 1){ // user wants to continue  
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

        }else{ 
            $text = "Thank you for conatacting Nairobi county services";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<Say>'.$text.'</Say>';
            $response .= '</Response>';

        }

    }else if($action == "getBusinessDetails"){
        $text = "Kindly share your busines name and a brief description  after  the tone , then press hash when done";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=finishbusinessregistartiion">';
        $response .= '<Say playBeep="true">'.$text.'</Say>';
        $response .= '</GetDigits>';
        $response .= '<Record/>';
        $response .= '</Response>';


    }else if($action == "recordincidence"){
        $text = "Kindly share the incidence after  the tone , then press hash when done";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=finishIncidence">';
        $response .= '<Say playBeep="true">'.$text.'</Say>';
        $response .= '</GetDigits>';
        $response .= '<Record/>';
        $response .= '</Response>';


    }else if($action == "finishIncidence"){
        $text = "your Incidence  has been recorded successfully,  you will get a follow up message shortly";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>'.$text.'</Say>';
        $response .= '</Response>';
        send_message($recepient, "your incidence has been recorded, we will contact you shortly");



    }     
    
    else if($action == "finishbusinessregistartiion"){
        $text = "your application has been received, kindly complete by making payment immediatly after the call";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>'.$text.'</Say>';
        $response .= '</Response>';
        $amount = "10";
        send_message($recepient, "kindly make payment of Ksh12000 to city county paybill number 1248877, account number- enter your id number");




    }else if($action == "finishparking"){
        if($option == 1){ //couty grounds ..
            $text = "thank you for contacting nairobi county services you will get a message on how to make payment";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<Say>'.$text.'</Say>';
            $response .= '</Response>';
            send_message($recepient, "kindly make payment of 200 to city county parking paybill number 1248877, account number- enter your vehicle number plate");

        }else if($option == 2){
            $text = "Thank you for conatacting Nairobi county services";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<Say>'.$text.'</Say>';
            $response .= '</Response>';
            send_message($recepient, "kindly make payment of 200 to city county parking paybill number 1248877, account number- enter your vehicle number plate");


        }else{
            $text = "Thank you for conatacting Nairobi county services";
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<Say>'.$text.'</Say>';
            $response .= '</Response>';

        }
    }
    
    
    
    
    else if($option == 1){
        $text = "please select the type of emergency, press  1 for  ambulance  services, Press 2 for  firefighter, Press 3 for police services, ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=listemergencies">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
        // header('Content-type: text/plain');
        // echo $response;

    }else if($action == "finishEmergecy"){
        $text = "your Emergency has been recorded successfully you wil be contacted shortly";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>'.$text.'</Say>';
        $response .= '</Response>';

    }else if($option == 2){ //handling parking services ...
        $text = "kindly select a parking area, Press 1 for Langata, Press 2 for Kibera, Press 3 for Eastlands, Press 4 for Westlands, Press 5 for Kasarani, Press 6 for CBD";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getparkingLocation">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($option == 3){ //handling business permits ...
        $text = "kindly select your sub county, Press 1 for Langata, Press 2 for Kibera, Press 3 for Eastlands, Press 4 for Westlands, Press 5 for Kasarani, Press 6 for CBD";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=getWard">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($option == 4){ //report incidence 
        $text = "kindly select incidence type, Press 1 to report corruption act, Press 2 to get county intervention ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=recordincidence">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }else if($option == 5){ //report incidence 
        $text = "you are about to access the county social services, Press 1 to hire county grounds ,  Press 2 to hire county halls, press 3 to hire a stadium ";
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="http://4657-41-139-168-163.ngrok.io/mlo/emergencies.php?action=socialServices">';
        $response .= '<Say>';
        $response .= '<speak>';
        $response .= $text;
        $response .= '</speak>';
        $response .= '</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';

    }

    
    
   

    

    // Print the response onto the page so that our gateway can read it
    header('Content-type: text/plain');
    echo $response;

?>