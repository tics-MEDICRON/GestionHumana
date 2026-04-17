<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);

$grupo = isset($_REQUEST['grupo']) ? $_REQUEST['grupo'] : 'examenes';
TipoDocumentoColaborador::sincronizarTipos();
$tituloGrupo = TipoDocumentoColaborador::getTituloGrupo($grupo);

$idPersona = isset($_REQUEST['idPersona']) ? $_REQUEST['idPersona'] : $USUARIO->getIdentificacion();
if ($USUARIO->getTipoEnObjeto() == "Colaborador" || $USUARIO->getTipoEnObjeto() == "Contrato de Servicio") {
    $idPersona = $USUARIO->getIdentificacion();
}

$persona = new Persona('identificacion', $idPersona);
$idsTiposSst = TipoDocumentoColaborador::getIdsPorGrupo($grupo);
$filtroTipos = count($idsTiposSst) > 0 ? implode(',', $idsTiposSst) : '0';
$documentos = DocumentoColaborador::getListaEnObjetos("id_persona = '$idPersona' and id_tipo_documento in ($filtroTipos)", 'id_tipo_documento, created_at desc');
$mensaje = isset($_REQUEST['mensaje']) ? $_REQUEST['mensaje'] : '';
$lista = '';

for ($i = 0; $i < count($documentos); $i++) {
    $documento = $documentos[$i];
    $estado = $documento->getVigente() == 1 ? 'Si' : 'No';
    $fechaDocumento = $documento->getFechaDocumento() == null ? '' : $documento->getFechaDocumento();
    $tipoDocumentoVisible = TipoDocumentoColaborador::getNombreVisible($documento->getTipoDocumento());

    $lista .= '<tr>';
    $lista .= "<td>{$documento->getId()}</td>";
    $lista .= "<td>{$tipoDocumentoVisible}</td>";
    $lista .= "<td>{$fechaDocumento}</td>";
    $lista .= "<td>{$estado}</td>";
    $lista .= "<td><a href='presentacion/sst/documentos/{$documento->getRutaArchivo()}' target='_blank' title='{$documento->getNombreOriginal()}'><img src='presentacion/img/descargar.png'></a></td>";

    if ($USUARIO->getTipoEnObjeto() == "Administrador") {
        $lista .= '<td>';
        $lista .= "<a href='principal.php?CONTENIDO=presentacion/sst/documentoFormulario.php&accion=Modificar&id={$documento->getId()}&idPersona={$idPersona}&grupo={$grupo}' title='Modificar'><img src='presentacion/img/modificar.png'></a> ";
        $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$documento->getId()}, \"{$idPersona}\", \"{$grupo}\")' title='Eliminar'>";
        $lista .= '</td>';
    }

    $lista .= '</tr>';
}
?>

<center>
    <h1><?= $tituloGrupo ?> DE <?= $persona ?></h1>
</center>

</br>

<?php
if ($mensaje == 'adicionado') {
    echo "<div class='alert alert-success' role='alert'>Documento cargado correctamente.</div>";
} elseif ($mensaje == 'modificado') {
    echo "<div class='alert alert-success' role='alert'>Documento actualizado correctamente.</div>";
} elseif ($mensaje == 'eliminado') {
    echo "<div class='alert alert-warning' role='alert'>Documento eliminado correctamente.</div>";
}
?>

<div class="mb-3">
    <a href="principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo=<?= $grupo ?>" class="btn btn-secondary">Volver</a>
    <?php
    if ($USUARIO->getTipoEnObjeto() == "Administrador") {
        echo "<a href='principal.php?CONTENIDO=presentacion/sst/documentoFormulario.php&idPersona={$idPersona}&grupo={$grupo}' class='btn btn-success'>Adicionar documento</a>";
    }
    ?>
</div>

<table class="table table-hover">
    <tr class="table-success">
        <th scope="row">ID</th>
        <td>TIPO DOCUMENTO</td>
        <td>FECHA DOCUMENTO</td>
        <td>VIGENTE</td>
        <td>ARCHIVO</td>
        <?php
        if ($USUARIO->getTipoEnObjeto() == "Administrador") {
            echo '<td></td>';
        }
        ?>
    </tr>
    <?= $lista ?>
</table>

<script type="text/javascript">
    function eliminar(id, idPersona, grupo) {
        var respuesta = confirm("Esta seguro de eliminar este registro");
        if (respuesta) location = "principal.php?CONTENIDO=presentacion/sst/documentoActualizar.php&accion=Eliminar&id=" + id + "&idPersona=" + idPersona + "&grupo=" + grupo;
    }
</script>
