<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$visitas = file_exists("visitas.json") ? json_decode(file_get_contents("visitas.json"), true) : [];

if (!isset($visitas[$id])) {
    echo "La visita no existe.";
    exit;
}

unset($visitas[$id]);

$visitas = array_values($visitas);

file_put_contents("visitas.json", json_encode($visitas, JSON_PRETTY_PRINT));

header("Location: index.php");
exit;
