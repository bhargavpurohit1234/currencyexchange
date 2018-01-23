<?php
include('db.php');

//Function to sanitize values received from the form. Prevents SQL injection
function clean($str)
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc())
			{
			$str = stripslashes($str);
			}
		return mysql_real_escape_string($str);
	}
//Sanitize the POST values
$id = clean($_POST['id']);
$rate = clean($_POST['rate']);
$amount = clean($_POST['amount']);
$pesoval = $rate*$amount;

mysql_query("UPDATE report SET rate='$rate', amount='$amount', pesoval='$pesoval' WHERE id='$id'");
mysql_query("UPDATE transaction SET rate='$rate', amount='$amount', netconvert='$pesoval' WHERE transaction_nu='$gggg'");
header("location: masterfile.php");
?>