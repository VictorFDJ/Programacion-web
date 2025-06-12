<?php
// Verificamos si se recibió el parámetro ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$visitas = file_exists("visitas.json") ? json_decode(file_get_contents("visitas.json"), true) : [];

// Validamos si el ID existe en el arreglo
if (!isset($visitas[$id])) {
    echo "Visita no encontrada.";
    exit;
}

$visita = $visitas[$id];

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitas[$id]['nombre'] = $_POST['nombre'];
    $visitas[$id]['apellido'] = $_POST['apellido'];
    $visitas[$id]['cedula'] = $_POST['cedula'];
    $visitas[$id]['edad'] = $_POST['edad'];
    $visitas[$id]['motivo'] = $_POST['motivo'];

    file_put_contents("visitas.json", json_encode($visitas, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Visita</h2>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required value="<?= htmlspecialchars($visita['nombre']) ?>">
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required value="<?= htmlspecialchars($visita['apellido']) ?>">
        </div>

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="form-control" required value="<?= htmlspecialchars($visita['cedula']) ?>">
        </div>

        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" name="edad" id="edad" class="form-control" required min="0" value="<?= htmlspecialchars($visita['edad']) ?>">
        </div>

        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo de la Visita</label>
            <select name="motivo" id="motivo" class="form-select" required>
                <option value="Limpieza" <?= $visita['motivo'] === 'Limpieza' ? 'selected' : '' ?>>Limpieza</option>
                <option value="Caries" <?= $visita['motivo'] === 'Caries' ? 'selected' : '' ?>>Caries</option>
                <option value="Dolor" <?= $visita['motivo'] === 'Dolor' ? 'selected' : '' ?>>Dolor</option>
                <option value="Chequeo" <?= $visita['motivo'] === 'Chequeo' ? 'selected' : '' ?>>Chequeo</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Actualizar Visita</button>
        </div>

    </form>
</div>

<?php include 'footer.php'; ?>
