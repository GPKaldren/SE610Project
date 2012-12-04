<html>
<body>
<?php
	$con = mysql_connect("localhost","ejk314","password");
	mysql_select_db("security", $con);
	mysql_query("UPDATE people7489 SET Voted=0 WHERE Username='ernestkirstein11271990'",$con);
	echo "Reset."
?>
</body>
</html>