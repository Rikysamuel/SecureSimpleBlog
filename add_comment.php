<?php

    session_start();
    if ($_SESSION['csrf-token'] == stripslashes(mysql_escape_string($_POST['token']))) {
        //koneksi ke database
        $link = mysqli_connect('localhost','root','','my_db');
        if (!$link) {
          die('Could not connect: ' . mysqli_error($con));
        }

        $id = stripslashes(mysqli_real_escape_string($link, $_POST['id']));
        $nama = stripslashes(mysqli_real_escape_string($link, $_POST['nama']));
        $komentar = mysqli_real_escape_string($link, $_POST['komentar']);
        $tanggal = mysqli_real_escape_string($link, $_POST['tanggal']);

        if ($nama=="undefined") {
            if (isset($_SESSION["name"])) {
                $nama = $_SESSION["name"];
            } else {
                $nama = "annonymous";
            }
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
    }
?>