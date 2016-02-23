<?php
    session_start();
    if (!isset($_SESSION["token"])) {
        header('Location: index.php');
    }

    if ($_SESSION['user-id'] != $_GET['user']) {
        header('Location: index.php');
    }

    if ($_SESSION['csrf-token'] != $_GET['token']) {
        header('Location: index.php');
    }

	header("Location:index.php");

	$link=mysqli_connect("localhost","root","","my_db");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $id = stripslashes(mysql_escape_string($_GET['var']));

	$sqlupdate="DELETE FROM my_db.posting WHERE posting.ID=$id";
	if (!mysqli_query($link,$sqlupdate)) {
		die('Error: ' . mysqli_error($link));
	}
	
	mysqli_close($link);
    exit;
?>