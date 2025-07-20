<?php
include 'db_config.php';

$nombre = 'victor';
$email = 'victor@gmail.com';
$password = password_hash('123456', PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $nombre, $email, $password);
$stmt->execute();

if ($stmt->affected_rows === 1) {
    echo "Usuario creado con éxito";
} else {
    echo "Error al crear usuario";
}
