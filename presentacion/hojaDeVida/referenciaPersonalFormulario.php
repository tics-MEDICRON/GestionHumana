<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new ReferenciaPersonal('id', $_REQUEST['id']);
} else $directorio = new ReferenciaPersonal(null, null);

$persona = new Persona('identificacion', $_REQUEST['idPersona']);

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/referenciaPersonalActualizar.php" enctype="multipart/form-data">
  <div class="form-group">
    <label class="form-label mt-4">NOMBRE: (*)</label>
    <input type="text" name="nombre" value="<?= $directorio->getNombre()  ?>" required class="form-control" placeholder="Ingrese sus nombres y apellidos">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">PARENTESCO: (*)</label>
    <input type="tel" name="parentesco" value="<?= $directorio->getParentesco()  ?>" required class="form-control" placeholder="Ingrese el parentesco">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">OCUPACION: (*)</label>
    <input type="text" name="ocupacion" value="<?= $directorio->getOcupacion()  ?>" required class="form-control" placeholder="Ingrese la ocupacion">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">TELEFONO: (*)</label>
    <input type="text" name="telefono" value="<?= $directorio->getTelefono()  ?>" required class="form-control" placeholder="Ingrese el número de telefono">
  </div>
  </P>
  <div class="form-group row">
    <label class="form-label mt-2">ADJUNTE SU REFERENCIA PERSONAL: (*)</label>
    <input class="form-control" type="file" name="archivo" required id="formFile" value="<?= $directorio->getArchivo()  ?>">
  </div>
  <br>
  <br>

  <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
  <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a href="principal.php?CONTENIDO=presentacion/hojaDeVida/referenciaPersonal.php&idPersona=<?= $persona->getIdentificacion() ?>" class="btn btn-danger">Cancelar</a>
</form>