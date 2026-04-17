<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);

$grupo = isset($_REQUEST['grupo']) ? $_REQUEST['grupo'] : 'examenes';
TipoDocumentoColaborador::sincronizarTipos();
$tituloGrupo = TipoDocumentoColaborador::getTituloGrupo($grupo);

$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
    $titulo = 'Modificar';
    $documento = new DocumentoColaborador('id', $_REQUEST['id']);
    $idPersona = $documento->getIdPersona();
} else {
    $documento = new DocumentoColaborador(null, null);
    $idPersona = isset($_REQUEST['idPersona']) ? $_REQUEST['idPersona'] : $USUARIO->getIdentificacion();
}

if ($USUARIO->getTipoEnObjeto() == "Colaborador" || $USUARIO->getTipoEnObjeto() == "Contrato de Servicio") {
    $idPersona = $USUARIO->getIdentificacion();
}

$persona = new Persona('identificacion', $idPersona);
$tipos = TipoDocumentoColaborador::getListaPorGrupo($grupo);
?>

<style>
    .cargando-sst {
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, 0.85);
        display: none;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        z-index: 9999;
    }

    .cargando-sst.activo {
        display: flex;
    }

    .cargando-sst__spinner {
        width: 54px;
        height: 54px;
        border: 6px solid #d9d9d9;
        border-top-color: #198754;
        border-radius: 50%;
        animation: giro-sst 0.8s linear infinite;
        margin-bottom: 12px;
    }

    @keyframes giro-sst {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div id="cargandoSst" class="cargando-sst">
    <div class="cargando-sst__spinner"></div>
    <strong>Guardando documento...</strong>
    <span>Por favor espera un momento.</span>
</div>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/sst/documentoActualizar.php" enctype="multipart/form-data">

    <div class="form-group">
        <label class="form-label mt-4">MODULO:</label>
        <input type="text" class="form-control" value="<?= $tituloGrupo ?>" readonly>
    </div>

    <div class="form-group">
        <label class="form-label mt-4">PERSONAL:</label>
        <input type="text" class="form-control" value="<?= $persona ?>" readonly>
    </div>

    <div class="form-group">
        <label class="form-label mt-4">TIPO DE DOCUMENTO:</label>
        <select class="form-select" name="idTipoDocumento" required>
            <option value="">Seleccione</option>
            <?php
            for ($i = 0; $i < count($tipos); $i++) {
                $selected = $documento->getIdTipoDocumento() == $tipos[$i]['id'] ? 'selected' : '';
                $nombreVisible = TipoDocumentoColaborador::getNombreVisible($tipos[$i]['nombre']);
                echo "<option value='{$tipos[$i]['id']}' $selected>{$nombreVisible}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label mt-4">FECHA DEL DOCUMENTO:</label>
        <input type="date" name="fechaDocumento" value="<?= $documento->getFechaDocumento() ?>" class="form-control">
    </div>

    <div class="form-group">
        <label class="form-label mt-4">VIGENTE:</label>
        <select class="form-select" name="vigente" required>
            <option value="1" <?= $documento->getVigente() === null || $documento->getVigente() == 1 ? 'selected' : '' ?>>Si</option>
            <option value="0" <?= $documento->getVigente() == 0 && $documento->getVigente() !== null ? 'selected' : '' ?>>No</option>
        </select>
    </div>

    <div class="form-group row">
        <label class="form-label mt-4">ARCHIVO:</label>
        <input class="form-control" type="file" name="archivo" <?= $titulo == 'Adicionar' ? 'required' : '' ?> id="formFile" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
        <?php
        if ($titulo == 'Modificar' && $documento->getNombreOriginal() != null) {
            echo "<small>Archivo actual: {$documento->getNombreOriginal()}</small>";
        }
        ?>
    </div>

    <br>

    <input type="hidden" name="id" value="<?= $documento->getId() ?>" />
    <input type="hidden" name="idPersona" value="<?= $idPersona ?>" />
    <input type="hidden" name="grupo" value="<?= $grupo ?>" />
    <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
    <button type="button" class="btn btn-danger" onclick="location='principal.php?CONTENIDO=presentacion/sst/documentos.php&idPersona=<?= $idPersona ?>&grupo=<?= $grupo ?>'">Cancelar</button>
</form>

<script type="text/javascript">
    document.forms.formulario.addEventListener('submit', function() {
        document.getElementById('cargandoSst').classList.add('activo');
    });
</script>
