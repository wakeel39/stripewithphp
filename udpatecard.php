<?php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98xFvapdfNBTTH";
$cardid = "card_18qfRJKAlFhWIxuxIo47ApP9";
$name="wakeel";
$s = $stripe->UpdateCardDetail($cid, $cardid,$name);
print_r($s);
?>