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
<div id="mainwrapper" style="width: 550px;">
<h1>
	<a id="addq" href="home.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
	<label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
</h1>
		<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th width="133"  style="border-left: 1px solid #C1DAD7"> Voucher No. </th>
					<th width="133"> Date </th>
					<th width="133"> Name </th>
					<th width="133"> Amount </th>
					<th width="133"> Currency </th>
					<th width="133"> Rate </th>
					<th width="133"> Peso Value </th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
			<?php
				include('db.php');
				$userid= $_SESSION['SESS_MEMBER_ID'];
				$result = mysql_query("SELECT * FROM report");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;"><a rel="facebox" href="viewserial.php?id='.$row['transaction_nu'].'" title="Click To View Use Serial">'.$row['transaction_nu'].'</a></td>';
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
						echo '<td><div align="center"><a rel="facebox" href="editratesnn.php?id='.$row['id'].'" title="Click To Edit"><img src="images/edit.gif"></a>';
						if ($_SESSION['SESS_FIRST_NAME']=="1")
							{
							  echo ' | '.'<a href="#" id="'.$row['id'].'" class="delbutton" title="Click To Delete"><img src="images/delete.gif"></a>';
							}
						echo '</div><td>';
						echo '</tr>';
					}
				?> 
			</tbody>
		</table>
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
   url: "deletefile.php",
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
