<?php
include("../../libreria/principal.php");
define("PAGINA_ACTUAL","profesiones");
Plantilla::aplicar();

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
          <a href="
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

