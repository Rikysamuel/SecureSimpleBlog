<?php
	session_start();

	if (($_SESSION['csrf-token']) == $_POST['csrftoken']) {
		// sql open connection
		$db_link = mysqli_connect("localhost", "root", "", "my_db");
		if (!$db_link) {
		  die("Failed to connect to MySQL: " . mysql_error());
		}

		$name = mysql_escape_string($_POST["name"]);
		$username = mysql_escape_string($_POST["username"]);
		$email = mysql_escape_string($_POST["email"]);
		$password = mysql_escape_string($_POST["password"]);

		// insert record
		$sqlinsert="INSERT INTO users(Name, Username, email, password, n) VALUES('$name','$username','$email','$password','10000')";

		if (!mysqli_query($db_link,$sqlinsert)) {
			die('Error: ' . mysqli_error($db_link));
		}

		// sql close connection
		mysqli_close($db_link);
	} else {
		echo "Error: csrf-token missmatch!";
	}
?>