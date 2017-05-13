<!-- Strona z szablonem rejestracji -->
<?php
require('header.php');
require('connect.php');
?>

<h1>Zarejestruj się</h1>
<form action="" method="post">
	<input type="text" name="login" placeholder="login"> <br><br>
	<input type="password" name="haslo" placeholder="hasło"> <br><br>
	<input type="password" name="haslo2" placeholder="powtórz hasło"> <br><br>
	Uprawnienia administratora: 
	<select name="admin">
		<option value="0">Nie</option>
		<option value="1">Tak</option>
	</select> <br><br>
	<input type="submit" name="wyslij" value="Zarejestruj">
</form>

<?php
if(isset($_POST["wyslij"]))  {
	$ok = true;

	$login = $_POST["login"];
	$haslo = $_POST["haslo"];
	$haslo2 = $_POST["haslo2"];

	if(empty($login) || empty($haslo) || empty($haslo2)) {
		$ok = false;
		echo '<br><font color="red">Nie zostawiaj pustych pól</font><br>';
	} else {
		if($existLogin = mysqli_query($conn, "SELECT * FROM osoby WHERE login = '$login' LIMIT 1")) {
			$row_cnt = mysqli_num_rows($existLogin);

			if($row_cnt > 0){
				$ok = false;
				echo '<br><font color="red">Ten login jest zajęty!</font><br>';
			}
		}

		if(strlen($login) < 5 || strlen($login) > 15) {
			$ok = false;
			echo '<br><font color="red">Za krótki login (od 5 do 15 znaków)</font><br>';
		}

		if(strlen($haslo) < 5 || strlen($haslo) > 15) {
			$ok = false;
			echo '<br><font color="red">Za krótkie hasło (od 5 do 15 znaków)</font><br>';
		}

		if($haslo != $haslo2) {
			$ok = false;
			echo '<br><font color="red">Hasło się nie zgadza!</font><br>';
		}

		if($ok == true) {
			$new_user = "INSERT INTO osoby (id_osoby, login, haslo) VALUES (NULL, '$login', '$haslo')";

			if (mysqli_query($conn, $new_user)) {
			    echo "<br>Rejestracja przebiegła pomyślnie!<br>";
			} else {
			    echo "<br>Error: " . $new_user . "<br>" . mysqli_error($conn). "<br>";
			}
		}
	}
}
?>

<br>

<form action="logowanie.php"> 
	<input type="submit" value="Przjedź do logowania">
</form>

<a href="index.php">Strona główna</a>

<?php
require('footer.php');
?>