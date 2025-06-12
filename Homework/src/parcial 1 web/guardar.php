<?php
date_default_timezone_set("America/Santo_Domingo");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $cedula = trim($_POST["cedula"]);
    $edad = intval($_POST["edad"]);
    $motivo = trim($_POST["motivo"]);

    $fecha_hora = date("Y-m-d H:i:s");

    $nuevaVisita = [
        "nombre" => $nombre,
        "apellido" => $apellido,
        "cedula" => $cedula,
        "edad" => $edad,
        "motivo" => $motivo,
        "fecha_hora" => $fecha_hora
    ];

    $archivo = "visitas.json";
    $visitas = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

    $visitas[] = $nuevaVisita;

    file_put_contents($archivo, json_encode($visitas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
