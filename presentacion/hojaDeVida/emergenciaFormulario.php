<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new ContactoEmergencia('id', $_REQUEST['id']);
} else $directorio = new ContactoEmergencia(null, null);
$persona=new Persona('identificacion', $_REQUEST['idPersona']);

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/emergenciaActualizar.php">
  <div class="form-group">
    <label class="form-label mt-4">NOMBRES Y APELLIDOS: (*)</label>
    <input type="text" name="nombre" value="<?= $directorio->getNombre()  ?>" required class="form-control" placeholder="Ingrese sus nombres y apellidos">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">OCUPACIÓN: (*)</label>
    <input type="tel" name="ocupacion" value="<?= $directorio->getOcupacion()  ?>" required class="form-control" placeholder="Ingrese una ocupacion">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">PARENTESCO: (*)</label>
    <input type="text" name="parentesco" value="<?= $directorio->getParentesco()  ?>" required class="form-control" placeholder="Ingrese el parentesco">
  </div>

  <div class="form-group">
    <label class="form-label mt-4">TELEFONO: </label>
    <input type="tel" name="telefonoEmergencia" value="<?= $directorio->getTelefonoEmergencia()  ?>" class="form-control" placeholder="Ingrese el número de telefono">
  </div>
  <p>
    <br>
    <br>

    <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
    <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>" />
    <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
    <a href="principal.php?CONTENIDO=presentacion/hojaDeVida/contactoEmergencia.php&idPersona=<?= $persona->getIdentificacion() ?>" class="btn btn-danger">Cancelar</a>
</form>