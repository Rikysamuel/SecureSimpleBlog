<?php
	session_start();

	if ($_SESSION["csrf-token"]==stripslashes(mysql_escape_string($_POST["csrftoken"]))) {
		// sql open connection
		$db_link = mysqli_connect("localhost", "root", "", "my_db");
		if (!$db_link) {
		  die("Failed to connect to MySQL: " . mysql_error());
		}

		$token = stripslashes(mysql_escape_string($_POST["token"]));

		$result = mysqli_query($db_link, "SELECT * FROM users WHERE last_session='$token'");
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
	    		$now = date('Y-m-d G:i:s');

	    		// for session data
				$date = date_create();
				$content = $row["Name"] + $row["Username"] + $row["email"] + date_timestamp_get($date);
				$session_token = hash("sha256", $content);
				
			    $sqlupdate="UPDATE users SET last_login='$now' , last_session='$session_token' WHERE last_session='$token'";

				if ($db_link->query($sqlupdate) === TRUE) {

					session_unset();
					// session_destroy();
					session_regenerate_id();

					// CREATE USER-SESSION
					$_SESSION["name"] = $row["Name"];
					$_SESSION["user-id"] = $row["Username"];
					$_SESSION["token"] = $session_token;
					
					unset($_GET['tok']);
					
				    echo $_SESSION["token"];
				} else {
					echo "false";
				    // echo "Error updating record: " . $db_link->error;
				}
	    		
				
		    }
		} else {
			$params = session_get_cookie_params();
			setcookie("cookieid", $_COOKIE["cookieid"], 1, $params["path"], $params["domain"], true, true);
			echo "false";
		}
	    

		// sql close connection
		$db_link->close();
	} else {
		echo "false";
	}
?>