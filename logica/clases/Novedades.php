<?php
class Novedades
{
    private $id;
    private $fecha;
    private $evaluacionPdf;
    private $idPersona;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, fecha, evaluacionPdf, idPersona from novedades where $campo=$valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->fecha = $campo['fecha'];
            $this->evaluacionPdf = $campo['evaluacionPdf'];
            $this->idPersona = $campo['idPersona'];
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getEvaluacionPdf()
    {
        return $this->evaluacionPdf;
    }
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }
    public function setEvaluacionPdf($evaluacionPdf): void
    {
        $this->evaluacionPdf = $evaluacionPdf;
    }
    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function getPersona()
    {
        return new Persona('identificacion', $this->idPersona);
    }

    public function guardar()
    {
        $cadenaSQL = "insert into novedades ( fecha, evaluacionPdf, idPersona) values ('{$this->fecha}', '{$this->evaluacionPdf}', '{$this->idPersona}')";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $cadenaSQL = "update novedades set  fecha='$this->fecha', evaluacionPdf='$this->evaluacionPdf', idPersona='$this->idPersona' where id='$this->id'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from novedades where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, fecha, evaluacionPdf, CONCAT(persona.nombres, ' ' ,persona.apellidos) as idPersona from novedades INNER JOIN persona on novedades.idPersona = persona.identificacion $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Novedades::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $academica = new Novedades($resultado[$i], null);
            $lista[$i] = $academica;
        }
        return $lista;
    }
}
