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
$fname = clean($_POST['fname']);
$lname = clean($_POST['lname']);
$contact = clean($_POST['contact']);
$country = clean($_POST['country']);
$city = clean($_POST['city']);
$address = clean($_POST['address']);
$gender = clean($_POST['gender']);

mysql_query("UPDATE customer SET fname='$fname', lname='$lname', contact='$contact', country='$country', city='$city', address='$address', gender='$gender' WHERE id='$id'");
header("location: customer.php");
?>