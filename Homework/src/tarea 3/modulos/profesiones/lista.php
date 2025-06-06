<?php
include("../../libreria/principal.php");
define("PAGINA_ACTUAL","profesiones");
Plantilla::aplicar();

$profesiones = Dbx::list("profesiones");

?>
<h1>Listado de profesiones</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Categoria</th>
      <td></td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($profesiones as $profesion): ?>
      <tr>
        <td><?php echo htmlspecialchars($profesion['nombre']); ?></td>
        <td><?php echo htmlspecialchars($profesion['categoria']); ?></td>
        <td>
          <a href="<?= base_url('modulos/profesiones/editar.php?codigo={$profesion->codigo}') ?>" class="btn btn-primary">
            📝
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

