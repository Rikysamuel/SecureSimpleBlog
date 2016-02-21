<?php
//id posting pada database
$username = mysql_escape_string($_GET['username']);

//koneksi ke database
$link = mysqli_connect('localhost','root','','my_db');
if (!$link) {
  die('Could not connect: ' . mysqli_error($con));
}

//mengambil data dari database dan menaruh kedalam array "row"
$result = mysqli_query($link,"SELECT * FROM users WHERE username='$username'");
// while($row[] = );

//mencetak ke halaman html
if (mysqli_num_rows($result) > 0) {
    echo "Username already exist!";
} else {
	echo "Ok";
}


//menutup koneksi
mysqli_close($link);
?>