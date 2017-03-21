<?php
session_start();

	if(!($_SESSION['zalogowany']) {
		header(":Location: index.php?error=0");
		exit;
	}
	
	echo $_SESSION['zalogowany'],' ',$_SESSION['uzytkownik'];
	
?>
