<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$laboral = new Laboral(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $laboral->setEmpresa($_REQUEST['empresa']);
                $laboral->setTelefono($_REQUEST['telefono']);
                $laboral->setCargo($_REQUEST['cargo']);
                $laboral->setDesde($_REQUEST['desde']);
                $laboral->setHasta($_REQUEST['hasta']);
                $laboral->setMotivoRetiro($_REQUEST['retiro']);
                $laboral->setIdPersona($_REQUEST['idPersona']);
                
                $nombreArchivo = "laboral_" . $_REQUEST['idPersona'] . '_' . $_REQUEST['empresa'];
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/hojaDeVida';
                move_uploaded_file($_FILES['archivo']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                $laboral->setArchivo($cadena . '.pdf');

                $laboral->guardar();
                break;
        case 'Modificar':
                $laboral->setId($_REQUEST['id']);
                $laboral->setEmpresa($_REQUEST['empresa']);
                $laboral->setTelefono($_REQUEST['telefono']);
                $laboral->setCargo($_REQUEST['cargo']);
                $laboral->setDesde($_REQUEST['desde']);
                $laboral->setHasta($_REQUEST['hasta']);
                $laboral->setMotivoRetiro($_REQUEST['retiro']);
                $laboral->setIdPersona($_REQUEST['idPersona']);
                
                $nombreArchivo = "laboral_" . $_REQUEST['idPersona'] . '_' . $_REQUEST['empresa'];
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/hojaDeVida';
                move_uploaded_file($_FILES['archivo']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                $laboral->setArchivo($cadena . '.pdf');
                
                $laboral->modificar();
                break;
        case 'Eliminar':
                $laboral->setId($_REQUEST['id']);
                $laboral->eliminar();
                break;
}

header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboral.php&idPersona='. $_REQUEST['idPersona']);
