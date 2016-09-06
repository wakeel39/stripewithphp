<?php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98xFvapdfNBTTH";
$cardid = "card_18qfRJKAlFhWIxuxIo47ApP9";
$s = $stripe->getCardDetail($cid, $cardid);
//all data
print_r($s["data"]);
//only id access
print_r($s["data"]->id);
?>