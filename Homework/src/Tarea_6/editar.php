<?php
include 'db_config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM personajes WHERE id = $id");
$personaje = $result->fetch_assoc();

if (!$personaje) {
    echo "Personaje no encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $tipo = $_POST['tipo'];
    $nivel = $_POST['nivel'];

    $foto_nombre = $personaje['foto'];


    if (!empty($_FILES["foto"]["name"])) {
        
        if (file_exists("fotos/" . $foto_nombre)) {
            unlink("fotos/" . $foto_nombre);
        }
        $foto_nombre = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $ruta_destino = "fotos/" . $foto_nombre;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_destino);
    }

    $stmt = $conn->prepare("UPDATE personajes SET nombre=?, color=?, tipo=?, nivel=?, foto=? WHERE id=?");
    $stmt->bind_param("sssdsi", $nombre, $color, $tipo, $nivel, $foto_nombre, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

include 'header.php';
?>

<h2>Editar Personaje</h2>

<form method="POST" enctype="multipart/form-data" class="row g-3 mt-3">
    <div class="col-md-6">
        <label class="form-label">Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($personaje['nombre']) ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Color Representativo:</label>
        <input type="text" name="color" class="form-control" value="<?= htmlspecialchars($personaje['color']) ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tipo / Rol:</label>
        <input type="text" name="tipo" class="form-control" value="<?= htmlspecialchars($personaje['tipo']) ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Nivel / Jerarquía:</label>
        <input type="number" name="nivel" class="form-control" value="<?= htmlspecialchars($personaje['nivel']) ?>" required>
    </div>

    <div class="col-md-12">
        <label class="form-label">Foto Actual:</label><br>
        <img src="fotos/<?= htmlspecialchars($personaje['foto']) ?>" width="100" style="border-radius: 8px;"><br><br>
        <label class="form-label">Nueva Foto (opcional):</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php include 'footer.php'; ?>
