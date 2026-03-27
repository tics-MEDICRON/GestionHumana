<?php

class ReferenciaLaboral
{

    private $id;
    private $empresa;
    private $nombre;
    private $cargo;
    private $telefono;
    private $archivo;
    private $idPersona;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, empresa, nombre, cargo, telefono, archivo, idPersona from referencialaboral where $campo=$valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->empresa = $campo['empresa'];
            $this->nombre = $campo['nombre'];
            $this->cargo = $campo['cargo'];
            $this->telefono = $campo['telefono'];
            $this->archivo = $campo['archivo'];
            $this->idPersona = $campo['idPersona'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCargo()
    {
        return $this->cargo;
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

    public function setEmpresa($empresa): void
    {
        $this->empresa = $empresa;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setCargo($cargo): void
    {
        $this->cargo = $cargo;
    }

    public function setTelefono($telefono): void
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
        $cadenaSQL = "insert into referencialaboral(empresa, nombre, cargo, telefono, archivo, idPersona) values('$this->empresa', '$this->nombre', '$this->cargo', '$this->telefono', '$this->archivo', '$this->idPersona')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update referencialaboral set empresa='$this->empresa', nombre='$this->nombre', cargo='$this->cargo', telefono='$this->telefono', archivo='$this->archivo', idPersona='$this->idPersona' where id='{$this->id}'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from referencialaboral where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, empresa, nombre, cargo, telefono, archivo, idPersona from referencialaboral $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = ReferenciaLaboral::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $referenciaLaboral = new ReferenciaLaboral($resultado[$i], null);
            $lista[$i] = $referenciaLaboral;
        }
        return $lista;
    }
}
