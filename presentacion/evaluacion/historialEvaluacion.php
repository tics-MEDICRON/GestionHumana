<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');

$USUARIO = unserialize($_SESSION['usuario']);

if ($USUARIO->getTipoEnObjeto() == "Colaborador") {
    $_REQUEST['idPersona'] = $USUARIO->getIdentificacion();
    include 'presentacion/evaluacion/historialArchivos.php';
    return;
}

$filtro = '';
$buscar = isset($buscar) ? trim($buscar) : '';

if (isset($buscador) && $buscar != '') {
    $buscarSeguro = str_replace("'", "''", strtoupper($buscar));
    $filtro = "upper(persona.identificacion) like '%$buscarSeguro%' or upper(persona.nombres) like '%$buscarSeguro%' or upper(persona.apellidos) like '%$buscarSeguro%'";
}

$resultado = HistorialEvaluacion::getResumenPorPersona($filtro, null);
$lista = '';

for ($i = 0; $i < count($resultado); $i++) {
    $persona = $resultado[$i];
    $idPersona = $persona['identificacion'];
    $nombreCompleto = $persona['nombres'] . ' ' . $persona['apellidos'];
    $totalArchivos = $persona['totalArchivos'];
    $ultimaFecha = $persona['ultimaFecha'] != '' ? $persona['ultimaFecha'] : 'Sin archivos';

    $lista .= '<tr>';
    $lista .= "<td>{$idPersona}</td>";
    $lista .= "<td>{$nombreCompleto}</td>";
    $lista .= "<td>{$totalArchivos}</td>";
    $lista .= "<td>{$ultimaFecha}</td>";
    $lista .= '<td>';
    $lista .= "<a class='btn btn-sm btn-info' href='principal.php?CONTENIDO=presentacion/evaluacion/historialArchivos.php&idPersona={$idPersona}'>Ver archivos</a>";
    $lista .= '</td>';
    $lista .= '</tr>';
}

?>

<center>
    <h1>HISTORIAL DE EVALUACIONES DE DESEMPE&Ntilde;O</h1>
</center>

<br>

<form method="post" action="principal.php?CONTENIDO=presentacion/evaluacion/historialEvaluacion.php" class="d-flex">
    <input class="form-control me-sm-3" type="text" name="buscar" id="buscar" value="<?= htmlspecialchars($buscar, ENT_QUOTES, 'UTF-8') ?>" placeholder="Buscador" title="Ingrese el valor que desea buscar y presione el boton buscar">
    <button class="btn btn-secondary my-2 my-sm-0" name="buscador" id="buscador" type="submit" value="Buscar">Buscar</button>
</form>

<br>

<table class="table table-hover">
    <tr class="table-success">
        <th scope="row">IDENTIFICACION</th>
        <td>PERSONA</td>
        <td>ARCHIVOS</td>
        <td>ULTIMA FECHA</td>
        <td>ACCIONES</td>
    </tr>
    <?= $lista ?>
</table>
