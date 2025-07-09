<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$bd = "visitas_db";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
