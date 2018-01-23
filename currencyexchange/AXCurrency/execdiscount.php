<?php
	require_once('auth.php');
?>
<?php
include('db.php');
$oper_id=$_SESSION['SESS_MEMBER_ID'];
$result = mysql_query("SELECT * FROM user where id='$oper_id'");
				while($row = mysql_fetch_array($result))
					{
					$uuuu=$row['username'];
					}
?>
<?php
 
//Include database connection details
require_once('db.php');
 
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
 
//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
$str = @trim($str);
if(get_magic_quotes_gpc()) {
$str = stripslashes($str);
}
return mysql_real_escape_string($str);
}

//Sanitize the POST values
$modeoftrans= clean($_POST['mt']);
$currency= clean($_POST['cur']);
$id = clean($_POST['id']);
$adminpass = clean($_POST['adminpass']);
$rate = clean($_POST['rate']);

$result = mysql_query("SELECT * FROM user where password='".md5($_POST['adminpass'])."'");
$count=mysql_num_rows($result);

if($count!=0)
{
$result = mysql_query("UPDATE transaction SET rate='$rate', netconvert=amount*'$rate' where transaction_nu='$id'");
$count=mysql_num_rows($result);
mysql_query("DELETE FROM power WHERE username='$uuuu'");
header("location: transaction.php?modeofpayment=$modeoftrans&currency=$currency");
}
else{
$errmsg_arr[] = 'You dont have access to add user pls. contact the administrator';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: transaction.php?modeofpayment=$modeoftrans&currency=$currency");
exit();
}
}
?> 