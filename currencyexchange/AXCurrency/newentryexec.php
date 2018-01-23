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
$tdate = clean($_POST['tdate']);
$bname = clean($_POST['bname']);
$tnum = clean($_POST['tnum']);
$deb = clean($_POST['deb']);
$cred = clean($_POST['cred']);
$remarks = clean($_POST['remarks']);
$result = mysql_query("SELECT * FROM bank_account WHERE bank_name='$bname'");
				while($row = mysql_fetch_array($result))
					{
					$bcode=$row['account_num'];
					}

mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, account_num, remarks)
VALUES ('$tnum','$tdate','$deb','$cred','$bname','$bcode','$remarks')");
header("location: debitcredit.php");
?>