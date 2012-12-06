<?php 
	//check that the username and pass are correct
	$con = mysql_connect("localhost","ejk314","password");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("security", $con);
	$result = mysql_query("SELECT * FROM votes9230 WHERE ID='" . $_REQUEST["id"] . "'", $con);
	if($result == false){
		echo "001: Database Connection Error";
		die();
	}
	$row = mysql_fetch_array($result);
	if($row){
		//verity that the double-hashed password matches the actual double-hashed password
		if($_REQUEST["passhash"] == hash("sha256", $row['PassHash'])){
			if($row['Vote'] != ""){
				echo "003: You have already voted.";
				die();
			}
		}
		else{
			echo "002: Invalid Voter Registration Number";
			die();
		}
	}
	else{
		echo "002: Invalid Voter Registration Number";
		die();
	}
	
	//decrypt the vote
	$plaintext = decryptHexToString($_REQUEST["vote"], $row['PassHash']);
	
	//store the vote in the database
	mysql_query("UPDATE votes9230 SET Vote='".$plaintext."' WHERE ID='".$_REQUEST["id"]."'",$con);
	
	//return success code
	echo "999: Vote Successfully Cast:".$plaintext.":".$_REQUEST["vote"];
	
	
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
	
	//converts an array of bytes into a string
	function bytesToStr($bytes) {
		$str = "";
		for($i = 0; $i < count($bytes); $i+=2) {
			$ascii = ($bytes[$i]<<8)+$bytes[$i+1];
			$str .= chr($ascii);
		}
		return $str;
	}
	
	//a simple polyalphabetic substitution cipher
	function decryptHexToString($str, $key){
		$key = substr($key, 32, 32) . substr($key, 0, 32);
		$key = hash("sha256", $key);
		$key = hash("sha256", $key);
		$k = hexToBytes($key);
		$m_ = hexToBytes($str);
		$m = array();
		for($i = 0; $i < count($m_); $i++){
			$m[] = $m_[$i] ^ $k[$i%32];
		}
		return bytesToStr($m);
	}
?>