<?php

include("libraries/principal.php");

$obra = new obra();
$personaje = new personaje();

// Verificar si se pasa el ID de la obra
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

// Procesar el formulario
if ($_POST) {
    // Cargar los datos del formulario en el objeto personaje
    $personaje->codigo_obra = $_POST['codigo_obra'];
    $personaje->cedula = $_POST['cedula'];
    $personaje->foto_url = $_POST['foto_url'];
    $personaje->nombre = $_POST['nombre'];
    $personaje->apellido = $_POST['apellido'];
    $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje->sexo = $_POST['sexo'];
    $personaje->havilidades = $_POST['havilidades'];
    $personaje->comida_favorita = $_POST['comida_favorita'];

    // Asegurarse de que la propiedad personajes exista
    if (!isset($obra->personajes)) {
        $obra->personajes = [];
    }

    // Agregar personaje al arreglo
    $obra->personajes[] = $personaje;

    // Verificar carpeta
    if (!is_dir('datos')) {
        echo "<div class='alert alert-danger'>Error al crear la carpeta de datos</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }

    // Guardar archivo actualizado
    $ruta = 'datos/' . $obra->codigo . '.json';
    file_put_contents($ruta, json_encode($obra));

    echo '<div class="alert alert-success">Personaje agregado exitosamente!</div>';
    echo "<a href='detalle.php?id={$obra->codigo}' class='btn btn-primary'>Volver a la obra</a>";
    exit();
}
?>

<!--Resumen de la obra -->
<div class="row">
    <div class="col-md-4">
        <h2><?= $obra->nombre ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="200">
        <p><strong>Tipo:</strong> <?= Datos::Tipos_de_Obras()[$obra->tipo] ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
    </div>

    <div class="col-md-8">
        <h3>Datos del personaje</h3>
        <form method="post" action="agregar_personaje.php?id=<?= $obra->codigo ?>">
            <input type="hidden" name="codigo_obra" value="<?= $obra->codigo ?>">

            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" name="cedula" id="cedula" required>
            </div>

            <div class="mb-3">
                <label for="foto_url" class="form-label">Foto URL</label>
                <input type="text" class="form-control" name="foto_url" id="foto_url">
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" id="apellido">
            </div>

            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" name="sexo" id="sexo">
                    <option value="">Seleccione...</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="havilidades" class="form-label">Habilidades</label>
                <textarea class="form-control" name="havilidades" id="havilidades"></textarea>
            </div>

            <div class="mb-3">
                <label for="comida_favorita" class="form-label">Comida Favorita</label>
                <input type="text" class="form-control" name="comida_favorita" id="comida_favorita">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar Personaje</button>
                <a href="detalle.php?id=<?= $obra->codigo ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
