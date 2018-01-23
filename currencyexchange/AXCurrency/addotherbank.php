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
<div id="mainwrapper" style="width:670px;">
<h1>
<a id="addq" href="btransferhome.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
<label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
	<a rel="facebox" href="addotherbankaccount.php" id="addq"><img src="images/edit.gif">Add Account</a>
	 
</h1>
		<table cellpadding="1" cellspacing="1" id="resultTable" width="">
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
					<?php
					if ($_SESSION['SESS_FIRST_NAME']=="1")
					{
					?>
					<th> Action </th>
					<?php
					}
					?>
				</tr>
			</thead>
			<tbody>
			<?php
			include('db.php');
				$result = mysql_query("SELECT * FROM other_bank_account ORDER BY bank_code ASC");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['bank_code'].'</td>';
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
						if ($_SESSION['SESS_FIRST_NAME']=="1")
						{
						echo '<td><div align="center"><a rel="facebox" href="editotheraccount.php?id='.$row['id'].'" title="Click To Edit"><img src="images/edit.gif"></a> | <a href="#" id="'.$row['id'].'" class="delbutton" title="Click To Delete"><img src="images/delete.gif"></a></div></td>';
						}
						echo '</tr>';
					}
				?> 
			</tbody>
		</table>
		<INPUT type="button" value="Print" onClick="window.open('reportotheraccount.php','mywindow','width=900,height=600,scrollbars=yes')">
</div>

  <script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteotheraccount.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>

</body>
</html>
