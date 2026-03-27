<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new ReferenciaLaboral('id', $_REQUEST['id']);
} else $directorio = new ReferenciaLaboral(null, null);

$persona = new Persona('identificacion', $_REQUEST['idPersona']);

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/referenciaLaboralActualizar.php" enctype="multipart/form-data">
  <div class="form-group">
    <label class="form-label mt-4">EMPRESA: (*)</label>
    <input type="text" name="empresa" value="<?= $directorio->getEmpresa()  ?>" required class="form-control" placeholder="Ingrese el nombre de la empresa donde trabajó">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">NOMBRE DEL CONTACTO: (*)</label>
    <input type="tel" name="nombre" value="<?= $directorio->getNombre()  ?>" required class="form-control" placeholder="Ingrese el nombre del contacto">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">CARGO: (*)</label>
    <input type="text" name="cargo" value="<?= $directorio->getCargo()  ?>" required class="form-control" placeholder="Ingrese el cargo de la persona ">
  </div>
  <div class="form-group">
    <label class="form-label mt-4">TELEFONO: (*)</label>
    <input type="text" name="telefono" value="<?= $directorio->getTelefono()  ?>" required class="form-control" placeholder="Ingrese el número de telefono de la persona">
  </div>
  <p>
  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">ADJUNTE SU REFERENCIA LABORAL: (*)</label>
    <input class="form-control" type="file" name="archivo" required id="formFile" value="<?= $directorio->getArchivo()  ?>">
  </div>
  <br>
  <br>

  <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
  <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>" />
  <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
  <a href="principal.php?CONTENIDO=presentacion/hojaDeVida/referenciasLaborales.php&idPersona=<?= $persona->getIdentificacion() ?>" class="btn btn-danger">Cancelar</a>
</form>