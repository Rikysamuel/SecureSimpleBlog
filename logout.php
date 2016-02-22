<?php
	session_start();
	if (!isset($_SESSION["token"])) {
		header('Location: index.php');
	}
	session_unset();
	session_destroy();
	header('Location: index.php');
?>