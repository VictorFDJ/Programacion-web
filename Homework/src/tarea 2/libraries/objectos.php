<?php
class obra{
    public $codigo;
    public $foto_url;
    public $tipo;
    public $nombre;
    public $descripcion;
    public $pais;
    public $autor;

    public $personajes = array();


}
class personaje{
    public $cedula;
    public $foto_url;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $sexo;
    public $havilidades;
    public $comida_favorita;
}
class Datos{
    public static function Tipos_de_Obras(): array
    {
        return array(
            "pelicula" => "Pelicula",
            "serie" => "Serie",
            "libro" => "Libro"
        );
    }
}