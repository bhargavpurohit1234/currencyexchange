<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>

<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
	width: 369px;
}
.suggestionsBox {
	position: absolute;
	left: 10px;
	top:55px;
	margin: 0;
	width: 369px;
	padding:0px;
	background-color: #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.combopopup{
	padding:3px;
	width:369px;
	border:1px #CCC solid;
}

</style>	
</head>
<body onLoad="document.getElementById('country').focus();">
<form action="generateid.php" method="post">
Enter Customer Name:<br>
<input type="text" size="25" value="" name="id" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" /><br><br>
     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div>
Transaction Type:<br>
<select name="transmode" class="combopopup">
	<option>Buy</option>
	<option>Sell</option>
</select><br><br>
Method:<br>
<select name="modeofpayment" class="combopopup">
	<option>Cash</option>
	<option>Bank</option>
	<option>Western Union</option>
</select><br><br>
Currency:<br>
<select name="currency" style="margin-right: 7px;" class="combopopup">
<option>USD</option>
<?php
include('db.php');
$result = mysql_query("SELECT * FROM rates ORDER BY currency ASC");

while($row = mysql_fetch_array($result))
  {
	echo '<option>'.$row['currency'].'</option>';
  }
?>
</select><br><br>
<input type="submit" value="Confirm">
</form>
</body>
</html>