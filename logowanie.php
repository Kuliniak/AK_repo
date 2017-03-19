<?php
session_start();
	if( isset($_POST['log_in']) ){
		
		$login = $_POST['login'];
		$haslo = md5($_POST['haslo']);
		
		if(empty($login) || empty($haslo) ){
			header("Location: index.php?error=1");
			exit;
		}
		
		$db = mysql_connect('localhost', 'root', '') or die ("Nie udalo siê po³¹czyæ z baz¹ danych!");
		
		mysql_select_db('programowanie');
		
		$wynik = mysql_query("SELECT * FROM 'users' WHERE 'login'+'$login'") or die("Nie uda³o siê pobraæ danych!");
		
		$rows = mysql_fetch_array($wynik);
		
		if($login) != $rows['login'] ){
			header("Location: index.php?error=2");
			exit;
		}
		if($haslo) != $rows['haslo'] ){
			header("Location: index.php?error=3"):
			exit;
		}
		if( ($login == $rows['login'] )&&($haslo == $rows['haslo'])){
			$_SESSION['zalogowany'] = 1;
			$_SESSION['uzytkownik'] = $rows['']
			header("Location: zalogowany.php");
			exit;
		}
	}
	else{
		header("Location: index.php?error=0");
		exit;
	}
?>