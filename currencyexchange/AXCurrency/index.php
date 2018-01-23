<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<script type="text/javascript">
function validateForm()
{
var x=document.forms["login"]["username"].value;
if (x==null || x=="")
  {
  alert("Username must be filled out");
  return false;
  }
var x=document.forms["login"]["password"].value;
if (x==null || x=="")
  {
  alert("Password must be filled out");
  return false;
  }
}
</script>
<script type="text/javascript">
function validateForms()
{
var x=document.forms["regs"]["adminpass"].value;
if (x==null || x=="")
  {
  alert("Admin Password must be filled out");
  return false;
  }
var x=document.forms["regs"]["position"].value;
if (x==null || x=="")
  {
  alert("Position must be filled out");
  return false;
  }
var x=document.forms["regs"]["regusername"].value;
if (x==null || x=="")
  {
  alert("Username must be filled out");
  return false;
  }
var x=document.forms["regs"]["regpassword"].value;
if (x==null || x=="")
  {
  alert("Password must be filled out");
  return false;
  }
}
</script>
<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />

        <title>Currency Exchange System</title>

        

        <!-- Our CSS stylesheet file -->

        <link rel="stylesheet" href="styles.css" />

        

        <!--[if lt IE 9]>

          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

        <![endif]-->

    </head>

    

<body>
<div id="header">
	<div id="headercontent">
		Currency Exchange System
	</div>
	<div id="headercontent1">
		Currency Exchange System
	</div>
</div>
	<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
echo '<ul class="err">';
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo '<li>',$msg,'</li>';
}
echo '</ul>';
unset($_SESSION['ERRMSG_ARR']);
}
?>
</div>


		<div id="formContainer">

			<form id="login" name="login" method="post" action="login.php" style="height: 222px;" onsubmit="return validateForm()">

				
				<h1>
				<div style="width: 190px; float:left;">
				<strong>Currency Exchange System</strong>
				<br>Login your account!</br>
				</div>
				<div style="width: 60px; float:right;">
				<a href="#" id="flipToRecover" class="flipLink">Register User</a>
				</div>
				<div class="clearfix"></div>
				</h1>
				<input type="text" name="username" id="loginEmail" placeholder="Username" style="width: 240px;" />

				<input type="password" name="password" id="loginPass" placeholder="Password" style="width: 240px;" />

				<input type="submit" id="buttonxxxx" name="submit" value="Login" />

			</form>

			<form id="recover" name="regs" method="post" action="register.php" style="height: 332px;" onsubmit="return validateForms()">
				<h1>
				<div style="width: 60px; float:left;">
				<a href="#" id="flipToLogin" class="flipLink">Back To Login</a>
				</div>
				<div style="width: 208px; float:right;">
				Welcome to
				<strong>Currency Exchange System</strong>
				Register a new account!
				</div>
				<div class="clearfix"></div>
				</h1>
				<input type="password" name="adminpass" id="loginEmail" placeholder="Admin Password" style="width: 240px;" />
				<select name="position" id="loginEmail" style="width: 240px;">
					<option value="1">admin</option>
					<option value="2">user</option>
				</select>
				<input type="text" name="regusername" id="loginEmail" placeholder="Username" style="width: 240px;" />
				<input type="password" name="regpassword" id="recoverEmail" placeholder="Password" style="width: 240px;" />
				<select name="branch" id="loginEmail" style="width: 240px;">
					<option value="0">Select Branch</option>
					<option value="1">AX Currency - 6th Street</option>
					<option value="2">AX Currency - Galo</option>
				</select>
				<input type="submit" id="buttonxxxx" name="submit" value="Save" />
			</form>

		</div>

	<div id="footer">
		&copy 2012 Currency Exchange System. All rights reserved. Powered by <a href="#" target="_blank">begie</a>
	</div>

    <!-- JavaScript includes -->

	<script src="jquery-1.7.1.min.js"></script>

		<script src="script.js"></script>


    

</body>

</html>



