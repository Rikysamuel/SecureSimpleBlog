<?php

$id = $_POST['id'];
$nama = $_POST['nama'];
$komentar = $_POST['komentar'];
$tanggal = $_POST['tanggal'];

//koneksi ke database
$link = mysqli_connect('localhost','root','','my_db');
if (!$link) {
  die('Could not connect: ' . mysqli_error($con));
}

//memasukan data ke database
$sqlinsert = "INSERT INTO komentar(id, nama, komentar, tanggal) VALUES('$id','$nama','$komentar', '$tanggal')";
if (!mysqli_query($link,$sqlinsert)) {
    die('Error: ' . mysqli_error($link));
}

//mengambil data dari database dan menaruh kedalam array "row"
$result = mysqli_query($link,"SELECT * FROM komentar WHERE id=$id ORDER BY tanggal ASC");
while($row[] = mysqli_fetch_array($result));

//mencetak ke halaman html
for ($i=0;$i<sizeof($row)-1;$i++) { 
    echo '
        <li class="art-list-item">
            <div class="art-list-item-title-and-time">
                <h2 class="art-list-title"><a href="post.php">'.$row[$i][1].'</a></h2>
                <div class="art-list-time">'.$row[$i][3].'</div>
            </div>
            <p>'.$row[$i][2].' &hellip;</p>
        </li>
        ';
}

//menutup koneksi ke database
mysqli_close($link);
?>