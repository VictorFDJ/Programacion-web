<?php
include("libraries/principal.php");
$id = $_GET['id'];
$cedula = $_GET['cedula'];

// Carga la obra
$obra = new Obra();
$ruta = 'datos/'.$id.'.json';
if (!is_file($ruta)) {
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}

$json = file_get_contents($ruta);
$obra = json_decode($json);

// Busca el personaje
$personaje = null;

foreach ($obra->personajes as $p) {
    if ($p->cedula == $cedula) {
        $personaje = $p;
        break;
    }
}
if ($personaje == null) {
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>Error al cargar el personaje</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}

// Elimina el personaje
$obra->personajes = array_filter($obra->personajes, function($p) use ($cedula) {
    return $p->cedula != $cedula;
});

// Guarda la obra
file_put_contents($ruta, json_encode($obra));
plantilla::aplicar();

echo "<div class='alert alert-success'>Personaje eliminado correctamente</div>";
echo "<a href='personajes.php?id=".$obra->codigo."' class='btn btn-primary'>Volver</a>";
exit();
?>