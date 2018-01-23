<?php
include('db.php');
$id=$_GET['id'];
$resulti = mysql_query("SELECT * FROM transaction WHERE transaction_nu='$id'");
while($rowi = mysql_fetch_array($resulti))
{
echo $rowi['serial'].', ';
}
?>