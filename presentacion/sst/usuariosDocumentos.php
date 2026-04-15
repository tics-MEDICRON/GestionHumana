<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$USUARIO = unserialize($_SESSION['usuario']);

$grupo = isset($_REQUEST['grupo']) ? $_REQUEST['grupo'] : 'examenes';
TipoDocumentoColaborador::sincronizarTipos();
$tituloGrupo = TipoDocumentoColaborador::getTituloGrupo($grupo);
$filtro = '';
$buscar = isset($_REQUEST['buscar']) ? trim($_REQUEST['buscar']) : '';

if (isset($buscador)) {
    if (is_numeric($buscar)) {
        $filtro = "identificacion like '%" . strtoupper($buscar) . "%' or nombres = $buscar or apellidos = $buscar";
    } else {
        $filtro = "identificacion like '%" . strtoupper($buscar) . "%' or nombres like '%" . strtoupper($buscar) . "%' or apellidos like '%" . strtoupper($buscar) . "%'";
    }
}

$lista = '';

if ($USUARIO->getTipoEnObjeto() == "Colaborador" || $USUARIO->getTipoEnObjeto() == "Contrato de Servicio") {
    $resultado = Persona::getListaEnObjetos("identificacion = '{$USUARIO->getIdentificacion()}'", null);
} else {
    $resultado = Persona::getListaEnObjetos($filtro, null);
}

for ($i = 0; $i < count($resultado); $i++) {
    $persona = $resultado[$i];
    $lista .= '<tr>';
    $lista .= "<td>{$persona->getIdentificacion()}</td>";
    $lista .= "<td>{$persona->getNombres()}</td>";
    $lista .= "<td>{$persona->getApellidos()}</td>";
    $lista .= "<td>{$persona->getTipo()}</td>";
    $lista .= "<td>{$persona->getCargo()}</td>";
    $lista .= '<td>';
    $lista .= "<a href='principal.php?CONTENIDO=presentacion/sst/documentos.php&idPersona={$persona->getIdentificacion()}&grupo={$grupo}' title='Gestionar documentos'><img src='presentacion/img/hojaVida.png'></a>";
    $lista .= '</td>';
    $lista .= '</tr>';
}
?>

<center>
    <h1><?= $tituloGrupo ?></h1>
</center>

</br>
</br>

<?php
if ($USUARIO->getTipoEnObjeto() == "Administrador") {
    echo "<form method='post' action='principal.php?CONTENIDO=presentacion/sst/usuariosDocumentos.php&grupo={$grupo}' class='d-flex'>
    <input class='form-control me-sm-3' type='text' name='buscar' id='buscar' value='{$buscar}' placeholder='Buscador' title='Ingrese el valor que desea buscar y presione el boton buscar'>
    <button class='btn btn-secondary my-2 my-sm-0' name='buscador' id='buscador' type='submit' value='Buscar'>Buscar</button>
  </form>";
}
?>

<br>

<div class="mb-3">
    <a href="presentacion/sst/exportarDocumentosExcel.php?grupo=<?= urlencode($grupo) ?>&buscar=<?= urlencode($buscar) ?>" class="btn btn-success">Exportar Excel</a>
</div>

<table class="table table-hover">
    <tr class="table-success">
        <th scope="row">IDENTIFICACION</th>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>TIPO</td>
        <td>CARGO</td>
        <td></td>
    </tr>
    <?= $lista ?>
</table>