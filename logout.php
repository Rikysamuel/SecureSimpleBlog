<?php
	session_start();
	if (!isset($_SESSION["token"])) {
		header('Location: index.php');
	}
	$params = session_get_cookie_params();
	session_unset();
	session_destroy();
	session_regenerate_id();
	echo $_COOKIE["cookieid"];
    setcookie("cookieid", $_COOKIE["cookieid"], 1, $params["path"], $params["domain"], true, true);
	header('Location: index.php');
?>