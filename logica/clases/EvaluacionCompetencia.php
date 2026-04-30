<?php

class EvaluacionCompetencia
{
    private $id;
    private $idCompetencia;
    private $idConducta;
    private $tipoLogro;
    private $adecuacion;
    
    private $evaluador2;
    private $evaluadorCal2;
    
    private $evaluadorCal3;
    private $autoEvaluador;
    private $evaluador3;
    private $promedio;
    private $rango2;
    private $idPersona;
    private $idEvaluacionDesempeno;



    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, tipoLogro, adecuacion, evaluador2, evaluadorCal2, evaluador3, evaluadorCal3, autoEvaluador, promedio, rango2, idPersona, idConducta,idCompetencia, idEvaluacionDesempeno from evaluacioncompetencia where $campo= $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->tipoLogro = $campo['tipoLogro'];
            $this->adecuacion = $campo['adecuacion'];
            $this->evaluador2 = $campo['evaluador2'];
            $this->evaluadorCal2 = $campo['evaluadorCal2'];
            $this->evaluador3 = $campo['evaluador3'];
            $this->evaluadorCal3 = $campo['evaluadorCal3'];
            $this->autoEvaluador = $campo['autoEvaluador'];
            $this->promedio = $campo['promedio'];
            $this->rango2 = $campo['rango2'];
            $this->idPersona = $campo['idPersona'];
            $this->idConducta = $campo['idConducta'];
            $this->idCompetencia = $campo['idCompetencia'];
            $this->idEvaluacionDesempeno = isset($campo['idEvaluacionDesempeno']) ? $campo['idEvaluacionDesempeno'] : null;
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTipoLogro()
    {
        return $this->tipoLogro;
    }
    public function getAdecuacion()
    {
        return $this->adecuacion;
    }
    public function getEvaluador2()
    {
        return $this->evaluador2;
    }
    public function getEvaluadorCal2()
    {
        return $this->evaluadorCal2;
    }
    public function getEvaluador3()
    {
        return $this->evaluador3;
    }
    public function getEvaluadorCal3()
    {
        return $this->evaluadorCal3;
    }
    public function getAutoEvaluador()
    {
        return $this->autoEvaluador;
    }
    public function getPromedio()
    {
        return $this->promedio;
    }
    public function getRango2()
    {
        return $this->rango2;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function getIdConducta()
    {
        return $this->idConducta;
    }
    public function getIdCompetencia()
    {
        return $this->idCompetencia;
    }
    public function getIdEvaluacionDesempeno()
    {
        return $this->idEvaluacionDesempeno;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setTipoLogro($tipoLogro): void
    {
        $this->tipoLogro = $tipoLogro;
    }
    public function setAdecuacion($adecuacion): void
    {
        $this->adecuacion = $adecuacion;
    }
    public function setevaluador2($evaluador2): void
    {
        $this->evaluador2 = $evaluador2;
    }
    public function setevaluadorCal2($evaluadorCal2): void
    {
        $this->evaluadorCal2 = $evaluadorCal2;
    }
    public function setEvaluador3($evaluador3): void
    {
        $this->evaluador3 = $evaluador3;
    }
    public function setEvaluadorCal3($evaluadorCal3): void
    {
        $this->evaluadorCal3 = $evaluadorCal3;
    }
    public function setAutoEvaluador($autoEvaluador): void
    {
        $this->autoEvaluador = $autoEvaluador;
    }
    public function setPromedio($promedio): void
    {
        $this->promedio = $promedio;
    }
    public function setRango2($rango2): void
    {
        $this->rango2 = $rango2;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }
    public function setIdConducta($idConducta): void
    {
        $this->idConducta = $idConducta;
    }
    public function setIdCompetencia($idCompetencia): void
    {
        $this->idCompetencia = $idCompetencia;
    }
    public function setIdEvaluacionDesempeno($idEvaluacionDesempeno): void
    {
        $this->idEvaluacionDesempeno = $idEvaluacionDesempeno;
    }

    public function getPersona()
    {
        return new Persona('identificacion', $this->idPersona);
    }

    public function guardar()
    {
        $idEvaluacion = $this->idEvaluacionDesempeno == null || $this->idEvaluacionDesempeno == '' ? 'NULL' : "'$this->idEvaluacionDesempeno'";
        $cadenaSQL = "insert into evaluacioncompetencia(tipoLogro, adecuacion, evaluador2,evaluadorCal2, evaluador3,evaluadorCal3,autoEvaluador, promedio, rango2, idPersona, idConducta,idCompetencia, idEvaluacionDesempeno) values ('$this->tipoLogro','$this->adecuacion','$this->evaluador2','$this->evaluadorCal2','$this->evaluador3','$this->evaluadorCal3','$this->autoEvaluador','$this->promedio','$this->rango2','$this->idPersona','$this->idConducta','$this->idCompetencia', $idEvaluacion)";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $idEvaluacion = $this->idEvaluacionDesempeno == null || $this->idEvaluacionDesempeno == '' ? 'NULL' : "'$this->idEvaluacionDesempeno'";
        $cadenaSQL = "update evaluacioncompetencia set tipoLogro='$this->tipoLogro',adecuacion='$this->adecuacion',evaluador2='$this->evaluador2',evaluadorCal2='$this->evaluadorCal2',evaluador3='$this->evaluador3',evaluadorCal3='$this->evaluadorCal3',autoEvaluador='$this->autoEvaluador',promedio='$this->promedio',rango2='$this->rango2', idPersona='$this->idPersona',idconducta='$this->idConducta',idCompetencia='$this->idCompetencia', idEvaluacionDesempeno=$idEvaluacion where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from evaluacioncompetencia where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select evaluacioncompetencia.id, competencia.descripcion as idCompetencia, idConducta, tipoLogro, adecuacion, evaluador2, evaluadorCal2, evaluador3,evaluadorCal3,autoEvaluador, promedio, rango2, idPersona, idEvaluacionDesempeno from evaluacioncompetencia INNER JOIN competencia on evaluacioncompetencia.idCompetencia = competencia.id $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = EvaluacionCompetencia::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $desempeno = new EvaluacionCompetencia($resultado[$i], null);
            $lista[$i] = $desempeno;
        }
        return $lista;
    }
}
