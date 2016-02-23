<?php
    session_start();
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

<title>Simple Blog</title>


</head>

<?php
  if (isset($_SESSION["token"])) {
    echo '<body class="default"">';
  } else {
    echo '<body class="default" onload="cookieLogin()">';
  }
?>
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <?php
      if (isset($_SESSION["token"])) {
        echo '<ul class="nav-primary">
                  <li><a href=\'logout.php\' style="color:red;">'; echo $_SESSION["name"]; echo ' (logout)</a></li>&nbsp;';
            echo "|";      
            echo '<li><a href="add_post.php">+ Tambah Post</a></li>
              </ul>';
      } else {
        $_SESSION["csrf-token"] = hash("sha256", uniqid());
        echo '<ul class="nav-primary">
                  <form method="post" id="login_index" onsubmit="return login()">
                      <li>
                          <input type="text" id="UsernameLogin" name="UsernameLogin" placeholder="Username"/>
                          &nbsp;
                          <input type="password" id="PasswordLogin" name="PasswordLogin" placeholder="Password"/>
                          &nbsp;
                          <input type="submit" value="Login!" class="submit-button"/>
                          <input type="hidden" id="csrf-token" value="'; echo $_SESSION["csrf-token"]; echo '"/>
                      </li>
                      <p id="login_comment" style="margin-bottom: -11px;"><br/></p>
                      <li style="color:blue;margin-left:0px;">Don\'t have an account? You can <a href="register.php" style="color:red"> register here <a/>.
                      </li>
                  </form>
              </ul>';
      }
    ?>
</nav>

<div id="home">
    <div class="posts">
        <nav class="art-list">
          <ul class="art-list-body">
            <?php
                $link=mysqli_connect("localhost","root","","my_db");
                // Cek koneksi ke database
                if (mysqli_connect_errno()) {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                //ambil data ke dalam array row dari database
                $result = mysqli_query($link,"SELECT * FROM `posting` JOIN users WHERE posting.USERNAME = users.Username ORDER BY Posting.ID DESC");
                while($row[] = mysqli_fetch_array($result));

                //data dalam array diprint ke halaman html
                for($it=0;$it<sizeof($row)-1;$it++){
                  echo '<li class="art-list-item">';
                    echo '<div class="art-list-item-title-and-time">';
                      echo '<h2 class ="art-list-title"><a href="post.php?var='.$row[$it][0].'&tok='.$_SESSION['csrf-token'].'">'.$row[$it][1].'</a></h2>';
                      echo '<div class="art-list-time">'.$row[$it][2].'</div>';
                      echo '<div class="art-list-time"><span style="color:#F40034;">&#10029;</span> By '.$row[$it][6].'</div>';
                    echo '</div>';
                    echo '<p>'.substr($row[$it][3],0,200).'&hellip;</p>';
                    echo '<p>';
                    if (isset($_SESSION["token"])) {
                      if ($_SESSION["user-id"] == $row[$it][7]) {
                        echo '<a href="editpost.php?var='.$row[$it][0].'&id='.$_SESSION['user-id'].'&tok='.$_SESSION['csrf-token'].'">Edit</a> | <a id="d_'.$row[$it][0].'" onclick="return hapus(\''.$row[$it][0].'\',\''.$_SESSION['user-id'].'\',\''.$_SESSION['csrf-token'].'\');" href="javascript:;">Hapus</a>';
                      }
                    }
                  echo '</li>';
                }
                //menutup koneksi
                mysqli_close($link);
            ?>
          </ul>
        </nav>
    </div>
</div>

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

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript" src="assets/js/confirm.js"></script>
<script type="text/javascript" src="assets/js/posting.js"></script>
<script type="text/javascript" src="assets/js/sha256.js"></script>
<script type="text/javascript" src="assets/js/login.js"></script>
<script type="text/javascript" src="assets/js/checkcookie.js"></script>

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