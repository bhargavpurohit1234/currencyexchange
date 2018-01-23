<?php
	echo '<div style="display:none;">';
	require_once('auth.php');
	$dsdsdsds=$_GET['modeofpayment'];
	echo '</div>';
?>
<html>
<head>
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<script type="text/javascript">
function validateForm()
{
var x=document.forms["myForm"]["amount"].value;
if (x==null || x=="")
  {
  alert("amount must be filled out");
  return false;
  }
var x=document.forms["myForm"]["serial"].value;
if (x==null || x=="")
  {
  alert("serial must be filled out");
  return false;
  }
var x=document.forms["myForm"]["amots"].value;
if (x==null || x=="")
  {
  alert("Name must be filled out");
  return false;
  }
}
</script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'src/loading.gif',
		closeImage   : 'src/closelabel.png'
	  })
	})
  </script>
</head>
<body onLoad="document.getElementById('amount').focus();">
<div id="mainwrapper" style="width: 800px;">
<h1>
	<a id="addq" href="home.php" title="click to enter homepage" style="background-image:url('images/out.png'); background-repeat:no-repeat; padding: 3px 12px 12px; margin-right: 10px;"></a>
</h1>
<div>
<form name="myForm" action="savetransaction.php" method="POST" onsubmit="return validateForm()" style="height:auto; clear:both; padding:5px; margin:0;">
	<div style="margin-bottom: 5px;">
		<div style="width:253px; float:left; margin-right:10px;">
			<span>Mode Of Payment:</span><br><span><input type="text" name="modeoftrans" value="<?php echo $dsdsdsds?>" style="width: 253px; border:1px #CCC solid; color:gray;" readonly/></span>
		</div>
		<div style="width:253px; float:left; margin-right:10px;">
			<span>Transaction Type:</span><br><span><input type="text" name="transactiontype" value="<?php echo $_SESSION['mode']?>" style="width: 253px; border:1px #CCC solid; color:gray;" readonly/></span>
		</div>
		<div style="width:253px; float:left; margin-right:10px;">
			<span>Date:</span><br><span><input type="text" name="date" value="<?php echo date("Y-m-d")?>" style="width: 253px; border:1px #CCC solid; color:gray;" readonly/></span>
		</div>
		<div class="clearfix"></div>
	</div>
	<div style="margin-bottom: 5px;">
		<div style="width:385px; float:left; margin-right:10px;">
			<span>Name:</span><br><span><input type="hidden" id="amots" name="amots" value="<?php echo $_SESSION['clientname']?>" style="width: 384px; border:1px #CCC solid; color:gray;" readonly/>
			<input type="text" id="amotss" name="amotss" value="
			<?php
			include('db.php');
			$ghg=$_SESSION['clientname'];
			$resultx = mysql_query("SELECT * FROM customer WHERE id='$ghg'");
				while($rowx = mysql_fetch_array($resultx))
					{
					$tttttt=$rowx['lname'] .' '.$rowx['fname'];
					echo $tttttt;
					}
			?>
			" style="width: 384px; border:1px #CCC solid; color:gray; text-align: left;" readonly/>
			</span>
		</div>
		<div style="width:385px; float:left; margin-right:10px;">
			<span>Voucher:</span><br><span><input type="text" name="transaction" value="<?php echo $_SESSION['transactioncode']?>" style="width: 384px; border:1px #CCC solid; color:gray;" readonly/></span>
		</div>
		<div class="clearfix"></div>
	</div>
	<div style="margin-bottom: 5px;">
		<div style="width:187px; float:left; margin-right:10px;">
		<span>Amount:</span><br><span><input type="text" id="amount" name="amount" style="width: 187px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;"></span>
		</div>
		<div style="width:187px; float:left; margin-right:10px;">
		<span>Currency</span><br><span><input type="text" name="currency" style="width: 187px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;" value="<?php echo $_GET['currency']?>" readonly/></span>
		</div>
		<div style="width:187px; float:left; margin-right:10px;">
		<span>Serial Number</span><br><span><input type="text" name="serial" style="width: 187px; font-size: 11px; height: 22px; border:1px #CCC solid; color:gray;">
		</div>
		<div style="width:187px; float:left; margin-right:10px;">
		<input type="submit" value="Calculate" style="height: 39px; width: 188px; border:1px #CCC solid" ></span>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php 
	if($dsdsdsds=='Cash')
	{
	?>
	<div style="margin-bottom: 5px;">
		<div style="width:187px; float:left; margin-right:10px;">
			<span>Deposit To:</span>
			<span>
			<select name="cvitr" id="brnu" class="ed" style="width: 187px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;">
				<?php
				$qqaass=$_GET['currency'];
				if($qqaass=='USD'){
				?>
				<?php
				include('db.php');
				$queryString='CVI';
				$result = mysql_query("SELECT * FROM bank_account WHERE currency='$qqaass' AND bank_code LIKE '$queryString%'");

				while($row = mysql_fetch_array($result))
				  {
					echo '<option>'.$row['bank_code'].'</option>';
					$ttttyyy=$row['bank_code'];
				  }
				?>
				<?php
				}
				?>
				<?php
				if($qqaass!='USD'){
				include('db.php');
				$result = mysql_query("SELECT * FROM other_bank_account WHERE currency='$qqaass' AND bank_code LIKE '$queryString%'");

				while($row = mysql_fetch_array($result))
				  {
					echo '<option>'.$row['bank_code'].'</option>';
					$ttttyyy=$row['bank_code'];
				  }
				}
				?>
			</select>
			</span>
		</div>
	</div>
	<?php
	}
	?>
	<?php 
	if($dsdsdsds=='Bank')
	{
	?>
	<div style="margin-bottom: 5px;">
		<div style="width:187px; float:left; margin-right:10px;">
		<span>Deposit To:</span>
		<span>
			<select name="bname" id="brnu" class="ed" style="width: 187px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;">
				<?php
				$qqaass=$_GET['currency'];
				if($qqaass=='USD'){
				?>
				<?php
				include('db.php');
				$result = mysql_query("SELECT * FROM bank_account");

				while($row = mysql_fetch_array($result))
				  {
					echo '<option>'.$row['bank_code'].'</option>';
				  }
				?>
				<?php
				}
				?>
				<?php
				if($qqaass!='USD'){
				include('db.php');
				$result = mysql_query("SELECT * FROM other_bank_account");

				while($row = mysql_fetch_array($result))
				  {
					echo '<option>'.$row['bank_code'].'</option>';
				  }
				}
				?>
			</select>
			</span>
		</div>
		<div style="width:384px; float:left; margin-right:10px;">
		<span>Remarks</span><br>
		<span>
			<input type="text" name="remarks" style="width: 384px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;"></span>
		</div>
		<div style="width:188px;; float:left; margin-right:10px;">
		<span>Pay Through</span><br>
		<span>
			<select name="sourceoffund" id="brnu" class="ed" style="width: 188px; border:1px #CCC solid; color:gray; padding: 1px 0; height:22px; font-size:11px;">
			<option>CASH</option>
				<?php
				include('db.php');
				$result = mysql_query("SELECT * FROM bank_account");

				while($row = mysql_fetch_array($result))
				  {
					echo '<option>'.$row['bank_code'].'</option>';
				  }
				?>
			</select></span>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php
	}	
	?>



</form>
</div>
<?php
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<div id="error">';
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>';
			}
			echo '</ul>';
			echo '</div>';
			unset($_SESSION['ERRMSG_ARR']);
			}
			?>
<?php $trans=$_SESSION['transactioncode'];?>
<table cellpadding="1" cellspacing="1" id="resultTable">
			<thead>
				<tr>
					<th  style="border-left: 1px solid #C1DAD7"> Amount </th>
					<th> Currency </th>
					<th> <a rel="facebox" href="discount.php?id=<?php echo $_SESSION['transactioncode'] ?>&mt=<?php echo $dsdsdsds ?>&cur=<?php echo $_GET['currency']?>">Rate</a> </th>
					<th> Serial </th>
					<th> Peso Value </th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
			<?php
			include('db.php');
			function formatMoney($number, $fractional=false) {
				if ($fractional) {
					$number = sprintf('%.2f', $number);
				}
				while (true) {
					$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
					if ($replaced != $number) {
						$number = $replaced;
					} else {
						break;
					}
				}
				return $number;
			}
				
				$result = mysql_query("SELECT * FROM transaction where transaction_nu='$trans'");
				while($row = mysql_fetch_array($result))
					{
						echo '<tr class="record">';
						echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['amount'].'</td>';
						echo '<td>'.$row['currency'].'</td>';
						echo '<td>';
						$ggcur=$row['currency'];
						$ffff=$row['rate'];
						echo $ffff;
						echo '</td>';
						echo '<td>'.$row['serial'].'</td>';
						echo '<td>';
						$bbbb=$row['netconvert'];
						echo formatMoney($bbbb, true);
						echo '</td>';
						echo '<td><div align="center"><a href="#" id="'.$row['id'].'" class="delbutton" title="Click To Delete"><img src="images/delete.gif"></a></div></td>';
						echo '</tr>';
					}
					echo '<tr>';
						echo '<td style="border-left: 1px solid #C1DAD7;">';
							$result = mysql_query("SELECT sum(amount) FROM transaction where transaction_nu='$trans'");
							while($row2 = mysql_fetch_array($result))
							  {
							   echo 'Total: ';
							   $ggggs=$row2['sum(amount)'];
							   echo formatMoney($ggggs, true);
							  }
						echo '</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>&nbsp;</td>';
						echo '<td>';
							$result = mysql_query("SELECT sum(netconvert) FROM transaction where transaction_nu='$trans'");
							while($row2 = mysql_fetch_array($result))
							  {
							   echo 'Total: ';
							   $gggg=$row2['sum(netconvert)'];
							   echo formatMoney($gggg, true);
							  }
						echo '</td>';
						echo '<td>&nbsp;</td>';
					echo '</tr>';
				?> 
			</tbody>
		</table>


<br>
<?php
echo '<div style="display:none;">';
if ($ffff!=''){
echo '</div>';
?>

<INPUT type="button" value="Print" onClick="window.open('receipt.php?transaction_nu=<?php echo $trans ?>&name=<?php echo $tttttt?>&transactiontype=<?php echo $_SESSION['mode']?>&type=<?php echo $dsdsdsds?>&cname=<?php echo $_SESSION['clientname'] ?>&rate=<?php echo $ffff ?>&amount=<?php echo $ggggs ?>&pesoval=<?php echo $gggg?>&cur=<?php echo $ggcur ?>&branch=<?php echo $_SESSION['SESS_LAST_NAME'] ?>&ttype=<?php echo $_SESSION['mode']?>&cvcvc=<?php echo $ttttyyy ?>','mywindow','width=600,height=400,scrollbars=yes')">

<?php
} 
else{
?>
<div style="display:none;">
<INPUT type="button" value="Print" onClick="window.open('receipt.php?transaction_nu=<?php echo $trans ?>&name=<?php echo $tttttt?>&transactiontype=<?php echo $_SESSION['mode']?>&type=<?php echo $dsdsdsds?>&cname=<?php echo $_SESSION['clientname'] ?>&rate=<?php echo $ffff ?>&amount=<?php echo $ggggs ?>&pesoval=<?php echo $gggg?>&cur=<?php echo $ggcur ?>&branch=<?php echo $_SESSION['SESS_LAST_NAME'] ?>&ttype=<?php echo $_SESSION['mode']?>&cvcvc=<?php echo $ttttyyy ?>','mywindow','width=600,height=400,scrollbars=yes')">
</div>
<?php
}
?>
</div>
  <script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deletetrans.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
</body>
</html>