<?php
@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona=new Persona('identificacion', $_REQUEST['idPersona']);


$lista = '';
$resultado = Complementaria::getListaEnObjetos("idPersona={$persona->getIdentificacion()}", null);
for ($i = 0; $i < count($resultado); $i++) {
  $agenda = $resultado[$i];
  $lista .= '<tr>';
  $lista .= "<td>{$agenda->getCursos()}</td>";
  $lista .= "<td>{$agenda->getInstitucion()}</td>";
  $lista .= "<td>{$agenda->getYear()}</td>";
  $lista .= "<td>{$agenda->getEstado()}</td>";
  $lista .= "<td><a href='presentacion/hojaDeVida/documentos/{$agenda->getArchivo()}' target='_blank' title='Ver su certficado'><img src='presentacion/img/pdf.png'></a></td>";
  $lista .= '<td>';
  $lista .= "<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/complementariaFormulario.php&accion=Modificar&id={$agenda->getId()}&idPersona={$persona->getIdentificacion()}'><img src='presentacion/img/modificar.png'></a>";
  $lista .= "<img src='presentacion/img/eliminar.png' onClick='eliminar({$agenda->getId()})'>";
  $lista .= '</td>';
  $lista .= '</tr>';
}
?>

<center>

  </br>
  <h4>6. FORMACIÓN COMPLEMENTARIA </h4>
  <P>¡Bien! Ahora vamos a añadir tu información complementaria</P>
  <p>Para el personal asistencial es de obligatoriedad relacionar y soportar los cursos requeridos por la norma 3100</p>
</center>

<br>

<table class="table table-hover">
  <tr class="table-success">
    <td>CURSOS O DIPLOMADOS</td>
    <td>INSTITUCIÓN</td>
    <td>FECHA DE REALIZACIÓN</td>
    <td>ESTADO</td>
    <td>ARCHIVO</td>
    <th><a href="principal.php?CONTENIDO=presentacion/hojaDeVida/complementariaFormulario.php&idPersona=<?=$persona->getIdentificacion()?>"><img src='presentacion/img/adicionar.png'></a></th>
  </tr>
  <?= $lista ?>
</table>

<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/academica.php&idPersona=<?=$persona->getIdentificacion()?>' class='m-2'><button type='button' class='btn btn-danger '>Atrás</button></a>
<a href='principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboral.php&idPersona=<?=$persona->getIdentificacion()?>'><button type='button' name='accion' class='btn btn-success'>Siguiente</button></a>

<script type="text/javascript">
  function eliminar(id) {
    var respuesta = confirm("Esta seguro de eliminar este registro");
    if (respuesta) location = "principal.php?CONTENIDO=presentacion/hojaDeVida/complementariaActualizar.php&accion=Eliminar&idPersona=<?= $persona->getIdentificacion() ?>&id=" + id;
  }
</script>