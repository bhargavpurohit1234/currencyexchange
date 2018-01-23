<?php
	require_once('auth.php');
?>
<?php
$ghghg='
<script type="text/javascript">
<!--

var a_p = "";
var d = new Date();
var curr_hour = d.getHours();
if (curr_hour < 12)
   {
   a_p = "AM";
   }
else
   {
   a_p = "PM";
   }
if (curr_hour == 0)
   {
   curr_hour = 12;
   }
if (curr_hour > 12)
   {
   curr_hour = curr_hour - 12;
   }

var curr_min = d.getMinutes();

curr_min = curr_min + "";

if (curr_min.length == 1)
   {
   curr_min = "0" + curr_min;
   }

document.write(curr_hour + " : " + curr_min + " " + a_p);

//-->
</script>
';
?>
<?php
include('db.php');
$id=$_POST['id'];
$pitsa=$_POST['pitsa'];
$resultv = mysql_query("SELECT * FROM transaction WHERE cusname='$id' AND pitsa='$pitsa'");
$rowv = mysql_fetch_array($resultv);
$ttype=$rowv['trans_type'];
$mode=$rowv['mode'];
$trans=$rowv['transaction_nu'];
$cusname=$rowv['cusname'];
$resultz = mysql_query("SELECT * FROM customer WHERE id='$cusname'");
$rowz = mysql_fetch_array($resultz);
$cname=$rowz['lname'].' '.$rowz['fname'];
?>
<html>
<head>
<title>AX Currency System</title>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=270, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Inel Power System</title>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 270px; font-size:11px; font-family:arial;">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>

</head>
<body>
<div id="mainwrapper">
<h1>
<a id="addq" href="home.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
</h1>
<br>
<a href="javascript:Clickheretoprint()"><img src="printer.png"></a>
<br>
<div id="print_content" style="width: 270px;">
<center>
AX CURRENCY EXCHANGE<br>
Cor. Galo-Mabini Sts. Bacolod City<br>
433-33372, 433-3373, 435-2997, 708-9996, 09209097735
</center>
<div>
<div style="float:left;">
Date:<?php
echo date('Y-m-d') .$ghghg;?>&nbsp;
</div>
<div style="float:right;">
Curr:<?php echo $mode;?>
</div>
</div>
<br>
<div>
<div style="float:left;">
Type:<?php echo $ttype;?>
</div>
<div style="float:right;">
Voucher:<?php echo $trans;?>
</div></div><br>
<div>
<div style="float:right;">
Operator:
<?php

$oper_id=$_SESSION['SESS_MEMBER_ID'];
$result = mysql_query("SELECT * FROM user where id='$oper_id'");
				while($row = mysql_fetch_array($result))
					{
					echo $row['username'];
					}
?>
</div>
</div>
<div style="float:left;">
Name:<?php echo $cusname;?>
</div>
<br><br>
<table border="1" cellspacing="0" cellpadding="0" style="font-size:11px; font-family:arial;">
				<tr>
					<td> Amount </td>
					<td> Currency </td>
					<td> Rate </td>
					<td> Serial </td>
					<td> Peso Value </td>
				</tr>
			<?php
			include('db.php');
			function formatMoney($number, $fractional=false) {
				if ($fractional) {
					$number = sprintf('%.2f', $number);
				}
				while (true) {
					$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
					if ($replaced != $number) {
						$number = $replaced;
					} else {
						break;
					}
				}
				return $number;
			}
				$result = mysql_query("SELECT * FROM transaction where transaction_nu='$trans'");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>'.$row['amount'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>'.$row['rate'].'</td>';
						echo '<td>'.$row['serial'].'</td>';
						echo '<td>';
						$bbbb=$row['netconvert'];
						echo formatMoney($bbbb, true);
						echo '</td>';
						echo '</tr>';
					}
					echo '<tr>';
						echo '<td>';
							$result = mysql_query("SELECT sum(amount) FROM transaction where transaction_nu='$trans'");
							while($row2 = mysql_fetch_array($result))
							  {
							   echo 'Total: ';
							   $gggg=$row2['sum(amount)'];
							   echo formatMoney($gggg, true);
							  }
						echo '</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
							$result = mysql_query("SELECT sum(netconvert) FROM transaction where transaction_nu='$trans'");
							while($row2 = mysql_fetch_array($result))
							  {
							   echo 'Total: ';
							   $gggg=$row2['sum(netconvert)'];
							   echo formatMoney($gggg, true);
							  }
						echo '</td>';
					echo '</tr>';
				?>
		</table>
		<br>
		______________________<br>
		Posted By: <?php echo $_SESSION['SESS_LAST_NAME'] ?>
		<br>
		______________________<br>
		Received By:
</div>

<br>

</div>
</body>
</html>
