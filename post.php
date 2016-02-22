<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Simple Blog | Apa itu Simple Blog?</title>


</head>


<?php

//mengambil nilai id dari url
$id = $_GET['var'];

echo '<body class="default" onload="req_komentar('.$id.')">';
echo '<div class="wrapper">

        <nav class="nav">
            <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
            <ul class="nav-primary">
                <li><a href="add_post.php">+ Tambah Post</a></li>
            </ul>
        </nav>

        <article class="art simple post">
    ';
        //koneksi ke database
        $link=mysqli_connect("localhost","root","","my_db");
        if (mysqli_connect_errno()) {
          die ("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        //mengambil judul, tanggal, dan konten dari database
        $judul = mysqli_query($link,"SELECT JUDUL FROM Posting WHERE ID=$id");
        $judul = $judul->fetch_assoc();
        $tanggal = mysqli_query($link,"SELECT TANGGAL FROM Posting WHERE ID=$id");
        $tanggal = $tanggal->fetch_assoc();
        $konten = mysqli_query($link,"SELECT KONTEN FROM Posting WHERE ID=$id");
        $konten = $konten->fetch_assoc();

        //mengganti karakter "new line" dari '\n' menjadi <br/> agar "new line" dapat terlihat dari html
        $konten = str_replace("\n", "<br/>", $konten);

        //print data dari database ke halaman html
        echo '
            <header class="art-header">
                <div class="art-header-inner" style="margin-top: 0px; opacity: 1;">
                    <time class="art-time">'.$tanggal['TANGGAL'].'</time>
                    <h2 class="art-title">'.$judul['JUDUL'].'</h2>
                    <p class="art-subtitle"></p>
                </div>
            </header>

            <div class="art-body">
                <div class="art-body-inner">
                    <hr class="featured-article" />
                        <p>'.$konten['KONTEN'].'</p>

                    <hr />
            
                    <h2>Komentar</h2>
                    <div id="contact-area">
                        <form method="post" id="form_comment" onSubmit="return false">
                            <label for="Nama">Nama:</label>
                            <input type="text" name="Nama" id="Nama" placeholder="Boleh kosong">
            
                            <label for="Email">Email:</label>
                            <input type="text" name="Email" id="Email">
                            <p id="email_comment"></p>
                        
                            <label for="Komentar">Komentar:</label>
                            <textarea name="Komentar" rows="20" cols="20" id="Komentar"></textarea>

                            <input type="submit" name="submit" value="Kirim" class="submit-button" onClick="ins_komentar('.$id.')">
                        </form>
                    </div>
                    <hr/>
                    <ul class="art-list-body">
                        <div id="comment_here">

                        </div>
                    </ul>

        ';

                echo '</div>';
            echo '</div>';
        
        //menutup koneksi ke database
        mysqli_close($link);

    ?>

    

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Asisten IF3110 /
        <a class="rss-link" href="#rss">RSS</a> /
        <br>
        <a class="twitter-link" href="http://twitter.com/YoGiiSinaga">Yogi</a> /
        <a class="twitter-link" href="http://twitter.com/sonnylazuardi">Sonny</a> /
        <a class="twitter-link" href="http://twitter.com/fathanpranaya">Fathan</a> /
        <br>
        <a class="twitter-link" href="#">Renusa</a> /
        <a class="twitter-link" href="#">Kelvin</a> /
        <a class="twitter-link" href="#">Yanuar</a> /
        
    </aside>
</footer>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript" src="assets/js/posting.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>

</body>
</html>