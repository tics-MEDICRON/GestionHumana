<?php

class Laboral
{
    private $id;
    private $empresa;
    private $telefono;
    private $cargo;
    private $desde;
    private $hasta;
    private $motivoRetiro;
    private $archivo;
    private $idPersona;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, empresa, telefono, cargo, desde, hasta, motivoRetiro, archivo, idPersona from laboral where $campo=$valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->empresa = $campo['empresa'];
            $this->telefono = $campo['telefono'];
            $this->cargo = $campo['cargo'];
            $this->desde = $campo['desde'];
            $this->hasta = $campo['hasta'];
            $this->motivoRetiro = $campo['motivoRetiro'];
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

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function getDesde()
    {
        return $this->desde;
    }

    public function getHasta()
    {
        return $this->hasta;
    }

    public function getMotivoRetiro()
    {
        return $this->motivoRetiro;
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

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setCargo($cargo): void
    {
        $this->cargo = $cargo;
    }

    public function setDesde($desde): void
    {
        $this->desde = $desde;
    }

    public function setHasta($hasta): void
    {
        $this->hasta = $hasta;
    }

    public function setMotivoRetiro($motivoRetiro): void
    {
        $this->motivoRetiro = $motivoRetiro;
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
        $cadenaSQL = "insert into laboral(empresa, telefono, cargo, desde, hasta, motivoRetiro, archivo, idPersona) values('$this->empresa', '$this->telefono', '$this->cargo', '$this->desde', '$this->hasta', '$this->motivoRetiro', '$this->archivo','$this->idPersona')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update laboral set empresa='$this->empresa', telefono='$this->telefono', cargo='$this->cargo', desde='$this->desde', hasta='$this->hasta', motivoRetiro='$this->motivoRetiro', archivo='$this->archivo', idPersona='$this->idPersona' where id='$this->id'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from laboral where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, empresa, telefono, cargo, desde, hasta, motivoRetiro, archivo, idPersona from laboral $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Laboral::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $laboral = new Laboral($resultado[$i], null);
            $lista[$i] = $laboral;
        }
        return $lista;
    }
}
