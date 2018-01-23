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
$mmmm = clean($_POST['pesoval']);

mysql_query("INSERT INTO other_bank_account (bank_code, bank_name, currency, account_num, debit, credit, balance, pesoval)
VALUES ('$bcode','$bname','$cur','$anum','$deb','$cred','$balance','$mmmm')");
header("location: addotherbank.php");
?>