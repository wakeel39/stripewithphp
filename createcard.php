<?php
//createcard.php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98xFvapdfNBTTH";
$data =array();
$data["exp_month"]=9;
$data["exp_year"]=2017;
$data["number"]="4242424242424242";
$data["cvc"]="314";
$s = $stripe->CreateCardofCustomer($cid,$data);
print_r($s);
?>