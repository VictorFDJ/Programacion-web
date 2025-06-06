<?php


class personaje{
    public $idx = '';
    public $identificacion;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $foto;
    public $profesion;
    public $nivel_experiencia;

    public function __construct($data = []){
        if(is_object($data)){
            $data = (array)$data;
        }

        foreach ($data as $key => $value) {
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
}

class profesion {
    public $idx = '';

    public $codigo = "";
    public $nombre = "";
    public $categoria = "";
    public $salario_mensual = 0;

    public function __construct($data = []) {
        if (is_object($data)) {
            $data = (array)$data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
