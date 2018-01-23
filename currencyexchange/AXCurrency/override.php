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
<form action="savepower.php" method="post">
Admin Password <br />
<input type="password" name="adminpass" /><br>
User<br>
<select name="username" id="brnu" class="ed" style="width: 187px; border:1px #CCC solid; padding: 1px 0; height:22px; font-size:11px;">
<?php
include('db.php');
$result = mysql_query("SELECT * FROM user");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['username'].'</option>';
  }
?>
</select>
<br>
<input type="submit" name="Submit" value="Allow" id="button1" />
</form>