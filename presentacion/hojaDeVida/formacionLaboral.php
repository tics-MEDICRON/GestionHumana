<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new Persona('identificacion', $_REQUEST['idPersona']);

$lista = '';
$resultado = Laboral::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);
for ($i = 0; $i < count($resultado); $i++) {
  $academica = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$academica->getEmpresa()}</td>";
  $lista .= "<td>{$academica->getTelefono()}</td>";
  $lista .= "<td>{$academica->getCargo()}</td>";
  $lista .= "<td>{$academica->getDesde()}</td>";
  $lista .= "<td>{$academica->getHasta()}</td>";
  $lista .= "<td>{$academica->getMotivoRetiro()}</td>";
  $lista .= "<td><a href='presentacion/hojaDeVida/documentos/{$academica->getArchivo()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a></td>";
  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboralFormulario.php&accion=Modificar&id={$academica->getId()}&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/modificar.png'></a>";
  $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$academica->getId()})'>";
  $lista .= '</td>';
  $lista .= '</tr>';
}
?>

<table class="table table" border="5">
  <tr>
    <th scope="col"><img src="presentacion/img/medicronLogo.png" width="250"></th>
    <th scope="col">
      <center>
        <h2>HOJA DE VIDA PERSONAL</h2>
        <center>
    </th>
    <th scope="col">VERSIÓN: 00</th>
    <th scope="col">EDICION: SEPTIEMBRE DE 2022</th>
    <th scope="col">CODIGO: FR-AST-15</th>
  </tr>
</table>

<center>

  </br>
  <h4>7. INFORMACIÓN LABORAL DE OTRAS EMPRESAS </h4>
  <P>¡Bien! Ahora vamos a añadir tu información laboral de otras empresas.</P>
</center>

<br>


<table class="table table-hover">
  <tr class="table-success">
    <th scope="row">EMPRESA</th>
    <td>TELEFONO</td>
    <td>CARGO DESEMPEÑADO</td>
    <td>DESDE</td>
    <td>HASTA</td>
    <td>MOTIVO DE RETIRO</td>
    <td>EVIDENCIA</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboralFormulario.php&idPersona=<?= $persona->getIdentificacion()?> "><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<?php
  
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarComplementaria.php&idPersona=".$persona->getIdentificacion()."' class='m-2'><button type='button' class='btn btn-danger '>Atrás</button></a>";
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/referenciasLaborales.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>";

?>


<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboralActualizar.php&accion=Eliminar&idPersona=<?= $persona->getIdentificacion() ?>&id=" + id;
  }
</script>