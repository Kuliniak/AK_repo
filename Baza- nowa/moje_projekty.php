<!-- Widok moich projektów -->
<?php
require('Szablon/header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
	?>

	<h1>Moje projekty</h1>
	<h3>Masz dostęp do tych projektów</h3>

	<?php
	$q_projekty = "SELECT * FROM projekty, dostepy, osoby WHERE projekty.id_projektu = dostepy.id_projektu AND osoby.id_osoby = '".$_SESSION['id_osoby']."' AND dostepy.id_osoby = '".$_SESSION['id_osoby']."'";
	echo "<hr>";
//////////////////////////////////////////////////////////////////////////////////////
	echo '<table id="tablica" style="width:100%">';
		echo "<tr>";
		echo "<th><b>NAZWA PROJEKTU<b></th>";
		echo "<th><b>STWÓRZ ROLĘ<b></th>";
		echo "<th><b>DODAJ UŻYTKOWNIKA<b></th>";
		echo "<th><b>EDYTUJ PROJEKT</b></th>";
		echo "</tr>";
	if($result = mysqli_query($conn, $q_projekty)) {
		while ($line = mysqli_fetch_assoc($result)) {

			echo "<tr>";
			echo "<th>".$line['nazwa']."</th>";

			/*echo '<form method="POST" action="stworz_role.php">';
				echo '<th><input type="submit" value="Stwórz rolę"></th>';
				echo '<input type="hidden" value="'.$line['id_projektu'].'" name="id_projektu">';
				echo '<input type="hidden" value="'.$line['nazwa'].'" name="nazwa_projektu">';
			echo '</form>';*/

			if($line['admin'] >= 1) {
				echo '<form method="POST" action="stworz_role.php">';
					echo '<th><input type="submit" value="Stwórz rolę"></th>';
					echo '<input type="hidden" value="'.$line['id_projektu'].'" name="id_projektu">';
					echo '<input type="hidden" value="'.$line['nazwa'].'" name="nazwa_projektu">';
				echo '</form>';

				echo '<form method="POST" action="dodaj_usera.php">';
					echo '<th><input type="submit" value="Dodaj użytkownika" name="dodaj"<th/>';
					echo '<input type="hidden" value="'.$line['id_projektu'].'" name="id_projektu">';
					echo '<input type="hidden" value="'.$line['nazwa'].'" name="nazwa_projektu">';
				echo '</form>';

				echo '<form method="POST" action="">';
					echo '<th><input type="submit" value="Edytuj projekt"></th>';
				echo '</form>';
			} else {
				echo '<th><input type="button" value="Stwórz rolę" title="Nie jesteś administratorem projektu" disabled></th>';
				
				echo '<th><input type="button" value="Dodaj użytkownika" title="Nie jesteś administratorem projektu" disabled></th>';	

				echo '<form method="POST" action="">';
					echo '<th><input type="submit" value="Edytuj projekt"></th>';
				echo '</form>';
			}
			echo "</tr>";
		}
	}
	echo '</table>';
	unset($_SESSION['nazwa_projektu']);
	unset($_SESSION['id_projektu']);
	//echo print_r($_SESSION);
//////////////////////////////////////////////////////////////////////////////////////
	?>

<?php
} else {
		header("Location: logowanie.php");
}
?>

<?php
require('Szablon/footer.php');
?>