<?php
	session_start();
	if ($_SESSION["csrf-token"]==mysql_escape_string($_GET["token"])) {
		$username = mysql_escape_string($_GET['username']);

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
		    	echo $row["n"];
		    }
		} else {
			echo "false";
		}

		// close connection
		mysqli_close($link);	
	} else {
		echo "false";
	}
?>