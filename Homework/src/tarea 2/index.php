<?php 
include("libraries/plantilla.php");
plantilla::aplicar();
?>
            <div class="text-end">
                <a href="editar.php" class="btn btn-primary">Agregar</a>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Año</th>
                        <th scope="col">Pais</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
