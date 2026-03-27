<?php
ob_clean();
ob_start();
$conexion = mysqli_connect('localhost', 'root', '', 'medicron');
$directorio = new Persona('identificacion', $_REQUEST['idDesempeno']);
$cal = 0;
$cal2 = 0;
$cal3 = 0;
$cal4 = 0;
$mensaje3 = '';
$div = 0;
$div2 = 0;
$resultadoFinal = 0;
$resultDesempeno = 0;
$resultCompentencias = 0;

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
        border-collapse:collapse;
    }


    table.funcionario {
      border-collapse: collapse;
    }

    /* Estilo adicional para bordes */
    td.funcionario, th.funcionario {
      border: 1px solid black;
      padding: 8px; /* Añadir un poco de espacio interno si es necesario */
      text-align: left;
    }


    td {
        height: 50px;
        border: 1px solid;
        color: #000000;
    }


    html {
	   margin: 100pt 100pt;
    }


</style>
<body>



       <?php
        $sql = "SELECT `identificacion`, concat(nombres,' ', apellidos) as nombres, `clave`, `tipo`, `cargo` FROM `persona` WHERE identificacion='{$directorio->getIdentificacion()}'";
 
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>


<table style="text-align:left; border: hidden;">
  <tr style="border:hidden;">
    <td >IDENTIFICACION: <?php echo $mostrar['identificacion'] ?><br>
    FUNCIONARIO: <?php echo $mostrar['nombres'] ?></td>
  </tr>
</table>

<p>

        <?php
        }
        ?>
 
    <h3>EVALUACION DE DESEMPEÑO</h3>
    <!--<table border="1" cellpáding="1" cellspacing="2">-->
    <table cellspacing="0" cellpadding="0" border="0" align="center">
        <thead>
            <tr bgcolor="#cbffce" >
                <th>LOGRO</th>
                <th>TIPO LOGRO</th>
                <th>PESO DE LOGRO</th>
                <th>EVALUACIÓN</th>
                <th>CALIFICACION</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, logro, tipo, peso, evaluador, evidencia, calificacion, rango from desempeno where idDesempeno='{$directorio->getIdentificacion()}'";

        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>

                <?php

                $cal = intVal($mostrar['calificacion'] * $mostrar['peso'])/100;
                $resultDesempeno += $cal;


                /*$div = ceil($cal / 100);*/
                ?>

            <tr>
                <td><?php echo $mostrar['logro'] ?></td>
                <td><?php echo $mostrar['tipo'] ?></td>
                <td><?php echo $mostrar['peso'] ?>%</td>
                <td><?php echo $mostrar['evaluador'] ?></td>
                <td><?php echo $mostrar['calificacion'] ?>%</td>
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

                <?php
                /*$cal2 += intVal($mostrar['promedio']);*/
                $cal2=intVal($mostrar['evaluadorCal2'])*60/100;
                $cal3=intVal($mostrar['evaluadorCal3'])*30/100;
                $cal4=intVal($mostrar['autoEvaluador'])*10/100;
                
                $resultCompentencias+=($cal2+$cal3+$cal4)*intval($mostrar['adecuacion'])/100;
                /*$div2 = ceil($cal2);*/
                ?>
            <tr>
                <td><?php echo $mostrar['idCompetencia'] ?></td>
                <td><?php echo $mostrar['idConducta'] ?></td>
                <td><?php echo $mostrar['tipoLogro'] ?></td>
                <td><?php echo $mostrar['adecuacion'] ?></td>
                <td><?php echo $mostrar['evaluador2'] . " " . $mostrar['evaluadorCal2'] ?>%</td>
                <td><?php echo $mostrar['evaluador3'] . " " . $mostrar['evaluadorCal3'] ?>%</td>
                <td><?php echo $mostrar['autoEvaluador'] ?>%</td>

            </tr>
        <?php
        }
        ?>
    </table>

    <?php




    $resultadoFinal = (($resultDesempeno * 60) / 100) + (($resultCompentencias * 40) / 100);
    if ($resultadoFinal  <= 79) {
        $mensaje3 = "<font color='red'>$resultadoFinal% NO CUMPLE</font>";
    } elseif ($resultadoFinal  >= 80 && $resultadoFinal  <= 99) {
        $mensaje3 = "<font color='blue'>$resultadoFinal% CUMPLE</font>";
    } else {
        $mensaje3 = "<font color='green'>$resultadoFinal% SOBRESALIENTE</font>";
    }

    ?>

    <p>

    <table class="table table">
        <tr class="table-success">
            <th scope="row">RESULTADO GENERAL: </th>
            <th scope="row">Desempeño: <?= $resultDesempeno ?>%</th>
            <th scope="row">Competencia: <?= round($resultCompentencias,2) ?>%</th>
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