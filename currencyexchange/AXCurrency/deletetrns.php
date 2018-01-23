
<?php

// This is a sample code in case you wish to check the username from a mysql db table
include('db.php');
if($_GET['id'])
{
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM bank_transfer where id='$id'");
while($row = mysql_fetch_array($result))
  {
  $d=$row['debit'];
  $c=$row['credit'];
  $b=$row['bank_name'];
  $pesoval=$row['pesoval'];
  }
  if($d=='0'){
  mysql_query("UPDATE bank_account SET debit=debit, credit=credit-'$c', balance=balance+'$c' WHERE bank_name='$b'");
  mysql_query("UPDATE other_bank_account SET debit=debit, credit=credit-'$c', balance=balance+'$c', pesoval=pesoval+'$pesoval' WHERE bank_name='$b'");
  }
  if($d!='0'){
  mysql_query("UPDATE bank_account SET debit=debit-'$d', credit=credit, balance=balance-'$d' WHERE bank_name='$b'");
  mysql_query("UPDATE other_bank_account SET debit=debit-'$d', credit=credit, balance=balance-'$d', pesoval=pesoval-'$pesoval' WHERE bank_name='$b'");
  }
 $sql = "delete from bank_transfer where id='$id'";
 mysql_query( $sql);
}

?>