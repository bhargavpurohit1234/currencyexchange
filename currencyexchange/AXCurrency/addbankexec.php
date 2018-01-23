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
$bcode = clean($_POST['bcode']);
$bname = clean($_POST['bname']);
$anum = clean($_POST['anum']);
$cur = clean($_POST['cur']);
$deb = clean($_POST['deb']);
$cred = clean($_POST['cred']);
$balance = clean($_POST['balance']);

mysql_query("INSERT INTO bank_account (bank_code, bank_name, currency, account_num, debit, credit, balance)
VALUES ('$bcode','$bname','$cur','$anum','$deb','$cred','$balance')");
header("location: banktransfer.php");
?>