<?php
	session_start();
	// header("Location:index.php");

	if ($_SESSION['csrf-token'] == mysql_escape_string($_POST["csrf-token"])) {
		$_GET['var'] = $_POST["id"];
		
		// connect to db
		$link = mysqli_connect("localhost", "root", "", "my_db");

	    if (mysqli_connect_errno()) {
	      die ("Failed to connect to MySQL: " . mysqli_connect_error());
	    }

	    // get some data
	    $id = $_POST['id'];
		$_SESSION['judul'] = mysqli_real_escape_string($link, $_POST["Judul"]); $judul = $_SESSION['judul'];
		$_SESSION['konten'] = mysqli_real_escape_string($link, $_POST["Konten"]); $konten = $_SESSION['konten'];
		$userid = $_SESSION['user-id']; $name = $_SESSION['name']; $_SESSION['error_msg'] = "";

		if (isset($_FILES["Image"]) && $_FILES["Image"]["size"] > 0) {
			$file = mysqli_real_escape_string($link, $_FILES["Image"]["name"]);
			$target_dir = "uploads/";
			$file_extension = pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION);
			$serverfilename = uniqid() . "." . $file_extension;
			$target_file = $target_dir . $serverfilename;

			// check if the file is truly an image
	        if(getimagesize($_FILES["Image"]["tmp_name"]) == false) {
	        	$_SESSION['error_msg'] = "This is not a valid image!";
	            header('Location: editpost.php?id='.$userid.'&tok='.$_SESSION['csrf-token'].'&var='.$id);
	            exit();
	        }

		    // Check file size
		    if ($_FILES["Image"]["size"] > 5000000) {
		        $_SESSION['error_msg'] = "The file is too large! 5 MB max file size";
	            header('Location: editpost.php?id='.$userid.'&tok='.$_SESSION['csrf-token'].'&var='.$id);
	            exit();
		    }

		    // Allow certain file formats
		    if($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" && $file_extension != "bmp" ) {
		        $_SESSION['error_msg'] = "File format is not supported! Only jpg, png, jpeg, and bmp are supported!";
	            header('Location: editpost.php?id='.$userid.'&tok='.$_SESSION['csrf-token'].'&var='.$id);
	            exit();
		    }

		    // rename the file until the filename not exist
			while(file_exists($target_file)) {
				$serverfilename = uniqid() . "." . $file_extension;
			    $target_file = $target_dir . $serverfilename;
			}

			$findimage = mysqli_query($link, "SELECT IMAGEFILENAME FROM posting WHERE ID='$id'");
	    	while ($row = mysqli_fetch_assoc($findimage)) {
	    		if (unlink("uploads/" . $row['IMAGEFILENAME'])) {
					if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) { //File uploaded successfully
						$sqlupdate = "UPDATE posting SET JUDUL='$judul', KONTEN='$konten', IMAGEFILENAME='$serverfilename' WHERE Posting.ID=$id";
				    } else {
				        $_SESSION['error_msg'] = "Sorry, there was an error updating your post.";
			            header('Location: editpost.php?id='.$userid.'&tok='.$_SESSION['csrf-token'].'&var='.$id);
			            exit();
				    }
				}
	    	}

		} else {
			$sqlupdate = "UPDATE my_db.posting SET JUDUL='$judul', KONTEN='$konten' WHERE Posting.ID=$id";
		}

		// execute db query
		if (!mysqli_query($link, $sqlupdate)) {
			die('Error: ' . mysqli_error($link));
		}

		// unset unused sessions
		unset($_SESSION['judul']);
		unset($_SESSION['konten']);
		unset($_SESSION['error_msg']);
		unset($_GET['tok']);
		unset($_GET['var']);
		
		// close db connection
		mysqli_close($link);
	} else {
		echo 'token missmatch';
	}
?>