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
      disp_setting+="scrollbars=yes,width=900, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Inel Power System</title>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="width:900px; font-size:11px; font-family:arial;"><center>');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</center></body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
</head>
<body>
<div id="print_content">
Other Bank Account Report<br>
<table border="1" cellspacing="0" cellpadding="0" width="900px;" style="font-size:11px; font-family:arial;">
			<thead>
				<tr>
					<th> Bank Code </th>
					<th> Bank Name </th>
					<th> Currency </th>
					<th> Account Number </th>
					<th> Debit </th>
					<th> Credit </th>
					<th> Balance </th>
					<th> Peso Value </th>
					<th> Average </th>
				</tr>
			</thead>
			<tbody>
			<?php
			include('db.php');
				$result = mysql_query("SELECT * FROM other_bank_account ORDER BY bank_code ASC");
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
						echo '<td>'.$row['pesoval'].'</td>';
						echo '<td>';
						$qw=$row['pesoval'];
						$df=$row['balance'];
						echo '<div style="display:none;">';
						$ffffjjjj=$qw/$df;
						echo '</div>';
						echo $ffffjjjj;
						echo '</td>';
						echo '</tr>';
					}
				?> 
			</tbody>
		</table>
</div>
<br>
<a href="javascript:Clickheretoprint()"> Click here to print</a>
</body>
</html>