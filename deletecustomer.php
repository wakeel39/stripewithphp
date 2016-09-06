<?php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98vCSftcTqXrgH";
$s = $stripe->DeleteCustomer($cid);
print_r($s);
?>