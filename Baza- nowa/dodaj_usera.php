<!-- Gotowy szablon strony po prostu skopiuj -->
<?php
require('Szablon/header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {

	if(isset($_POST['nazwa_projektu'])) {
		$_SESSION['nazwa_projektu']=$_POST['nazwa_projektu'];
		$_SESSION['id_projektu']=$_POST['id_projektu'];
	}

	$id_proj = $_SESSION['id_projektu'];
	$nazwa = $_SESSION['nazwa_projektu'];
	//echo print_r($_SESSION);

	$q_dostepne_role = "SELECT rola FROM role WHERE id_projektu='$id_proj'";

	echo '<h1>Dodaj nowego użytkowniaka do projektu:<br><font color="red">'.$nazwa.'</font></h1>';
	?>

	<form method="GET" action="">
		Podaj nazwę użytkownika:
		<input type="text" name="nick" placeholder="Nazwa użytkownika"><br>
		Wybierz rolę:
		<select name="dostepne_role">
		    <?php
		    if($result = mysqli_query($conn, $q_dostepne_role)) {
		    	while ($line = mysqli_fetch_assoc($result)) {
		    		echo "<option value= ".$line['rola'].">".$line['rola']."</option>";
		    	}
			}
		    ?>
		</select><br>
		<input type="submit" name="dodaj" value="Dodaj nowego użytkownika">
	</form>
	<?php

	if(isset($_GET['dodaj'])) {
		$nick = $_GET['nick'];
		$ok = true;
		$rola = $_GET['dostepne_role'];

		$q_exist_user = "SELECT id_osoby FROM osoby WHERE login='$nick' LIMIT 1";

		if(empty($_GET['nick'])) {
			echo '<font color="red">Zostawiłeś puste pole</font>';
			$ok = false;
		}

		if($exist_login = mysqli_query($conn, $q_exist_user)) {
			$row_cnt = mysqli_num_rows($exist_login);
			$line = mysqli_fetch_assoc($exist_login);

			if($row_cnt <= 0) {
				$ok = false;
				echo '<br><font color="red">Nie ma takiego konta</font><br>';
			} else {
				$id_osoby = $line['id_osoby'];

				$q_exist_dostep = "SELECT * FROM dostepy WHERE id_osoby='$id_osoby' AND id_projektu='$id_proj'";

				if($exist_dostep = mysqli_query($conn, $q_exist_dostep)) {
					$row_cntn = mysqli_num_rows($exist_dostep);

					if($row_cntn > 0) {
						$ok = false;
						echo '<br><font color="red">Ta osoba ma już dostęp do projektu</font><br>';
					}
				}
			}
		}

		if($ok==true) {
			$dodaj_dostep = "INSERT INTO dostepy (id_dostepu, id_osoby, id_projektu, rola, admin) VALUES (NULL, '$id_osoby', '$id_proj', '$rola', '0')";

			if(mysqli_query($conn, $dodaj_dostep)) {
				echo "Dodano nowego użytkownika do projektu";

			} else {
				echo "Coś poszło nie tak";
			}
		}
	}
} else {
	//echo print_r($_SESSION);
	//Co ma być wyświetlone gdy dostaniesz się na strone mimo, że nie jesteś zalogowany
	echo "<h1>PA, HAKIER!</h1>";
}
?>

<?php
require('Szablon/footer.php');
?>