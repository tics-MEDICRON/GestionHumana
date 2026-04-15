<?php
@session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../../index.php?mensaje=Acceso no autorizado');
    exit;
}

require_once '../../logica/clasesGenericas/ConectorBD.php';
require_once '../../logica/clases/Persona.php';
require_once '../../logica/clases/TipoPersona.php';
require_once '../../logica/clases/TipoDocumentoColaborador.php';

$USUARIO = unserialize($_SESSION['usuario']);
$grupo = isset($_REQUEST['grupo']) ? $_REQUEST['grupo'] : 'examenes';
$buscar = isset($_REQUEST['buscar']) ? trim($_REQUEST['buscar']) : '';

TipoDocumentoColaborador::sincronizarTipos();
$tituloGrupo = TipoDocumentoColaborador::getTituloGrupo($grupo);
$idsTiposSst = TipoDocumentoColaborador::getIdsPorGrupo($grupo);
$filtroTipos = count($idsTiposSst) > 0 ? implode(',', $idsTiposSst) : '0';

$condiciones = array();
$condiciones[] = "dc.id_tipo_documento in ($filtroTipos)";

if ($USUARIO->getTipoEnObjeto() == "Colaborador" || $USUARIO->getTipoEnObjeto() == "Contrato de Servicio") {
    $identificacionUsuario = $USUARIO->getIdentificacion();
    $condiciones[] = "p.identificacion = '$identificacionUsuario'";
} elseif ($buscar !== '') {
    $buscarSeguro = str_replace("'", "''", $buscar);
    if (is_numeric($buscarSeguro)) {
        $condiciones[] = "(p.identificacion like '%$buscarSeguro%' or p.nombres = '$buscarSeguro' or p.apellidos = '$buscarSeguro')";
    } else {
        $condiciones[] = "(p.identificacion like '%$buscarSeguro%' or p.nombres like '%$buscarSeguro%' or p.apellidos like '%$buscarSeguro%')";
    }
}

$where = 'where ' . implode(' and ', $condiciones);
$cadenaSQL = "select 
    p.identificacion,
    p.nombres,
    p.apellidos,
    p.tipo,
    c.nombreCargo as cargo,
    hp.tipoDocumento,
    tdc.nombre as tipo_documento_cargado,
    dc.fecha_documento,
    dc.vigente,
    dc.nombre_original
from documento_colaborador dc
inner join persona p on p.identificacion = dc.id_persona
left join cargos c on c.id = p.cargo
left join historiaprueba hp on hp.idPersona = p.identificacion
inner join tipo_documento_colaborador tdc on tdc.id = dc.id_tipo_documento
$where
order by p.nombres, p.apellidos, dc.fecha_documento desc, dc.id desc";

$registros = ConectorBD::ejecutaryQuery($cadenaSQL);
$nombreArchivo = strtolower($tituloGrupo) . '_' . date('Ymd_His') . '.xls';

header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=' . $nombreArchivo);
header('Pragma: no-cache');
header('Expires: 0');
?>
<html>
<head>
    <meta charset="iso-8859-1">
    <style>
        table {
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            font-weight: bold;
        }

        .texto {
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>TIPO DOCUMENTO IDENTIDAD</th>
            <th>IDENTIFICACION</th>
            <th>NOMBRES</th>
            <th>APELLIDOS</th>
            <th>TIPO</th>
            <th>CARGO</th>
            <th>TIPO DOCUMENTO</th>
            <th>FECHA DOCUMENTO</th>
            <th>VIGENTE</th>
            <th>ARCHIVO</th>
        </tr>
        <?php
        for ($i = 0; $i < count($registros); $i++) {
            $registro = $registros[$i];
            $vigente = isset($registro['vigente']) && $registro['vigente'] == 1 ? 'Si' : 'No';
            $tipoDocumentoIdentidad = isset($registro['tipoDocumento']) ? $registro['tipoDocumento'] : '';
            $tipoDocumentoCargado = isset($registro['tipo_documento_cargado']) ? $registro['tipo_documento_cargado'] : '';
            $cargo = isset($registro['cargo']) ? $registro['cargo'] : '';
            $fechaDocumento = isset($registro['fecha_documento']) && $registro['fecha_documento'] != null
                ? date('d/m/Y', strtotime($registro['fecha_documento']))
                : '';
            $archivo = isset($registro['nombre_original']) ? $registro['nombre_original'] : '';
        ?>
            <tr>
                <td><?= htmlspecialchars($tipoDocumentoIdentidad) ?></td>
                <td><?= htmlspecialchars($registro['identificacion']) ?></td>
                <td class="texto"><?= htmlspecialchars($registro['nombres']) ?></td>
                <td class="texto"><?= htmlspecialchars($registro['apellidos']) ?></td>
                <td><?= htmlspecialchars($registro['tipo']) ?></td>
                <td class="texto"><?= htmlspecialchars($cargo) ?></td>
                <td><?= htmlspecialchars($tipoDocumentoCargado) ?></td>
                <td style="mso-number-format:'dd/mm/yyyy';"><?= htmlspecialchars($fechaDocumento) ?></td>
                <td><?= htmlspecialchars($vigente) ?></td>
                <td class="texto"><?= htmlspecialchars($archivo) ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
