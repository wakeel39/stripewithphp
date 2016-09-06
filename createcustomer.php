<?php
require_once('payment.php');
$stripe = new StripPayment();
$email = "abdur@rehman.com";
$s = $stripe->CreateCustomer($email);
print_r($s);
?>