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
<form action="cvitransexec.php" method="post">
Amount <br />
<input type="text" name="amount" /><br>
From<br>
<select name="fddd" id="brnu" class="ed" style="width: 187px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;">
<?php
include('db.php');
$result = mysql_query("SELECT * FROM bank_account");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['bank_code'].'</option>';
  }
?>

<?php
include('db.php');
$result = mysql_query("SELECT * FROM other_bank_account");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['bank_code'].'</option>';
  }
?>
</select>
<br>
To<br>
<select name="tddd" id="brnu" class="ed" style="width: 187px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;">
<?php
include('db.php');
$result = mysql_query("SELECT * FROM bank_account");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['bank_code'].'</option>';
  }
?>

<?php
include('db.php');
$result = mysql_query("SELECT * FROM other_bank_account");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['bank_code'].'</option>';
  }
?>
</select>
<br>
<input type="submit" name="Submit" value="save" id="button1" />
</form>