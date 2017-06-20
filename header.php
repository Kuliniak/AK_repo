<!-- Nagłówek strony -->
<!DOCTYPE html>
<html>
<head>
	<title>Przykładowa strona</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script languge="javascript" type="text/javascript" src="JavaScript/tabela.js"></script>
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	</head>
<body>
<div id="wrapper">
	<div id="logo">
		<img src="images/logo.png" />
	</div>
	<div id="menu_lewe">
		<h3>Panel użytkownika</h3>
		<ul>
			<?php 
			session_start();

			if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
			?>
				<li><a href="zalogowany.php">Mój profil</a></li>
				<li><a href="create_proj.php">Stwórz nowy projekt</a></li>
				<li><a href="moje_projekty.php">Moje projekty</a></li>
				<br>
			<?php
			}else {
				echo '<li><a href="logowanie.php">Logowanie</a></li>';
				echo '<li><a href="rejestracja.php">Rejestracja</a></li>';
			}
			?>
		</ul>
	</div>
</div>

<div id="tresc">