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
					<th  style="border-left: 1px solid #C1DAD7"> Symbol </th>
					<th> Currency </th>
					<th> Buy Rates </th>
					<th> Sell Rates </th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
			<?php
				include('db.php');
				$userid= $_SESSION['SESS_MEMBER_ID'];
				$result = mysql_query("SELECT * FROM rates ORDER BY currency ASC");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['currency'].'</td>';
						echo '<td>'.$row['name'].'</td>';
						echo '<td><div align="right">'.$row['buyrate'].'</div></td>';
						echo '<td><div align="right">'.$row['rate'].'</div></td>';
						echo '<td><div align="center"><a rel="facebox" href="editratestoday.php?id='.$row['id'].'" title="Click To Edit"><img src="images/edit.gif"></a> | <a href="#" id="'.$row['id'].'" class="delbutton" title="Click To Delete"><img src="images/delete.gif"></a></div></td>';
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
   url: "deleterate.php",
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
