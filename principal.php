<?php
ob_start();
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
require_once 'logica/clases/Competencia.php';
require_once 'logica/clases/EvaluacionCompetencia.php';
require_once 'logica/clases/EvaluacionDesempeno.php';
require_once 'logica/clases/HistorialEvaluacion.php';
require_once 'logica/clases/HistorialSarlaft.php';
require_once 'logica/clases/Novedades.php';
require_once 'logica/clases/HistoriaPrueba.php';
require_once 'logica/clases/Familiar.php';
require_once 'logica/clases/Conducta.php';
require_once 'logica/clases/Contrato.php';
require_once 'logica/clases/TipoDocumentoColaborador.php';
require_once 'logica/clases/DocumentoColaborador.php';
require_once 'logica/clasesGenericas/Fecha.php';
require_once 'librerias/dompdf/autoload.inc.php';

date_default_timezone_set('America/Bogota');
session_start();
if (!isset($_SESSION['usuario'])) header('location: index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);
$filtro = '';
foreach ($_POST as $key => $value) {
    ${$key} = $value;
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Gestion Humana - <?= $USUARIO ?> (<?= $USUARIO->getTipoEnObjeto() ?>)</title>
    <link rel="stylesheet" href="presentacion/css/bootstrap.min.css" />
    <link rel="stylesheet" href="presentacion/css/principal.css" />
    <link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <script src="presentacion/js/principal.js" defer></script>
</head>

<body class="principal-layout">
    <header class="app-header">
        <div class="brand-block">
            <img src="presentacion/img/medicronLogo.png" alt="Medicron" class="brand-logo-image">
        </div>
        <div class="header-search" aria-hidden="true">
            <i class="ion ion-md-search"></i>
            <span>Navegación y módulos</span>
        </div>
        <div class="user-summary">
            <span class="user-summary__label">Sesi&oacute;n activa</span>
            <strong><?= $USUARIO ?></strong>
            <small><?= $USUARIO->getTipoEnObjeto() ?></small>
        </div>
    </header>

    <div class="app-shell">
    <?php
    switch ($USUARIO->getTipo()) {
        case 'Administrador':
    ?>
            <nav class="menu" aria-label="Navegaci�n principal">
                <ol>
                    <li class="menu-item">
                        <a href="principal.php?CONTENIDO=presentacion/inicio.php" class="home">
                            <i class="ion ion-md-home"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="widgets">
                            <i class="ion ion-md-analytics"></i>
                            <span>Gesti&oacute;n de desempe&ntilde;o</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/usuarios/usuarios.php" class="item--a"><span>Ejecuci&oacute;n de evaluaci&oacute;n de desempe&ntilde;o</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php" class="item--b"><span>Historial de evaluaciones de desempe&ntilde;o</span></a></li>
                            <li class="menu-item item--c"><a href="principal.php?CONTENIDO=presentacion/evaluacion/competencias.php" class="item--c"><span>Competencias</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="kabobs">
                            <i class="ion ion-md-document"></i>
                            <span>Vinculaci&oacute;n e incorporaci&oacute;n</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php" class="item--a"><span>Diligenciar hoja de vida</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/contrato/historialContrato.php" class="item--b"><span>Contrato laboral</span></a></li>
                            <li class="menu-item item--c"><a href="principal.php?CONTENIDO=presentacion/historial/historialSarlaft.php" class="item--c"><span>Certificado de Sarlaft</span></a></li>
                            <li class="menu-item item--d"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=formatos" class="item--d"><span>Formatos de inducción</span></a></li>
                            <li class="menu-item item--e"><a href="principal.php?CONTENIDO=presentacion/Novedades/novedades.php" class="item--e"><span>Novedades</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="about">
                            <i class="ion ion-md-folder-open"></i>
                            <span>SST</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=examenes" class="item--a"><span>Ex&aacute;menes ocupacionales</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=vacunas" class="item--b"><span>Vacunas</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="index.php" class="contact">
                            <i class="ion ion-md-exit"></i>
                            <span>Salir</span>
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
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="widgets">
                            <i class="ion ion-md-analytics"></i>
                            <span>Desempe&ntilde;o</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/usuarios/usuarios.php" class="item--a"><span>Ejecuci&oacute;n de evaluaci&oacute;n de desempe&ntilde;o</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php" class="item--b"><span>Historial de evaluaciones de desempe&ntilde;o</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="kabobs">
                            <i class="ion ion-md-document"></i>
                            <span>Vinculaci&oacute;n e incorporaci&oacute;n</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php" class="item--a"><span>Diligenciar hoja de vida</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/contrato/historialContrato.php" class="item--b"><span>Contrato laboral</span></a></li>
                            <li class="menu-item item--c"><a href="principal.php?CONTENIDO=presentacion/historial/historialSarlaft.php" class="item--c"><span>Certificado de Sarlaft</span></a></li>
                            <li class="menu-item item--d"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=formatos" class="item--d"><span>Formatos</span></a></li>
                            <li class="menu-item item--e"><a href="principal.php?CONTENIDO=presentacion/Novedades/novedades.php" class="item--e"><span>Novedades</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="about">
                            <i class="ion ion-md-folder-open"></i>
                            <span>SST</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=examenes" class="item--a"><span>Subir ex&aacute;menes</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=vacunas" class="item--b"><span>Vacunas</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="index.php" class="contact">
                            <i class="ion ion-md-exit"></i>
                            <span>Salir</span>
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
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="widgets">
                            <i class="ion ion-md-analytics"></i>
                            <span>Desempe&ntilde;o</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu"></ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="kabobs">
                            <i class="ion ion-md-document"></i>
                            <span>Vinculaci&oacute;n e incorporaci&oacute;n</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/usuariosHojaVida.php" class="item--a"><span>Diligenciar hoja de vida</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=formatos" class="item--b"><span>Formatos</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="#0" class="about">
                            <i class="ion ion-md-folder-open"></i>
                            <span>SST</span>
                            <div class="dots"></div>
                        </a>
                        <ol class="sub-menu">
                            <li class="menu-item item--a"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=examenes" class="item--a"><span>Subir ex&aacute;menes</span></a></li>
                            <li class="menu-item item--b"><a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=vacunas" class="item--b"><span>Vacunas</span></a></li>
                        </ol>
                    </li>
                    <li class="menu-item">
                        <a href="index.php" class="contact">
                            <i class="ion ion-md-exit"></i>
                            <span>Salir</span>
                        </a>
                    </li>
                </ol>
            </nav>
    <?php
            break;
    }
    ?>

        <div class='dashboard'>
            <div class='dashboard-app'>
                <div class="dashboard-heading">
                    <div>
                        <span class="dashboard-heading__eyebrow">Espacio de trabajo</span>
                        <h2>Contenido principal</h2>
                    </div>
                </div>
                <div class='dashboard-content'>
                    <div class='card'>
                        <div class='card-body'>
                            <div id="contenido"><?= include $_REQUEST['CONTENIDO']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


