<?php
require_once('payment.php');
$stripe = new StripPayment();
$s = $stripe->getAllCustomers();
if($s["success"] == 1 ) {
    $data  = $s["data"]["data"];
}
else {
    $data  = $s["data"];
}
//print_r($data);

?>
<table>
    <tr><td>id </td><td>email</td><td>Descp</td></tr>
    <?php
    if(is_array($data) && count($data) > 0) {
        foreach ($data as $d) {
            echo "<tr><td>" . $d['id'] . "</td><td>" . $d['email'] . "</td><td>" . $d['description'] . "</td></tr>";
        }
    }else
    {
        echo "<tr><td colspan='4'> Data Not Found</td></tr>";
    }
    ?>

</table>
