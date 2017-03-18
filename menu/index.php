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
			<textarea name="zadanie1">1. </textarea>
			<input type="data" name="s_data1" placeholder="Początek zadania(data)">
			<input type="data" name="f_data1" placeholder="Koniec zadania(data)">
		</div>
		
		<br>
		<input type="button" name="make_new" value="+" onclick="tworz()">

		<input type="button" name="delete_last" value="-" onclick="niszcz()">
		<br>

		<br>
		<input type="submit" value="Zakończ">
	</form>



	<?php
	$zadania = [];
	foreach($_POST as $i) {
		//echo $_POST['zadanie'];
		$zadania[] = $i;
	}
	
	if(count($zadania)>0){
		echo print_r($zadania); //wypisanie tablicy
		echo "<br>";
		//echo $zadania[0];
	}
	?>

	
</body>
</html>