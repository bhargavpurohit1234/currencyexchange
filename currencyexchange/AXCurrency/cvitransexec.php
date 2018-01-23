<?php
require_once('auth.php');
include('db.php');

function clean($str)
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc())
			{
			$str = stripslashes($str);
			}
		return mysql_real_escape_string($str);
	}
$amount= clean($_POST['amount']);
$fddd= clean($_POST['fddd']);
$tddd= clean($_POST['tddd']);
$rem='from '.$fddd;
function createRandomPassword() {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;
}
$finalcode='BS-'.createRandomPassword();
$da=date("Y-m-d");
$resultx = mysql_query("SELECT * FROM other_bank_account WHERE bank_code='$tddd'");
				while($rowx = mysql_fetch_array($resultx))
					{
					$tttttt=$rowx['currency'];
					}
$resultxs = mysql_query("SELECT * FROM rates WHERE currency='$tttttt'");
				while($rowxs = mysql_fetch_array($resultxs))
					{
					$jkjk=$rowxs['rate'];
					}
$fdbn=$amount*$jkjk;
mysql_query("UPDATE bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount' WHERE bank_code='$tddd'");
mysql_query("UPDATE bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount' WHERE bank_code='$fddd'");
mysql_query("UPDATE other_bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount', pesoval=pesoval+'$fdbn' WHERE bank_code='$tddd'");
mysql_query("UPDATE other_bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount', pesoval=pesoval-'$fdbn' WHERE bank_code='$fddd'");
mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$finalcode','$da','$amount','0','$tddd','$rem','$amount')");
header("location: home.php");
?>