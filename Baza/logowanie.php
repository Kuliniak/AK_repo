<!-- Strona na której się logujesz -->
<?php
require('header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION["zalogowany"]=true){
	header("Location: zalogowany.php");
	exit;
} else {
?>
	<h1>Zaloguj się</h1>
	<form action="" method="post">
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

			if($row_cnt <= 0){
				echo '<br><font color="red">Nie poprawny login lub hasło</font><br>';
			}

			$line = mysqli_fetch_assoc($existAcc);

			if($row_cnt > 0 && $ok = true) {
				$_SESSION['id_osoby'] = $line['id_osoby'];
				$_SESSION['login'] = $login;
				$_SESSION['haslo'] = $haslo;
				$_SESSION['zalogowany'] = true;
				header('Location: zalogowany.php');
			}
		}				
	}
}
?>

<a href="index.php">Strona główna</a>

<?php
require('footer.php');
?>