<?php
include('db.php');
require_once('auth.php');
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
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
$transactiontype= clean($_POST['transactiontype']);
$sourceoffund= clean($_POST['sourceoffund']);
$gffg= clean($_POST['transaction']);
$currency= clean($_POST['currency']);
$modeoftrans= clean($_POST['modeoftrans']);
$amount = clean($_POST['amount']);
$cusname = clean($_POST['amots']);
$currency = clean($_POST['currency']);
$serial = clean($_POST['serial']);
$bname = clean($_POST['bname']);
$da=date("Y-m-d");
$brach=$_SESSION['SESS_LAST_NAME'];
$resultf = mysql_query("SELECT * FROM transaction where transaction_nu='$gffg' and serial='$serial'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['cusname'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'Duplicate Serial Number';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: transaction.php?modeofpayment=$modeoftrans&currency=$currency");
	exit();
	}
	}
	}
$result = mysql_query("SELECT * FROM rates where currency='$currency'");
while($row = mysql_fetch_array($result))
	{
		if ($transactiontype=='Buy'){
		$cur=$row['buyrate'];
		}
		if ($transactiontype=='Sell'){
		$cur=$row['rate'];
		}
	}
$total=$amount*$cur;
if(($currency=='USD') && ($bname!=''))
	{
		if($transactiontype=='Buy'){
		$rem = clean($_POST['remarks']);
		mysql_query("UPDATE bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount' WHERE bank_code='$bname'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','$amount','0','$bname','$rem','$total')");
//mysql_query("UPDATE bank_account SET debit=debit, credit=credit+$total, balance=balance+(debit-credit) WHERE bank_name='$sourceoffund'");
		}
		if($transactiontype=='Sell'){
		$rem = clean($_POST['remarks']);
		mysql_query("UPDATE bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount' WHERE bank_code='$bname'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','0','$amount','$bname','$rem','$total')");
//mysql_query("UPDATE bank_account SET debit=debit+$total, credit=credit, balance=balance+(debit-credit) WHERE bank_name='$sourceoffund'");
		}
	}
if(($currency!='USD') && ($bname!='')){
if($transactiontype=='Buy'){
		$rem = clean($_POST['remarks']);
		mysql_query("UPDATE other_bank_account SET debit=debit+$amount, credit=credit+0, balance=balance+'$amount', pesoval=pesoval+'$total' WHERE bank_code='$bname'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','$amount','0','$bname','$rem','$total')");
		}
		if($transactiontype=='Sell'){
		$rem = clean($_POST['remarks']);
		mysql_query("UPDATE other_bank_account SET debit=debit+0, credit=credit+$amount, balance=balance-'$amount', pesoval=pesoval-'$total' WHERE bank_code='$bname'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$gffg','$da','0','$amount','$bname','$rem','$total')");
		}
}
mysql_query("INSERT INTO transaction (transaction_nu, amount, currency, rate, serial, netconvert, cusname, trans_type, pitsa, mode, branch)
VALUES ('$gffg','$amount','$currency','$cur','$serial','$total','$cusname','$transactiontype','$da','$modeoftrans','$brach')");
header("location: transaction.php?modeofpayment=$modeoftrans&currency=$currency");
?>