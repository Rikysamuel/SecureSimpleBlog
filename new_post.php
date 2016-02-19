<?php
	//redirect ke halaman lain
	header("Location:index.php");
	//koneksi ke database
	$db_link = mysqli_connect("localhost", "root", "", "my_db");
	if (!$db_link) {
	  die("Failed to connect to MySQL: " . mysql_error());
	}

	//menerima input judul, tanggal, dan konten dari dokumen html
	$judul = mysqli_real_escape_string($db_link,$_POST["Judul"]);
	$tanggal = mysqli_real_escape_string($db_link,$_POST["Tanggal"]);
	$konten = mysqli_real_escape_string($db_link,$_POST["Konten"]);

	//memasukan data judul,tanggal, konten kedalam database
	$sqlinsert="INSERT INTO Posting(JUDUL, TANGGAL, KONTEN) VALUES('$judul','$tanggal','$konten')";
	if (!mysqli_query($db_link,$sqlinsert)) {
		die('Error: ' . mysqli_error($db_link));
	}

	//menutup koneksi ke database
	mysqli_close($db_link);
	exit;
?>