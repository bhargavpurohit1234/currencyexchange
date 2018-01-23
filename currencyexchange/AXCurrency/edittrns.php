<?php
include('db.php');
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM bank_transfer where id='$id'");

while($row = mysql_fetch_array($result))
  {
$trn_num=$row['trn_num'];
$date=$row['date'];
$debit=$row['debit'];
$credit=$row['credit'];
$remarks=$row['remarks'];
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
var x=document.forms["myForm"]["bname"].value;
if (x==null || x=="")
  {
  alert("Bank Name must be filled out");
  return false;
  }
var x=document.forms["myForm"]["deb"].value;
if (x==null || x=="")
  {
  alert("Debit must be filled out");
  return false;
  }
var x=document.forms["myForm"]["cred"].value;
if (x==null || x=="")
  {
  alert("Credit must be filled out");
  return false;
  }
var x=document.forms["myForm"]["remarks"].value;
if (x==null || x=="")
  {
  alert("Remarks must be filled out");
  return false;
  }
}
</script>
<form name="myForm" action="editdebit.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<input name="id" type="hidden" class="ed" id="brnu" value="<?php echo $id?>" />
Transaction Date <br />
<input name="tdate" type="text" class="ed" id="brnu" value="<?php echo date("Y-m-d");?>" readonly />
<br />
Transaction Number <br />
<input name="tnum" type="text" class="ed" id="brnu" value="<?php echo $trn_num;?>" readonly />
<br>
Bank Name <br />
<select name="bname" id="brnu" class="ed">
<?php
include('db.php');
$result = mysql_query("SELECT * FROM bank_account");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['bank_code'].'</option>';
  }
?>
</select>
<br>
Debit <br />
<input name="deb" type="text" class="ed" id="brnu" value="<?php echo $debit;?>" />
<br>
Credit <br />
<input name="cred" type="text" class="ed" id="brnu" value="<?php echo $credit;?>" />
<br>
Remarks <br />
<input name="remarks" type="text" class="ed" id="brnu" value="<?php echo $remarks;?>" />
<br>
<input type="submit" name="Submit" value="save" id="button1" />
</form
