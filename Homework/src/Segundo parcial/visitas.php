<?php
require 'db.php';
include 'header.php';
?>
<h2 class="text-center">Visitas Registradas</h2>
<a href="index.php" class="btn btn-primary mb-3">Agregar Nueva Visita</a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Teléfono</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $resultado = $conn->query("SELECT * FROM visitas ORDER BY fecha DESC");
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['telefono']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['apellido']}</td>
                    <td>{$fila['correo']}</td>
                    <td>{$fila['fecha']}</td>
                  </tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>
