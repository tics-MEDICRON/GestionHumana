<?php

class ContactoEmergencia{

    private $id;
    private $nombre;
    private $ocupacion;
    private $parentesco;
    private $telefonoEmergencia;
    private $idPersona;


    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select * from contactoemergencia where $campo = $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->nombre = $campo['nombre'];
            $this->ocupacion = $campo['ocupacion'];
            $this->parentesco = $campo['parentesco'];
            $this->telefonoEmergencia = $campo['telefono'];
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

    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    public function getParentesco()
    {
        return $this->parentesco;
    }


    public function getTelefonoEmergencia()
    {
        return $this->telefonoEmergencia;
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

    public function setOcupacion($ocupacion): void
    {
        $this->ocupacion = $ocupacion;
    }

    public function setParentesco($parentesco): void
    {
        $this->parentesco = $parentesco;
    }


    public function setTelefonoEmergencia($telefonoEmergencia): void
    {
        $this->telefonoEmergencia = $telefonoEmergencia;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into contactoemergencia(nombre, ocupacion,parentesco, telefono, idPersona) values('$this->nombre','$this->ocupacion', '$this->parentesco','$this->telefonoEmergencia', '$this->idPersona')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function modificar()
    {
        $cadenaSQL = "update contactoemergencia set nombre='$this->nombre', ocupacion='$this->ocupacion', parentesco='$this->parentesco', telefono='$this->telefonoEmergencia', idPersona='$this->idPersona' where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public function eliminar()
    {
        $cadenaSQL = "delete from contactoemergencia where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, nombre, ocupacion,	parentesco,	telefono, idPersona FROM contactoemergencia INNER JOIN persona on persona.identificacion = idPersona $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = ContactoEmergencia::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $ContactoEmergencia = new ContactoEmergencia($resultado[$i], null);
            $lista[$i] = $ContactoEmergencia;
        }
        return $lista;
    }


}


?>