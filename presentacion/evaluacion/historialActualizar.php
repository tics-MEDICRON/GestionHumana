<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$mensaje = '';
$academica = new HistorialEvaluacion(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setFecha($_REQUEST['fecha']);

                /*$nombreArchivo = $_REQUEST['id'] . '_' . $_REQUEST['fecha'];*/
                $nombreArchivo = $_REQUEST['id'] . '_' . $_REQUEST['fecha'];
                $ruta = 'presentacion/evaluacion';
                move_uploaded_file($_FILES['evaluacionPdf']['tmp_name'], "$ruta/documentos/$nombreArchivo.pdf");
                $academica->setEvaluacionPdf($nombreArchivo . '.pdf');
                $academica->setIdPersona($_REQUEST['idPersona']);
                $academica->guardar();
                break;


        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setFecha($_REQUEST['fecha']);

                $nombreArchivo = $_REQUEST['id'] . '_' . $_REQUEST['fecha'];
                $ruta = 'presentacion/evaluacion';
                move_uploaded_file($_FILES['evaluacionPdf']['tmp_name'], "$ruta/documentos/$nombreArchivo.pdf");
                $academica->setEvaluacionPdf($nombreArchivo . '.pdf');
                $academica->setIdPersona($_REQUEST['idPersona']);
                $academica->modificar();
                break;

        case 'Eliminar':
                $academica->setId($_REQUEST['id']);
                $academica->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php');
