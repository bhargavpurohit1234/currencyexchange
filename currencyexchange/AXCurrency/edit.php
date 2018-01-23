<?php
include('db.php');
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM customer where id='$id'");

while($row = mysql_fetch_array($result))
  {
$fname=$row['fname'];
$lname=$row['lname'];
$contact=$row['contact'];
$country=$row['country'];
$city=$row['city'];
$address=$row['address'];
$gender=$row['gender'];
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
var x=document.forms["myForm"]["fname"].value;
if (x==null || x=="")
  {
  alert("First name must be filled out");
  return false;
  }
var x=document.forms["myForm"]["lname"].value;
if (x==null || x=="")
  {
  alert("Last name must be filled out");
  return false;
  }
var x=document.forms["myForm"]["contact"].value;
if (x==null || x=="")
  {
  alert("Contact must be filled out");
  return false;
  }
var x=document.forms["myForm"]["country"].value;
if (x==null || x=="")
  {
  alert("Country must be filled out");
  return false;
  }
var x=document.forms["myForm"]["city"].value;
if (x==null || x=="")
  {
  alert("City must be filled out");
  return false;
  }
var x=document.forms["myForm"]["address"].value;
if (x==null || x=="")
  {
  alert("Address must be filled out");
  return false;
  }
var x=document.forms["myForm"]["gender"].value;
if (x==null || x=="")
  {
  alert("First name must be filled out");
  return false;
  }
}
</script>
<form name="myForm" action="editexec.php" method="post" enctype="multipart/form-data" name="addroom" onsubmit="return validateForm()">
<input name="id" type="hidden" class="ed" id="brnu" value="<?php echo $id?>" />
First Name <br />
<input name="fname" type="text" class="ed" id="brnu" value="<?php echo $fname?>" />
<br />
Last Name <br />
<input name="lname" type="text" id="mnu" class="ed" value="<?php echo $lname?>" />
<br />
Contact <br />
<input name="contact" type="text" id="mnu" class="ed" value="<?php echo $contact?>" />
<br />
Country<br />
<select onchange="print_state('state',this.selectedIndex);" id="country" class="ed" name ="country"></select>
<br />
City<br />
<select name ="city" id ="state" class="ed"></select>
<script language="javascript">print_country("country");</script>
<br />
Street Address <br />
<input name="address" type="text" id="mnu" class="ed" value="<?php echo $address?>"/>
<br />
Gender <br />
<select name="gender" class="ed">
<option>Male</option>
<option>Female</option>
</select>
<br />
<input type="submit" name="Submit" value="save" id="button1" />
</form
