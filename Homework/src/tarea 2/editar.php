<?php

include("libraries/principal.php");

$obra = new obra();

// Cargar obra desde archivo si se proporciona un ID por GET
if (isset($_GET['id'])) {
    $ruta = 'datos/' . $_GET['id'] . '.json';
    if (is_file($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    }
}

// Procesar envío del formulario (POST)
if ($_POST) {
    // Cargar los datos del formulario en el objeto obra
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    // Verificar que la carpeta "datos" exista
    if (!is_dir('datos')) {
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Error al crear la carpeta de datos</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }

    // Guardar la obra como JSON
    $ruta = 'datos/' . $obra->codigo . '.json';
    $json = json_encode($obra);
    file_put_contents($ruta, $json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada correctamente</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}

plantilla::aplicar();
?>

<!-- Formulario de edición de obra -->
<form method="post" action="editar.php">
    <!-- Código de la obra -->
    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" class="form-control" name="codigo" id="codigo" value="<?= $obra->codigo ?>">
    </div>

    <!-- Foto de la obra -->
    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto</label>
        <input type="text" class="form-control" name="foto_url" id="foto_url" value="<?= $obra->foto_url ?>">
    </div>

    <!-- Tipo de obra -->
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" name="tipo" id="tipo">
            <option value="">Seleccione</option>
            <?php
            foreach (Datos::Tipos_de_Obras() as $key => $value) {
                $selected = ($obra->tipo == $key) ? "selected" : "";
                echo "<option value='$key' $selected>$value</option>";
            }
            ?>
        </select>
    </div>

    <!-- Nombre de la obra -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $obra->nombre ?>">
    </div>

    <!-- Descripción de la obra -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion"><?= $obra->descripcion ?></textarea>
    </div>

    <!-- País de la obra -->
    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" class="form-control" name="pais" id="pais" value="<?= $obra->pais ?>">
    </div>

    <!-- Autor de la obra -->
    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" name="autor" id="autor" value="<?= $obra->autor ?>">
    </div>

    <!-- Botones -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
