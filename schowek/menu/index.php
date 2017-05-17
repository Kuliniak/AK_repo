<html>
<head>
  <meta charset="UTF-8">
  <script language="javascript" type="text/javascript" src="sketch.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<form method="post" id="zadania">
		<h2>Nazwa Projektu</h2>
		<input type="text" name="nazwa" placeholder="Nazwa projektu">

		<h2>Lista zadań</h2>
		<div id = "d_zadania">
			<textarea id = "z1" name="zadanie[]">1. </textarea>
			<!--<input type="data" name="s_data[]" placeholder="Początek zadania(data)">
			<input type="data" name="f_data[]" placeholder="Koniec zadania(data)">-->
		</div>
		
		<br>
		<input type="button" name="make_new" value="+" onclick="tworz()">

		<input type="button" name="delete_last" value="-" onclick="niszcz()">
		<br>

		<br>
		<input type="submit" name="wyslij" value="zakoncz">
	</form>

	<?php
	//ZAPIS ZADAŃ DO 'BAZY'
	$dane = "";
	$start = "|start|";
	$stop = "|stop|";

	if(isset($_POST['wyslij']) && isset($_POST['zadanie'])) { //jesli wcisne wyslij i bedzie jakies zadanie to ...
		$zadania = $_POST['zadanie'];//tablica zadań. Nie uporządkowana
		
		foreach($zadania as $value){
			$dane = $dane.$start.$value.$stop; //wszystkie zadania jako jeden plik
			//echo $value."<br>";
		}
		echo $dane;
	}

	//ODCZYT ZADAŃ Z 'BAZY'
	function get_string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}

	$tab_zadan = [];//tablica w ktorej przechowywane sa zwrócone z bazy zadania
	while(strpos($dane, $start) !== false) {
		$cut = get_string_between($dane, $start, $stop);
		array_push($tab_zadan, $cut);
		$dane = substr($dane, strlen($start) + strlen($cut) + strlen($stop), strlen($dane));
	}
	echo "<br>";
	print_r($tab_zadan);

	?>
</body>
</html>
