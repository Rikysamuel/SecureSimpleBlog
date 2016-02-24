<?php
    session_start();
    header("Location:index.php");

    if (!isset($_SESSION["token"])) {
        header('Location: index.php');
    }

    if ($_SESSION['user-id'] != $_GET['user']) {
        header('Location: index.php');
    }

    if ($_SESSION['csrf-token'] != $_GET['token']) {
        header('Location: index.php');
    }

	$link = mysqli_connect("localhost","root","","my_db");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $id = stripslashes(mysql_escape_string($_GET['var']));

    $result = mysqli_query($link, "SELECT * FROM posting WHERE ID = $id");
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["IMAGEFILENAME"] != "null") {
            unlink("uploads/" . $row["IMAGEFILENAME"]);
        }
    }

	$sqlupdate="DELETE FROM my_db.posting WHERE posting.ID=$id";
	if (!mysqli_query($link,$sqlupdate)) {
		die('Error: ' . mysqli_error($link));
	}
	
	mysqli_close($link);
?>