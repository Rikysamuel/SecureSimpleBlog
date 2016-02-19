<?php
	//redirect ke halaman lain
	header("Location:index.php");
	//koneksi ke database
	$link=mysqli_connect("localhost","root","","my_db");
    if (mysqli_connect_errno()) {
      die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    //mengambil nilai id dari url
    $id = $_GET['var'];

    //mengambil judul, tanggal, konten dari elemen id dari html
    $judul = mysqli_real_escape_string($link,$_POST["Judul"]);
	$konten = mysqli_real_escape_string($link,$_POST["Konten"]);

	//mengupdate data ke database
	$sqlupdate="UPDATE my_db.posting SET JUDUL='$judul', KONTEN='$konten' WHERE Posting.ID=$id";
	if (!mysqli_query($link,$sqlupdate)) {
		die('Error: ' . mysqli_error($link));
	}
	
	//menutup koneksi ke database
	mysqli_close($link);
    exit;
?>