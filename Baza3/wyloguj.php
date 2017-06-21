<?php
	session_start();
	$_SESSION["zalogowany"]=false;
	unset($_SESSION["zalogowany"]);
	unset($_SESSION["login"]);
	session_unset();
	session_destroy();
	header("Location: logowanie.php");
?>