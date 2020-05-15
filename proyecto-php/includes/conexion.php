<?php

//conexión

$server = "localhost";
$username = "root";
$contrasena = "";
$database = "myowndatabases";

$db = mysqli_connect($server, $username, $contrasena, $database);

mysqli_query($db, "SET NAMES 'utf8'");

if (!isset($_SESSION)) {
    session_start();
}
?>