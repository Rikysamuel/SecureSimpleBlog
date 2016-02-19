<?php
	//koneksi ke database
	$db_link = mysqli_connect("localhost", "root", "", "my_db");
	if (!$link) {
  		die('Could not connect: ' . mysqli_error($con));
	}

	//mengambil nilai id dari url
	$id = $_GET['var'];

	//mengambil nama dari id:Nama dari dokumen html
	$nama = mysqli_real_escape_string($db_link,$_POST["Nama"]);

	//mengambil komentar dari id:Komentar dari dokumen html
	$komentar = mysqli_real_escape_string($db_link,$_POST["Komentar"]);
	//$tanggal = mysqli_real_escape_string($db_link,$_POST["tanggal"]);

	//memasukan komentar kedalam database
	$sqlinsert="INSERT INTO komentar(id, nama, komentar, tanggal) VALUES('$id','$nama','$komentar','2014-10-08')";
	if (!mysqli_query($db_link,$sqlinsert)) {
		die('Error: ' . mysqli_error($db_link));
	}

	//memutuskan koneksi database
	mysqli_close($db_link);

	//redirect ke halaman lain
	header("Location:post.php?var=$id");
	exit;
?>