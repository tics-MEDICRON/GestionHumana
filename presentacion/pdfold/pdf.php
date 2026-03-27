<?php
ob_clean();
ob_start();
$conexion = mysqli_connect('localhost', 'root', '', 'medicron');
$directorio = new Persona('identificacion', $_REQUEST['idDesempeno']);
$cal = 0;
$cal2 = 0;
$mensaje3 = '';
$div = 0;
$div2 = 0;
$resultadoFinal = 0;

?>
<html>

<head>
</head>

<style>

    body {
        font-family: 'Courier New', Courier, monospace;
        text-align: center;
    }


    table {
        width: 100%;
        text-align: center;
        
    }

    th {
        height: 50px;
        border: 1px solid;
        background-color: #CFCFCF;

    }

    td {
        height: 50px;
        border: 1px solid;
        color: #000000;
    }

   

</style>
<body>
    <h3>EVALUACION DE DESEMPEÑO</h3>
    <table border="1" cellpáding="1" cellspacing="2">
        <thead>
            <tr bgcolor="#cbffce">
                <th>ID</th>
                <th>LOGRO</th>
                <th>TIPO LOGRO</th>
                <th>PESO DE LOGRO</th>
                <th>EVALUACIÓN</th>
                <th>EVIDENCIA</th>
                <th>CALIFICACION</th>
                <th>RANGO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, logro, tipo, peso, evaluador, evidencia, calificacion, rango from desempeno where idDesempeno='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['logro'] ?></td>
                <td><?php echo $mostrar['tipo'] ?></td>
                <td><?php echo $mostrar['peso'] ?>%</td>
                <td><?php echo $mostrar['evaluador'] ?></td>
                <td><?php echo $mostrar['evidencia'] ?></td>
                <td><?php echo $mostrar['calificacion'] ?>%</td>
                <td><?php echo $mostrar['rango'] ?></td>

                <?php
                $cal += intVal($mostrar['calificacion'] * $mostrar['peso']);
                $div = ceil($cal / 100);
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
    </br>
    <h3>COMPETENCIA</h3>
    <table border="1" cellpáding="1" cellspacing="2">
        <thead>
            <tr bgcolor="#cbffce">
                <th>COMPETENCIA</th>
                <th>CONDUCTA OBSERVADA</th>
                <th>TIPO DE LOGRO</th>
                <th>ADECUACION</th>
                <th>EVAL. CAL 1 (60%)</th>
                <th>EVAL. CAL 2 (30%)</th>
                <th>AUTO (10%)</th>
                <th>PROMEDIO</th>
                <th>RANGO</th>
            </tr>
        </thead>
        <?php

        $sql = "
        select 
        evaluacioncompetencia.id, 
        evaluacioncompetencia.idConducta,
        tipoLogro, 
        adecuacion, 
        evaluador2, 
        evaluadorCal2, 
        evaluador3, 
        evaluadorCal3,
        autoEvaluador, 
        promedio, 
        rango2, 
        idPersona, 
        competencia.descripcion as idCompetencia
        from evaluacioncompetencia 
        INNER JOIN competencia ON evaluacioncompetencia.idCompetencia = Competencia.id 
        where idPersona='{$directorio->getIdentificacion()}' ORDER BY id ASC;
        ";

        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['idCompetencia'] ?></td>
                <td><?php echo $mostrar['idConducta'] ?></td>
                <td><?php echo $mostrar['tipoLogro'] ?></td>
                <td><?php echo $mostrar['adecuacion'] ?></td>
                <td><?php echo $mostrar['evaluador2'] . " " . $mostrar['evaluadorCal2'] ?>%</td>
                <td><?php echo $mostrar['evaluador3'] . " " . $mostrar['evaluadorCal3'] ?>%</td>
                <td><?php echo $mostrar['autoEvaluador'] ?>%</td>
                <td><?php echo $mostrar['promedio'] ?>%</td>
                <td><?php echo $mostrar['rango2'] ?></td>

                <?php
                $cal2 += intVal($mostrar['promedio']);
                $div2 = ceil($cal2);
                ?>
            </tr>
        <?php
        }
        ?>
    </table>

    <?php

    $resultadoFinal = (($div * 60) / 100) + (($div2 * 40) / 100);
    if ($resultadoFinal  <= 79) {
        $mensaje3 = "<font color='red'>$resultadoFinal% NO CUMPLE</font>";
    } elseif ($resultadoFinal  >= 80 && $resultadoFinal  <= 99) {
        $mensaje3 = "<font color='blue'>$resultadoFinal% CUMPLE</font>";
    } else {
        $mensaje3 = "<font color='green'>$resultadoFinal% SOBRESALIENTE</font>";
    }

    ?>

    <table class="table table">
        <tr class="table-success">
            <th scope="row">RESULTADO GENERAL: </th>
            <th scope="row">Desempeño: <?= ($div * 60) / 100 ?>%</th>
            <th scope="row">Competencia: <?= ($div2 * 40) / 100 ?>%</th>
            <th scope="row">Final: <?= $mensaje3 ?></th>
    </table>

</body>

</html>

<?php

$html = ob_get_clean();
//echo($html);



use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
/*
$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'Landscape')Para poner el formato que imprima con los datos de forma horizontal

$dompdf->setPaper('A4', 'landscape');
 
en A5 y en vertical
$dompdf->setPaper('A5', 'portrait');
 
//tamaño custom, se especifica en puntos, lo que en CSS se escribe como pt
*/

$dompdf->set_paper(array(0, 0, 800, 841), 'portrait');


$dompdf->render();
$dompdf->stream("archivo_pdf", array("Attachment" => true)); //false no descarga el archivo, true descarga el archivo directamente
?>