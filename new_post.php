<?php
	
	header("Location:index.php");
	session_start();
	// db connection

	$csrftoken = mysql_escape_string($_POST["csrf-token"]);

	if ($_SESSION['csrf-token']==$csrftoken) {
		$db_link = mysqli_connect("localhost", "root", "", "my_db");
		if (!$db_link) {
		  die("Failed to connect to MySQL: " . mysql_error());
		}
		//menerima input judul, tanggal, dan konten dari dokumen html
		$judul = mysqli_real_escape_string($db_link, $_POST["Judul"]);
		$tanggal = mysqli_real_escape_string($db_link, $_POST["Tanggal"]);
		$file = mysqli_real_escape_string($db_link, $_POST["Image"]);
		$konten = mysqli_real_escape_string($db_link, $_POST["Konten"]);
		$username = mysqli_real_escape_string($db_link, $_SESSION["user-id"]);
		$name = mysqli_real_escape_string($db_link, $_SESSION["name"]);
		$temp_name = hash(uniqid());
		if (move_uploaded_file($_FILES[$file][$tmp_name], $file)) {
			// db query
			$sqlinsert="INSERT INTO Posting(JUDUL, TANGGAL, KONTEN, USERNAME, CREATED_BY) VALUES('$judul','$tanggal','$konten', '$username', '$name')";
			if (!mysqli_query($db_link,$sqlinsert)) {
				die('Error: ' . mysqli_error($db_link));
			}

			// close connection
			mysqli_close($db_link);
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else {
	        echo "false";
	    }
		
	}
?>