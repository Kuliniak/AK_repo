<!-- Podłączenie się do bazy danych -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inz_proj";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 