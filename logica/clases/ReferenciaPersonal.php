<?php

class ReferenciaPersonal
{
    private $id;
    private $nombre;
    private $parentesco;
    private $ocupacion;
    private $telefono;
    private $archivo;
    private $idPersona;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, nombre, parentesco, ocupacion, telefono, archivo, idPersona from referenciapersonal where $campo = $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->nombre = $campo['nombre'];
            $this->parentesco = $campo['parentesco'];
            $this->ocupacion = $campo['ocupacion'];
            $this->telefono = $campo['telefono'];
            $this->archivo = $campo['archivo'];
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

    public function getParentesco()
    {
        return $this->parentesco;
    }

    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getArchivo()
    {
        return $this->archivo;
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

    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;
    }

    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setArchivo($archivo): void
    {
        $this->archivo = $archivo;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into referenciapersonal(nombre, parentesco, ocupacion, telefono, archivo, idPersona) values('$this->nombre', '$this->parentesco', '$this->ocupacion', '$this->telefono', '$this->archivo', '$this->idPersona')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update referenciapersonal set nombre='$this->nombre', parentesco='$this->parentesco', ocupacion='$this->ocupacion', telefono='$this->telefono', archivo='$this->archivo', idPersona='$this->idPersona' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from referenciapersonal where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getlista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, nombre, parentesco, ocupacion, telefono, archivo, idPersona from referenciapersonal $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = ReferenciaPersonal::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $referenciaPersonal = new ReferenciaPersonal($resultado[$i], null);
            $lista[$i] = $referenciaPersonal;
        }
        return $lista;
    }
}
