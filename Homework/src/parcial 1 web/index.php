<!-- 
Victor Manuel Fernandez de Jesus (2024-0214) 
-->
<?php
$visitas = file_exists("visitas.json") ? json_decode(file_get_contents("visitas.json"), true) : [];
include 'header.php';
?>

<div class="container mt-5">
  <h1 class="mb-4">Pacientes del Consultorio</h1>
  <a href="registrar.php" class="btn btn-primary mb-3">Registrar Nueva Visita</a>

  <?php if (count($visitas) > 0): ?>
    <table class="table table-bordered table-hover bg-white">
      <thead class="table-dark">
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Cédula</th>
          <th>Edad</th>
          <th>Motivo</th>
          <th>Fecha y Hora</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($visitas as $index => $visita): ?>
          <tr>
            <td><?= htmlspecialchars($visita["nombre"]) ?></td>
            <td><?= htmlspecialchars($visita["apellido"]) ?></td>
            <td><?= htmlspecialchars($visita["cedula"]) ?></td>
            <td><?= htmlspecialchars($visita["edad"]) ?></td>
            <td><?= htmlspecialchars($visita["motivo"]) ?></td>
            <td><?= htmlspecialchars($visita["fecha_hora"]) ?></td>
            <td>
              <a href="editar.php?id=<?= $index ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="eliminar.php?id=<?= $index ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta visita?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">No hay registros aún.</div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
