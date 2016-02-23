<?php
	session_start();

	if ($_SESSION["csrf-token"]==mysql_escape_string($_POST["token"])) {
		// sql open connection
		$db_link = mysqli_connect("localhost", "root", "", "my_db");
		if (!$db_link) {
		  die("Failed to connect to MySQL: " . mysql_error());
		}

		$username = stripslashes(mysql_escape_string($_POST["username"]));
		$password = stripslashes(mysql_escape_string($_POST["password"]));
		$h_password = hash("sha256", $password);

		$result = mysqli_query($db_link, "SELECT * FROM users WHERE username='$username'");
	    while ($row = mysqli_fetch_assoc($result)) {
	    	if (strcmp($row["password"], $h_password) == 0) {
	    		$n = intval($row["n"]) - 1;
	    		$now = date('Y-m-d G:i:s');

	    		// for session data
				$date = date_create();
				$content = $row["Name"] + $row["Username"] + $row["email"] + date_timestamp_get($date);
				$session_token = hash("sha256", $content);
	    		
				$sqlupdate="UPDATE users SET password='$password', n='$n', last_login='$now' WHERE username='$username'";

				if ($db_link->query($sqlupdate) === TRUE) {
					// recreate the session
					session_unset();
					session_destroy();
					session_start();

					// CREATE USER-SESSION
					$_SESSION["name"] = $row["Name"];
					$_SESSION["user-id"] = $row["Username"];
					$_SESSION["token"] = $session_token;

					unset($_GET['tok']);
					
				    echo "success";
				} else {
					echo "false";
				    // echo "Error updating record: " . $db_link->error;
				}
	    	} else {
	    		echo "false";
	    	}
	    }

		// sql close connection
		$db_link->close();
	} else {
		echo "false";
	}
?>