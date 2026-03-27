<?php

class Conducta
{
    private $id;
    private $descripcion;

    private $idCompetencia;
    private $descripcionCompetencia;

    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, descripcion from conducta where $campo = $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
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

    public function getIdCompetencia()
    {
        return $this->idCompetencia;
    }

    public function getDescripcionCompetencia()
    {
        return $this->descripcionCompetencia;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function setIdCompetencia($idCompetencia): void
    {
        $this->idCompetencia = $idCompetencia;
    }
    public function setDescripcionCompetencia($descripcionCompetencia): void
    {
        $this->descripcionCompetencia = $descripcionCompetencia;
    }

    public function guardar()
    {
        $cadenaSQL = "insert into conducta(descripcion) values('$this->descripcion')";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $cadenaSQL = "update conducta set descripcion='$this->descripcion'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from conducta where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }





    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select id, descripcion  from conducta $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Conducta::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $conducta = new Conducta($resultado[$i], null);
            $lista[$i] = $conducta;
        }
        return $lista;
    }



    public static function getListaCompetencia($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select
        conducta.id, conducta.descripcion,
        competencia.id as idCompetencia, competencia.descripcion as descripcionCompetencia
        from conducta
        left join competencia on competencia.id = conducta.idCompetencia $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetosCompetencia($filtro, $orden)
    {
        $resultado = Conducta::getListaCompetencia($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $conducta = new Conducta(null, null);

            $conducta->setId($resultado[$i]['id']);
            $conducta->setDescripcion($resultado[$i]['descripcion']);
            $conducta->setIdCompetencia($resultado[$i]['idCompetencia']);
            $conducta->setDescripcionCompetencia($resultado[$i]['descripcionCompetencia']);
            $lista[$i] = $conducta;
        }
        return $lista;
    }
}
