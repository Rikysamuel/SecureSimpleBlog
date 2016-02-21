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
	$param = explode(":", $param);

	$username = mysql_escape_string($param[0]);
	$password = $param[1];
	$h_password = hash("sha256", $password);

	$result = mysqli_query($db_link, "SELECT * FROM users WHERE username='$username'");
    while ($row = mysqli_fetch_assoc($result)) {
    	if (strcmp($row["password"], $h_password) == 0) {
    		$n = intval($row["n"]) - 1;
			$sqlupdate="UPDATE users SET password='$password', n='$n' WHERE username='$username'";

			if ($db_link->query($sqlupdate) === TRUE) {
			    echo "success";
			} else {
			    echo "Error updating record: " . $db_link->error;
			}
    	} else {
    		echo "false";
    	}
    }

	// sql close connection
	$db_link->close();
?>