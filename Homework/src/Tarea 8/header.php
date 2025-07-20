<!-- header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Personajes</title>
    <link rel="stylesheet" href="estilo_blackclover.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        nav {
            background-color: #343a40;
        }
        nav a {
            color: white !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">🎬 Black Clover</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="agregar.php">Agregar</a></li>
                <li class="nav-item"><a class="nav-link" href="acerca_de.php">Acerca De</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
<?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
<div class="container">
