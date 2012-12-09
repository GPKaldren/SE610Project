<html>
<body>
<?php
	$username = "ernestkirstein11271990";
	$con = mysql_connect("localhost","ejk314","password");
	mysql_select_db("security", $con);
	mysql_query("UPDATE people7489 SET Voted=0 WHERE Username='".$username."'",$con);
	mysql_query("TRUNCATE TABLE votes9230",$con);
	
	echo "Reset.";
?>
</body>
</html>