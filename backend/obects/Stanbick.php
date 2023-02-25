<?php 
class Stanbic{
    
    private $key;
    private $secret;
    
    public function __construct()
    {
        // tocken requirements
        $this->consumerKey     	 ="d6db259f210b964b80b4a4b6ac18b7d2";
        $this->consumerSecret    ="ac592d3fb6ce5093b3a732619a0cd024";
        // $this->credentials     	 = base64_encode($this->consumerKey.":".$this->consumerSecret);		
        // //process requirements		
        // $this->BusinessShortCode = 174379;
        // $this->Timestamp 		 = date("YmdGis");
        // $this->PartyA 			 = 600982;
        // $this->PartyB 			 = 600000;
        // $this->PhoneNumber       = "254794940160";
        // $this->CallBackURL       = "https://f20a-197-136-151-2.ngrok.io/connect-us-safaricom-api/callback.php?orderNumber=6";
        // $this->AccountReference  = 'CART001';
        // $this->TransactionDesc   = 'Cart Payment Online';		
        // $this->PassKey           = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        // $this->Password          = base64_encode($this->BusinessShortCode.$this->PassKey.$this->Timestamp);
        // $this->Amount 			 = "";
        // $this->curl   			 = "";
        // $this->response          = "";
        // $this->accessToken       = "";
        // $this->tockenString      = "";
        // $this->url  			 = "";
        
    }
    
    public function getToken(){
        
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
            CURLOPT_POSTFIELDS => 'client_id=a01479ca2e0bdee0510f29988e8e1130&client_secret=b54a9d817c8995e9cde7044bc22a9080&scope=payments&grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        
        $response = curl_exec($curl);
        $this->accessToken   	= json_decode($response);
        
        curl_close($curl);
        // echo $response;
        // die();
        return $this->accessToken->access_token;
        
        
    }
    
    public function makePayment($token, $phone, $amount){
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
                "billAccountRef": "0100010969764",
                "amount": "'.$amount.'",
                "mobileNumber": "'.$phone.'",
                "corporateNumber": "740757",
                "bankReferenceId": "REW21331DR5F1",
                "txnNarrative": "ttsteeeee"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ),
        ));
        
        $response       = curl_exec($curl);
        $information    	= json_decode($response);
        
        
        curl_close($curl);
        print_r($information );
        
    }


    // public function 
    
}


?>