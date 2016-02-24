<?php
	session_start();
	// echo $_GET["token"];
	if ($_SESSION["csrf-token"] == stripslashes(mysql_escape_string($_GET["token"]))) {
		$username = stripslashes(mysql_escape_string($_GET['username']));

		// db connection
		$link = mysqli_connect('localhost','root','','my_db');
		if (!$link) {
		  die('Could not connect: ' . mysqli_error($con));
		}

		// process the query
		$result = mysqli_query($link,"SELECT * FROM users WHERE username='$username'");

		// check whether username is already exist
		if (mysqli_num_rows($result) > 0) {
		    while ($row = mysqli_fetch_assoc($result)) {
		    	$_SESSION["csrf-token"] = hash("sha256", uniqid());

		    	$ret[0] = $row['n'];
		    	$ret[1] = $_SESSION["csrf-token"];

		    	echo json_encode($ret);
		    }
		} else {
			echo "false";
		}

		// close connection
		mysqli_close($link);

		// regenerate csrf-token

	} else {
		echo "false";
	}
?>