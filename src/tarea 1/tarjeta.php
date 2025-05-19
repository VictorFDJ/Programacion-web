<?php
$nombre = "Victor Manuel"; 
$apellido = "Fernandez de Jesus"; 
$edad = 22; 
$carrera = "Software"; 
$universidad = "Itla";

 require('partes/cabeza.php'); ?>  

<div class="card">
    <h1>Datos Personales</h1>
    <div class="info"><span>Nombre:</span> <?php echo $nombre; ?></div>
    <div class="info"><span>Apellido:</span> <?php echo $apellido; ?></div>
    <div class="info"><span>Edad:</span> <?php echo $edad; ?> años</div>
    <div class="info"><span>Carrera:</span> <?php echo $carrera; ?></div>
    <div class="info"><span>Universidad:</span> <?php echo $universidad; ?></div>
</div>


<?php require('partes/foot.php'); ?>