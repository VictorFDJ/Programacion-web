<?php
include("modelos.php");
include("plantilla.php");
include("Dbx.php");

function base_url($path = "") {

//protocolo
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

//host
$host = $_SERVER['HTTP_HOST'];

//ruta
$path = trim($path, "/");

//retornar la URL completa
return $protocol . $host . "/" . $path;
}

