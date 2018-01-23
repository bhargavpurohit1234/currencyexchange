<?php
//Start session
session_start();

include('db.php');
$rrrr=$_POST['id'];
$modeofpayment=$_POST['modeofpayment'];
$currency=$_POST['currency'];
$transmode=$_POST['transmode'];
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
session_regenerate_id();
$_SESSION['transactioncode'] = $finalcode;
$_SESSION['clientname'] = $rrrr;
$_SESSION['mode'] = $transmode;
session_write_close();
header("location: transaction.php?modeofpayment=$modeofpayment&currency=$currency");
exit();	
		
	
?>