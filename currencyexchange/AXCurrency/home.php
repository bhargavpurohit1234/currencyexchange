<?php
	require_once('auth.php');
?>
<?php

	unset($_SESSION['transactioncode']);
	unset($_SESSION['clientname']);
	unset($_SESSION['mode']);
?>
<html>
<head>
<title>Currency Exchange System</title>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'src/loading.gif',
		closeImage   : 'src/closelabel.png'
	  })
	})
  </script>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div style="width: 500px; margin-top: 31px; text-align:right; color: #fff; margin:0 auto; font-family:tahoma;">
Powered by <a href="#" target="_blank">begie</a>
</div>
<div id="mainwrapper" style="width: 500px; margin-top: 12px;">
	<h1>
	Welcome 
	<?php
	include('db.php');
	$oper_id=$_SESSION['SESS_MEMBER_ID'];
	$result = mysql_query("SELECT * FROM user where id='$oper_id'");
					while($row = mysql_fetch_array($result))
						{
						echo $row['username'];
						}
	?>
	<div style="float:right; width:auto;">Currency Exchange System
	</div>
	</h1>
	<div id="homecontent" style="width: 92%;">
		
		<div style="float:left; with:auto; padding:10px;"><a id="addq" href="customer.php"><img src="images/people.png" height="64" width="64"><br>Customer</a></div>
		<?php if ($_SESSION['SESS_FIRST_NAME']=="1")
		{
		  echo '<div style="float:left; width:auto; padding:10px;"><a href="editrates.php" id="addq"><img src="images/dollars.png" height="64" width="64"><br>Rates</a></div>';
		}
		?>
		<div style="float:left; width:auto; padding:10px;"><a rel="facebox" href="cvitrans.php" id="addq"><img src="images/banktransfer.png" height="64" width="64"><br>CIV Transfer</a></div>
		<div style="float:left; width:auto; padding:10px;"><a href="btransferhome.php" id="addq"><img src="images/banktransfer.png" height="64" width="64"><br>Bank Transfer</a></div>
		<div style="float:left; width:auto; padding:10px;"><a id="addq" href="masterfile.php"><img src="images/masterfile.png" height="64" width="64"><br>Master file</a></div>
		<div style="float:left; width:auto; padding:10px;"><a href="report.php" id="addq"><img src="images/report.png" height="64" width="64"><br>Reports</a></div>
		<div style="float:left; width:auto; padding:10px;"><a rel="facebox" href="generate.php" id="addq"><img src="images/transaction.png" height="64" width="64"><br>Transaction</a></div>
		<div style="float:left; width:auto; padding:10px;"><a href="trackserial.php" id="addq"><img src="images/numbers-icon.png" height="64" width="64"><br>Track Serial</a></div>
		<div style="float:left; width:auto; padding:10px;"><a rel="facebox" href="rreceipt.php" id="addq"><img src="images/recover.png" height="64" width="64"><br>Recover Receipt</a></div>
		<div style="float:left; width:auto; padding:10px;"><a id="addq" href="index.php"><img src="images/padlock.png" height="64" width="64"><br>logout</a></div>
		<div class="clearfix"></div>
	</div>

</div>
<div id="mainwrapper" style="width: 500px; margin-top: -42px;">
<h1>
	USD RATES
	<?php if ($_SESSION['SESS_FIRST_NAME']=="1")
	{
	?>
	<div style="float:right; width:auto;"><a rel="facebox" href="override.php">Change Transaction Rate</a>
	</div>
	<?php 
	}
	?>
</h1>
<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th  style="border-left: 1px solid #C1DAD7"> Symbol </th>
					<th> Currency </th>
					<th> Buy Rates </th>
					<th> Sell Rates </th>
				</tr>
			</thead>
			<tbody>
			<?php
				include('db.php');
				$result = mysql_query("SELECT * FROM rates WHERE currency='USD'");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['currency'].'</td>';
						echo '<td>'.$row['name'].'</td>';
						echo '<td><div align="right">'.$row['buyrate'].'</div></td>';
						echo '<td><div align="right">'.$row['rate'].'</div></td>';
					}
				?> 
			</tbody>
</table>
</div>
<div id="mainwrapper" style="width: 500px; margin-top: -42px;">
<h1 style="height: 27px;">
	OTHER CURRENCY RATES<div style="float:right; width:auto;"><label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" /></div>
</h1>
<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th  style="border-left: 1px solid #C1DAD7"> Symbol </th>
					<th> Currency </th>
					<th> Buy Rates </th>
					<th> Sell Rates </th>
				</tr>
			</thead>
			<tbody>
			<?php
				include('db.php');
				$result = mysql_query("SELECT * FROM rates ORDER BY currency ASC");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['currency'].'</td>';
						echo '<td>'.$row['name'].'</td>';
						echo '<td><div align="right">'.$row['buyrate'].'</div></td>';
						echo '<td><div align="right">'.$row['rate'].'</div></td>';
					}
				?> 
			</tbody>
</table>
</div>
</body>
</html>
