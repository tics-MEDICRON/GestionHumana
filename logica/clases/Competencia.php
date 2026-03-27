<?php

class Competencia
{
    private $id;
    private $descripcion;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, descripcion from competencia where $campo = $valor";
                ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->descripcion['descripcion'];
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function guardar()
    {
        $cadenaSQL = "insert into competencia(descripcion) values('$this->descripcion')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $cadenaSQL = "update competencia set descripcion='$this->descripcion'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from competencia where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, descripcion  from competencia $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Competencia::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $competencia = new Competencia($resultado[$i], null);
            $lista[$i] = $competencia;
        }
        return $lista;
    }
}
