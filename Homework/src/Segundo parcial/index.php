<!-- Victor Manuel Fernandez de Jesus (2024-0214)   -->
<?php include 'header.php'; ?>
<h2>Registro de Visitas</h2>
<form action="guardar.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Apellido</label>
        <input type="text" name="apellido" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Visita</button>
    <a href="visitas.php" class="btn btn-secondary">Ver Visitas</a>
</form>
<?php include 'footer.php'; ?>
