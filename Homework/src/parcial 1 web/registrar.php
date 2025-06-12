<?php include("header.php");
?>
<h2 class="mb-4">Registrar nueva visita</h2>
<form action="guardar.php" method="POST" class="bg-white p-4 rounded shadow-sm">

<div class="mb-3">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre"> 
</div>

<div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" name="apellido" id="apellido" class="form-control" required placeholder="Apellido"> 
</div>

<div class="mb-3">
    <label for="cedula" class="form-label">Cedula</label>
    <input type="text" name="cedula" id="cedula" class="form-control" required placeholder="Cedula"> 
</div>

<div class="mb-3">
    <label for="edad" class="form-label">Edad</label>
    <input type="number" name="edad" id="edad" class="form-control" required placeholder="Edad"> 
</div>

<div class="mb-3">
    <label for="motivo" class="form-label"></label>
    <select name="motivo" id="motivo" class="form-select" required>
        <option value="">Toma una opcion</option>
        <option value="Limpieza">Limpieza</option>
        <option value="Caries">Caries</option>
        <option value="Dolor">Dolor</option>
        <option value="Chequeo">Chequeo</option>
</select>
</div>

<div class="d-filex justify-content-between">
<a href="inde.php" class="btn btn-secondary">Cancelar</a>
<button type="summit" class="btn btn-success">Guardar Visita</button>

</div>
</form>
<?php include("footer.php");