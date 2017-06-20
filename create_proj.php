﻿<!-- Strona na której tworzy się projekty -->
<?php
require('Szablon/header.php');
require('connect.php');
?>
			
<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
	?>

	<h1>Stwórz nowy projekt</h1><br>
	<b><font style="color: red">Uwaga! Nazwanie projektu i dodanie roli zapewni jego pewny zapis</b></font>
	<div id="form_div">
	<form method="post" action="">
		<table id="tablica" style="width:100%">
			Nazwa projektu*
			<input type="text" name="nazwa" placeholder="nazwa projektu"><br><br>
			Początek projektu
			<input id="startDate" type="date" name="start" max="" onchange="startDateChanged(event);"><br><br>

			Koniec projektu
			<input id="endDate" type="date" name="koniec">
			<hr>
			<tr>
				<td>Sprinty</td>
				<td>Początek sprintu</td>
				<td>Koniec sprintu</td>
				<td>Usuń sprint</td>
			</tr>
			<tr id="row0">
				<td><input type="text" name="sprint[]" placeholder="Sprint"></td>
				<td><input type="date" name="od[]"></td>
				<td><input type="date" name="do[]"></td>
				<td><input type="button" onclick="usun(this);" value="-"></td>
			</tr>
		</table>
			<br>
			<input type="button" onclick="dodaj();" value="Dodaj sprint"><br><br>
			<hr>
			Wpisz rolę którą będziesz pełnił w tym projekcie lub wybierz z listy*<br><br>
			<input type="text" name="nowa_rola" placeholder="Podaj rolę">
			<select name="dostepne_role">
			    <?php
			    $q_dostepne_role = "SELECT rola FROM role GROUP BY rola ORDER BY rola ASC";
			    if($result = mysqli_query($conn, $q_dostepne_role)) {
			    	echo '<option value="pusto"></option>';
			    	while ($line = mysqli_fetch_assoc($result)) {
			    		echo "<option value= ".$line['rola'].">".$line['rola']."</option>";
			    	}
				}
			    ?>
			</select><br><br>
			<textarea name="komentarz" placeholder="Dodaj komentarz (opcjonalny)"></textarea><br>
			<input type="submit" name="wyslij" value="Stwórz projekt"><br>
	</form>
	</div>

	<?php
	if(isset($_POST['wyslij'])) {
		$ok = true;

		$nazwa = $_POST['nazwa'];
		$start_proj = $_POST['start'];
		$koniec_proj = $_POST['koniec'];
		$sprint = $_POST['sprint'];
		$od = $_POST['od'];
		$do = $_POST['do'];
		$nrola = strtoupper($_POST['nowa_rola']);
		$lista_rol = $_POST['dostepne_role'];
		$koment = $_POST['komentarz'];

	  	$q_znajdz_zad = "SELECT * FROM projekty WHERE nazwa='$nazwa' LIMIT 1";

	  	if($nazwa==NULL) {//jesli nazwa projektu jest pusta
	  		$ok = false;
	    	echo '<br><font color="red">Nazwa projektu nie może być pusta!</font><br>';
	  	}

	  	if($result = mysqli_query($conn, $q_znajdz_zad)) {//jesli istnieje juz taki projekt
	    	  $row_cnt = mysqli_num_rows($result);
	    	  if($row_cnt > 0) {
	    	  	$ok = false;
	    	    echo '<br><font color="red">Ta nazwa jest już zajęta! Wybierz inną!</font><br>';
	    	  }
	  	}

	  	if($koniec_proj != NULL) {// jesli koniec projektu jest podany to sprawdzam...
			if($start_proj > $koniec_proj) { //...jesli wystapił błąd z datami start-koniec projektu
		  		$ok = false;
		  		echo '<br><font color="red">Błąd w datach</font><br>';
		  	}
	  	}


	  	if($ok == true) { //jeśli nie zostały znalezione żadne błędy
	  		$q_znajdz_id = "SELECT MAX(id_projektu) FROM projekty";

			if($result = mysqli_query($conn, $q_znajdz_id)) {
				$row = mysqli_fetch_assoc($result);
				$id_projektu = $row['MAX(id_projektu)']+1;
			}

			//dodanie projektu------------------------------------------------------
		    $dodaj_proj = "INSERT INTO projekty (id_projektu, nazwa, start_proj, koniec_proj, komentarze) VALUES ('$id_projektu', '$nazwa', '$start_proj', '$koniec_proj', '$koment')";

		    if (mysqli_query($conn, $dodaj_proj)) {
		      	echo "Dodano nowy projekt!";
		    } else {
		      	echo "Error: " . $dodaj_proj . "<br>" . mysqli_error($conn);
		    }
			//-----------------------------------------------------------------------

			//dodawanie sprintów-----------------------------------------------------
	    	$ile = count($sprint);
		    for($i = 0; $i < $ile; $i++) {
		    	$dodaj_sprinty = "INSERT INTO sprinty (id_sprintu, id_projektu, sprint, poczatek, koniec) VALUES (NULL, '$id_projektu', '$sprint[$i]', '$od[$i]', '$do[$i]')";
		    	if(!mysqli_query($conn, $dodaj_sprinty)) {
		    		echo "Error: " . $dodaj_sprinty . "<br>" . mysqli_error($conn);
		    	}
		    }
			//------------------------------------------------------------------------

			//dodanie dostepu---------------------------------------------------------
		    if(!empty($nrola) && $lista_rol == "pusto") {//wypełnione pole z rola

				$dodaj_dostep = "INSERT INTO dostepy (id_dostepu, id_osoby, id_projektu, rola, admin) VALUES (NULL, '".$_SESSION['id_osoby']."', '$id_projektu', '$nrola', '1')";

				if(!mysqli_query($conn, $dodaj_dostep)) {
					echo "Coś poszło nie tak";
				}

				//dodanie nowej roli do bazy
				$q_dodaj_role = "INSERT INTO role (id_roli, rola) VALUES (NULL, '$nrola')";
				if(!mysqli_query($conn, $q_dodaj_role)) {
					echo "Coś poszło nie tak";
				}
			}

			if(empty($nrola) && $lista_rol != "pusto") {//rola wybrana z listy

				$dodaj_dostep2 = "INSERT INTO dostepy (id_dostepu, id_osoby, id_projektu, rola, admin) VALUES (NULL, '".$_SESSION['id_osoby']."', '$id_projektu', '$lista_rol', '1')";

				if(!mysqli_query($conn, $dodaj_dostep2)) {
					echo "Coś poszło nie tak";
				}
			}
		    //--------------------------------------------------------------------------
		}
	}
	?>

	<?php
} else {
	header("Location: index.php");
}
?>
<script>
function startDateChanged(e){
  document.getElementById("endDate").setAttribute("min", e.target.value);
}
(function() {
	
	
	
})();	
</script>


<?php
require('Szablon/footer.php');
?>