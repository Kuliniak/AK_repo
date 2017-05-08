<!-- Strona na której wyświetlane są wszystkie konta zarejestrowane, ale nie ma jej podpiętej do uzytkowania -->
<?php
require('header.php');
require('connect.php');

$select = "SELECT * FROM osoby";

$result = mysqli_query($conn, $select);

if (!$result) {
    echo '<font color="red">Zapytanie nie powiodło się</font><br>';
    exit;
}

echo "<h1>Tabela Osoby</h1>";

while ($line = mysqli_fetch_assoc($result)) {
	echo $line["id_osoby"]." | ".$line["login"]." | ".$line["haslo"]."<br>";
}
?>

<br><br>

<form action="index.php">
	<input type="submit" value="Cofnij">
</form>

<?php
require('footer.php');
?>