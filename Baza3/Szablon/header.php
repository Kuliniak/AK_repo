<!-- Nagłówek strony -->
<!DOCTYPE html>
<html>
<head>
	<title>Przykładowa strona</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
</head>
<body>
<?php session_start(); ?>
<div class="wrapper">
	
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    <font size="5">N</font>on<font size="5">G</font>antt<font color="red"><font size="5">P</font>roject<font size="5">L</font>ibre</font>
                </a>
            </div>
			<ul class="nav">
			<?php 
				if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
			?>
                <li class="active">
                    <a href="zalogowany.php">
                        <i class="pe-7s-user"></i>
                        <p>Mój profil</p>
                    </a>
                </li>
				<li class="active">
                    <a href="create_proj.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Nowy projekt</p>
                    </a>
                </li>
				<li class="active">
                    <a href="moje_projekty.php">
                        <i class="pe-7s-pin"></i>
                        <p>Zarządzanie projektem</p>
                    </a>
                </li>
			<?php } else { ?>
				<li class="active">
                    <a href="logowanie.php">
                        <i class="pe-7s-switch"></i>
                        <p>Logowanie</p>
                    </a>
                </li>
				<li class="active">
                    <a href="rejestracja.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Rejestracja</p>
                    </a>
                </li>
			<?php } ?>

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
					<?php 
						if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true) {
					?>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <?php echo $_SESSION['login'];?>
                            </a>
                        </li>
						<li>
                           <a href="wyloguj.php">Wyloguj</a>
                        </li>
                    </ul>
					<?php 
						}
					?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">

