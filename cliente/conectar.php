<?php

$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_database = "groupgiam";
$conn = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("No se puede conectar a la base de datos");
mysqli_select_db($conn, $mysqli_database) or die("No se puede conectar a la base de datos");

?>
