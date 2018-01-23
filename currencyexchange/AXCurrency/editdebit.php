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
$tdate = clean($_POST['tdate']);
$bname = clean($_POST['bname']);
$tnum = clean($_POST['tnum']);
$deb = clean($_POST['deb']);
$cred = clean($_POST['cred']);
$remarks = clean($_POST['remarks']);
mysql_query("UPDATE bank_transfer SET trn_num='$tnum', date='$tdate', debit='$deb', credit='$cred', bank_name='$bname', remarks='$remarks' WHERE id='$id'");
header("location: debitcredit.php");
?>