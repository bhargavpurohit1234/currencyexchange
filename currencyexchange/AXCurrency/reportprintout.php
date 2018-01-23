<?php
	require_once('auth.php');
?>
<?php
			echo '<div style="display:none;">';
			$a=$_GET['from'];
			$b=$_GET['to'];
			$catfilter=$_GET['filtercat'];
			$branch=$_SESSION['SESS_LAST_NAME'];
			echo '</div>';
?>
<html>
<head>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=600, height=300, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Inel Power System</title>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="font-size:11px; font-family:arial;"><center>');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</center></body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
</head>
<body>
<a href="javascript:Clickheretoprint()"><img src="printer.png"></a>
<div id="print_content">
<?php
if($catfilter=="Search USD"){
?>
USD$ RUN-UP REPORT<br> From <?php echo $a ?> to <?php echo $b ?>
<?php } ?>
<?php
if($catfilter!="Search USD"){
?>
OTHER CURRENCY RUN-UP REPORT<br> From <?php echo $a ?> to <?php echo $b ?>
<?php } ?>
<br>

<?php
if($catfilter=="Search USD"){
?>

Cash
<table border="1" cellspacing="0" cellpadding="3" width="580px;" style="font-size:11px; font-family:arial;">
			<thead>
				<tr>
					<th width="82"> Voucher No. </th>
					<th width="82"> Date </th>
					<th width="82"> Name </th>
					<th width="82"> Amount </th>
					<th width="82"> Currency </th>
					<th width="82"> Rate </th>
					<th width="82"> Peso Value </th>
				</tr>
			</thead>
			<tr><td style="background-color:#CAE8EA;" colspan="7"><center><STRONG>BUY TRANSACTION</STRONG><center></td></tr>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Cash Buy</td></tr>
			<tbody>
			<?php
			$argie=$_SESSION['SESS_FIRST_NAME'];
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
				if($argie!='1'){
				$resulta = mysql_query("SELECT * FROM report WHERE payment='Cash' AND branch='$branch' AND currency='USD' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resulta = mysql_query("SELECT * FROM report WHERE payment='Cash' AND currency='USD' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($row = mysql_fetch_array($resulta))
					{
						echo '<tr>';
						echo '<td>'.$row['transaction_nu'].'</td>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>';
						$fart=$row['name'];
						$resulti = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowi = mysql_fetch_array($resulti))
						{
						echo $rowi['lname'].' '.$rowi['fname'];
						}
						echo '</td>';
						echo '<td>'.$row['amount'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>';
						$ffff=$row['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$row['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$results = mysql_query("SELECT sum(amount) FROM report WHERE payment='Cash' AND branch='$branch' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$results = mysql_query("SELECT sum(amount) FROM report WHERE payment='Cash' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2 = mysql_fetch_array($results))
							  {
							   $gggg1=$row2['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultv = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Cash' AND branch='$branch' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultv = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Cash' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3 = mysql_fetch_array($resultv))
							  {
							   $ggggsddsd=$row3['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG>'.$gggg1.'</STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg2=$ggggsddsd/$gggg1;
						echo '</div>';
						echo '<STRONG>Average: '.$fffhg2.'</STRONG>';
						echo '</td>';
						echo '<td><STRONG>';
							echo 'Total: ';
							echo $ggggsddsd;
						echo '</STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Bank Buy</td></tr>
			<tbody>
			<?php
				if($argie!='1'){
				$resultq = mysql_query("SELECT * FROM report WHERE payment='Bank' AND branch='$branch' AND currency='USD' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resultq = mysql_query("SELECT * FROM report WHERE payment='Bank' AND currency='USD' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($rowq = mysql_fetch_array($resultq))
					{
						echo '<tr>';
						echo '<td>'.$rowq['transaction_nu'].'</td>';
						echo '<td>'.$rowq['date'].'</td>';
						echo '<td>';
						$fart=$rowq['name'];
						$resultiq = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowiq = mysql_fetch_array($resultiq))
						{
						echo $rowiq['lname'].' '.$rowiq['fname'];
						}
						echo '</td>';
						echo '<td>'.$rowq['amount'].'</td>';
						echo '<td>'.$rowq['currency'].'</td>';
						echo '<td>';
						$ffff=$rowq['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$rowq['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE payment='Bank' AND branch='$branch' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE payment='Bank' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2w = mysql_fetch_array($resultsw))
							  {
							   $gggg2=$row2w['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Bank' AND branch='$branch' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Bank' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3w = mysql_fetch_array($resultvw))
							  {
							   $ggggsddsd2=$row3w['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG>'.$gggg2.'</STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg=$ggggsddsd2/$gggg2;
						echo '</div>';
						echo '<STRONG>Average: '.$fffhg.'</STRONG>';
						echo '</td>';
						echo '<td><STRONG>';
							echo 'Total: ';
							echo $ggggsddsd2;
						echo '</STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Western Union Buy</td></tr>
			<tbody>
			<?php
				if($argie!='1'){
				$resultq = mysql_query("SELECT * FROM report WHERE payment='Western Union' AND branch='$branch' AND currency='USD' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resultq = mysql_query("SELECT * FROM report WHERE payment='Western Union' AND currency='USD' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($rowq = mysql_fetch_array($resultq))
					{
						echo '<tr>';
						echo '<td>'.$rowq['transaction_nu'].'</td>';
						echo '<td>'.$rowq['date'].'</td>';
						echo '<td>';
						$fart=$rowq['name'];
						$resultiq = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowiq = mysql_fetch_array($resultiq))
						{
						echo $rowiq['lname'].' '.$rowiq['fname'];
						}
						echo '</td>';
						echo '<td>'.$rowq['amount'].'</td>';
						echo '<td>'.$rowq['currency'].'</td>';
						echo '<td>';
						$ffff=$rowq['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$rowq['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE payment='Western Union' AND branch='$branch' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE payment='Western Union' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2w = mysql_fetch_array($resultsw))
							  {
							   $gggg3=$row2w['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Western Union' AND branch='$branch' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Western Union' AND ttype='Buy' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3w = mysql_fetch_array($resultvw))
							  {
							   $ggggsddsd3=$row3w['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG>'.$gggg3.'</STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg1=$ggggsddsd3/$gggg3;
						echo '</div>';
						echo '<STRONG>Average: '.$fffhg1.'</STRONG>';
						echo '</td>';
						echo '<td><STRONG>';
							echo 'Total: ';
							echo $ggggsddsd3;
						echo '</STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr>
			<td style="background-color:#CAE8EA; text-align:right;" colspan="3"><STRONG>OVERALL AMOUNT</STRONG></td>
			<td style="background-color:#CAE8EA;"><STRONG>
			<?php
			$kkll=$gggg3+$gggg2+$gggg1;
			echo $kkll;
			?></STRONG>
			</td>
			<td style="background-color:#CAE8EA; text-align:right;"><STRONG>
			AVE. RATES</STRONG>
			</td>
			<td style="background-color:#CAE8EA;"><STRONG>
			<?php
			$kkl=($fffhg1+$fffhg+$fffhg2)/3;
			echo $kkl;
			?></STRONG>
			</td>
			<td style="background-color:#CAE8EA;"><STRONG>
			<?php
			$kk=$ggggsddsd3+$ggggsddsd2+$ggggsddsd;
			echo $kk;
			?></STRONG>
			</td>
			</tr>
			<tr><td style="background-color:#CAE8EA;" colspan="7"><center><STRONG>SELL TRANSACTION</STRONG><center></td></tr>
			
			<tr><td style="background-color:#CAE8EA;" colspan="7">Cash Sell</td></tr>
			<tbody>
			<?php
				if($argie!='1'){
				$resulta = mysql_query("SELECT * FROM report WHERE payment='Cash' AND branch='$branch' AND currency='USD' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resulta = mysql_query("SELECT * FROM report WHERE payment='Cash' AND currency='USD' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($row = mysql_fetch_array($resulta))
					{
						echo '<tr>';
						echo '<td>'.$row['transaction_nu'].'</td>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>';
						$fart=$row['name'];
						$resulti = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowi = mysql_fetch_array($resulti))
						{
						echo $rowi['lname'].' '.$rowi['fname'];
						}
						echo '</td>';
						echo '<td>'.$row['amount'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>';
						$ffff=$row['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$row['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$results = mysql_query("SELECT sum(amount) FROM report WHERE payment='Cash' AND branch='$branch' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$results = mysql_query("SELECT sum(amount) FROM report WHERE payment='Cash' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2 = mysql_fetch_array($results))
							  {
							   $ggggc=$row2['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultv = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Cash' AND branch='$branch' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultv = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Cash' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3 = mysql_fetch_array($resultv))
							  {
							   $ggggsddsdc=$row3['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>'.$ggggc.'</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhgc=$ggggsddsdc/$ggggc;
						echo '</div>';
						echo 'Average: '.$fffhgc;
						echo '</td>';
						echo '<td>';
							echo 'Total: ';
							echo $ggggsddsdc;
						echo '</td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Bank Sell</td></tr>
			<tbody>
			<?php
				if($argie!='1'){
				$resultae = mysql_query("SELECT * FROM report WHERE payment='Bank' AND branch='$branch' AND currency='USD' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resultae = mysql_query("SELECT * FROM report WHERE payment='Bank' AND currency='USD' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($rowe = mysql_fetch_array($resultae))
					{
						echo '<tr>';
						echo '<td>'.$rowe['transaction_nu'].'</td>';
						echo '<td>'.$rowe['date'].'</td>';
						echo '<td>';
						$fart=$rowe['name'];
						$resultie = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowie = mysql_fetch_array($resultie))
						{
						echo $rowie['lname'].' '.$rowie['fname'];
						}
						echo '</td>';
						echo '<td>'.$rowe['amount'].'</td>';
						echo '<td>'.$rowe['currency'].'</td>';
						echo '<td>';
						$ffff=$rowe['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$rowe['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE payment='Bank' AND branch='$branch' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE payment='Bank' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2r = mysql_fetch_array($resultsr))
							  {
							   $ggggb=$row2r['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Bank' AND branch='$branch' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Bank' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3r = mysql_fetch_array($resultvr))
							  {
							   $ggggsddsdb=$row3r['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>'.$ggggb.'</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhgb=$ggggsddsdb/$ggggb;
						echo '</div>';
						echo 'Average: '.$fffhgb;
						echo '</td>';
						echo '<td>';
							echo 'Total: ';
							echo $ggggsddsdb;
						echo '</td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Western Union Sell</td></tr>
			<tbody>
			<?php
				if($argie!='1'){
				$resultae = mysql_query("SELECT * FROM report WHERE payment='Western Union' AND branch='$branch' AND currency='USD' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resultae = mysql_query("SELECT * FROM report WHERE payment='Western Union' AND currency='USD' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($rowe = mysql_fetch_array($resultae))
					{
						echo '<tr>';
						echo '<td>'.$rowe['transaction_nu'].'</td>';
						echo '<td>'.$rowe['date'].'</td>';
						echo '<td>';
						$fart=$rowe['name'];
						$resultie = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowie = mysql_fetch_array($resultie))
						{
						echo $rowie['lname'].' '.$rowie['fname'];
						}
						echo '</td>';
						echo '<td>'.$rowe['amount'].'</td>';
						echo '<td>'.$rowe['currency'].'</td>';
						echo '<td>';
						$ffff=$rowe['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$rowe['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE payment='Western Union' AND branch='$branch' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE payment='Western Union' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2r = mysql_fetch_array($resultsr))
							  {
							   $gggga=$row2r['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Western Union' AND branch='$branch' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE payment='Western Union' AND ttype='Sell' AND currency='USD' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3r = mysql_fetch_array($resultvr))
							  {
							   $ggggsddsda=$row3r['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>'.$gggga.'</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhga=$ggggsddsda/$gggga;
						echo '</div>';
						echo 'Average: '.$fffhga;
						echo '</td>';
						echo '<td>';
							echo 'Total: ';
							echo $ggggsddsda;
						echo '</td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr>
			<td style="background-color:#CAE8EA; text-align:right;" colspan="3">OVERALL AMOUNT</td>
			<td style="background-color:#CAE8EA;">
			<?php
			$kkllc=$ggggc+$ggggb+$gggga;
			echo $kkllc;
			?>
			</td>
			<td style="background-color:#CAE8EA; text-align:right;">
			AVE. RATES
			</td>
			<td style="background-color:#CAE8EA;">
			<?php
			$kklc=($fffhgc+$fffhgb+$fffhga)/3;
			echo $kklc;
			?>
			</td>
			<td style="background-color:#CAE8EA;">
			<?php
			$kkc=$ggggsddsdc+$ggggsddsdb+$ggggsddsda;
			echo $kkc;
			?>
			</td>
			</tr>
</table>
<?php } ?>
<?php
include('db.php');
if($catfilter=="Search Other Currency"){
$resultasaiban = mysql_query("SELECT * FROM report WHERE currency!='USD' GROUP BY currency");
while($rowcvb = mysql_fetch_array($resultasaiban))
{
$vbbbvb=$rowcvb['currency'];
?>
<strong><?php echo $vbbbvb ?></strong>
	<table border="1" cellspacing="0" cellpadding="0" width="580px;" style="font-size:11px; font-family:arial;">
			<thead>
				<tr>
					<th width="82"> Voucher No. </th>
					<th width="82"> Date </th>
					<th width="82"> Name </th>
					<th width="82"> Amount </th>
					<th width="82"> Currency </th>
					<th width="82"> Rate </th>
					<th width="82"> Peso Value </th>
				</tr>
			</thead>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Buy</td></tr>
			<tbody>
			<?php
				$resultq = mysql_query("SELECT * FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				while($rowq = mysql_fetch_array($resultq))
					{
						echo '<tr>';
						echo '<td>'.$rowq['transaction_nu'].'</td>';
						echo '<td>'.$rowq['date'].'</td>';
						echo '<td>';
						$fart=$rowq['name'];
						$resultiq = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowiq = mysql_fetch_array($resultiq))
						{
						echo $rowiq['lname'].' '.$rowiq['fname'];
						}
						echo '</td>';
						echo '<td>'.$rowq['amount'].'</td>';
						echo '<td>'.$rowq['currency'].'</td>';
						echo '<td>';
						$ffff=$rowq['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$rowq['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Buy' AND date BETWEEN '$a' AND '$b'");
							while($row2w = mysql_fetch_array($resultsw))
							  {
							   $gggg=$row2w['sum(amount)'];
							   
							  }
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Buy' AND date BETWEEN '$a' AND '$b'");
							while($row3w = mysql_fetch_array($resultvw))
							  {
							   $ggggsddsd=$row3w['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>'.$gggg.'</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg=$ggggsddsd/$gggg;
						echo '</div>';
						echo 'Average: '.$fffhg;
						echo '</td>';
						echo '<td>';
							echo 'Total: ';
							echo $ggggsddsd;
						echo '</td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="background-color:#CAE8EA;" colspan="7">Sell</td></tr>
			<tbody>
			<?php
				$resultae = mysql_query("SELECT * FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				while($rowe = mysql_fetch_array($resultae))
					{
						echo '<tr>';
						echo '<td>'.$rowe['transaction_nu'].'</td>';
						echo '<td>'.$rowe['date'].'</td>';
						echo '<td>';
						$fart=$rowe['name'];
						$resultie = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowie = mysql_fetch_array($resultie))
						{
						echo $rowie['lname'].' '.$rowie['fname'];
						}
						echo '</td>';
						echo '<td>'.$rowe['amount'].'</td>';
						echo '<td>'.$rowe['currency'].'</td>';
						echo '<td>';
						$ffff=$rowe['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$rowe['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Sell' AND date BETWEEN '$a' AND '$b'");
							while($row2r = mysql_fetch_array($resultsr))
							  {
							   $gggg=$row2r['sum(amount)'];
							   
							  }
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Sell' AND date BETWEEN '$a' AND '$b'");
							while($row3r = mysql_fetch_array($resultvr))
							  {
							   $ggggsddsd=$row3r['sum(pesoval)'];
							  }
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>'.$gggg.'</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg=$ggggsddsd/$gggg;
						echo '</div>';
						echo 'Average: '.$fffhg;
						echo '</td>';
						echo '<td>';
							echo 'Total: ';
							echo $ggggsddsd;
						echo '</td>';
					echo '</tr>';
				?> 
			</tbody>
		</table>
<?php 
}
} 
?>
</div>
<br>

</body>
</html>