<?php
	require_once('auth.php');
?>
<html>
<head>
<title>Currency Exchange System</title>
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
<div id="mainwrapper">
<h1>
<a id="addq" href="home.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
<label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
	<a rel="facebox" href="addcurrency.php" id="addq"><img src="images/edit.gif">Add Currency</a>
	 
</h1>
		<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th width="100" style="border-left: 1px solid #C1DAD7"> Serial </th>
					<th width="150"> Name </th>
					<th width="150"> Complete Address </th>
					<th width="150"> Contact Number </th>
				</tr>
			</thead>
			<tbody>
			<?php
				include('db.php');
				$userid= $_SESSION['SESS_MEMBER_ID'];
				$result = mysql_query("SELECT * FROM transaction ORDER BY cusname ASC");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr>';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['serial'].'</td>';
						$bbbll=$row['cusname'];
						$resultz = mysql_query("SELECT * FROM customer WHERE id='$bbbll'");
						$rowz = mysql_fetch_array($resultz);
							echo '<td>'.$rowz['lname'].' '.$rowz['fname'].'</td>';
							echo '<td>';
							echo $rowz['address'].', '.$rowz['city'].', '.$rowz['country'];
							echo '</td>';
							echo '<td>';
							echo $rowz['contact'];
							echo '</td>';
						
						echo '</tr>';
					}
				?> 
			</tbody>
		</table>
</div>

</body>
</html>
