<?php
require_once('payment.php');
$stripe = new StripPayment();
$cid = "cus_98xFvapdfNBTTH";
$data = $stripe->getAllCards($cid);

?>
<table>
    <tr><td>id </td><td>exp_month</td><td>exp_year</td><td>last4</td></tr>
    <?php

    if(is_array($data["data"]->data) && count($data["data"]->data) > 0) {
        foreach ($data["data"]->data as $d) {
            echo "<tr><td>" . $d->id . "</td><td>" . $d->exp_month . "</td><td>" . $d->exp_year . "</td><td>" . $d->last4 . "</td></tr>";
        }
    }else
    {
        echo "<tr><td colspan='4'> Data Not Found</td></tr>";
    }
    ?>

</table>
