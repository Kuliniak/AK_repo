<!-- Strona główna -->
<?php
require('header.php');
require('connect.php');
?>

<?php
	if(isset($_GET["logowanie"])){
		header("Location: logowanie.php");
		exit;
	}else if(isset($_GET["rejestracja"])){
		header("Location: rejestracja.php");
		exit;
	}
?>

<h1>Witaj na stronie głównej</h1>

<form method="get">
	<input type="submit" name="logowanie" value="zaloguj się"><br><br>
	<input type="submit" name="rejestracja" value="rejestracja">
</form>

<?php
require('footer.php');
?>