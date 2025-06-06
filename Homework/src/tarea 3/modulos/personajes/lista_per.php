<?php
include("../../libreria/principal.php");
define("PAGINA_ACTUAL","personajes");
Plantilla::aplicar();

$personajes = Dbx::list("personajes");

?>
<h3>Listado de personajes</h3>
<div class="text-end mb-3">
    <a href="<?= base_url('modulos/personajes/editar.php'); ?>" class="btn btn-primary">Nuevo Personaje</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Experiencia</th>
            <th>Profesion</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personajes as $personaje): ?>
        <tr>
            <td><?= htmlspecialchars($personaje->idx);?></td readonly>
            <td><?= htmlspecialchars($personaje->nombre); ?></td>
            <td><?= htmlspecialchars($personaje->edad()); ?></td>
            <td><?= htmlspecialchars($personaje->nivel_experiencia); ?></td>
            <td><?= htmlspecialchars($personaje->profesion); ?></td>
            <td>
                <a href="<?= base_url('modulos/personajes/editar.php?codigo=' . $personaje->idx); ?>" class="btn btn-warning btn-sm">Editar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>