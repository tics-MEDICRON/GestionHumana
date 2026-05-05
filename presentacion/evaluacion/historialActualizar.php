<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$mensaje = '';
$academica = new HistorialEvaluacion(null, null);
$ruta = 'presentacion/evaluacion';

function guardarEvaluacionPdf($archivo, $idPersona, $fecha)
{
        global $ruta;

        if (!isset($archivo['tmp_name']) || $archivo['error'] !== UPLOAD_ERR_OK) return null;

        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        if ($extension == '') $extension = 'pdf';

        $idPersonaSeguro = preg_replace('/[^A-Za-z0-9_-]/', '', $idPersona);
        $nombreArchivo = $idPersonaSeguro . '_' . $fecha . '_' . uniqid() . '.' . $extension;
        move_uploaded_file($archivo['tmp_name'], "$ruta/documentos/$nombreArchivo");
        return $nombreArchivo;
}

function eliminarArchivoEvaluacion($nombreArchivo)
{
        global $ruta;

        if ($nombreArchivo != '') {
                $archivo = "$ruta/documentos/$nombreArchivo";
                if (file_exists($archivo)) unlink($archivo);
        }
}

switch ($_REQUEST['accion']) {
        case 'Adicionar':
                if (isset($_FILES['evaluacionPdf']['name']) && is_array($_FILES['evaluacionPdf']['name'])) {
                        for ($i = 0; $i < count($_FILES['evaluacionPdf']['name']); $i++) {
                                $archivo = array(
                                        'name' => $_FILES['evaluacionPdf']['name'][$i],
                                        'type' => $_FILES['evaluacionPdf']['type'][$i],
                                        'tmp_name' => $_FILES['evaluacionPdf']['tmp_name'][$i],
                                        'error' => $_FILES['evaluacionPdf']['error'][$i],
                                        'size' => $_FILES['evaluacionPdf']['size'][$i]
                                );
                                $nombreArchivo = guardarEvaluacionPdf($archivo, $_REQUEST['idPersona'], $_REQUEST['fecha']);
                                if ($nombreArchivo != null) {
                                        $academica = new HistorialEvaluacion(null, null);
                                        $academica->setFecha($_REQUEST['fecha']);
                                        $academica->setEvaluacionPdf($nombreArchivo);
                                        $academica->setIdPersona($_REQUEST['idPersona']);
                                        $academica->guardar();
                                }
                        }
                }
                break;


        case 'Modificar':
                $actual = new HistorialEvaluacion('id', $_REQUEST['id']);
                $academica->setFecha($_REQUEST['fecha']);
                $academica->setId($_REQUEST['id']);
                $academica->setIdPersona($_REQUEST['idPersona']);

                $nombreArchivo = $actual->getEvaluacionPdf();
                if (isset($_FILES['evaluacionPdf']) && $_FILES['evaluacionPdf']['error'] === UPLOAD_ERR_OK) {
                        $nuevoArchivo = guardarEvaluacionPdf($_FILES['evaluacionPdf'], $_REQUEST['idPersona'], $_REQUEST['fecha']);
                        if ($nuevoArchivo != null) {
                                eliminarArchivoEvaluacion($nombreArchivo);
                                $nombreArchivo = $nuevoArchivo;
                        }
                }
                $academica->setEvaluacionPdf($nombreArchivo);
                $academica->modificar();
                break;

        case 'Eliminar':
                $academica = new HistorialEvaluacion('id', $_REQUEST['id']);
                $idPersona = $academica->getIdPersona();
                eliminarArchivoEvaluacion($academica->getEvaluacionPdf());
                $academica->eliminar();
                header("location: principal.php?CONTENIDO=presentacion/evaluacion/historialArchivos.php&idPersona=$idPersona");
                exit;
                break;
}

$idPersona = isset($_REQUEST['idPersona']) ? $_REQUEST['idPersona'] : '';
if ($idPersona != '') header("location: principal.php?CONTENIDO=presentacion/evaluacion/historialArchivos.php&idPersona=$idPersona");
else header('location: principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php');
