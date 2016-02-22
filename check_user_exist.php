<?php
	session_start();

	if (($_SESSION['csrf-token']) == $_GET['csrftoken']) {
		$username = mysql_escape_string($_GET['username']);

		// db connection
		$link = mysqli_connect('localhost','root','','my_db');
		if (!$link) {
		  die('Could not connect: ' . mysqli_error($con));
		}

		// process the query
		$result = mysqli_query($link,"SELECT * FROM users WHERE username='$username'");

		// recreate csrf-token
		$_SESSION["csrf-token"] = hash("sha256", uniqid());

		// check whether username is already exist
		if (mysqli_num_rows($result) > 0) {
		    echo "Error: Username is already exist!";
		} else {
			echo $_SESSION["csrf-token"];
		}

		// close connection
		mysqli_close($link);
	} else {
		echo "Error: csrf-token missmatch!";
	}
?>