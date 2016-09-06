<?php
//createpayment.php
require_once('payment.php');
$stripe = new StripPayment();
$data = array();
$data["amount"]= "200";
$data["customer"]= "cus_98xFvapdfNBTTH";
$data["card"]= "card_18qfRJKAlFhWIxuxIo47ApP9";
$s = $stripe->CreatePayment($data);
print_r($s);
?>