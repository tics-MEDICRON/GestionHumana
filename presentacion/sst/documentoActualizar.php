<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

TipoDocumentoColaborador::sincronizarTipos();

function normalizarNombreArchivo($nombre)
{
    $nombre = pathinfo($nombre, PATHINFO_FILENAME);
    $nombre = preg_replace('/[^A-Za-z0-9_-]/', '_', $nombre);
    return trim($nombre, '_');
}

function guardarArchivoDocumento($idPersona, $idTipoDocumento, $archivo)
{
    $directorio = 'presentacion/sst/documentos';

    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $nombreOriginal = $archivo['name'];
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
    $nombreBase = normalizarNombreArchivo($nombreOriginal);

    if ($nombreBase == '') {
        $nombreBase = 'documento';
    }

    $nombreArchivo = $idPersona . '_' . $idTipoDocumento . '_' . date('YmdHis') . '_' . $nombreBase;
    if ($extension != '') {
        $nombreArchivo .= '.' . $extension;
    }

    move_uploaded_file($archivo['tmp_name'], $directorio . '/' . $nombreArchivo);
    return array($nombreOriginal, $nombreArchivo);
}

$documento = new DocumentoColaborador(null, null);
$idPersona = isset($_REQUEST['idPersona']) ? $_REQUEST['idPersona'] : '';
$grupo = isset($_REQUEST['grupo']) ? $_REQUEST['grupo'] : 'examenes';

switch ($_REQUEST['accion']) {
    case 'Adicionar':
        $documento->setIdPersona($_REQUEST['idPersona']);
        $documento->setIdTipoDocumento($_REQUEST['idTipoDocumento']);
        $documento->setFechaDocumento(isset($_REQUEST['fechaDocumento']) ? $_REQUEST['fechaDocumento'] : '');
        $documento->setVigente($_REQUEST['vigente']);

        list($nombreOriginal, $rutaArchivo) = guardarArchivoDocumento($_REQUEST['idPersona'], $_REQUEST['idTipoDocumento'], $_FILES['archivo']);
        $documento->setNombreOriginal($nombreOriginal);
        $documento->setRutaArchivo($rutaArchivo);
        $documento->guardar();
        $mensaje = 'adicionado';
        break;

    case 'Modificar':
        $documento = new DocumentoColaborador('id', $_REQUEST['id']);
        $documento->setId($_REQUEST['id']);
        $documento->setIdPersona($_REQUEST['idPersona']);
        $documento->setIdTipoDocumento($_REQUEST['idTipoDocumento']);
        $documento->setFechaDocumento(isset($_REQUEST['fechaDocumento']) ? $_REQUEST['fechaDocumento'] : '');
        $documento->setVigente($_REQUEST['vigente']);

        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
            $rutaAnterior = 'presentacion/sst/documentos/' . $documento->getRutaArchivo();
            list($nombreOriginal, $rutaArchivo) = guardarArchivoDocumento($_REQUEST['idPersona'], $_REQUEST['idTipoDocumento'], $_FILES['archivo']);
            $documento->setNombreOriginal($nombreOriginal);
            $documento->setRutaArchivo($rutaArchivo);

            if (file_exists($rutaAnterior)) {
                unlink($rutaAnterior);
            }
        }

        $documento->modificar();
        $mensaje = 'modificado';
        break;

    case 'Eliminar':
        $documento = new DocumentoColaborador('id', $_REQUEST['id']);
        $idPersona = $documento->getIdPersona();
        $rutaAnterior = 'presentacion/sst/documentos/' . $documento->getRutaArchivo();

        if (file_exists($rutaAnterior)) {
            unlink($rutaAnterior);
        }

        $documento->eliminar();
        $mensaje = 'eliminado';
        break;
}

$rutaRedireccion = 'principal.php?CONTENIDO=presentacion/sst/documentos.php&idPersona=' . $idPersona . '&grupo=' . $grupo . '&mensaje=' . $mensaje;

if (!headers_sent()) {
    header('location: ' . $rutaRedireccion);
} else {
    echo "<script>window.location.href='" . $rutaRedireccion . "';</script>";
}
exit;
