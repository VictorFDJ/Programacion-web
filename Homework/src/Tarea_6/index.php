<?php
include 'db_config.php';
include 'header.php';

$result = $conn->query("SELECT * FROM personajes");
?>

<h1 class="mb-4">Lista de Personajes</h1>
<a href="agregar.php" class="btn btn-success mb-3">➕ Agregar Nuevo Personaje</a>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Color</th>
            <th>Tipo</th>
            <th>Nivel</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="fotos/<?= htmlspecialchars($row['foto']) ?>" width="60" height="60" style="object-fit: cover; border-radius: 10px;"></td>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['color']) ?></td>
            <td><?= htmlspecialchars($row['tipo']) ?></td>
            <td><?= htmlspecialchars($row['nivel']) ?></td>
            <td>
                <a href="ver.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">👁️ Ver</a>
                <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este personaje?')">🗑️ Eliminar</a>
                <a href="descargar_pdf.php?id=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">📄 PDF</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
