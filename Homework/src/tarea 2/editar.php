<?php

include("libraries/principal.php");

$obra = new obra();

if ($_POST) {
    // Cargar los datos del formulario en el objeto obra
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    // Aquí podrías guardar el objeto obra en una base de datos o archivo
    // Por simplicidad, solo mostraremos un mensaje de éxito
    echo "<div class='alert alert-success'>Obra guardada exitosamente!</div>";
    if (!is_dir('datos')) {
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Error al crear la carpeta de datos</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        exit();
    }
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


<form method="post" action="editar.php">
    <!-- Codigo de la obra -->
    <div class="mb-3">
        <label for="codigo" class="form-label">Codigo</label>
        <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo $obra->codigo; ?>">
    </div>
    <!-- Foto de la obra -->
    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto</label>
        <input type="text" class="form-control" name="foto_url" id="foto_url" value="<?php echo $obra->foto_url; ?>">
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
        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $obra->nombre; ?>">
    </div>
    <!-- Descripcion de la obra -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea class="form-control" name="descripcion" id="descripcion"><?php echo $obra->descripcion; ?></textarea>
    </div>
    <!-- Pais de la obra -->
    <div class="mb-3">
        <label for="pais" class="form-label">Pais</label>
        <input type="text" class="form-control" name="pais" id="pais" value="<?php echo $obra->pais; ?>">
    </div>
    <!-- Autor de la obra -->
    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" name="autor" id="autor" value="<?php echo $obra->autor; ?>">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>