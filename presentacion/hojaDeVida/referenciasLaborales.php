<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new Persona('identificacion', $_REQUEST['idPersona']);


$lista = '';
$resultado = ReferenciaLaboral::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);
for ($i = 0; $i < count($resultado); $i++) {
  $academica = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$academica->getEmpresa()}</td>";
  $lista .= "<td>{$academica->getNombre()}</td>";
  $lista .= "<td>{$academica->getCargo()}</td>";
  $lista .= "<td>{$academica->getTelefono()}</td>";
  $lista .= "<td><a href='presentacion/hojaDeVida/documentos/{$academica->getArchivo()}' target='_blank' title='Ver su evidencia'><img src='presentacion/img/pdf.png'></a></td>";
  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaLaboralFormulario.php&accion=Modificar&id={$academica->getId()}&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/modificar.png'></a>";
  $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$academica->getId()})'>";
  $lista .= '</td>';
  $lista .= '</tr>';
}
?>

<center>
  </br>
  <h4>8. REFERENCIAS LABORALES </h4>
  <P>¡Bien! Ahora vamos a añadir tu información de tus referencias laborales.</P>
  <p>(Minimo registrar dos referencias laborales)</p>
</center>

<br>


<table class="table table-hover">
  <tr class="table-success">
    <th scope="row">EMPRESA</th>
    <td>NOMBRE DEL CONTACTO</td>
    <td>CARGO</td>
    <td>TELEFONO</td>
    <td>ARCHIVO</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaLaboralFormulario.php&idPersona=<?= $persona->getIdentificacion()?> "><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<?php
  if($lista != ""){
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboral.php&idPersona=".$persona->getIdentificacion()."' class='m-2'><button type='button' class='btn btn-danger '>Atrás</button></a>";
    echo "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaPersonal.php&idPersona={$persona->getIdentificacion()}'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>";
  }
?>



<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaLaboralActualizar.php&accion=Eliminar&idPersona=<?= $persona->getIdentificacion() ?>&id=" + id;
  }
</script>