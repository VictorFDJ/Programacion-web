<?php

class Plantilla
{

    static $instancia = null;


    public static function aplicar()
    {
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
    }

    function __construct()
    {

        ?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        </head>

        <body>
            <div class="container">
                <div>
                    <h1>Mundo Barabie</h1>
                </div>
                <div class="divMenu">
                    <ul class="nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="personajes.php">Personajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profesiones.php">Profesiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="estadisticas.php">Estadísticas</a>
                        </li>
                    </ul>

                </div>
                <div class="contenido">

               

        <?php
    }

    function __destruct()
    {
        ?>
         </div>
                <div class="footer">
                    <hr>
                    <p>© 2025 Mundo Barabie</p>
                </div>
            </div>
        </body>

        </html>
        <?php
    }

}