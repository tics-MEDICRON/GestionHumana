<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$mensaje = '';
$academica = new HistorialSarlaft(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setFecha($_REQUEST['fecha']);
                $academica->setIdPersona($_REQUEST['idPersona']);
                $nombreArchivo = $_REQUEST['idPersona'] . '_' . $_REQUEST['fecha'];
                $ruta = 'presentacion/historial';
                move_uploaded_file($_FILES['evaluacionPdf']['tmp_name'], "$ruta/documentos/$nombreArchivo.pdf");

                $academica->setEvaluacionPdf($nombreArchivo . '.pdf');
                $academica->guardar();
                break;



        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setFecha($_REQUEST['fecha']);
                $academica->setIdPersona($_REQUEST['idPersona']);
                $nombreArchivo = $_REQUEST['idPersona'] . '_' . $_REQUEST['fecha'];
                $ruta = 'presentacion/historial';
                move_uploaded_file($_FILES['evaluacionPdf']['tmp_name'], "$ruta/documentos/$nombreArchivo.pdf");

                $academica->setEvaluacionPdf($nombreArchivo . '.pdf');
                $academica->modificar();
                break;

        case 'Eliminar':
                $academica->setId($_REQUEST['id']);
                $academica->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/historial/historialSarlaft.php');
