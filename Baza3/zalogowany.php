<!-- Widok po zalogowaniu -->
<?php
require('Szablon/header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
	//echo print_r($_SESSION);
	?>
	<?php
	echo '<h1>Witaj '.$_SESSION['login'].'<h1>';
	?>

	<?php
	if(isset($_POST["wyloguj"])) {
		$_SESSION["zalogowany"]=false;
		session_unset();
		session_destroy();
		header("Location: logowanie.php");
	}
}else{
	header("Location: logowanie.php");
}
?>

<?php
require('Szablon/footer.php');
?>