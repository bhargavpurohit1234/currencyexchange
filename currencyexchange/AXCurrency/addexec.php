<?php
require_once('auth.php');
include('db.php');
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
$fname = clean($_POST['fname']);
$lname = clean($_POST['lname']);
$mname = clean($_POST['mname']);
$contact = clean($_POST['contact']);
$country = clean($_POST['country']);
$city = clean($_POST['city']);
$address = clean($_POST['address']);
$gender = clean($_POST['gender']);
$resultf = mysql_query("SELECT * FROM customer where fname='$fname' AND lname='$lname' AND mname='$mname' AND contact='$contact' AND gender='$gender'");
while($rowf = mysql_fetch_array($resultf))
	{
	$cccvvv=$rowf['fname'];
	if ($cccvvv!=''){
	//Login failed
	$errmsg_arr[] = 'User Allready Added';
	$errflag = true;
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: customer.php");
	exit();
	}
	}
	}
mysql_query("INSERT INTO customer (fname, lname, mname, contact, country, city, address, gender)
VALUES ('$fname','$lname','$mname','$contact','$country','$city','$address','$gender')");
header("location: customer.php");
?>