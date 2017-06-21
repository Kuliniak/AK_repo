<!-- Strona z szablonem rejestracji -->
<?php
require('Szablon/header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
	header("Location: zalogowany.php");
}else {
	?>

	<h1>Zarejestruj się</h1>
	
	<div class="row">
		<form action="" method="POST" class="col-md-4 col-md-offset-4">
			<div class="form-group">
				<input type="text" class="form-control" name="login" placeholder="login">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="haslo" placeholder="hasło">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="haslo2" placeholder="powtórz hasło">
			</div>
			<button type="submit" name="wyslij" class="btn btn-success btn-fill pull-right">Zarejestruj</button>
		</form>
	</div> <br/>

	<?php
	if(isset($_POST["wyslij"]))  {
		$ok = true;

		$login = $_POST["login"];
		$haslo = $_POST["haslo"];
		$haslo2 = $_POST["haslo2"];
		$msg = "";

		if(empty($login) || empty($haslo) || empty($haslo2)) {
			$ok = false;
			$msg .='Nie zostawiaj pustych pól<br>';
		}

		if($existLogin = mysqli_query($conn, "SELECT * FROM osoby WHERE login = '$login' LIMIT 1")) {
			$row_cnt = mysqli_num_rows($existLogin);

			if($row_cnt > 0){
				$ok = false;
				$msg .='Ten login jest zajęty!<br>';
			}
		}

		if(strlen($login) < 5 || strlen($login) > 15) {
			$ok = false;
			$msg .= 'Za krótki login (od 5 do 15 znaków)<br>';
		}

		if(strlen($haslo) < 5 || strlen($haslo) > 15) {
			$ok = false;
			$msg .='Za krótkie hasło (od 5 do 15 znaków)<br>';
		}

		if($haslo != $haslo2) {
			$ok = false;
			$msg .='Hasło się nie zgadza!<br>';
		}

		if($ok == true) {
			$new_user = "INSERT INTO osoby (id_osoby, login, haslo) VALUES (NULL, '$login', '$haslo')";

			if (mysqli_query($conn, $new_user)) {
				echo '<div class="row">
					<div class="alert alert-success">
						<strong>Rejestracja przebiegła pomyślnie!<br>Możesz już się zalogować</strong>
					</div>
				</div>';
			} else {
			    echo "<br>Error: " . $new_user . "<br>" . mysqli_error($conn). "<br>";
			}
		} else{
			echo '<div class="row">
				<div class="alert alert-danger">
					<strong>'.$msg.'</strong>
				</div>
			</div>';
		}
		
	}
}
?>

<?php
require('Szablon/footer.php');
?>