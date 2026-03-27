<?php
ob_clean();
ob_start();
$conexion = mysqli_connect('localhost', 'root', '', 'medicron');
$directorio = new Persona('identificacion', $_REQUEST['idPersona']);




?>

<html>

<head>
</head>

<style>
    body {
        font-family: 'Courier New', Courier, monospace;

    }

    table {
        width: 100%;


    }

    th {
        height: 50px;
        border: 1px solid;
        background-color: #CFCFCF;
        text-align: center;

    }

    td {
        height: 50px;
        border: 1px solid;
        color: #000000;
    }

    .tablaMargen {
        border: 2px solid;
    }

    .imagen {
        margin: 25px;
        width: 150px;
        height: 150px;
        border: 1px solid;
        background-size: 100% 100%;
        background-repeat: no-repeat;

    }

    .titulos {
        width: 100%;
        background-color: #bebebe;
        height: 30px;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-weight: 100;
    }

    .formulario {
        border: 10px solid #ffffff;
    }

    .formulario-hoja-de-vida {
        text-align: left;
        border: 1px;
    }

    .border {
        border: 10px solid red;

    }

    .bordes-td {
        border: 0px;
    }
</style>

<body>

    <?php
    $path = 'presentacion/img/medicronLogo.jpg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>

    <header>
        <div class="tablaMargen">
            <table class="encabezado">
                <tr>
                    <th><img src="<?php echo $base64 ?>" /></th>
                    <th>
                        <center>
                            <P>HOJA DE VIDA PERSONAL</P>
                            <center>
                    </th>
                    <img>
                    <th>VERSIÓN: 00</th>
                    <th>EDICION: SEPTIEMBRE DE 2022</th>
                    <th>CODIGO: FR-AST-15</th>
                </tr>
            </table>
    </header>

    <?php
    $sql = "select id, idPersona, foto, primerApellido, segundoApellido, nombres, lugarNacimiento, lugarExpedicion, fechaNacimiento, tipoDocumento, numeroDocumento, numeroLibreta, libretaMilitar, distrito, direccionResidencia, barrio, telResidencia, celular, email,estadoCivil,grupoSanguineo, tipoVivienda, estratoEconomico, personasCargo,eps,fondoPension, libreta, cc, archivoPension, afiliacionEps, sexo, nacionalidad, paisExpedicion, paisNacionalidad, paisResidencia, departamentoNacionalidad, departamentoResidencia, municipioNacionalidad, municipioResidencia, cesantias, archivoCesantias from historiaprueba where idPersona='{$directorio->getIdentificacion()}'";
    $result = mysqli_query($conexion, $sql);
    while ($mostrar = mysqli_fetch_array($result)) {
    ?>
        <?php
        $path = "presentacion/hojaDeVida/fotos/{$mostrar['foto']}";
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <div class="imagen"><img src="<?php echo $base64 ?>" width="100%" /></div>


        <center>
            <div class="titulos">
                <h4>1. INFORMACION PERSONAL </h4>
            </div>
        </center>
        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Primer Apellido:</th>
                <th class="formulario-hoja-de-vida">Segundo Apellido:</th>
                <th class="formulario-hoja-de-vida">Nombres:</th>
            </tr>
            <tr>
                <td><?php echo $mostrar['primerApellido'] ?></td>
                <td><?php echo $mostrar['segundoApellido'] ?></td>
                <td><?php echo $mostrar['nombres'] ?></td>
            </tr>
        </table>
        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Tipo ID:</th>
                <th class="formulario-hoja-de-vida">Número:</th>
                <th class="formulario-hoja-de-vida">Lugar de Expedicion:</th>
                <th class="formulario-hoja-de-vida">Sexo:</th>
                <th class="formulario-hoja-de-vida">Nacionalidad:</th>
                <th class="formulario-hoja-de-vida">Pais:</th>
            </tr>
            <tr>
                <td><?php echo $mostrar['tipoDocumento'] ?></td>
                <td><?php echo $mostrar['numeroDocumento'] ?></td>
                <td><?php echo $mostrar['lugarExpedicion'] ?></td>
                <td><?php echo $mostrar['sexo'] ?></td>
                <td><?php echo $mostrar['nacionalidad'] ?></td>
                <td><?php echo $mostrar['paisExpedicion'] ?></td>
            </tr>
        </table>
        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Fecha y lugar de nacimiento:</th>
                <th class="formulario-hoja-de-vida">Pais:</th>
                <th class="formulario-hoja-de-vida">Departamento:</th>
                <th class="formulario-hoja-de-vida">Municipio:</th>
            </tr>
            <tr>
                <td><?php echo $mostrar['fechaNacimiento'] ?> <?php echo $mostrar['lugarNacimiento'] ?></td>
                <td><?php echo $mostrar['paisNacionalidad'] ?></td>
                <td><?php echo $mostrar['departamentoNacionalidad'] ?></td>
                <td><?php echo $mostrar['municipioNacionalidad'] ?></td>
            </tr>
        </table>
        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Estado Civil:</th>
                <th class="formulario-hoja-de-vida">Libreta Militar:</th>
                <th class="formulario-hoja-de-vida">Numero de la Libreta:</th>
                <th class="formulario-hoja-de-vida">Distrito Militar:</th>
            </tr>
            <tr>
                <td><?php echo $mostrar['estadoCivil'] ?></td>
                <td><?php echo $mostrar['libretaMilitar'] ?></td>
                <td><?php echo $mostrar['numeroLibreta'] ?></td>
                <td><?php echo $mostrar['distrito'] ?></td>
            </tr>
        </table>

        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Pais:</th>
                <th class="formulario-hoja-de-vida">Departamento:</th>
                <th class="formulario-hoja-de-vida">Municipio:</th>
                <th class="formulario-hoja-de-vida">direccion Residencial:</th>
            </tr>
            <tr>
                <td><?php echo $mostrar['paisResidencia'] ?></td>
                <td><?php echo $mostrar['departamentoResidencia'] ?></td>
                <td><?php echo $mostrar['municipioResidencia'] ?></td>
                <td><?php echo $mostrar['direccionResidencia'] ?></td>
            </tr>
        </table>

        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Barrio:</th>
                <th class="formulario-hoja-de-vida">Tipo Vivienda:</th>
                <th class="formulario-hoja-de-vida">Estrato Socioeconomico:</th>
                <th class="formulario-hoja-de-vida">Telefono Fijo:</th>
                <th class="formulario-hoja-de-vida">Celular:</th>
            </tr>
            <tr>
                <td><?php echo $mostrar['barrio'] ?></td>
                <td><?php echo $mostrar['tipoVivienda'] ?></td>
                <td><?php echo $mostrar['estratoEconomico'] ?></td>
                <td><?php echo $mostrar['telResidencia'] ?></td>
                <td><?php echo $mostrar['celular'] ?></td>
            </tr>
        </table>

        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">E-mail: <td class="formulario-hoja-de-vida"><?php echo $mostrar['email'] ?></td></th>
            </tr>
            <tr class="border">
                <th class="formulario-hoja-de-vida">Número de personas a cargo y quienes: <td class="formulario-hoja-de-vida"><?php echo $mostrar['personasCargo'] ?></th></th>
            </tr>
            <tr class="border">
                <th class="formulario-hoja-de-vida">Grupo Sanguineo y RH: <td class="formulario-hoja-de-vida"><?php echo $mostrar['grupoSanguineo'] ?></td></th>
            </tr>
        </table>

        <table class="formulario">
            <tr class="border">
                <th class="formulario-hoja-de-vida">Afiliación a:</th>
                <th class="formulario-hoja-de-vida">EPS:</th>
                <th class="formulario-hoja-de-vida">Fondo de Pensiones:</th>
                <th class="formulario-hoja-de-vida">Cesantias:</th>
            </tr>
            <tr>
                <td></td>
                <td><?php echo $mostrar['eps'] ?></td>
                <td><?php echo $mostrar['fondoPension'] ?></td>
                <td><?php echo $mostrar['cesantias'] ?></td>
            </tr>
        </table>
    <?php
    }
    ?>
    <br>
    <br>

    <center>
        </br>
        <div class="titulos">
            <h4>2. INFORMACION FAMILIAR </h4>
        </div>
    </center>

    <?php
    $sql = "select id, nombre,identificacion, celular, fechaNacimiento, ocupacion, idPersona from familiar where idPersona='{$directorio->getIdentificacion()}'";
    $result = mysqli_query($conexion, $sql);
    while ($mostrar = mysqli_fetch_array($result)) {
    ?>
        <table>
            <tr>
                <th class="formulario-hoja-de-vida">Nombre del Cónyuge ó Compañera(o): </th>
                <th class="formulario-hoja-de-vida">Número de Identificacion: </th>
                <th class="formulario-hoja-de-vida">Fecha de Nacimiento: </th>
            </tr>
            <tr>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['identificacion'] ?></td>
                <td><?php echo $mostrar['fechaNacimiento'] ?></td>
                
            </tr>
            <tr>
                <th class="formulario-hoja-de-vida">Profesion u Ocupación: </th>
                <th class="formulario-hoja-de-vida">Número de Celular: </th>
            </tr>
            <tr>
                <td><?php echo $mostrar['ocupacion'] ?></td>
                <td><?php echo $mostrar['celular'] ?></td>
            </tr>
        </table>
    <?php
    }
    ?>
    <center>
        </br>
        <div class="titulos">
            <h4>INFORMACIÓN HIJOS Y/O PADRES</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <th>NOMBRES Y APELLIDOS</th>
                <th>FECHA DE NACIMIENTO</th>
                <th>OCUPACIÓN</th>
                <th>PARENTESCO</th>
                <th>EMERGENCIA AVISAR A</th>
                <th>TELEFONO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, nombre, fechaNacimiento, ocupacion, parentesco, emergencia, telefono, idPersona from familia where idPersona='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['fechaNacimiento'] ?></td>
                <td><?php echo $mostrar['ocupacion'] ?></td>
                <td><?php echo $mostrar['parentesco'] ?></td>
                <td><?php echo $mostrar['emergencia'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </br>
    <center>
        </br>
        <div class="titulos">
            <h4>4. INFORMACIÓN ACADEMICA</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <th>NIVEL</th>
                <th>TITULO OBTENIDO</th>
                <th>INSTITUCIÓN QUE OTORGA EL TITULO</th>
                <th>NO SEMESTRES CURSADOS</th>
                <th>FECHA GRADO MES/AÑO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, nivel, titulo, institucion, numSemestres, fechaGrado, archivo, idPersona from academica where idPersona='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['nivel'] ?></td>
                <td><?php echo $mostrar['titulo'] ?></td>
                <td><?php echo $mostrar['institucion'] ?></td>
                <td><?php echo $mostrar['numSemestres'] ?></td>
                <td><?php echo $mostrar['fechaGrado'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </br>
    <center>
        </br>
        <div class="titulos">
            <h4>4. FORMACIÓN COMPLEMENTARIA</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <th>CURSOS O DIPLOMADOS</th>
                <th>INSTITUCIÓN</th>
                <th>AÑO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, cursos, institucion, year, archivo, idPersona from complementaria where idPersona='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['cursos'] ?></td>
                <td><?php echo $mostrar['institucion'] ?></td>
                <td><?php echo $mostrar['year'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </br>
    <center>
        </br>
        <div class="titulos">
            <h4>5. INFORMACIÓN LABORAL DE OTRAS EMPRESAS</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <th>EMPRESA</th>
                <th>TELEFONO</th>
                <th>CARGO DESEMPEÑADO</th>
                <th>DESDE</th>
                <th>HASTA</th>
                <th>MOTIVO DE RETIRO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, empresa, telefono, cargo, desde, hasta, motivoRetiro, idPersona from laboral where idPersona='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['empresa'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>
                <td><?php echo $mostrar['cargo'] ?></td>
                <td><?php echo $mostrar['desde'] ?></td>
                <td><?php echo $mostrar['hasta'] ?></td>
                <td><?php echo $mostrar['motivoRetiro'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </br>
    <center>
        </br>
        <div class="titulos">
            <h4>6. REFERENCIAS LABORALES</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <th>EMPRESA</th>
                <th>NOMBRE DEL CONTACTO</th>
                <th>CARGO</th>
                <th>TELEFONO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, empresa, nombre, cargo, telefono, archivo, idPersona from referencialaboral where idPersona='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['empresa'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['cargo'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </br>
    <center>
        </br>
        <div class="titulos">
            <h4>7. REFERENCIAS PERSONALES</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>PARENTESCO</th>
                <th>OCUPACION</th>
                <th>TELEFONO</th>
            </tr>
        </thead>
        <?php
        $sql = "select id, nombre, parentesco, ocupacion, telefono, archivo, idPersona from referenciapersonal where idPersona='{$directorio->getIdentificacion()}'";
        $result = mysqli_query($conexion, $sql);
        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['parentesco'] ?></td>
                <td><?php echo $mostrar['ocupacion'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

    <center>
        <br>
        <br>
        <br>
        <div class="titulos">
            <h4>8. FIRMA DEL COLABORADOR</h4>
        </div>
    </center>
    <table>
        <thead>
            <tr>
                <P>Para todos los efectos legales, certifico que los datos por mi diligenciados en el presente Formato de Hoja de Vida, son veraces.</P>
            </tr>
            <hr>
            <tr>
                <p>Firma Colaborador: </p>
                <p>C.C: </p>
            </tr>
        </thead>
    </table>

    </div>
    </br>



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


/*
$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'Landscape')Para poner el formato que imprima con los datos de forma horizontal

$dompdf->setPaper('A4', 'landscape');
 
en A5 y en vertical
$dompdf->setPaper('A5', 'portrait');
 
//tamaño custom, se especifica en puntos, lo que en CSS se escribe como pt
*/

$dompdf->set_paper(array(0, 0, 800, 841), 'portrait');
$dompdf->loadHtml($html);

$dompdf->render();
$dompdf->stream("archivo_pdf", array("Attachment" => true)); //false no descarga el archivo, true descarga el archivo directamente
$pdf->Output();
?>