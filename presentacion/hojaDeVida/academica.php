<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new Persona('identificacion', $_REQUEST['idPersona']);

$lista = '';
$resultado = Academica::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);
for ($i = 0; $i < count($resultado); $i++) {
  $academica = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$academica->getNivel()}</td>";
  $lista .= "<td>{$academica->getTitulo()}</td>";
  $lista .= "<td>{$academica->getInstitucion()}</td>";
  $lista .= "<td>{$academica->getNumSemestres()}</td>";
  $lista .= "<td>{$academica->getFechaGrado()}</td>";
  $lista .= "<td>{$academica->getEstado()}</td>";
  $lista .= "<td><a href='presentacion/hojaDeVida/documentos/{$academica->getArchivo()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a></td>";
  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/academicaFormulario.php&accion=Modificar&id={$academica->getId()}&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/modificar.png'></a>";
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
  <h4>5. INFORMACIÓN ACADEMICA </h4>
  <P>¡Bien! Ahora vamos a añadir tu información academica</P>
</center>

<br>


<table class="table table-hover">
  <tr class="table-success">
    <th scope="row">NIVEL</th>
    <td>TITULO OBTENIDO</td>
    <td>INSTITUCIÓN QUE OTORGA EL TITULO</td>
    <td>NO SEMESTRES CURSADOS</td>
    <td>FECHA GRADO MES/AÑO</td>
    <td>ESTADO</td>
    <td>ARCHIVO</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/academicaFormulario.php&idPersona=<?= $persona->getIdentificacion()?> "><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<?php
  if($lista != ""){
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/contactoEmergencia.php&idPersona=".$persona->getIdentificacion()."' class='m-2'><button type='button' class='btn btn-danger '>Atrás</button></a>";
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/hvDatosActualizarComplementaria.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>";
  }
?>



<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/academicaActualizar.php&accion=Eliminar&idPersona=<?= $persona->getIdentificacion() ?>&id=" + id;
  }
</script>