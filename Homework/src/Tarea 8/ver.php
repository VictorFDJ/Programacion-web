<?php
include 'db_config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM personajes WHERE id = $id");

if (!$result || $result->num_rows === 0) {
    echo "Personaje no encontrado.";
    exit();
}

$personaje = $result->fetch_assoc();

include 'header.php';
?>

<h2 style="color: white;">Perfil del Personaje</h2>

<div class="card mb-4 mt-3 shadow" style="max-width: 600px; background-color: #121212; color: white;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="fotos/<?= htmlspecialchars($personaje['foto']) ?>" class="img-fluid rounded-start" alt="Foto del personaje" style="object-fit: cover; height: 100%;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($personaje['nombre']) ?></h5>
                <p class="card-text"><strong>Color:</strong> <?= htmlspecialchars($personaje['color']) ?></p>
                <p class="card-text"><strong>Tipo:</strong> <?= htmlspecialchars($personaje['tipo']) ?></p>
                <p class="card-text"><strong>Nivel:</strong> <?= htmlspecialchars($personaje['nivel']) ?></p>
                <a href="descargar_pdf.php?id=<?= $personaje['id'] ?>" class="btn btn-outline-light">📄 Descargar PDF</a>
                <a href="index.php" class="btn btn-secondary">🔙 Volver</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
