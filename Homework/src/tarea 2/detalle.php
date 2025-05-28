<?php

include("libraries/principal.php");

$obra = new obra();

if (isset($_GET['id'])) {
    $ruta = 'datos/' . $_GET['id'] . '.json';
    if (is_file($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    } else {
        plantilla::aplicar();
        echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
        exit();
    }
} else {
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
    exit();
}

plantilla::aplicar();
?>

<div class="text-end">
    <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
</div>

<div class="row">
  <div class="col-md-12">
    <h2><?= $obra->nombre ?></h2>
    <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="200">
    <p><strong>Tipo:</strong> <?= Datos::Tipos_de_Obras()[$obra->tipo] ?></p>
    <p><strong>Autor:</strong> <?= $obra->autor ?></p>
    <p><strong>País:</strong> <?= $obra->pais ?></p>
    <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h3>Personajes</h3>
    
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Foto</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Fecha de Nacimiento</th>
         
        </tr>
      </thead>
      <tbody>
        <?php
        // Cargar los datos de los personajes
        foreach ($obra->personajes as $personaje) {
            echo "
                <tr>
                    <td>
                        <img src='{$personaje->foto_url}' alt='{$personaje->nombre}' height='100'>
                    </td>
                    <td>{$personaje->nombre}</td>
                    <td>{$personaje->apellido}</td>
                    <td>{$personaje->fecha_nacimiento}</td>
                   
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>