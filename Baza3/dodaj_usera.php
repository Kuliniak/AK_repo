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

	$q_dostepne_role = "SELECT rola FROM role GROUP BY rola ORDER BY rola ASC";

	echo '<h1>Dodaj nowego użytkowniaka do projektu:<br><font color="red">'.$nazwa.'</font></h1><br>';
	?>

	<form method="GET" action="">
		Podaj nazwę użytkownika:<br><br>
		<input type="text" name="nick" placeholder="Nazwa użytkownika"><br><br><hr><br>
		Wpisz nową rolę lub wybierz z listy:<br><br>
		<input type="text" name="nowa_rola" placeholder="Podaj rolę">
		<select name="dostepne_role">

		    <?php
		    if($result = mysqli_query($conn, $q_dostepne_role)) {
		    	echo '<option value="pusto"></option>';
		    	while ($line = mysqli_fetch_assoc($result)) {
		    		echo "<option value= ".$line['rola'].">".$line['rola']."</option>";
		    	}
			}
		    ?>

		</select><br><br>
		<input type="submit" name="dodaj" value="Dodaj nowego użytkownika">
	</form>
	<?php

	if(isset($_GET['dodaj'])) {
		$nick = $_GET['nick'];
		$nrola = strtoupper($_GET['nowa_rola']); // nowa rola(pole tekstowe)
		$lista_rol = $_GET['dostepne_role']; //lista ról

		$ok = true;

		$q_exist_user = "SELECT * FROM osoby WHERE login='$nick' LIMIT 1";

		if(empty($_GET['nick'])) {
			echo '<font color="red">Nie podałeś nazwy użytkownika!</font>';
			$ok = false;
		}else {
			if($exist_login = mysqli_query($conn, $q_exist_user)) {
				$row_cnt = mysqli_num_rows($exist_login);
				$line = mysqli_fetch_assoc($exist_login);

				if($row_cnt <= 0) {//nie znaleziono takiego konta w bazie
					$ok = false;
					echo '<br><font color="red">Nie ma takiego konta</font><br>';

				} if(strcmp($line['login'], $nick) == 1) {// porównywanie znaków
					$ok = false;
					echo '<br><font color="red">Nie ma takiego konta</font><br>';

				} else { // czy ta osoba ma już dostęp do tego projeku
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
		}

		if(empty($nrola) && $lista_rol == "pusto") {
			echo '<br><font color="red">Nie podałeś żadnej roli!</font><br>';
			$ok = false;
		} 

		if(!empty($nrola) && $lista_rol != "pusto") {
			echo '<br><font color="red">Wybierz rolę albo podaj własną!</font><br>';
			$ok = false;
		}

		if($ok==true) {
			
			if(!empty($nrola) && $lista_rol == "pusto") {//wypełnione pole z rola

				$dodaj_dostep = "INSERT INTO dostepy (id_dostepu, id_osoby, id_projektu, rola, admin) VALUES (NULL, '$id_osoby', '$id_proj', '$nrola', '0')";

				if(mysqli_query($conn, $dodaj_dostep)) {
					echo "Dodano nowego użytkownika do projektu";
				} else {
					echo "Coś poszło nie tak";
				}

				$q_dodaj_role = "INSERT INTO role (id_roli, rola) VALUES (NULL, '$nrola')";
				if(!mysqli_query($conn, $q_dodaj_role)) {
					echo "Coś poszło nie tak";
				}
			}

			if(empty($nrola) && $lista_rol != "pusto") {//rola wybrana z listy

				$dodaj_dostep2 = "INSERT INTO dostepy (id_dostepu, id_osoby, id_projektu, rola, admin) VALUES (NULL, '$id_osoby', '$id_proj', '$lista_rol', '0')";

				if(mysqli_query($conn, $dodaj_dostep2)) {
					echo "Dodano nowego użytkownika do projektu";
				} else {
					echo "Coś poszło nie tak";
				}
			}


		}
	}
} else {
	header("Location: index.php");
}
?>

<?php
require('Szablon/footer.php');
?>