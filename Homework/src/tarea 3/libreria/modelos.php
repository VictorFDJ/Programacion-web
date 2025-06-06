<?php


class personaje
{
    public $idx = '';
    public $identificacion = '';
    public $nombre = '';
    public $apellido = '';
    public $fecha_nacimiento = '';
    public $foto = '';
    public $profesion = '';
    public $nivel_experiencia = '';


    public function edad()
    {
        if (empty($this->fecha_nacimiento)) {
            return 0;
        }
        $fecha_nacimiento = strtotime($this->fecha_nacimiento);
        $fecha_actual = time();
        $edad = date('Y', $fecha_actual) - date('Y', $fecha_nacimiento);
        if (date('md', $fecha_actual) < date('md', $fecha_nacimiento)) {
            $edad--;
        }
        return $edad;
    }



    public function __construct($data = [])
    {
        if (is_object($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

class profesion
{
    public $idx = '';

    public $codigo = "";
    public $nombre = "";
    public $categoria = "";
    public $salario_mensual = 0;

    public function __construct($data = [])
    {
        if (is_object($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __tostring()
    {
        return "{$this->nombre} - Salario: {$this->salario_mensual}";
    }

}
