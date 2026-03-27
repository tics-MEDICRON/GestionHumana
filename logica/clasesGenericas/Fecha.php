<?php

class Fecha {
    public static function calcularDiferenciaFechasEnSegundos($fecha1, $fecha2){
        $inicio=strtotime($fecha1); // STRTOTIME Devuelve el numero de segundos que a pasado desde el 1 de enero de 1970 hasta la fecha indicada.
        $fin=strtotime($fecha2);
        $diferencia=$fin-$inicio;
        return $diferencia;
    }
    public static function calcularDiferenciaFechasEnDias($fecha1, $fecha2){
        //DEVUELVVE LA RESTA ENTRE LA FECHA 2 Y LA FECHA 1, LA DEVOLUCION LA HACE EN SEGUNDOS
        $fechaInicio=new DateTime($fecha1);
        $fechaFin=new DateTime($fecha2);
        $diferencia=$fechaFin->diff($fechaInicio);
        return $diferencia->days;
    }
}
