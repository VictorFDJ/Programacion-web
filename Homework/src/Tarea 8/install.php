<?php
$host = "localhost";
$user = "tu_usuario";
$password = "tu_contraseña";

$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS serie_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if (!$conn->query($sql)) {
    die("Error creando base de datos: " . $conn->error);
}

$conn->select_db("serie_db");

$sql = "CREATE TABLE IF NOT EXISTS personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    color VARCHAR(50),
    tipo VARCHAR(50),
    nivel INT,
    foto VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if (!$conn->query($sql)) {
    die("Error creando tabla personajes: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if (!$conn->query($sql)) {
    die("Error creando tabla usuarios: " . $conn->error);
}

$nombre = 'admin';
$email = 'admin@admin.com';
$pass = password_hash('admin123', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $email, $pass);
$stmt->execute();

if ($stmt->affected_rows !== 1) {
    die("Error insertando usuario admin");
}

echo "Instalación completada con éxito. Usuario admin creado con email: admin@admin.com y contraseña: admin123";


$stmt->close();
$conn->close();
