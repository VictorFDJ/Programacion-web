<?php
$nombre = "Victor Manuel"; 
$apellido = "Fernandez de Jesus"; 
$edad = 22; 
$carrera = "Software"; 
$universidad = "Itla";
$mensaje = ($edad >= 18)? "Eres mayor de edad, 'Tienes que buscar trabajo rapido')":"Eres menor de edad 'acuestate temprano'";

 require('partes/cabeza.php'); ?>  

<div class="card">
    <h1>Datos Personales</h1>
    <div >Nombre: <?php echo $nombre; ?></div>
    <div >Apellido: <?php echo $apellido; ?></div>
    <div >Edad: <?php echo $edad; ?> años</div>
    <div >Carrera: <?php echo $carrera; ?></div>
    <div >Universidad: <?php echo $universidad; ?></div>
    <div><?php echo $mensaje; ?></div>
</div>


<?php require('partes/foot.php'); ?>