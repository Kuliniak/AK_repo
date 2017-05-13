<!-- Widok moich projektów -->
<?php
require('header.php');
require('connect.php');
?>

<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
	?>

	<h1>Moje projekty</h1>
	<h3>Masz dostęp do tych projektów</h3>

	<?php
	$q_projekty = "SELECT * FROM projekty, dostepy, osoby WHERE projekty.id_projektu = dostepy.id_projektu AND osoby.id_osoby = '".$_SESSION['id_osoby']."' AND dostepy.id_osoby = '".$_SESSION['id_osoby']."'";

	echo '<table id="tabela">';
	if($result = mysqli_query($conn, $q_projekty)) {
		while ($line = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<th>".$line['id_projektu']."<th>";
			echo "<th>".$line['nazwa']."<th>";
			echo '<th><input type="button" value="Edytuj"><th>';
			echo '<th><input type="button" value="Dodaj użytkownika"><th>';
			echo "</tr>";
		}
	}
	echo "<table>";
	?>


<?php
	} else {
		header("Location: logowanie.php");
}
?>

<?php
require('footer.php');
?>