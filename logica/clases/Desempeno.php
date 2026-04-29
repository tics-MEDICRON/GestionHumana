<?php

class Desempeno
{
    private $id;
    private $logro;
    private $tipo;
    private $peso;
    private $evaluador;
    private $evidencia;
    private $calificacion;
    private $rango;
    private $idDesempeno;
    private $idEvaluacionDesempeno;


    public function __construct($campo, $valor)
    {
        if ($campo != null) {
            if (!is_array($campo)) {
                $cadenaSQL = "select id, logro, tipo, peso, evaluador, evidencia, calificacion, rango, idDesempeno, idEvaluacionDesempeno from desempeno where $campo= $valor";
                $campo = ConectorBD::ejecutaryQuery($cadenaSQL)[0];
            }
            $this->id = $campo['id'];
            $this->logro = $campo['logro'];
            $this->tipo = $campo['tipo'];
            $this->peso = $campo['peso'];
            $this->evaluador = $campo['evaluador'];
            $this->evidencia = $campo['evidencia'];
            $this->calificacion = $campo['calificacion'];
            $this->rango = $campo['rango'];
            $this->idDesempeno = $campo['idDesempeno'];
            $this->idEvaluacionDesempeno = isset($campo['idEvaluacionDesempeno']) ? $campo['idEvaluacionDesempeno'] : null;
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getLogro()
    {
        return $this->logro;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getPeso()
    {
        return $this->peso;
    }
    public function getEvaluador()
    {
        return $this->evaluador;
    }
    public function getEvidencia()
    {
        return $this->evidencia;
    }
    public function getCalificacion()
    {
        return $this->calificacion;
    }
    public function getRango()
    {
        return $this->rango;
    }
    public function getIdDesempeno()
    {
        return $this->idDesempeno;
    }
    public function getIdEvaluacionDesempeno()
    {
        return $this->idEvaluacionDesempeno;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    public function setLogro($logro): void
    {
        $this->logro = $logro;
    }
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }
    public function setPeso($peso): void
    {
        $this->peso = $peso;
    }
    public function setEvaluador($evaluador): void
    {
        $this->evaluador = $evaluador;
    }
    public function setEvidencia($evidencia): void
    {
        $this->evidencia = $evidencia;
    }
    public function setCalificacion($calificacion): void
    {
        $this->calificacion = $calificacion;
    }
    public function setRango($rango): void
    {
        $this->rango = $rango;
    }
    
    public function setIdDesempeno($idDesempeno): void
    {
        $this->idDesempeno = $idDesempeno;
    }
    public function setIdEvaluacionDesempeno($idEvaluacionDesempeno): void
    {
        $this->idEvaluacionDesempeno = $idEvaluacionDesempeno;
    }

    public function getPersona()
    {
        return new Persona('identificacion', $this->idDesempeno);
    }

    public function guardar()
    {
        $idEvaluacion = $this->idEvaluacionDesempeno == null || $this->idEvaluacionDesempeno == '' ? 'NULL' : "'$this->idEvaluacionDesempeno'";
        $cadenaSQL = "insert into desempeno(logro, tipo, peso, evaluador, evidencia, calificacion, rango, idDesempeno, idEvaluacionDesempeno) values ('$this->logro','$this->tipo','$this->peso','$this->evaluador','$this->evidencia', $this->calificacion, '$this->rango' , '$this->idDesempeno', $idEvaluacion)";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function modificar()
    {
        $idEvaluacion = $this->idEvaluacionDesempeno == null || $this->idEvaluacionDesempeno == '' ? 'NULL' : "'$this->idEvaluacionDesempeno'";
        $cadenaSQL = "update desempeno set logro='$this->logro',tipo='$this->tipo',peso='$this->peso',evaluador='$this->evaluador',evidencia='$this->evidencia',calificacion='$this->calificacion',rango='$this->rango', idDesempeno ='$this->idDesempeno', idEvaluacionDesempeno=$idEvaluacion where id='$this->id'";
        //echo $cadenaSQL;
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public function eliminar()
    {
        $cadenaSQL = "delete from desempeno where id='$this->id'";
        ConectorBD::ejecutaryQuery($cadenaSQL);
    }

    /*
    public function modificarEvaluador($id)
    {
        $cadenaSQL = "update desempeno set idPersonaJefe='$this->idPersonaJefe', idPersonaPar='$this->idPersonaPar' where idDesempeno='$id'";
        echo $cadenaSQL;
        //ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    */

    public static function getLista($filtro, $orden)
    {
        if ($filtro == null || $filtro == '') $filtro = '';
        else $filtro = "where $filtro";
        if ($orden == null || $orden == '') $orden = '';
        else $orden = "order by $orden";
        $cadenaSQL = "select desempeno.id, logro, desempeno.tipo, peso, evaluador, evidencia, calificacion, rango, idDesempeno, idEvaluacionDesempeno from desempeno INNER JOIN persona on persona.identificacion = idDesempeno $filtro $orden";
        return ConectorBD::ejecutaryQuery($cadenaSQL);
    }
    public static function getLIstaEnObjetos($filtro, $orden)
    {
        $resultado = Desempeno::getLista($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $desempeno = new Desempeno($resultado[$i], null);
            $lista[$i] = $desempeno;
        }
        return $lista;
    }
}
