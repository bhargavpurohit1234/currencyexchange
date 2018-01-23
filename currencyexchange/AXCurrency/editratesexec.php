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
$brate = clean($_POST['brate']);

mysql_query("UPDATE rates SET rate='$rate', buyrate='$brate' WHERE id='$id'");
header("location: editrates.php");
?>