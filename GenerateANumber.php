<?php 
	//check that the username and pass are correct
	$con = mysql_connect("localhost","ejk314","password");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("security", $con);
	$result = mysql_query("SELECT * FROM people7489 WHERE Username='" . $_REQUEST["username"] . "'", $con);
	if($result == false){
		echo "001: Database Connection Error";
		die();
	}
	$row = mysql_fetch_array($result);
	if($row){
		//verity that the double-hashed password matches the actual double-hashed password
		if($_REQUEST["passhash"] == hash("sha256", $row['PassHash'])){
			if($row['Voted'] != 0){
				echo "003: You have already recieved a voting number.";
				die();
			}
		}
		else{
			echo "002: Invalid Username and Password Combination.";
			die();
		}
	}
	else{
		echo "002: Invalid Username and Password Combination.";
		die();
	}
	
	//generate a unique 10 digit random ID number
	$id = getRandNum();
	while(isUsed($id, $con))
		$id = getRandNum();
	
	//generate random 10 digit password number and hash
	$pass = getRandNum();
	$passhash =  hash("sha256", $pass);
	
	//store the ID and passhash in the database
	mysql_query("INSERT INTO votes9230 (ID, PassHash, Vote) VALUES ('".$id."', '" . $passhash . "','')",$con);
	//update the person's database entry to having a voting number
	mysql_query("UPDATE people7489 SET Voted=1 WHERE Username='".$_REQUEST["username"]."'",$con);
	
	//Encrypt with the users password hash and give to the user
	$ciphertext = encryptStringToHex($id.$pass, $row['PassHash']);
	echo "999: " . $ciphertext."|".$id.$pass;
	
	function getRandNum(){
		$num = "";
		for($i = 0; $i < 10; $i++){
			$dig = rand(0,9);
			$num .= $dig;
		}
		return $num;
	}
	
	function isUsed($id, $con){
		$result = mysql_query("SELECT * FROM votes9230 WHERE ID='" . $id . "'", $con);
		if($result == false){
			echo "Database Connection Error";
			die();
		}
		$row = mysql_fetch_array($result);
		if($row){
			return true;
		}
		else{
			return false;
		}
	}
	
	//converts a hex string to a byte array
	function hexToBytes($hexstr){
		$bytes = array();
		for ($i = 0; $i < strlen($hexstr); $i += 2) {
			$bytes[] = hexdec(substr($hexstr, $i, 2));
		}
		return $bytes;
	}
	
	//converts a byte array to a hex string
	function bytesToHex($bytes){
		$hexstr = "";
		for ($i = 0; $i < count($bytes); $i ++) {
			if($bytes[$i]<=15)
				$hexstr .= "0";
			$hexstr .= dechex($bytes[$i]);
		}
		return $hexstr;
	}
	
	//converts a string into an array of bytes
	function strToBytes($str) {
		$bytes = array();
		for($i = 0; $i < strlen($str); $i++) {
			$char = substr($str, $i, 1);
			$bytes[] = ord($char) >> 8;
			$bytes[] = ord($char) & 0xff;
		}
		return $bytes;
	}
	
	function encryptStringToHex($str, $key){
		$key = substr($key, 32, 32) . substr($key, 0, 32);
		$key = hash("sha256", $key);
		$key = hash("sha256", $key);
		$k = hexToBytes($key);
		$m = strToBytes($str);
		$m_ = array();
		for($i = 0; $i < count($m); $i++){
			//echo $m[$i] . "<br>";
			$m_[] = $m[$i] ^ $k[$i%32];
		}
		return bytesToHex($m_);
	}
?>