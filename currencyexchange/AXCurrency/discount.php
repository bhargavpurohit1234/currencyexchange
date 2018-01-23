<?php
	require_once('auth.php');
?>
<?php
include('db.php');
$oper_id=$_SESSION['SESS_MEMBER_ID'];
$result = mysql_query("SELECT * FROM user where id='$oper_id'");
				while($row = mysql_fetch_array($result))
					{
					$uuuu=$row['username'];
					}
?>
<?php
include('db.php');
$results = mysql_query("SELECT * FROM power WHERE username='$uuuu'");
$count=mysql_num_rows($results);
if($count==0)
{
$adminpass='';
}
if($count!=0)
{
while($rows = mysql_fetch_array($results))
  {
	$adminpass=$rows['adminpass'];
  }
}
?>
<form action="execdiscount.php" method="post">
Admin Password<br>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="mt" value="<?php echo $_GET['mt']; ?>" />
<input type="hidden" name="cur" value="<?php echo $_GET['cur']; ?>" />
<input type="password" name="adminpass" value="<?php echo $adminpass ?>" readonly/><br>
Rate<br>
<input type="password" name="rate" /><br>
<input type="submit" value="Recalculate">
</form>