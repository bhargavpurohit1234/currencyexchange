<?php
include('db.php');
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM bank_account where id='$id'");

while($row = mysql_fetch_array($result))
  {
$bank_code=$row['bank_code'];
$bank_name=$row['bank_name'];
$currency=$row['currency'];
$account_num=$row['account_num'];
$debit=$row['debit'];
$credit=$row['credit'];
$balance=$row['balance'];
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
var x=document.forms["myForm"]["bcode"].value;
if (x==null || x=="")
  {
  alert("Bank Code must be filled out");
  return false;
  }
var x=document.forms["myForm"]["bname"].value;
if (x==null || x=="")
  {
  alert("Bank Name must be filled out");
  return false;
  }
var x=document.forms["myForm"]["anum"].value;
if (x==null || x=="")
  {
  alert("Account Number must be filled out");
  return false;
  }
var x=document.forms["myForm"]["cur"].value;
if (x==null || x=="")
  {
  alert("Currency must be filled out");
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
var x=document.forms["myForm"]["balance"].value;
if (x==null || x=="")
  {
  alert("Balance must be filled out");
  return false;
  }
}
</script>
<form name="myForm" action="editaccountexec.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<input name="id" type="hidden" class="ed" id="brnu" value="<?php echo $id?>" />
Bank Code <br />
<input name="bcode" type="text" class="ed" id="brnu" value="<?php echo $bank_code?>" />
<br />
Bank Name <br />
<input name="bname" type="text" class="ed" id="brnu" value="<?php echo $bank_name?>" />
<br>
Account Number <br />
<input name="anum" type="text" class="ed" id="brnu" value="<?php echo $account_num?>" />
<br>
Currency <br />
<select name="cur" id="brnu" class="ed">
<?php
include('db.php');
$result = mysql_query("SELECT * FROM rates WHERE currency='USD'");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['currency'].'</option>';
  }
?>
</select>
<br>
Debit <br />
<input name="deb" type="text" class="ed" id="brnu" value="<?php echo $debit?>" />
<br>
Credit <br />
<input name="cred" type="text" class="ed" id="brnu" value="<?php echo $credit?>" />
<br>
Balance <br />
<input name="balance" type="text" class="ed" id="brnu" value="<?php echo $balance?>" />
<br>
<input type="submit" name="Submit" value="save" id="button1" />
</form
