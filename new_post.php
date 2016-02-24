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
		$konten = mysqli_real_escape_string($db_link, $_POST["Konten"]);
		$username = mysqli_real_escape_string($db_link, $_SESSION["user-id"]);
		$name = mysqli_real_escape_string($db_link, $_SESSION["name"]);
		$file = mysqli_real_escape_string($db_link, $_FILES["Image"]["name"]);
		
		$target_dir = "uploads/";
		$file_extension = pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION);
		$serverfilename = uniqid() . "." . $file_extension;
		$target_file = $target_dir . $serverfilename;
		while(file_exists($target_file)) {
			$serverfilename = uniqid() . "." . $file_extension;
		    $target_file = $target_dir . $serverfilename;
		}
		if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
	        //File uploaded successfully
	        // db query
			$sqlinsert="INSERT INTO Posting(JUDUL, TANGGAL, KONTEN, USERNAME, CREATED_BY, IMAGEFILENAME) VALUES('$judul','$tanggal','$konten', '$username', '$name', '$serverfilename')";
			if (!mysqli_query($db_link,$sqlinsert)) {
				die('Error: ' . mysqli_error($db_link));
			}
			// close connection
			mysqli_close($db_link);
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }		
	}
?>