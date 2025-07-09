<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    $stmt = $conn->prepare("INSERT INTO visitas (telefono, nombre, apellido, correo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $telefono, $nombre, $apellido, $correo);

    if ($stmt->execute()) {
        header("Location: visitas.php");
    } else {
        echo "Error al guardar la visita: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
