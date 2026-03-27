<!DOCTYPE html>

<?php
require_once 'logica/clasesGenericas/ConectorBD.php';
require_once 'logica/clases/Persona.php';
require_once 'logica/clases/TipoPersona.php';
require_once 'logica/clases/Familia.php';
require_once 'logica/clases/Academica.php';
require_once 'logica/clases/editUser.php';
require_once 'logica/clases/contactoEmergencia.php';
require_once 'logica/clases/Complementaria.php';
require_once 'logica/clases/Laboral.php';
require_once 'logica/clases/ReferenciaLaboral.php';
require_once 'logica/clases/ReferenciaPersonal.php';
require_once 'logica/clases/Desempeno.php';
require_once 'logica/clases/EvaluacionCompetencia.php';
require_once 'logica/clases/HistorialEvaluacion.php';
require_once 'logica/clases/HistorialSarlaft.php';
require_once 'logica/clases/Novedades.php';
require_once 'logica/clases/HistoriaPrueba.php';
require_once 'logica/clases/Familiar.php';
require_once 'logica/clases/Conducta.php';
require_once 'logica/clases/Contrato.php';
require_once 'logica/clasesGenericas/Fecha.php';
require_once 'librerias/dompdf/autoload.inc.php';

//require_once 'librerias/fpdf.php';



date_default_timezone_set('America/Bogota');
session_start();
if (!isset($_SESSION['usuario'])) header('location: index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
$filtro = '';
foreach ($_POST as $key => $value)
    ${$key} = $value;
?>



<html>

<head>
    <meta charset="UTF-8">
    <title>Gestion Humana - <?= $USUARIO ?> (<?= $USUARIO->getTipoEnObjeto() ?>)</title>
    <link rel="stylesheet" href="presentacion/css/bootstrap.min.css" />
    <link rel="stylesheet" href="presentacion/css/menu.css" />
    <link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <script src="presentacion/js/menu.js"></script>

</head>

<body>
    <?php
    switch ($USUARIO->getTipo()) {
        case 'Administrador':
    ?>
            <nav class="menu">
                <ol>
                    <li class="menu-item">
                        <a href="principal.php?CONTENIDO=presentacion/inicio.php" class="home">
                            <i class="ion ion-md-home"></i>
                            <span>INICIO</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="widgets">
                            <i class="ion ion-md-analytics"></i>
                            <span>DESEMPEÑO</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/usuarios/usuarios.php" class="item--a"><span>Ejecución evalucion de desempeño</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php" class="item--b"><span>Historial de evaluaciones de desempeño</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="kabobs">
                            <i class="ion ion-md-document"></i>

                            <span>HOJA DE VIDA </span>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php" class="item--a"><span>Diligenciar hoja de vida</span></a></li>
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/contrato/historialContrato.php" class="item--b"><span>Contrato Laboral</span></a></li>
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/historial/historialSarlaft.php" class="item--b"><span>Certificado de Sarlaft</span></a></li>
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/Novedades/novedades.php" class="item--c"><span>Novedades</span></a></li>
                        </ol>
                    </li>

                    <li class="menu-item">
                        <a href="" class="about">
                            <i class="ion ion-md-"></i>
                            <span></span>

                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="index.php" class="contact">
                            <i class="ion ion-md-exit"></i>
                            <span>SALIR</span>
                        </a>
                    </li>
                </ol>
            </nav>
        <?php
            break;
        case 'Colaborador':
        ?>
            <nav class="menu">
                <ol>
                    <li class="menu-item">
                        <a href="principal.php?CONTENIDO=presentacion/inicio.php" class="home">
                            <i class="ion ion-md-home"></i>
                            <span>INICIO</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="widgets">
                            <i class="ion ion-md-analytics"></i>
                            <span>DESEMPEÑO</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                        <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/usuarios/usuarios.php" class="item--a"><span>Ejecución evalucion de desempeño</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php" class="item--b"><span>Historial de evaluaciones de desempeño</span></a></li>

                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="kabobs">
                            <i class="ion ion-md-document"></i>

                            <span>HOJA DE VIDA </span>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php" class="item--a"><span>Diligenciar hoja de vida</span></a></li>
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/contrato/historialContrato.php" class="item--b"><span>Contrato Laboral</span></a></li>
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/historial/historialSarlaft.php" class="item--b"><span>Certificado de Sarlaft</span></a></li>
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/Novedades/novedades.php" class="item--c"><span>Novedades</span></a></li>
                        </ol>
                    </li>

                    <li class="menu-item">
                        <a href="" class="about">
                            <i class="ion ion-md-"></i>
                            <span></span>

                        </a>

                    </li>

                    <li class="menu-item">
                        <a href="index.php" class="contact">
                            <i class="ion ion-md-exit"></i>
                            <span>SALIR</span>
                        </a>
                    </li>
                </ol>
            </nav>
        <?php
            break;

        case 'Contrato de Servicio':
        ?>
            <nav class="menu">
                <ol>
                    <li class="menu-item">
                        <a href="principal.php?CONTENIDO=presentacion/inicio.php" class="home">
                            <i class="ion ion-md-home"></i>
                            <span>INICIO</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="widgets">
                            <i class="ion ion-md-analytics"></i>
                            <span>DESEMPEÑO</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">

                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="kabobs">
                            <i class="ion ion-md-document"></i>

                            <span>HOJA DE VIDA </span>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item"><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php" class="item--a"><span>Diligenciar hoja de vida</span></a></li>
                        </ol>
                    </li>

                    <li class="menu-item">
                        <a href="" class="about">
                            <i class="ion ion-md-"></i>
                            <span></span>

                        </a>

                    </li>

                    <li class="menu-item">
                        <a href="index.php" class="contact">
                            <i class="ion ion-md-exit"></i>
                            <span>SALIR</span>
                        </a>
                    </li>
                </ol>
            </nav>
    <?php
            break;
    }

    ?>
    <div class="menu"></div>
    <div class='dashboard'>
        <div class='dashboard-app'>

            <div class='dashboard-content'>

                <div class='card'>

                    <div class='card-body'>
                        <!--<div id="opciones" >div>-->

                        <div id="contenido"><?= include $_REQUEST['CONTENIDO']; ?></div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>