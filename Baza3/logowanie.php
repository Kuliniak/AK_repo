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
	<div class="row">
		<form action="" method="POST" class="col-md-4 col-md-offset-4">
			<div class="form-group">
				<input type="text" class="form-control" name="login" placeholder="login">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="haslo" placeholder="hasło">
			</div>
			<button type="submit" name="wyslij" class="btn btn-success btn-fill pull-right">Zaloguj</button>
		</form>
	</div> <br/>
	
	

<?php
	if(isset($_POST["wyslij"])) {
		$ok = true;

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		$msg = "";
		if(empty($login) || empty($haslo)) {
			$ok = false;
			$msg = "Nie poprawny login lub hasło<br/>";
		}

		if($existAcc = mysqli_query($conn, "SELECT * FROM osoby WHERE login='$login' AND haslo='$haslo' LIMIT 1")) {
			$row_cnt = mysqli_num_rows($existAcc);
			$line = mysqli_fetch_assoc($existAcc);

			if($row_cnt <= 0){
				$ok = false;
				$msg = "Nie poprawny login lub hasło<br/>";
			}

			if(strcmp($line['login'], $login) == 1) {
				$ok = false;
				$msg = "Nie poprawny login lub hasło<br/>";
			}

			if(strcmp($line['haslo'], $haslo) == 1) {
				$ok = false;
				$msg = "Nie poprawny login lub hasło<br/>";
			}
			$_SESSION['msg'] = $msg;
			if($row_cnt > 0 && $ok == true) {
				$_SESSION['id_osoby'] = $line['id_osoby'];
				$_SESSION['login'] = $line['login'];
				//$_SESSION['haslo'] = $haslo;
				$_SESSION['zalogowany'] = true;
				header('Location: zalogowany.php');
			} else{
				echo '<div class="row">
					<div class="alert alert-danger">
						<strong>'.$msg.'</strong>
					</div>
				</div>';
			}
		}				
	}
}
?>

<?php
require('Szablon/footer.php');
?>