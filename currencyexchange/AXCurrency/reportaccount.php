<?php
	require_once('auth.php');
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
USD Bank Account Report<br>
<table border="1" cellspacing="0" cellpadding="0" width="580px;" style="font-size:11px; font-family:arial;">
			<thead>
				<tr>
					<th> Bank Code </th>
					<th> Bank Name </th>
					<th> Currency </th>
					<th> Account Number </th>
					<th> Debit </th>
					<th> Credit </th>
					<th> Balance </th>
				</tr>
			</thead>
			<tbody>
			<?php
			include('db.php');
				$result = mysql_query("SELECT * FROM bank_account ORDER BY bank_code ASC");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td>'.$row['bank_code'].'</td>';
						echo '<td>'.$row['bank_name'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>'.$row['account_num'].'</td>';
						echo '<td>'.$row['debit'].'</td>';
						echo '<td>'.$row['credit'].'</td>';
						echo '<td>'.$row['balance'].'</td>';
						echo '</tr>';
					}
				?> 
				<tr><td colspan="4"><strong>Total<strong></td>
				<td>
				<?php
					$results = mysql_query("SELECT sum(debit) FROM bank_account");
							while($row2 = mysql_fetch_array($results))
							  {
							   $gggg=$row2['sum(debit)'];
							   echo $gggg;
							  }
				?>
				</td>
				<td>
				<?php
					$results = mysql_query("SELECT sum(credit) FROM bank_account");
							while($row2 = mysql_fetch_array($results))
							  {
							   $gggg=$row2['sum(credit)'];
							   echo $gggg;
							  }
				?>
				</td>
				<td>
				<?php
					$results = mysql_query("SELECT sum(balance) FROM bank_account");
							while($row2 = mysql_fetch_array($results))
							  {
							   $gggg=$row2['sum(balance)'];
							   echo $gggg;
							  }
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