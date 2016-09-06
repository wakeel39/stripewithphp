<?php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98xFvapdfNBTTH";
$s = $stripe->getCustomer($cid);
if($s["success"] == 1 ) { $data  = $s["data"]->getLastResponse()->json; }
else {
    $data  = $s["data"];
}
print_r($data["id"]);
?>