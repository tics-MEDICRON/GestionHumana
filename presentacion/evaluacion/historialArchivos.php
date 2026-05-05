<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$USUARIO = unserialize($_SESSION['usuario']);
$idPersona = isset($_REQUEST['idPersona']) ? $_REQUEST['idPersona'] : '';

if ($USUARIO->getTipoEnObjeto() == "Colaborador") {
    $idPersona = $USUARIO->getIdentificacion();
}

$idPersonaSeguro = str_replace("'", "''", $idPersona);
$persona = Persona::validarIdentificacion($idPersonaSeguro);
$nombrePersona = $persona != null ? $persona->__toString() : $idPersona;

$cadenaSQL = "select historialevaluacion.id, historialevaluacion.fecha, historialevaluacion.evaluacionPdf
    from historialevaluacion
    where historialevaluacion.idPersona = '$idPersonaSeguro'
    order by historialevaluacion.fecha desc, historialevaluacion.id desc";
$resultado = ConectorBD::ejecutaryQuery($cadenaSQL);

$lista = '';
for ($i = 0; $i < count($resultado); $i++) {
    $archivo = $resultado[$i];
    $lista .= '<tr>';
    $lista .= "<td>{$archivo['id']}</td>";
    $lista .= "<td>{$archivo['fecha']}</td>";
    $lista .= "<td><a href='presentacion/evaluacion/documentos/{$archivo['evaluacionPdf']}' target='_blank' title='Ver archivo'><img src='presentacion/img/pdf.png'></a></td>";
    $lista .= "<td>{$archivo['evaluacionPdf']}</td>";

    if ($USUARIO->getTipoEnObjeto() != "Colaborador") {
        $lista .= '<td>';
        $lista .= "<a href='principal.php?CONTENIDO=presentacion/evaluacion/historialFormulario.php&accion=Modificar&id={$archivo['id']}' title='Modificar'><img src='presentacion/img/modificar.png'></a>";
        $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$archivo['id']})' title='Eliminar'>";
        $lista .= '</td>';
    }

    $lista .= '</tr>';
}

?>

<center>
    <h1>ARCHIVOS DE EVALUACIONES DE DESEMPE&Ntilde;O</h1>
    <h4><?= htmlspecialchars($nombrePersona, ENT_QUOTES, 'UTF-8') ?></h4>
</center>

<br>

<?php if ($USUARIO->getTipoEnObjeto() != "Colaborador") { ?>
    <a class="btn btn-success" href="principal.php?CONTENIDO=presentacion/evaluacion/historialFormulario.php&idPersona=<?= $idPersona ?>">Adicionar archivos</a>
    <a class="btn btn-secondary" href="principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php">Volver</a>
    <br><br>
<?php } ?>

<table class="table table-hover">
    <tr class="table-success">
        <th scope="row">ID</th>
        <td>FECHA</td>
        <td>VER</td>
        <td>ARCHIVO</td>
        <?php if ($USUARIO->getTipoEnObjeto() != "Colaborador") { ?>
            <td>ACCIONES</td>
        <?php } ?>
    </tr>
    <?= $lista ?>
</table>

<script type="text/javascript">
    function eliminar(id) {
        var respuesta = confirm("Esta seguro de eliminar este archivo");
        if (respuesta) location = "principal.php?CONTENIDO=presentacion/evaluacion/historialActualizar.php&accion=Eliminar&id=" + id;
    }
</script>
