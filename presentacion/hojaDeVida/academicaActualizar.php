<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$academica = new Academica(null, null);
switch ($_REQUEST['accion']) {
        case 'Adicionar':
                $academica->setNivel($_REQUEST['nivel']);
                $academica->setTitulo($_REQUEST['titulo']);
                $academica->setInstitucion($_REQUEST['institucion']);
                $academica->setnumSemestres($_REQUEST['numSemestres']);
                $academica->setfechaGrado($_REQUEST['fechaGrado']);
                $academica->setIdPersona($_REQUEST['idPersona']);
                $academica->setEstado($_REQUEST['estado']);
                $newName = '';
                $removeAcentos = quitarAcentos($_REQUEST['titulo']);
                $explode = explode(' ',$removeAcentos);
                foreach($explode as $x){
                        $newName .=  $x[0];
                    }
                $nombreArchivo = "academica_". $_REQUEST['idPersona'] . '_' . $newName;
                $cadena =str_replace(' ', '', $nombreArchivo);
                $ruta = 'presentacion/hojaDeVida';
                move_uploaded_file($_FILES['archivo']['tmp_name'], "$ruta/documentos/$cadena.pdf");
                $academica->setArchivo($cadena . '.pdf');
                $academica->guardar();
                break;
        case 'Modificar':
                $academica->setId($_REQUEST['id']);
                $academica->setNivel($_REQUEST['nivel']);
                $academica->setTitulo($_REQUEST['titulo']);
                $academica->setInstitucion($_REQUEST['institucion']);
                $academica->setnumSemestres($_REQUEST['numSemestres']);
                $academica->setfechaGrado($_REQUEST['fechaGrado']);
                $academica->setIdPersona($_REQUEST['idPersona']);
                $academica->setEstado($_REQUEST['estado']);
                $newName = '';
                $removeAcentos = quitarAcentos($_REQUEST['titulo']);
                $explode = explode(' ',$removeAcentos);
                foreach($explode as $x){
                        $newName .=  $x[0];
                    }

                $nombreArchivo = "academica_". $_REQUEST['idPersona'] . '_' . $newName;
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


function quitarAcentos($cadena) {
        $acentos = array('á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ');
        $sinAcentos = array('a', 'e', 'i', 'o', 'u', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'U', 'N');
        $cadenaSinAcentos = str_replace($acentos, $sinAcentos, $cadena);
        return $cadenaSinAcentos;
    }


header('location: principal.php?CONTENIDO=presentacion/hojaDeVida/academica.php&idPersona='. $_REQUEST['idPersona']);
