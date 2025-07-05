<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $tipo = $_POST['tipo'];
    $nivel = $_POST['nivel'];

    // Manejo de la imagen
    $foto_nombre = "";
    if (!empty($_FILES["foto"]["name"])) {
        $foto_nombre = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $ruta_destino = "fotos/" . $foto_nombre;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_destino);
    }

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $nombre, $color, $tipo, $nivel, $foto_nombre);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

include 'header.php';
?>

<h2>Agregar Nuevo Personaje</h2>

<form method="POST" enctype="multipart/form-data" class="row g-3 mt-3">
    <div class="col-md-6">
        <label class="form-label">Nombre:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Color Representativo:</label>
        <input type="text" name="color" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tipo / Rol:</label>
        <input type="text" name="tipo" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Nivel / Jerarquía:</label>
        <input type="number" name="nivel" class="form-control" required>
    </div>

    <div class="col-md-12">
        <label class="form-label">Foto del Personaje:</label>
        <input type="file" name="foto" class="form-control" accept="image/*" required>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar Personaje</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include 'footer.php'; ?>
