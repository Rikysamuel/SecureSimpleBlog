<?php
	header("Location:index.php");
	$link=mysqli_connect("localhost","root","","my_db");
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $id = $_GET['var'];

	$sqlupdate="DELETE FROM my_db.posting WHERE Posting.ID=$id";
	if (!mysqli_query($link,$sqlupdate)) {
		die('Error: ' . mysqli_error($link));
	}
	
	mysqli_close($link);
    exit;
?>