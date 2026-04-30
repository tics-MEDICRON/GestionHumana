<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$mensaje = '';
$academica = new Desempeno(null, null);
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

                $nombreArchivo = $_REQUEST['idDesempeno'] . '_' . $_REQUEST['logro']. '_' . $_REQUEST['calificacion'];
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/evaluacion';
                move_uploaded_file($_FILES['evidencia']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                $academica->setEvidencia($cadena . '.pdf');
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

                $nombreArchivo = $_REQUEST['idDesempeno'] . '_' . $_REQUEST['tipo'];
                $ruta = 'presentacion/evaluacion';
                move_uploaded_file($_FILES['evidencia']['tmp_name'], "$ruta/documentos/$nombreArchivo.pdf");

                $academica->setEvidencia($nombreArchivo . '.pdf');
                $academica->modificar();
                break;

        case 'Eliminar':
                $academica->setId($_REQUEST['id']);
                $academica->eliminar();
                break;
}

$periodo = isset($_REQUEST['idEvaluacionDesempeno']) && $_REQUEST['idEvaluacionDesempeno'] != '' ? '&idEvaluacionDesempeno=' . $_REQUEST['idEvaluacionDesempeno'] : '';
header('location: principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno=' . $_REQUEST['idDesempeno'] . $periodo);
