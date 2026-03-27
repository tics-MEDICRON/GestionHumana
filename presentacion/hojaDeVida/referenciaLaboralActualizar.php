<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$academica = new ReferenciaLaboral(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setEmpresa($_REQUEST['empresa']);
                $academica->setNombre($_REQUEST['nombre']);
                $academica->setCargo($_REQUEST['cargo']);
                $academica->setTelefono($_REQUEST['telefono']);
                $academica->setIdPersona($_REQUEST['idPersona']);

                $nombreArchivo = "empresa_" . $_REQUEST['idPersona'] . '_' . $_REQUEST['empresa'];
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/hojaDeVida';
                move_uploaded_file($_FILES['archivo']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                
                $academica->setArchivo($cadena . '.pdf');
                $academica->guardar();
                break;
        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setEmpresa($_REQUEST['empresa']);
                $academica->setNombre($_REQUEST['nombre']);
                $academica->setCargo($_REQUEST['cargo']);
                $academica->setTelefono($_REQUEST['telefono']);
                $academica->setIdPersona($_REQUEST['idPersona']);

                $nombreArchivo = "empresa_" . $_REQUEST['idPersona'] . '_' . $_REQUEST['empresa'];
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/hojaDeVida';
                move_uploaded_file($_FILES['archivo']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                
                $academica->setArchivo($cadena . '.pdf');
                $academica->modificar();
                break;
        case 'Eliminar':
                $academica->setId($_REQUEST['id']);
                $academica->eliminar();
                break;
}
header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/referenciasLaborales.php&idPersona='. $_REQUEST['idPersona']);
