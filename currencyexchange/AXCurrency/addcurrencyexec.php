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
$currency = clean($_POST['currency']);
$dfdfdf = clean($_POST['currency_name']);
$rate = clean($_POST['rate']);
$brate = clean($_POST['brate']);

mysql_query("INSERT INTO rates (currency, rate, buyrate, name)
VALUES ('$currency','$rate','$brate','$dfdfdf')");
header("location: editrates.php");
?>