<!-- Strona na której tworzy się projekty -->
<?php
require('header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
	?>

	<h1>Stwórz nowy projekt</h1>

	<div id="form_div">
	<form method="post" action="">
		<table id="tablica">
			Nazwa projektu
			<input type="text" name="nazwa" placeholder="nazwa projektu"><br>
			Początek projektu:
			<input type="date" name="start"><br>
			Koniec projektu:
			<input type="date" name="koniec">
			<tr>
				<td>Zadanie</td>
				<td>Początek zadania</td>
				<td>Koniec zadania</td>
				<td>Usuń zadanie</td>
			</tr>
			<tr id="row0">
				<td><input type="text" name="zadanie[]" placeholder="Zadanie"></td>
				<td><input type="date" name="od[]"></td>
				<td><input type="date" name="do[]"></td>
				<td><input type="button" onclick="usun(this);" value="Usuń zadanie"></td>
			</tr>
		</table>
			<input type="button" onclick="dodaj();" value="Dodaj zadanie"><br>
			<input type="text" name="rola" placeholder="Twoja rola"><br>
			<textarea name="komentarz" placeholder="Dodaj komentarz"></textarea><br>
			<input type="submit" name="wyslij" value="Stwórz projekt">
	</form>
	</div>

	<?php
	if(isset($_POST['wyslij'])) {
		$ok = true;

		$nazwa = $_POST['nazwa'];
		$start_proj = $_POST['start'];
		$koniec_proj = $_POST['koniec'];
		$zadanie = $_POST['zadanie'];
		$od = $_POST['od'];
		$do = $_POST['do'];
		$rola = $_POST['rola'];
		$koment = $_POST['komentarz'];

	  	$q_znajdz_zad = "SELECT * FROM projekty WHERE nazwa='$nazwa' LIMIT 1";

	  	if($nazwa==NULL) {
	  		$ok = false;
	    	echo '<br><font color="red">Nazwa projektu jest pusta!</font><br>';
	  	}

	  	if($result = mysqli_query($conn, $q_znajdz_zad)) {
	    	  $row_cnt = mysqli_num_rows($result);
	    	  if($row_cnt > 0) {
	    	  	$ok = false;
	    	    echo '<br><font color="red">Nazwa projektu jest już zajęta!</font><br>';
	    	  }
	  	}

	  	if($start_proj==NULL || $koniec_proj==NULL) {
	  		$ok = false;
	      	echo '<font color="red">Początek i koniec projektu nie może być pusty</font>';
	  	}

	  	$ile = count($zadanie);
		for($i = 0; $i < $ile; $i++){
			if($zadanie[$i]==NULL || $od==NULL || $do==NULL) {
				$ok = false;
				echo '<br><font color="red">Nie zostawiaj pustych wierszy</font><br>';
				break;
			}
		}

	  	if($ok == true) {
	  		$q_znajdz_id = "SELECT MAX(id_projektu) FROM projekty";

			if($result = mysqli_query($conn, $q_znajdz_id)) {
				$row = mysqli_fetch_assoc($result);
				$id_projektu = $row['MAX(id_projektu)']+1;
			}

			//dodanie projektu------------------------------------------------------
		    $dodaj_proj = "INSERT INTO projekty (id_projektu, nazwa, start_proj, koniec_proj, komentarze) VALUES ('$id_projektu', '$nazwa', '$start_proj', '$koniec_proj', '$koment')";

		    if (mysqli_query($conn, $dodaj_proj)) {
		      	echo "Dodano nowy projekt!";
		    }else{
		      	echo "Error: " . $dodaj_proj . "<br>" . mysqli_error($conn);
		    }
			//-----------------------------------------------------------------------

			//dodawanie zadań--------------------------------------------------------
	    	$ile = count($zadanie);
		    for($i = 0; $i < $ile; $i++){
		    	$dodaj_zadanie = "INSERT INTO zadania (id_zadania, id_projektu, ktore_zadanie, tresc_zadania, poczatek_zad, koniec_zad) VALUES (NULL, '$id_projektu', '$i', '$zadanie[$i]', '$od[$i]', '$do[$i]')";
		    	if(mysqli_query($conn, $dodaj_zadanie)){
		    		echo "Zdania poszły! :)";
		    	}else {
		    		echo "Error: " . $dodaj_zadanie . "<br>" . mysqli_error($conn);
		    	}
		    }
			//------------------------------------------------------------------------

			//dodanie dostepu---------------------------------------------------------
		    $q_dodaj_dostep = "INSERT INTO dostepy (id_dostepu, id_osoby, id_projektu, rola, admin) VALUES (NULL, '".$_SESSION['id_osoby']."', '$id_projektu', '$rola', '')";

			if(mysqli_query($conn, $q_dodaj_dostep)) {
				echo "<br>Masz dostęp do tego projektu";
		    }else{
		      	echo "Error: " . $q_dodaj_dostep . "<br>" . mysqli_error($conn);
		    }
		    //--------------------------------------------------------------------------
		}
	}
	?>

	<?php
} else {
		if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true){
			header("Location: zalogowany.php");
		} else {
			header("Location: index.php");
		}
}

?>

<?php
require('footer.php');
?>