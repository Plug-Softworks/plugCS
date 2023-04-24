<?php 
require_once __DIR__ .'/sms.php';

$receiver = @$_GET['phone'];
$msg  =  @$_GET['message'];
send_message($receiver, $msg);




?>