<html>
<body>
<?php
	$con = mysql_connect("localhost","ejk314","password");
	if (!$con)
	 {
	  die('Could not connect: ' . mysql_error());
	 }
	 mysql_select_db("security", $con);
	 $passhash = hash("sha256", "314159265");
	if (mysql_query("INSERT INTO people7489 (Username, PassHash, Voted) VALUES ('ernestkirstein11271990', '" . $passhash . "',0)",$con))
	  {
	  echo "Inserted";
	  }
	else
	  {
	  echo "Insertion Failed";
	  }
?>
</body>
</html>