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
$pesoval = clean($_POST['pesoval']);
$id = clean($_POST['id']);

mysql_query("UPDATE other_bank_account SET bank_code='$bcode', bank_name='$bname', currency='$cur', account_num='$anum', debit='$deb', credit='$cred', balance='$balance', pesoval='$pesoval' WHERE id='$id'");
header("location: addotherbank.php");
?>