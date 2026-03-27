<?php

class Familiar
{
    private $id;
    private $nombre;
    private $identificacion;
    private $celular;
    private $fechaNacimiento;
    private $ocupacion;
    private $idPersona;


    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, nombre,identificacion, celular, fechaNacimiento, ocupacion, idPersona from familiar where $campo = $valor";
                //echo $cadenaSQL.'<p>';
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->nombre = $campo['nombre'];
            $this->identificacion = $campo['identificacion'];
            $this->celular = $campo['celular'];
            $this->fechaNacimiento = $campo['fechaNacimiento'];
            $this->ocupacion = $campo['ocupacion'];
            $this->idPersona = $campo['idPersona'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }
    public function setIdentificacion($identificacion): void
    {
        $this->identificacion = $identificacion;
    }
    public function setCelular($celular): void
    {
        $this->celular = $celular;
    }

    public function setFechaNacimiento($fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setOcupacion($ocupacion): void
    {
        $this->ocupacion = $ocupacion;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }


    public function guardar()
    {
        $cadenaSQL = "insert into familiar(nombre, identificacion, celular,  fechaNacimiento, ocupacion, idPersona) values('$this->nombre','$this->identificacion','$this->celular','$this->fechaNacimiento','$this->ocupacion', '$this->idPersona')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update familiar set nombre='$this->nombre', identificacion='$this->identificacion', celular='$this->celular', fechaNacimiento='$this->fechaNacimiento', ocupacion='$this->ocupacion', idPersona='$this->idPersona' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from familiar where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, nombre,identificacion,celular, fechaNacimiento, ocupacion, idPersona from familiar $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Familiar::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $familia = new Familiar($resultado[$i], null);
            $lista[$i] = $familia;
        }
        return $lista;
    }
}
