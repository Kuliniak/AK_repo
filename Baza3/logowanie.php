<!-- Strona na której się logujesz -->
<?php
require('Szablon/header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION["zalogowany"]=true){
	header("Location: zalogowany.php");
	exit;
} else {
?>
	<h1>Zaloguj się</h1>
	<form action="" method="POST">
		<input type="text" name="login" placeholder="login"> <br><br>
		<input type="password" name="haslo" placeholder="hasło"> <br><br>
		<input type="submit" name="wyslij" value="Zaloguj się"> <br><br>
	</form>

<?php
	if(isset($_POST["wyslij"])) {
		$ok = true;

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		if(empty($login) || empty($haslo)) {
			$ok = false;
			echo '<br><font color="red">Nie poprawny login lub hasło</font><br>';
		}

		if($existAcc = mysqli_query($conn, "SELECT * FROM osoby WHERE login='$login' AND haslo='$haslo' LIMIT 1")) {
			$row_cnt = mysqli_num_rows($existAcc);
			$line = mysqli_fetch_assoc($existAcc);

			if($row_cnt <= 0){
				$ok = false;
				echo '<br><font color="red">Nie poprawny login lub hasło</font><br>';
			}

			if(strcmp($line['login'], $login) == 1) {
				$ok = false;
				echo '<br><font color="red">Nie poprawny login lub hasło</font><br>';
			}

			if(strcmp($line['haslo'], $haslo) == 1) {
				$ok = false;
				echo '<br><font color="red">Nie poprawny login lub hasło</font><br>';
			}

			if($row_cnt > 0 && $ok == true) {
				$_SESSION['id_osoby'] = $line['id_osoby'];
				$_SESSION['login'] = $line['login'];
				//$_SESSION['haslo'] = $haslo;
				$_SESSION['zalogowany'] = true;
				header('Location: zalogowany.php');
			}
		}				
	}
}
?>

<?php
require('Szablon/footer.php');
?>