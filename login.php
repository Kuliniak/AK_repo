<html>
<head>
<title> NonGantt ProjectLibre</title>
<meta http-equiv="Content-Type" content="text/html; charset-utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="kontener">

	<?php
	echo '<pre>';
		if( isset($_GET['error']) ){
			switch($_GET['error']){
				case 0: echo 'Zaloguj siê do systemu'; break;
				case 1: echo 'Proszê wype³niæ wszystkie pola!'; break;
				case 2: echo 'U¿ytkownik nie istnieje!'; break;
				case 3: echo 'Podane has³o jest nieprawid³owo!'; break;
			}
		}
	echo '</pre>';
	?>
	<form id="login">
		<div id="naglowek">
			<h1>NonGantt <font color="red">ProjectLibre</font></h1>
		</div>
		<div id="menu_gorne">
			<ul>
				<li><a href="#">Strona g³ówna</a></li>
				<li><a href="#">O projekcie</a></li>
				<li><a href="#">O tworz¹cych projekt</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="menu_lewe">
			<h3>Panel u¿ytkownika</h3>
					<ul>
				<li><a href="#">Logowanie</a></li>
				<li><a href="#">Rejestracja</a></li>
			</ul>
		</div>
		<div id="tresc">
			<h3>Zaloguj siê</h3>
			<p>Wype³nij poni¿sze pola, by siê zalogowaæ do panelu</p>
			<form action="logowanie.php" method="post"
				<input type="login" placeholder="Login" autofocus />
				<input type="haslo" placeholder="Has³o" />
				<div class="remember">
					<input name="checky" id="checky" value="1" type="checkbox" />
					<label class="terms"=>Zapamiêtaj mnie</label>
				</div>
				<input type="submit" value="Zaloguj siê" name="log_in"/>
			</form>
			</div>
		</div>
		<div class="clear"></div>
		<div id="stopka">&copy; M.J., D.K., A.K., R.Z. 2017</div>
	</form>
</div>
</body>
</html>