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
		$_SESSION['judul'] = mysqli_real_escape_string($db_link, $_POST["Judul"]);
		$judul = $_SESSION['judul'];
		$_SESSION['tanggal'] = mysqli_real_escape_string($db_link, $_POST["Tanggal"]);
		$tanggal = $_SESSION['tanggal'];
		$_SESSION['konten'] = mysqli_real_escape_string($db_link, $_POST["Konten"]);
		$konten = $_SESSION['konten'];
		$userid = $_SESSION['user-id'];
		$name = $_SESSION['name'];
		$file = mysqli_real_escape_string($db_link, $_FILES["Image"]["name"]);
		
		$target_dir = "uploads/";
		$file_extension = pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION);
		$serverfilename = uniqid() . "." . $file_extension;
		$target_file = $target_dir . $serverfilename;

		// check if the file is truly an image
        if(getimagesize($_FILES["Image"]["tmp_name"]) == false) {
        	$_SESSION['error_msg'] = "The file is not an image!";
            header('Location: add_post.php');
            exit();
        }

	    // Check file size
	    if ($_FILES["Image"]["size"] > 5000000) {
	        $_SESSION['error_msg'] = "The file is too large! 5 MB max file size";
            header('Location: add_post.php');
            exit();
	    }

	    // Allow certain file formats
	    if($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "bmp" ) {
	        $_SESSION['error_msg'] = "File format is not supported! Only jpg, png, jpeg, and bmp are supported!";
            header('Location: add_post.php');
            exit();
	    }

	    // rename the file until the filename not exist
		while(file_exists($target_file)) {
			$serverfilename = uniqid() . "." . $file_extension;
		    $target_file = $target_dir . $serverfilename;
		}

		if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
	        //File uploaded successfully
	        // db query

			$sqlinsert = "INSERT INTO Posting(JUDUL, TANGGAL, KONTEN, USERNAME, CREATED_BY, IMAGEFILENAME) VALUES('$judul', '$tanggal','$konten', '$userid', '$name', '$serverfilename')";

			if (!mysqli_query($db_link, $sqlinsert)) {
				die('Error: ' . mysqli_error($db_link));
			}
			// close connection
			mysqli_close($db_link);
	    } else {
	        $_SESSION['error_msg'] = "Sorry, there was an error uploading your file.";
            header('Location: add_post.php');
            exit();
	    }		
	}
?>