<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$mensaje = '';
$academica = new Desempeno(null, null);
$ruta = 'presentacion/evaluacion';

function guardarEvidenciaDesempeno($archivo, $idDesempeno, $logro, $calificacion)
{
        global $ruta;

        if (!isset($archivo['tmp_name']) || $archivo['error'] !== UPLOAD_ERR_OK) return '';

        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        if ($extension == '') $extension = 'pdf';

        $nombreArchivo = $idDesempeno . '_' . $logro . '_' . $calificacion;
        $nombreArchivo = preg_replace('/[^A-Za-z0-9._-]/', '', str_replace(' ', '', $nombreArchivo));
        $nombreArchivo .= '_' . uniqid() . '.' . $extension;

        if (!is_dir("$ruta/documentos")) mkdir("$ruta/documentos", 0777, true);
        if (!move_uploaded_file($archivo['tmp_name'], "$ruta/documentos/$nombreArchivo")) return '';

        return $nombreArchivo;
}

switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setLogro($_REQUEST['logro']);
                $academica->setTipo($_REQUEST['tipo']);
                $academica->setPeso($_REQUEST['peso']);
                $academica->setEvaluador($_REQUEST['evaluador']);
                $academica->setCalificacion($_REQUEST['calificacion']);
                $academica->setIdDesempeno($_REQUEST['idDesempeno']);
                if (isset($_REQUEST['idEvaluacionDesempeno'])) $academica->setIdEvaluacionDesempeno($_REQUEST['idEvaluacionDesempeno']);

                if ($_REQUEST['calificacion']  <= 79) {
                        $mensaje = 'NO CUMPLE';
                } elseif ($_REQUEST['calificacion'] >= 80 && $_REQUEST['calificacion'] <= 99) {
                        $mensaje = 'CUMPLE';
                } else {
                        $mensaje = 'SOBRESALIENTE';
                }
                $academica->setRango($mensaje);

                $academica->setEvidencia(guardarEvidenciaDesempeno($_FILES['evidencia'], $_REQUEST['idDesempeno'], $_REQUEST['logro'], $_REQUEST['calificacion']));
                $academica->guardar();
                break;



        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setLogro($_REQUEST['logro']);
                $academica->setTipo($_REQUEST['tipo']);
                $academica->setPeso($_REQUEST['peso']);
                $academica->setEvaluador($_REQUEST['evaluador']);
                $academica->setCalificacion($_REQUEST['calificacion']);
                $academica->setIdDesempeno($_REQUEST['idDesempeno']);
                if (isset($_REQUEST['idEvaluacionDesempeno'])) $academica->setIdEvaluacionDesempeno($_REQUEST['idEvaluacionDesempeno']);

                if ($_REQUEST['calificacion']  <= 79) {
                        $mensaje = 'NO CUMPLE';
                } elseif ($_REQUEST['calificacion'] >= 80 && $_REQUEST['calificacion'] <= 99) {
                        $mensaje = 'CUMPLE';
                } else {
                        $mensaje = 'SOBRESALIENTE';
                }
                $academica->setRango($mensaje);

                $actual = new Desempeno('id', $_REQUEST['id']);
                $nombreArchivo = $actual->getEvidencia();
                $nuevoArchivo = guardarEvidenciaDesempeno($_FILES['evidencia'], $_REQUEST['idDesempeno'], $_REQUEST['logro'], $_REQUEST['calificacion']);
                if ($nuevoArchivo != '') $nombreArchivo = $nuevoArchivo;

                $academica->setEvidencia($nombreArchivo);
                $academica->modificar();
                break;

        case 'Eliminar':
                $academica->setId($_REQUEST['id']);
                $academica->eliminar();
                break;
}

$periodo = isset($_REQUEST['idEvaluacionDesempeno']) && $_REQUEST['idEvaluacionDesempeno'] != '' ? '&idEvaluacionDesempeno=' . $_REQUEST['idEvaluacionDesempeno'] : '';
header('location: principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno=' . $_REQUEST['idDesempeno'] . $periodo);
