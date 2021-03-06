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
<meta name="description" content="Register USer">
<meta name="author" content="Rikysamuel">

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


<body class="default">
    <div class="wrapper">

        <nav class="nav">
		    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
		</nav>


        <article class="art simple post"><br/><br/>
            <h2 class="art-title" style="margin-bottom:40px">-</h2>
            <div class="art-body">
                <div class="art-body-inner">
                    <h2>Login</h2>

                    <div id="contact-area">
                        <form id="Form" onsubmit="return login()">
                            <label for="Username_login">Username:</label>
                            <input type="text" id="UsernameLogin" label="Username_login">
                            
                            <label for="Password_login">Password:</label>
                            <input type="password" id="PasswordLogin" label="Password_login"/>

                            <label for="remember" class="pure-checkbox">
                                <input id="remember" type="checkbox"> Remember me
                            </label>
                            <input type="hidden" id="csrf-token" value='<?=$_SESSION["csrf-token"]; ?>'/>

                            <br/><br/>
                            <input type="submit" value="Login" class="submit-button"/>
                            <p id="login_comment"></p>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</body>


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
<script type="text/javascript" src="assets/js/sha256.js"></script>
<script type="text/javascript" src="assets/js/cookiefunc.js"></script>
<script type="text/javascript" src="assets/js/login.js"></script>

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