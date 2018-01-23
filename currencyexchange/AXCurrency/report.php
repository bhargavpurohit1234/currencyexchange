<?php
	require_once('auth.php');
?>
<?php
			echo '<div style="display:none;">';
			$a=$_POST['from'];
			$b=$_POST['to'];
			$catfilter=$_POST['filtercat'];
			$branch=$_SESSION['SESS_LAST_NAME'];
			echo '</div>';
?>
<html>
<head>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
</head>
<body>
<div id="mainwrapper" style="width:600px;">
<h1>
	<a id="addq" href="home.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
</h1>
<form action="report.php" method="post">
From: <input name="from" type="text" class="tcal"/>
  To: <input name="to" type="text" class="tcal"/>
  <input name="filtercat" type="submit" value="Search USD" />
  <input name="filtercat" type="submit" value="Search Other Currency" />
  <INPUT type="button" value="Preview" onClick="window.open('reportprintout.php?from=<?php echo $a ?>&to=<?php echo $b ?>&filtercat=<?php echo $catfilter ?>','mywindow','width=600,height=300,scrollbars=yes')">
</form>
<br>
<?php
if($catfilter=="Search USD"){
?>
<label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th width="82"  style="border-left: 1px solid #C1DAD7"> Voucher No. </th>
					<th width="82"> Date </th>
					<th width="82"> Name </th>
					<th width="82"> Amount </th>
					<th width="82"> Currency </th>
					<th width="82"> Rate </th>
					<th width="82"> Peso Value </th>
				</tr>
			</thead>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7"><center><STRONG>BUY TRANSACTION</STRONG><center></td></tr>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Cash Buy</td></tr>
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
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['transaction_nu'].'</td>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>';
						$fart=$row['name'];
						$resulti = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowi = mysql_fetch_array($resulti))
						{
						echo $rowi['lname'].' '.$rowi['fname'];
						}
						echo '</td>';
						echo '<td><div align="right">'.$row['amount'].'</div></td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td><div align="right">';
						$ffff=$row['rate'];
						echo $ffff;
						echo '</div></td>';
						echo '<td><div align="right">'.$row['pesoval'].'</div></td>';
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
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG><div align="right">';
						//$gggg1
						echo formatMoney($gggg1, true);
						echo '</div></STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg2=$ggggsddsd/$gggg1;
						echo '</div>';
						echo '<STRONG><div align="right">';
						//$fffhg2.
						echo formatMoney($fffhg2, true);
						echo '</div></STRONG>';
						echo '</td>';
						echo '<td><STRONG><div align="right">';
							//echo $ggggsddsd;
							echo formatMoney($ggggsddsd, true);
						echo '</div></STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Bank Buy</td></tr>
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
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$rowq['transaction_nu'].'</td>';
						echo '<td>'.$rowq['date'].'</td>';
						echo '<td>';
						$fart=$rowq['name'];
						$resultiq = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowiq = mysql_fetch_array($resultiq))
						{
						echo $rowiq['lname'].' '.$rowiq['fname'];
						}
						echo '</td>';
						echo '<td><div align="right">'.$rowq['amount'].'</div></td>';
						echo '<td>'.$rowq['currency'].'</td>';
						echo '<td><div align="right">';
						$ffff=$rowq['rate'];
						echo $ffff;
						echo '</div></td>';
						echo '<td><div align="right">'.$rowq['pesoval'].'</div></td>';
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
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG><div align="right">';
						//$gggg2
						echo formatMoney($gggg2, true);
						echo '</div></STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg=$ggggsddsd2/$gggg2;
						echo '</div>';
						echo '<STRONG><div align="right">';
						//$fffhg
						echo formatMoney($fffhg, true);
						echo '</div></STRONG>';
						echo '</td>';
						echo '<td><STRONG>';
							echo $ggggsddsd2;
							echo formatMoney($ggggsddsd2, true);
						echo '</STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Western Union Buy</td></tr>
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
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$rowq['transaction_nu'].'</td>';
						echo '<td>'.$rowq['date'].'</td>';
						echo '<td>';
						$fart=$rowq['name'];
						$resultiq = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowiq = mysql_fetch_array($resultiq))
						{
						echo $rowiq['lname'].' '.$rowiq['fname'];
						}
						echo '</td>';
						echo '<td><div align="right">'.$rowq['amount'].'</div></td>';
						echo '<td>'.$rowq['currency'].'</td>';
						echo '<td><div align="right">';
						$ffff=$rowq['rate'];
						echo $ffff;
						echo '</div></td>';
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
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG><div align="right">';
						//$gggg3
						echo formatMoney($gggg3, true);
						echo '</div></STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg1=$ggggsddsd3/$gggg3;
						echo '</div>';
						echo '<STRONG><div align="right">';
						//$fffhg1
						echo formatMoney($fffhg1, true);
						echo '</div></STRONG>';
						echo '</td>';
						echo '<td><STRONG<div align="right">';
							echo $ggggsddsd3;
							echo formatMoney($ggggsddsd3, true);
						echo '</div></STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr>
			<td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA; text-align:right;" colspan="3"><STRONG>OVERALL AMOUNT</STRONG></td>
			<td style="background-color:#CAE8EA;"><div align="right">
			<?php
			$kkll=$gggg3+$gggg2+$gggg1;
			echo '<STRONG>'.formatMoney($kkll, true).'</STRONG>';
			?>
			</div></td>
			<td style="background-color:#CAE8EA; text-align:right;">
			<STRONG>AVE. RATES</STRONG>
			</td>
			<td style="background-color:#CAE8EA;"><div align="right">
			<?php
			$kkl=($fffhg1+$fffhg+$fffhg2)/3;
			echo '<STRONG>'.formatMoney($kkl, true).'</STRONG>';
			?>
			</div></td>
			<td style="background-color:#CAE8EA;"><div align="right">
			<?php
			$kk=$ggggsddsd3+$ggggsddsd2+$ggggsddsd;
			echo '<STRONG>'.formatMoney($kk, true).'</STRONG>';
			?>
			</div></td>
			</tr>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7"><center><STRONG>SELL TRANSACTION</STRONG><center></td></tr>
			
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Cash Sell</td></tr>
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
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['transaction_nu'].'</td>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>';
						$fart=$row['name'];
						$resulti = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowi = mysql_fetch_array($resulti))
						{
						echo $rowi['lname'].' '.$rowi['fname'];
						}
						echo '</td>';
						echo '<td><div align="right">'.$row['amount'].'</div></td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td><div align="right">';
						$ffff=$row['rate'];
						echo $ffff;
						echo '</div></td>';
						echo '<td><div align="right">'.$row['pesoval'].'</div></td>';
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
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG><div align="right">';
						//$ggggc
						echo formatMoney($ggggc, true);
						echo '</div></STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhgc=$ggggsddsdc/$ggggc;
						echo '</div>';
						echo '<STRONG><div align="right">';
						//$fffhgc
						echo formatMoney($fffhgc, true);
						echo '</div></STRONG>';
						echo '</td>';
						echo '<td><STRONG><div align="right">';
							//echo $ggggsddsdc;
							echo formatMoney($ggggsddsdc, true);
						echo '</div></STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Bank Sell</td></tr>
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
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$rowe['transaction_nu'].'</td>';
						echo '<td>'.$rowe['date'].'</td>';
						echo '<td>';
						$fart=$rowe['name'];
						$resultie = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowie = mysql_fetch_array($resultie))
						{
						echo $rowie['lname'].' '.$rowie['fname'];
						}
						echo '</td>';
						echo '<td><div align="right">'.$rowe['amount'].'</div></td>';
						echo '<td>'.$rowe['currency'].'</td>';
						echo '<td><div align="right">';
						$ffff=$rowe['rate'];
						echo $ffff;
						echo '</div></td>';
						echo '<td><div align="right">'.$rowe['pesoval'].'</div></td>';
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
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG><div align="right">';
						//$ggggb
						echo formatMoney($ggggb, true);
						echo '</div></STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhgb=$ggggsddsdb/$ggggb;
						echo '</div>';
						echo '<STRONG><div align="right">';
						//$fffhgb
						echo formatMoney($fffhgb, true);
						echo '</div></STRONG>';
						echo '</td>';
						echo '<td><STRONG><div align="right">';
							echo $ggggsddsdb;
							echo formatMoney($ggggsddsdb, true);
						echo '</div></STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr>
			<td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA; text-align:right;" colspan="3">OVERALL AMOUNT</td>
			<td style="background-color:#CAE8EA;">
			<?php
			$kkllc=$ggggc+$ggggb;
			echo '<STRONG><div align="right">'.formatMoney($kkllc, true).'</div></STRONG>';
			?>
			</td>
			<td style="background-color:#CAE8EA; text-align:right;">
			<STRONG>AVE. RATES</STRONG>
			</td>
			<td style="background-color:#CAE8EA;">
			<?php
			$kklc=($fffhgc+$fffhgb)/2;
			echo '<STRONG><div align="right">'.formatMoney($kklc, true).'</div></STRONG>';
			?>
			</td>
			<td style="background-color:#CAE8EA;">
			<?php
			$kkc=$ggggsddsdc+$ggggsddsdb;
			echo '<STRONG><div align="right">'.formatMoney($kkc, true).'</div></STRONG>';
			?></td>
			</tr>
		</table>
<?php } ?>
<?php
include('db.php');
if($catfilter=="Search Other Currency"){

$resultasaiban = mysql_query("SELECT * FROM report WHERE date BETWEEN '$a' AND '$b' AND currency!='USD' GROUP BY currency");
while($rowcvb = mysql_fetch_array($resultasaiban))
{
$vbbbvb=$rowcvb['currency'];
?>
<strong><?php echo $vbbbvb ?></strong>
	<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th width="82"  style="border-left: 1px solid #C1DAD7"> Voucher No. </th>
					<th width="82"> Date </th>
					<th width="82"> Name </th>
					<th width="82"> Amount </th>
					<th width="82"> Currency </th>
					<th width="82"> Rate </th>
					<th width="82"> Peso Value </th>
				</tr>
			</thead>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Buy</td></tr>
			<tbody>
			<?php
			$argie=$_SESSION['SESS_FIRST_NAME'];
				if($argie!='1'){
				$resultq = mysql_query("SELECT * FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resultq = mysql_query("SELECT * FROM report WHERE currency='$vbbbvb' AND ttype='Buy' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($rowq = mysql_fetch_array($resultq))
					{
						echo '<tr>';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$rowq['transaction_nu'].'</td>';
						echo '<td>'.$rowq['date'].'</td>';
						echo '<td>';
						$fart=$rowq['name'];
						$resultiq = mysql_query("SELECT * FROM customer WHERE id='$fart'");
						while($rowiq = mysql_fetch_array($resultiq))
						{
						echo $rowiq['lname'].' '.$rowiq['fname'];
						}
						echo '</td>';
						echo '<td><div align="right">'.$rowq['amount'].'</div></td>';
						echo '<td>'.$rowq['currency'].'</td>';
						echo '<td><div align="right">';
						$ffff=$rowq['rate'];
						echo $ffff;
						echo '</div></td>';
						echo '<td>'.$rowq['pesoval'].'</td>';
						echo '</tr>';
					}
					echo '<tr>';
							if($argie!='1'){
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Buy' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultsw = mysql_query("SELECT sum(amount) FROM report WHERE currency='$vbbbvb' AND ttype='Buy' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2w = mysql_fetch_array($resultsw))
							  {
							   $gggg=$row2w['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Buy' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultvw = mysql_query("SELECT sum(pesoval) FROM report WHERE currency='$vbbbvb' AND ttype='Buy' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3w = mysql_fetch_array($resultvw))
							  {
							   $ggggsddsd=$row3w['sum(pesoval)'];
							  }
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG><div align="right">'.$gggg.'</div></STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg=$ggggsddsd/$gggg;
						echo '</div>';
						echo '<STRONG><div align="right">'.$fffhg.'</div></STRONG>';
						echo '</td>';
						echo '<td><STRONG><div align="right">';
							echo $ggggsddsd;
						echo '</div></STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
			<tr><td style="border-left: 1px solid #C1DAD7; background-color:#CAE8EA;" colspan="7">Sell</td></tr>
			<tbody>
			<?php
				if($argie!='1'){
				$resultae = mysql_query("SELECT * FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				if($argie=='1'){
				$resultae = mysql_query("SELECT * FROM report WHERE currency='$vbbbvb' AND ttype='Sell' AND date BETWEEN '$a' AND '$b' ORDER BY currency asc");
				}
				while($rowe = mysql_fetch_array($resultae))
					{
						echo '<tr>';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$rowe['transaction_nu'].'</td>';
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
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Sell' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultsr = mysql_query("SELECT sum(amount) FROM report WHERE currency='$vbbbvb' AND ttype='Sell' AND date BETWEEN '$a' AND '$b'");
							}
							while($row2r = mysql_fetch_array($resultsr))
							  {
							   $gggg=$row2r['sum(amount)'];
							   
							  }
							if($argie!='1'){
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE currency='$vbbbvb' AND branch='$branch' AND ttype='Sell' AND date BETWEEN '$a' AND '$b'");
							}
							if($argie=='1'){
							$resultvr = mysql_query("SELECT sum(pesoval) FROM report WHERE currency='$vbbbvb' AND ttype='Sell' AND date BETWEEN '$a' AND '$b'");
							}
							while($row3r = mysql_fetch_array($resultvr))
							  {
							   $ggggsddsd=$row3r['sum(pesoval)'];
							  }
						echo '<td style="border-left: 1px solid #C1DAD7;">&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td><STRONG>'.$gggg.'</STRONG></td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
						echo '<div style="display:none;">';
						$fffhg=$ggggsddsd/$gggg;
						echo '</div>';
						echo '<STRONG>Average: '.$fffhg.'</STRONG>';
						echo '</td>';
						echo '<td><STRONG>';
							echo 'Total: ';
							echo $ggggsddsd;
						echo '</STRONG></td>';
					echo '</tr>';
				?> 
			</tbody>
		</table>
<?php 
}
} 
?>
<br>

</div>
</body>
</html>