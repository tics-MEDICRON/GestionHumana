<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new Persona('identificacion', $_REQUEST['idDesempeno']);


$lista = '';
$lista2 = '';
$cal = 0;
$canPeso = 0;
$canAdecuacion = 0;
$mensaje = '';
$mensaje2 = '';
$mensaje3 = '';
$div = 0;
$div2 = 0;
$resultDesempeno = "";
$resultFinal = "";


$resultado = Desempeno::getListaEnObjetos("idDesempeno={$persona->getIdentificacion()}", null);

for ($i = 0; $i < count($resultado); $i++) {
    $desempeno = $resultado[$i];

    $lista .= '<tr>';
    $lista .= "<td>{$desempeno->getLogro()}</td>";
    $lista .= "<td>{$desempeno->getTipo()}</td>";
    $lista .= "<td>{$desempeno->getPeso()}%</td>";
    $lista .= "<td>{$desempeno->getEvaluador()}</td>";
    $lista .= "<td><a href='presentacion/evaluacion/documentos/{$desempeno->getEvidencia()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a></td>";
    $lista .= "<td>{$desempeno->getCalificacion()}%</td>";

    $cal += intVal($desempeno->getCalificacion() * $desempeno->getPeso());


    $div = $cal / 100;
    $resultDesempeno = $div;
    $resultFinal = ($div * 60) / 100;

    /*  */

    if ($div  <= 79) {
        $mensaje = 'NO CUMPLE';
    } elseif ($div  >= 80 && $div  <= 99) {
        $mensaje = 'CUMPLE';
    } else {
        $mensaje = 'SOBRESALIENTE';
    }

    $canPeso += intVal($desempeno->getPeso());

    //$lista .= "<td>{$desempeno->getRango()}</td>";
    $lista .= '<td>';
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionFormulario.php&accion=Modificar&id={$desempeno->getId()}'><img src='presentacion/img/modificar.png'></a>";
    $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$desempeno->getId()})'>";
    $lista .= '</td>';
    $lista .= '</tr>';
}

$cal2 = 0;

$resultado = EvaluacionCompetencia::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", 'id');
for ($i = 0; $i < count($resultado); $i++) {
    $evaluacion = $resultado[$i];
    $lista2 .= '<tr>';
    $lista2 .= "<td>{$evaluacion->getIdCompetencia()}</td>";
    $lista2 .= "<td>{$evaluacion->getIdConducta()}</td>";
    $lista2 .= "<td>{$evaluacion->getTipoLogro()}</td>";
    $lista2 .= "<td>{$evaluacion->getAdecuacion()}%</td>";
    $lista2 .= "<td>{$evaluacion->getEvaluador2()} {$evaluacion->getEvaluadorCal2()}%</td>";
    $lista2 .= "<td>{$evaluacion->getEvaluador3()} {$evaluacion->getEvaluadorCal3()}%</td>";
    $lista2 .= "<td>{$evaluacion->getAutoEvaluador()}%</td>";
    $lista2 .= "<td>{$evaluacion->getPromedio()}%</td>";

    $cal2 += intVal($evaluacion->getPromedio());
    $div2 = ceil($cal2);
    if ($div2  <= 79) {
        $mensaje2 = 'NO CUMPLE';
    } elseif ($div2  >= 80 && $div2  <= 99) {
        $mensaje2 = 'CUMPLE';
    } else {
        $mensaje2 = 'SOBRESALIENTE';
    }

    $canAdecuacion += intVal($evaluacion->getAdecuacion());

    //$lista2 .= "<td>{$evaluacion->getRango2()}</td>";
    $lista2 .= '<td>';
    $lista2 .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionCompetenciaFormulario.php&accion=Modificar&id={$evaluacion->getId()}'><img src='presentacion/img/modificar.png'></a>";
    $lista2 .= "<img src='presentacion/img/eliminar.png' onClick='eliminar2({$evaluacion->getId()})'>";

    $lista2 .= '</td>';
    $lista2 .= '</tr>';
}

?>

<table class="table table" border="5">


    <th scope="col"><img src="presentacion/img/medicronLogo.png" width="250"></th>

    <th scope="col">
        <center>
            <h1>EVALUACIÓN DE DESEMPEÑO </h1>
            <center>
    </th>

    </tr>
</table>
</br>
</br>

<table class="table table">
    <tr>
        <th scope="row">Identificacion: <?= $persona->getIdentificacion() ?></th>
        <th scope="row">Nombres y Apellidos: <?= $persona->getNombres() ?> <?= $persona->getApellidos() ?></th>
</table>

</br>
</br>
<center>
    <h3>DESEMPEÑO</h3>
    <center>
        </br>
        <?php
        if ($canPeso < 100) {
            echo "<table class='table table-hover'>
        <tr class='table-success'>
       
        <td>LOGRO</td>
        <td>TIPO DE LOGRO</td>
        <td>PESO DE LOGRO</td>
        <td>EVALUADOR</td>
        <td>EVIDENCIA</td>
        <td>CALIFICACION</td>

        <th><a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionFormulario.php&idDesempeno={$persona->getIdentificacion()}'><img src='presentacion/img/adicionar.png'></a></th>
        </tr>
        $lista
        </table>";
        } else {
            echo "<table class='table table-hover'>
        <tr class='table-success'>

        <td>LOGRO</td>
        <td>TIPO DE LOGRO</td>
        <td>PESO DE LOGRO</td>
        <td>EVALUADOR</td>
        <td>EVIDENCIA</td>
        <td>CALIFICACION</td>

        <th></th>
        </tr>
        $lista
        </table>";
        }
        $borderResult = '';
        $iconData = '';

        if ($resultDesempeno) {
            if ($resultDesempeno < 80) {$borderResult = 'border-red'; $iconData = 'down'; }
            else { $borderResult = 'border-green'; $iconData = 'up'; }
            ?>
        

        <div class="result-data <?= $borderResult; ?>">
            <div class="data-full">
                <span><strong>Resultado</strong> <p><?= $resultDesempeno . "% "?> </p> </span>
                <i class="ion ion-md-arrow-<?= $iconData; ?>"></i>
            </div>
            <p class="data-cumplir"><?= $mensaje ?></p>
        </div>

        <?php 
        }
        
        ?>
        </br>
        </br>

        <center>
            <h3>COMPETENCIA </h3>
            <center>
                </br>
                <?php
                if ($canAdecuacion < 100) {
                    echo "<table class='table table-hover'>
                        <tr class='table-success'>
                        <th scope='row'>COMPETENCIA</th>
                        <td>CONDUCTA OBSERVADA</td>
                        <td>TIPO DE LOGRO</td>
                        <td>ADECUACION</td>
                        <td>EVAL. CAL 1 (60%)</td>
                        <td>EVAL. CAL 2 (30%)</td>
                        <td>AUTO (10%)</td>
                        <td>PROMEDIO</td>
                        <th><a href='principal.php?CONTENIDO=presentacion/evaluacion/evaluacionCompetenciaFormulario.php&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/adicionar.png'></a></th>
                        $lista2 
                     </table>";
                } else {
                    echo "<table class='table table-hover'>
                        <tr class='table-success'>
                        <th scope='row'>COMPETENCIA</th>
                        <td>CONDUCTA OBSERVADA</td>
                        <td>TIPO DE LOGRO</td>
                        <td>ADECUACION</td>
                        <td>EVAL. CAL 1 (60%)</td>
                        <td>EVAL. CAL 2 (30%)</td>
                        <td>AUTO (10%)</td>
                        <td>PROMEDIO</td>

                        <td></td>
                        $lista2 
                     </table>";
                }

                ?>

                <?php

                


                $resultadoFinal = (($div * 60) / 100) + (($div2 * 40) / 100);


                if ($resultadoFinal  <= 79) {
                    $mensaje3 = "<font color='red'>$resultadoFinal% NO CUMPLE'</font>";
                } elseif ($resultadoFinal  >= 80 && $resultadoFinal  <= 99) {
                    $mensaje3 = "<font color='blue'>$resultadoFinal% CUMPLE'</font>";
                } else {
                    $mensaje3 = "<font color='green'>$resultadoFinal% SOBRESALIENTE'</font>";
                }

                $borderResult = '';
                $iconData = '';
                if ($div2 != 0) {
                    if ($div2 < 80) {
                        $borderResult = 'border-red'; $iconData = 'down'; 
                        $mensaje = 'NO CUMPLE';
                    }
                    else { 
                        $borderResult = 'border-green'; $iconData = 'up'; 
                        $mensaje = 'CUMPLE';
                    }
                    ?>
                

                <div class="result-data <?= $borderResult; ?>">
                    <div class="data-full">
                        <span><strong>Resultado</strong> <p><?= $div2 . "% "?> </p> </span>
                        <i class="ion ion-md-arrow-<?= $iconData; ?>"></i>
                    </div>
                    <p class="data-cumplir"><?= $mensaje ?></p>
                </div>

                <?php    
                }
                

                ?>

                <table class="table table">
                    <tr class="table-success">
                        <th scope="row">RESULTADO GENERAL: </th>
                        <th scope="row">Desempeño: <?= $resultDesempeno; ?>%</th>
                        <th scope="row">Competencia: <?= $div2 ?>%</th>
                        <th scope="row">Final: <?= $mensaje3 ?></th>
                </table>

                <script type="text/javascript">
                    function eliminar2(id) {
                        var respuesta = confirm("Esta seguro de eliminar este registro");
                        if (respuesta) location = "principal.php?CONTENIDO=presentacion/evaluacion/evaluacionCompetenciaActualizar.php&accion=Eliminar&idDesempeno=<?= $persona->getIdentificacion() ?>&id=" + id;;
                    }

                    function eliminar(id) {
                        var respuesta = confirm("Esta seguro de eliminar este registro");
                        if (respuesta) location = "principal.php?CONTENIDO=presentacion/evaluacion/evaluacionActualizar.php&accion=Eliminar&idDesempeno=<?= $persona->getIdentificacion() ?>&id=" + id;
                    }
                </script>