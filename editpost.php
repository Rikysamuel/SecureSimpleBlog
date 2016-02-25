<?php
    session_start();
    if (!isset($_SESSION["token"])) {
        // header('Location: index.php');
    }

    if ($_SESSION['user-id'] != $_GET['id']) {
        // header('Location: index.php');
    }

    if ($_SESSION['csrf-token'] != $_GET['tok']) {
        // header('Location: index.php');
    }

    $_SESSION["csrf-token"] = hash("sha256", uniqid());
?>
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

<title>Simple Blog | Edit Post</title>


</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
</nav>

<article class="art simple post">
    
    
    <h2 class="art-title" style="margin-bottom:40px">-</h2>

    <div class="art-body">
        <div class="art-body-inner">
            <h2>Edit Post</h2>

            <div id="contact-area">
                <?php
                    // db connection
                    $link=mysqli_connect("localhost","root","","my_db");
                    if (mysqli_connect_errno()) {
                      die ("Failed to connect to MySQL: " . mysqli_connect_error());
                    }

                    $id = $_GET['var'];

                    // fetch a row
                    $item = mysqli_query($link, "SELECT * FROM Posting WHERE ID=$id");
                    $item = $item->fetch_assoc();
                ?>
                    <form method="post" id="edit_form" enctype="multipart/form-data" onSubmit="return checkformatedit()">
                        <label for="Judul">Judul:</label>
                        <?php 
                        if (isset($_SESSION['judul'])) { 
                                echo '<input type="text" name="Judul" id="Judul" value="'.$_SESSION['judul'].'">';
                                unset($_SESSION['judul']);
                            } else {
                                echo '<input type="text" name="Judul" id="Judul" value="'.$item['JUDUL'].'">';
                            }
                        ?>
                        <p id="title_comment"></p>

                        <label for="Tanggal">Tanggal:</label>
                        <input type="text" name="Tanggal" id="Tanggal" disabled value="<?=$item['TANGGAL']?>">

                        <label for="Image">Gambar:</label>
                        <input type="file" name="Image" id="Image">
                        <?php
                            if (isset($_SESSION['error_msg'])) {
                                echo '<p id="img_comment" style="color:red;">'.$_SESSION['error_msg'].'</p>';
                                unset($_SESSION['error_msg']);
                            } else {
                                echo '<p id="img_comment" style="color:red;"></p>';
                            }
                        ?>
                    
                        <label for="Konten">Konten:</label><br>
                        <?php
                            if (isset($_SESSION['konten'])) {
                                echo '<textarea name="Konten" rows="20" cols="20" id="Konten">'.$_SESSION['konten'].'</textarea>';
                                unset($_SESSION['konten']);
                            } else {
                                echo '<textarea name="Konten" rows="20" cols="20" id="Konten">'.$item['KONTEN'].'</textarea>';
                            }
                        ?>

                        <input type="hidden" id="id" name="id" value="<?=$id?>"/>
                        <input type="hidden" id="csrf-token" name="csrf-token" value="<?=$_SESSION["csrf-token"]?>"/>

                        <input type="submit" name="submit" value="Simpan" class="submit-button">
                    </form>

                <?php mysqli_close($link); ?>
            </div>
        </div>
    </div>

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        [IF4033] Information Assurance and Security
        <br>
        <a class="twitter-link" href="#">13512089 - Rikysamuel</a>
        <br>
        <a class="twitter-link" href="#">13512096 - Kevin Huang</a>
        
    </aside>
</footer>

</div>

<script type="text/javascript">
    document.getElementById("Tanggal").setAttribute("title", "Cannot change this value");
</script>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript" src="assets/js/confirm.js"></script>
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