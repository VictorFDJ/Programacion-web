<?php
session_start();
include __DIR__ . '/db_config.php'; // ruta segura

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    if (password_verify($password, $usuario['password'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = "Contraseña incorrecta";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: login.php");
    exit;
}
