<?php
include('db.php');
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM report where id='$id'");

while($row = mysql_fetch_array($result))
  {
	$rate=$row['rate'];
	$amount=$row['amount'];
  }
?>
<style type="text/css">

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
</style>
<form action="editratesnnexec.php" method="post">
<input name="id" type="hidden" class="ed" id="brnu" value="<?php echo $id?>" />
Sell Rate <br />
<input name="rate" type="text" class="ed" id="brnu" value="<?php echo $rate?>" />
<br>
Amount <br />
<input name="amount" type="text" class="ed" id="brnu" value="<?php echo $amount?>" />
<br>
<input type="submit" name="Submit" value="save" id="button1" />
</form>