<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$evaluacion = new EvaluacionDesempeno(null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $evaluacion->setIdPersona($_REQUEST['idDesempeno']);
        $evaluacion->setFechaInicio($_REQUEST['fechaInicio']);
        $evaluacion->setFechaFin($_REQUEST['fechaFin']);
        $evaluacion->setEstado($_REQUEST['estado']);
        $evaluacion->guardar();
        break;
    case 'Modificar':
        $evaluacion->setId($_REQUEST['id']);
        $evaluacion->setIdPersona($_REQUEST['idDesempeno']);
        $evaluacion->setFechaInicio($_REQUEST['fechaInicio']);
        $evaluacion->setFechaFin($_REQUEST['fechaFin']);
        $evaluacion->setEstado($_REQUEST['estado']);
        $evaluacion->modificar();
        break;
    case 'Eliminar':
        ConectorBD::ejecutaryQuery("delete from desempeno where idEvaluacionDesempeno='{$_REQUEST['id']}'");
        ConectorBD::ejecutaryQuery("delete from evaluacioncompetencia where idEvaluacionDesempeno='{$_REQUEST['id']}'");
        $evaluacion->setId($_REQUEST['id']);
        $evaluacion->eliminar();
        break;
}

header('location: principal.php?CONTENIDO=presentacion/evaluacion/evaluacionesPeriodo.php&idDesempeno=' . $_REQUEST['idDesempeno']);
