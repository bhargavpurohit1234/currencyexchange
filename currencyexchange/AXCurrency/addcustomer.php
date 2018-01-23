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
<form name="myForm" action="addexec.php" method="post" enctype="multipart/form-data" name="addroom" onsubmit="return validateForm()">
First Name <br />
<input name="fname" type="text" class="ed" id="brnu" />
<br />
Last Name <br />
<input name="lname" type="text" id="mnu" class="ed" onkeypress="return isNumberKey(event)" />
<br />
Middle Name <br />
<input name="mname" type="text" class="ed" id="brnu" />
<br />
Contact <br />
<input name="contact" type="text" id="mnu" class="ed" onkeypress="return isNumberKey(event)" />
<br />
Country<br />
<select onchange="print_state('state',this.selectedIndex);" id="country" class="ed" name ="country"></select>
<br />
City<br />
<select name ="city" id ="state" class="ed"></select>
<script language="javascript">print_country("country");</script>
<br />
Address <br />
<input name="address" type="text" id="mnu" class="ed" />
<br />
Gender <br />
<select name="gender" class="ed">
<option>Male</option>
<option>Female</option>
</select>
<br />
<input type="submit" name="Submit" value="save" id="button1" />
</form
