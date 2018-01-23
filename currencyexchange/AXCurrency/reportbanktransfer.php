<?php
	require_once('auth.php');
?>
<?php
			echo '<div style="display:none;">';
			$a=$_GET['from'];
			$b=$_GET['to'];
			$catfilter=$_GET['filtercat'];
			$bname=$_GET['bname'];
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
<div id="print_content">

Bank Transfer Report

<table border="1" cellspacing="0" cellpadding="0" width="580px;" style="font-size:11px; font-family:arial;">
			<thead>
				<tr>
					<th colspan="7" width="114"> <?php echo $bname ?> </th>
				</tr>
				<tr>
					<th width="114"> Transaction Number </th>
					<th width="114"> Date </th>
					<th width="114"> Bank Name </th>
					<th width="114"> Debit </th>
					<th width="114"> Credit </th>
					<th width="114"> Balance </th>
					<th width="114"> Remarks </th>
				</tr>
			</thead>
			<tbody>
			<?php
			include('db.php');
				$resulta = mysql_query("SELECT * FROM bank_transfer WHERE bank_name='$bname' AND date BETWEEN '$a' AND '$b' order by date asc");
				while($row = mysql_fetch_array($resulta))
					{
						echo '<tr>';
						echo '<td>'.$row['trn_num'].'</td>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>'.$row['bank_name'].'</td>';
						echo '<td>'.$row['debit'].'</td>';
						echo '<td>'.$row['credit'].'</td>';
						$deb=$row['debit'];
						$cred=$row['credit'];
						$balance=$deb-$cred;
						echo '<td>'.$balance.'</td>';
						echo '<td>'.$row['remarks'].'</td>';
						echo '</tr>';
					}
				?> 
				<tr><td colspan="3">&nbsp;</td>
				<td>
				<?php
				$results = mysql_query("SELECT sum(debit) FROM bank_transfer WHERE bank_name='$bname' AND date BETWEEN '$a' AND '$b'");
				while($row2 = mysql_fetch_array($results))
				  {
				   $dsdsds=$row2['sum(debit)'];
				   echo $dsdsds;
				  }
				?>
				</td>
				<td>
				<?php
				$results = mysql_query("SELECT sum(credit) FROM bank_transfer WHERE bank_name='$bname' AND date BETWEEN '$a' AND '$b'");
				while($row2 = mysql_fetch_array($results))
				  {
				   $gggg=$row2['sum(credit)'];
				   echo $gggg;
				  }
				?>
				</td>
				<td>
				<?php
				$fff=$dsdsds-$gggg;
				echo $fff;
				?>
				</td>
				</tr>
			</tbody>
		</table>
</div>
<br>
<a href="javascript:Clickheretoprint()"> Click here to print</a>
</body>
</html>