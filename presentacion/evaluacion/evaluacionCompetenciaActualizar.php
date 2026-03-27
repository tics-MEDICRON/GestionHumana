<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$cal2 = 0;
$mensaje = '';
$academica = new EvaluacionCompetencia(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setIdCompetencia($_REQUEST['idCompetencia']);
                $academica->setIdConducta($_REQUEST['idConducta']);
                $academica->setTipoLogro($_REQUEST['tipoLogro']);
                $academica->setAdecuacion($_REQUEST['adecuacion']);
                $academica->setevaluador2($_REQUEST['evaluador2']);
                $academica->setEvaluadorCal2($_REQUEST['evaluadorCal2']);
                $academica->setEvaluador3($_REQUEST['evaluador3']);
                $academica->setEvaluadorCal3($_REQUEST['evaluadorCal3']);
                $academica->setAutoEvaluador($_REQUEST['autoEvaluador']);

                $cal2 += intVal(($academica->getEvaluadorCal2() * 0.6) + ($academica->getEvaluadorCal3() * 0.3) + ($academica->getAutoEvaluador() * 0.1));
                $dataAdecuacion = ($cal2 * $_REQUEST['adecuacion']) / 100;
                $academica->setPromedio($dataAdecuacion);


                if ($dataAdecuacion  <= 79) {
                        $mensaje = 'NO CUMPLE';
                } elseif ($dataAdecuacion <= 99) {
                        $mensaje = 'CUMPLE';
                } else {
                        $mensaje = 'SOBRESALIENTE';
                }

                $academica->setRango2($mensaje);
                $academica->setIdPersona($_REQUEST['idDesempeno']);
                $academica->guardar();
                break;

        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setIdCompetencia($_REQUEST['idCompetencia']);
                $academica->setIdConducta($_REQUEST['idConducta']);
                $academica->setTipoLogro($_REQUEST['tipoLogro']);
                $academica->setAdecuacion($_REQUEST['adecuacion']);
                $academica->setevaluador2($_REQUEST['evaluador2']);
                $academica->setEvaluadorCal2($_REQUEST['evaluadorCal2']);
                $academica->setEvaluador3($_REQUEST['evaluador3']);
                $academica->setEvaluadorCal3($_REQUEST['evaluadorCal3']);
                $academica->setAutoEvaluador($_REQUEST['autoEvaluador']);

                $cal2 += intVal(($academica->getEvaluadorCal2() * 0.6) + ($academica->getEvaluadorCal3() * 0.3) + ($academica->getAutoEvaluador() * 0.1));
                $dataAdecuacion = ($cal2 * $_REQUEST['adecuacion']) / 100;
                $academica->setPromedio($dataAdecuacion);


                if ($dataAdecuacion  <= 79) {
                        $mensaje = 'NO CUMPLE';
                } elseif ($dataAdecuacion <= 99) {
                        $mensaje = 'CUMPLE';
                } else {
                        $mensaje = 'SOBRESALIENTE';
                }

                $academica->setRango2($mensaje);
                $academica->setIdPersona($_REQUEST['idDesempeno']);
                $academica->modificar();
                break;
        case 'Eliminar':
                $academica->setId($_REQUEST['id']);
                $academica->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/evaluacion/evaluacionDesempeno.php&idDesempeno=' . $_REQUEST['idDesempeno']);
