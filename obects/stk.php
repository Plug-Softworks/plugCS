<?php
class Stanbic
{
	private $url;
	private $consumerKey;
	private $consumerSecret;
	private $credentials;
	private $BusinessShortCode;
	private $Timestamp ;
	private $PartyA ;
	private $PartyB ;
	private $PhoneNumber;
	private $CallBackURL;
	private $AccountReference;
	private $TransactionDesc;
	private $Amount;
	private $PassKey;
	private $Password;
	private $curl;
	private $response;
	private $accessToken;
	private $tockenString;
	public function __construct()
	{
		// tocken requirements
		$this->consumerKey     	 ="DYxethm1EkJW5tm5R9jicimDmDdyhzqq";
		$this->consumerSecret    ="Jefi2yFGf5Rb6pSw";
		$this->credentials     	 = base64_encode($this->consumerKey.":".$this->consumerSecret);		
		//process requirements		
		$this->BusinessShortCode = 174379;
		$this->Timestamp 		 = date("YmdGis");
		$this->PartyA 			 = 600982;
		$this->PartyB 			 = 600000;
		$this->PhoneNumber       = "254794940160";
		$this->CallBackURL       = "https://f20a-197-136-151-2.ngrok.io/connect-us-safaricom-api/callback.php?orderNumber=6";
		$this->AccountReference  = 'CART001';
		$this->TransactionDesc   = 'Cart Payment Online';		
		$this->PassKey           = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
		$this->Password          = base64_encode($this->BusinessShortCode.$this->PassKey.$this->Timestamp);
		$this->Amount 			 = "";
		$this->curl   			 = "";
		$this->response          = "";
		$this->accessToken       = "";
		$this->tockenString      = "";
		$this->url  			 = "";

	}
	public function get_access_tocken()
	{
		$this->url 			   = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';		
		$this->curl 		   = curl_init();
		$this->credentials     = base64_encode($this->consumerKey.":".$this->consumerSecret);
		curl_setopt($this->curl, CURLOPT_URL, $this->url);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$this->credentials));
		curl_setopt($this->curl, CURLOPT_HEADER,false);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		$this->response   		= curl_exec($this->curl);
		$this->accessToken   	= json_decode($this->response);
		// print_r($this->accessToken);
		// die();
		$this->tockenString  	= $this->accessToken->access_token;
		return $this->tockenString;
	}
	public function stk_push($accessToken, $amaunt, $PhoneNumber)
	{
		$this->Amount = $amaunt;
		$this->accessToken = $accessToken;
		$this->url = 'https://sandbox.safaricom.co.ke/stanbic/stkpush/v1/processrequest';
		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_URL, $this->url);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization:Bearer '.$this->accessToken));
		$post_data = array(
			"BusinessShortCode" => $this->BusinessShortCode,
			"Password" => $this->Password,
			"Timestamp"=> $this->Timestamp,
			"TransactionType" => "CustomerPayBillOnline",
			"Amount" => $this->Amount,
			"PartyA" => $this->PartyA,
			"PartyB"=> $this->BusinessShortCode,
			"PhoneNumber" => $this->PhoneNumber,
			"CallBackURL" => $this->CallBackURL,
			"AccountReference" => $this->AccountReference,
			"TransactionDesc" => $this->TransactionDesc
		);
		$data_string           = json_encode($post_data);

		curl_setopt($this->curl, CURLOPT_POST,1);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		$this->response       = curl_exec($this->curl);
		return $this->response;
	}
}
$stanbic = new Stanbic();
$tocken = $stanbic->get_access_tocken();
$message = $stanbic->stk_push($tocken, 1, "0794940160");
print($message);

?>