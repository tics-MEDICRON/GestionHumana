<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
if ($USUARIO->getTipoEnObjeto() != 'Administrador') {
    header('location: principal.php?CONTENIDO=presentacion/inicio.php');
    exit;
}

$competencia = new Competencia(null, null);
switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $competencia->setDescripcion($_REQUEST['descripcion']);
        $competencia->setCriterio($_REQUEST['criterio']);
        $competencia->guardar();
        break;
    case 'Modificar':
        $competencia->setId($_REQUEST['id']);
        $competencia->setDescripcion($_REQUEST['descripcion']);
        $competencia->setCriterio($_REQUEST['criterio']);
        $competencia->modificar();
        break;
    case 'Eliminar':
        $competencia->setId($_REQUEST['id']);
        $competencia->eliminar();
        break;
}

header('location: principal.php?CONTENIDO=presentacion/evaluacion/competencias.php');
