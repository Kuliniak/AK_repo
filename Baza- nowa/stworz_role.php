<!-- Gotowy szablon strony po prostu skopiuj -->
<?php
require('Szablon/header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {

	if(isset($_POST['nazwa_projektu'])){
		$_SESSION['nazwa_projektu']=$_POST['nazwa_projektu'];
		$_SESSION['id_projektu']=$_POST['id_projektu'];
	}

	$id_proj = $_SESSION['id_projektu'];
	$nazwa = $_SESSION['nazwa_projektu'];
	//echo print_r($_SESSION);
	?>

	<h1>DODAJ NOWĄ ROLĘ DO PROJEKTU</h1>

	<?php echo '<h2>'.$nazwa.'</h2>';
	?>

	<form action="" method="GET">
		<input type="text" name="rola" placeholder="Podaj rolę">
		<input type="submit" name="dodaj">
	</form>

	<?php
	if(isset($_GET['dodaj'])) {
		$ok= true;
		$rola = $_GET['rola'];
		$q_exist_rola = "SELECT rola, id_projektu FROM role WHERE rola='$rola' AND id_projektu='$id_proj'";

		if($rola==NULL){
			$ok = false;
			echo "Zostawiłeś puste pole!";
		}

		if($rola_zajeta = mysqli_query($conn, $q_exist_rola)) {
			$num_rows = mysqli_num_rows($rola_zajeta);
			if($num_rows>0) {
				$ok=false;
				echo "Taka rola już istnieje!";
			}
		}

		if($ok == true) {
			$q_dodaj_role = "INSERT INTO role (id_roli, rola, id_projektu) VALUES (NULL, '$rola', '$id_proj')";

			if(mysqli_query($conn, $q_dodaj_role)) {
				echo "Dodałeś nową rolę do projektu!";
			} else {
				echo "Coś poszło nie tak";
			}	
		}
	}
	?>

	<br>
	<hr>


<?php
} else {
	echo "<h1>PA, HAKIER!</h1>";
}
?>

<?php
require('Szablon/footer.php');
?>