<?php
	// sql open connection
	$db_link = mysqli_connect("localhost", "root", "", "my_db");
	if (!$db_link) {
	  die("Failed to connect to MySQL: " . mysql_error());
	}

	// decrypting process
	$key = pack("H*", "0123456789abcdef0123456789abcdef");
	$iv =  pack("H*", "abcdef9876543210abcdef9876543210");
	$param = base64_decode($_POST["param"]);

	$param = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $param, MCRYPT_MODE_CBC, $iv));


	// trim the param
	$param = explode(":", $param);

	// insert record
	$sqlinsert="INSERT INTO users(Name, Username, email, password, role, n) VALUES('$param[0]','$param[1]','$param[2]','$param[3]','0','$param[4]')";

	if (!mysqli_query($db_link,$sqlinsert)) {
		die('Error: ' . mysqli_error($db_link));
	}

	// sql close connection
	mysqli_close($db_link);
?>