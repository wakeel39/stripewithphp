<?php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98vCSftcTqXrgH";
$desc= "this is new description for update ";
$s = $stripe->UpdateCustomer($cid,$desc);
if($s["success"] == 1 ) { $data  = $s["data"]->getLastResponse()->json; }
else {
    $data  = $s["data"];
}
print_r($data);
?>