<?php
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
    echo "Username is already exist!";
} else {
	echo "Ok";
}

// close connection
mysqli_close($link);
?>