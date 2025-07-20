<?php
include 'db_config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Obtener la foto del personaje
$result = $conn->query("SELECT foto FROM personajes WHERE id = $id");
if ($result && $row = $result->fetch_assoc()) {
    $foto = $row['foto'];

    // Eliminar la foto del servidor
    if (file_exists("fotos/" . $foto)) {
        unlink("fotos/" . $foto);
    }

    // Eliminar el personaje de la base de datos
    $conn->query("DELETE FROM personajes WHERE id = $id");
}

header("Location: index.php");
exit();
