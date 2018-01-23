<?php
include('db.php');
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM rates where id='$id'");

while($row = mysql_fetch_array($result))
  {
	$rate=$row['rate'];
	$brate=$row['buyrate'];
  }
?>
<style type="text/css">
<!--
.ed{
border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
margin-bottom: 4px;
}
#button1{
text-align:center;
font-family:Arial, Helvetica, sans-serif;
border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
background-color:#00CCFF;
height: 34px;
}
-->
</style>
<script type="text/javascript" src ="countries.js"></script>
<script type="text/javascript">
function validateForm()
{
var x=document.forms["myForm"]["rate"].value;
if (x==null || x=="")
  {
  alert("Rate must be filled out");
  return false;
  }
}
</script>
<form name="myForm" action="editratesexec.php" method="post" enctype="multipart/form-data" name="addroom" onsubmit="return validateForm()">
<input name="id" type="hidden" class="ed" id="brnu" value="<?php echo $id?>" />
Buy Rate <br />
<input name="brate" type="text" class="ed" id="brnu" value="<?php echo $brate?>" />
<br>
Sell Rate <br />
<input name="rate" type="text" class="ed" id="brnu" value="<?php echo $rate?>" />
<br>
<input type="submit" name="Submit" value="save" id="button1" />
</form>
