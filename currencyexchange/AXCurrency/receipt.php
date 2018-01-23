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
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=900, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Inel Power System</title>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 900px; font-size:16px; font-family:arial;">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<?php
echo '<div style="display:none;">';
include('db.php');
$da=date("Y-m-d");
$tnu=$_GET['transaction_nu'];
$cname=$_GET['cname'];
$rate=$_GET['rate'];
$amount=$_GET['amount'];
$pesoval=$_GET['pesoval'];
$cur=$_GET['cur'];
$branch=$_GET['branch'];
$ttype=$_GET['ttype'];
$payment=$_GET['type'];
$civu=$_GET['cvcvc'];
$result = mysql_query("SELECT * FROM report WHERE transaction_nu='$tnu'");
while($row = mysql_fetch_array($result))
  {
  $ftd=$row['transaction_nu'];
  }
  if($ftd!=$tnu){
  mysql_query("INSERT INTO report (transaction_nu, date, name, currency, rate, pesoval, branch, amount, ttype, payment)
VALUES ('$tnu','$da','$cname','$cur','$rate','$pesoval','$branch','$amount','$ttype','$payment')");
  if($cur=='USD'){
		if($ttype=='Buy'){
		$rem = '0';
		mysql_query("UPDATE bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount' WHERE bank_code='$civu'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$tnu','$da','$amount','0','$civu','$rem','$pesoval')");
		}
		if($ttype=='Sell'){
		$rem = '0';
		mysql_query("UPDATE bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount' WHERE bank_code='$civu'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$tnu','$da','0','$amount','$civu','$rem','$pesoval')");
		}
  }
  if($cur!='USD'){
		if($ttype=='Buy'){
		$rem = '0';
		mysql_query("UPDATE other_bank_account SET debit=debit+$amount, credit=credit, balance=balance+'$amount', pesoval=pesoval+'$pesoval' WHERE bank_code='$civu'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$tnu','$da','$amount','0','$civu','$rem','$pesoval')");
		}
		if($ttype=='Sell'){
		$rem = '0';
		mysql_query("UPDATE other_bank_account SET debit=debit, credit=credit+$amount, balance=balance-'$amount', pesoval=pesoval-'$pesoval' WHERE bank_code='$civu'");
		mysql_query("INSERT INTO bank_transfer (trn_num, date, debit, credit, bank_name, remarks, pesoval) 
VALUES ('$tnu','$da','0','$amount','$bname','$rem','$pesoval')");
		}
  }
  }
  echo '</div>';
?>
<a href="javascript:Clickheretoprint()"><img src="printer.png"></a><a href="home.php">save</a>
<div id="print_content" style="width: 900px;">
<div style="float:left; width:400; margin-right:80px;">
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
Curr:<?php echo $_GET['transactiontype'];?>
</div>
</div>
<br>
<div>
<div style="float:left;">
Type:<?php echo $_GET['type'];?>
</div>
<div style="float:right;">
Voucher:<?php echo $_GET['transaction_nu'];?>
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
Name:<?php echo $_GET['name'];?>
</div>
<br><br>
<table border="1" width="400" cellspacing="0" cellpadding="3" style="font-size:16px; font-family:arial;">
				<tr>
					<td width="80"> Amount </td>
					<td width="80"> Currency </td>
					<td width="80"> Rate </td>
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
				$trans=$_GET['transaction_nu'];
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
		<div>
		<div style="float:left; width:auto;">
		<br>
		____________________<br>
		Posted By:
		<?php

$oper_id=$_SESSION['SESS_MEMBER_ID'];
$result = mysql_query("SELECT * FROM user where id='$oper_id'");
				while($row = mysql_fetch_array($result))
					{
					echo $row['username'];
					}
?>
		</div>
		<div style="float:right; width:auto;">
		<br>
		____________________<br>
		Received By:
		</div>
		</div>
</div>
<div style="float:left; width:400">
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
Curr:<?php echo $_GET['transactiontype'];?>
</div>
</div>
<br>
<div>
<div style="float:left;">
Type:<?php echo $_GET['type'];?>
</div>
<div style="float:right;">
Voucher:<?php echo $_GET['transaction_nu'];?>
</div></div><br>
<div>
<div style="float:right;">
Operator:
<?php
include('db.php');
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
Name:<?php echo $_GET['name'];?>
</div>
<br><br>

<table border="1" width="400" cellspacing="0" cellpadding="3" style="font-size:16px; font-family:arial;">
				<tr>
					<td width="80"> Amount </td>
					<td width="80"> Currency </td>
					<td width="80"> Rate </td>
					<td> Serial </td>
					<td> Peso Value </td>
				</tr>
			<?php
				$trans=$_GET['transaction_nu'];
				$result = mysql_query("SELECT * FROM transaction where transaction_nu='$trans'");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>'.$row['amount'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>'.$row['rate'].'</td>';
						echo '<td>'.$row['serial'].'</td>';
						echo '<td><strong>';
						$bbbb=$row['netconvert'];
						echo formatMoney($bbbb, true);
						echo '</strong></td>';
						echo '</tr>';
					}
					echo '<tr>';
						echo '<td><strong>';
							$result = mysql_query("SELECT sum(amount) FROM transaction where transaction_nu='$trans'");
							while($row2 = mysql_fetch_array($result))
							  {
							   echo 'Total: ';
							   $gggg=$row2['sum(amount)'];
							   echo formatMoney($gggg, true);
							  }
						echo '</strong></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><strong>';
							$result = mysql_query("SELECT sum(netconvert) FROM transaction where transaction_nu='$trans'");
							while($row2 = mysql_fetch_array($result))
							  {
							   echo 'Total: ';
							   $gggg=$row2['sum(netconvert)'];
							   echo formatMoney($gggg, true);
							  }
						echo '</strong></td>';
					echo '</tr>';
				?>
		</table>
		<div>
		<div style="float:left; width:auto;">
		<br>
		____________________<br>
		Posted By: 
		<?php

$oper_id=$_SESSION['SESS_MEMBER_ID'];
$result = mysql_query("SELECT * FROM user where id='$oper_id'");
				while($row = mysql_fetch_array($result))
					{
					echo $row['username'];
					}
?>
		</div>
		<div style="float:right; width:auto;">
		<br>
		____________________<br>
		Received By:
		</div>
		</div>
		</div>
		<div style="clear:both;"></div>
</div>
</div>
<br>
