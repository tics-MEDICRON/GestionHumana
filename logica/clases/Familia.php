<?php

class Familia
{
    private $id;
    private $nombre;
    private $fechaNacimiento;
    private $ocupacion;
    private $parentesco;
    private $emergencia;
    private $telefono;
    private $idPersona;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, nombre, fechaNacimiento, ocupacion, parentesco, emergencia, telefono, idPersona from familia where $campo = $valor";
                //echo $cadenaSQL.'<p>';
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->nombre = $campo['nombre'];
            $this->fechaNacimiento = $campo['fechaNacimiento'];
            $this->ocupacion = $campo['ocupacion'];
            $this->parentesco = $campo['parentesco'];
            $this->emergencia = $campo['emergencia'];
            $this->telefono = $campo['telefono'];
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

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    public function getParentesco()
    {
        return $this->parentesco;
    }

    public function getEmergencia()
    {
        return $this->emergencia;
    }

    public function getTelefono()
    {
        return $this->telefono;
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

    public function setFechaNacimiento($fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setOcupacion($ocupacion): void
    {
        $this->ocupacion = $ocupacion;
    }

    public function setParentesco($parentesco): void
    {
        $this->parentesco = $parentesco;
    }

    public function setEmergencia($emergencia): void
    {
        $this->emergencia = $emergencia;
    }

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into familia(nombre, fechaNacimiento, ocupacion, parentesco, emergencia, telefono, idPersona) values('$this->nombre','$this->fechaNacimiento','$this->ocupacion', '$this->parentesco', '$this->emergencia', '$this->telefono', '$this->idPersona')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update familia set nombre='$this->nombre', fechaNacimiento='$this->fechaNacimiento', ocupacion='$this->ocupacion', parentesco='$this->parentesco', emergencia='$this->emergencia', telefono='$this->telefono', idPersona='$this->idPersona' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from familia where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, nombre, fechaNacimiento,	ocupacion,	parentesco,	emergencia,	telefono, idPersona FROM familia INNER JOIN persona on persona.identificacion = idPersona $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Familia::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $familia = new Familia($resultado[$i], null);
            $lista[$i] = $familia;
        }
        return $lista;
    }
}
