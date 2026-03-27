<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$academica = new ReferenciaPersonal(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setNombre($_REQUEST['nombre']);
                $academica->setParentesco($_REQUEST['parentesco']);
                $academica->setOcupacion($_REQUEST['ocupacion']);
                $academica->setTelefono($_REQUEST['telefono']);
                $academica->setIdPersona($_REQUEST['idPersona']);

                $nombreArchivo = "personal_" . $_REQUEST['idPersona'] . '_' . $_REQUEST['nombre'];
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/hojaDeVida';
                move_uploaded_file($_FILES['archivo']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                
                $academica->setArchivo($cadena . '.pdf');
                $academica->guardar();
                break;
        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setNombre($_REQUEST['nombre']);
                $academica->setParentesco($_REQUEST['parentesco']);
                $academica->setOcupacion($_REQUEST['ocupacion']);
                $academica->setTelefono($_REQUEST['telefono']);
                $academica->setIdPersona($_REQUEST['idPersona']);

                $nombreArchivo = "personal_" . $_REQUEST['idPersona'] . '_' . $_REQUEST['nombre'];
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
header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaPersonal.php&idPersona='. $_REQUEST['idPersona']);
