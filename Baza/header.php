<!-- Nagłówek strony -->
<!DOCTYPE html>
<html>
<head>
	<title>Przykładowa strona</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script languge="javascript" type="text/javascript" src="tabela.js"></script>
	</head>
<body>
<?php 
session_start();

if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
?>
	<ul>
	<li><a href="zalogowany.php">Mój profil</a></li>
	<li><a href="create_proj.php">Stwórz nowy projekt</a></li>
	<li><a href="moje_projekty.php">Moje projekty</a></li>
	</ul>
	<br>
<?php
}
?>