<?php
require_once 'libraries/objectos.php';
include("libraries/plantilla.php");
plantilla::aplicar();
?>
<div class="text-end">
    <a href="editar.php" class="btn btn-primary">Agregar</a>
</div>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Tipo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Año</th>
            <th scope="col">Pais</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Example row 
        <tr>
            <td>Serie</td>
            <td>Breaking Bad</td>
            <td>2008</td>
            <td>USA</td>
            <td>
                <a href="editar.php?id=1" class="btn btn-warning">Editar</a>
                <a href="detalle.php?id=1" class="btn btn-danger">Detalle</a>
            </td>
        </tr>
        -->
       <?php
if(is_dir(filename: 'datos')){

    $archivos = scandir(directory: 'datos');

    foreach($archivos as $archivo){
        $ruta = 'datos/' . $archivo;
        if(is_file(filename: $ruta)){

            $json = file_get_contents(filename: $ruta);
            $obra = json_decode(json: $json);
?>
    <tr>
        <td><img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" width="100"></td>
        <td><?= Datos::Tipos_de_Obras()[$obra->tipo] ?></td>
        <td><?= $obra->nombre ?></td>
        <td><?= $obra->autor ?></td>
        <td><?= $obra->pais ?></td>
        <td>
            <a href="editar.php?id=<?= $obra->codigo ?>" class="btn btn-warning">Editar</a>
            <a href="detalle.php?id=<?= $obra->codigo ?>" class="btn btn-danger">Detalle</a>
        </td>
    </tr>
<?php
        }
    }
}
?>

    </tbody>
</table>