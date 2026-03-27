<?php

@session_start();
if (!isset($_SESSION['usuario'])) header('location: ../../index.php?mensaje=Acceso no autorizado');
$titulo = 'Adicionar';
if (isset($_REQUEST['id'])) {
  $titulo = 'Modificar';
  $directorio = new Laboral('id', $_REQUEST['id']);
} else $directorio = new Laboral(null, null);

$persona=new Persona('identificacion', $_REQUEST['idPersona']);

?>
<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDevida/formacionLaboralActualizar.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">EMPRESA: (*)</label>
    <input type="text" name="empresa" value="<?= $directorio->getEmpresa()  ?>" required class="form-control" placeholder="Ingrese el nombre de la empresa donde trabajó">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">TELEFONO: (*)</label>
    <input type="tel" name="telefono" value="<?= $directorio->getTelefono()  ?>" required class="form-control" placeholder="Ingrese el telefono de la empresa donde trabajó">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">CARGO DESEMPEÑADO (*)</label>
    <input type="text" name="cargo" value="<?= $directorio->getCargo()  ?>" required class="form-control" placeholder="Ingrese que cargo desempeñado">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">DESDE: (*)</label>
    <input type="date" name="desde" value="<?= $directorio->getDesde()  ?>" required class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">HASTA: (*)</label>
    <input type="date" name="hasta" value="<?= $directorio->getHasta()  ?>" required class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label mt-4">MOTIVO RETIRO: (*)</label>
    <input type="text" name="retiro" value="<?= $directorio->getMotivoRetiro()  ?>" required class="form-control" placeholder="Ingrese el motivo del retiro de la empresa">
  </div>
  <br>
  <div class="form-group row">
    <label for="formFile" class="form-label mt-2">ADJUNTE SU EVIDENCIA: (*)</label>
    <input class="form-control" type="file" name="archivo" required id="formFile" value="<?= $directorio->getArchivo()  ?>">
  </div>
  <p>
    <br>
    <br>

    <input type="hidden" name="id" value="<?= $directorio->getId() ?>" />
    <input type="hidden" name="idPersona" value="<?= $persona->getIdentificacion() ?>" />
    <button type="submit" name="accion" class="btn btn-success" value="<?= $titulo ?>"><?= $titulo ?></button>
    <a href="principal.php?CONTENIDO=presentacion/hojaDeVida/formacionLaboral.php&idPersona=<?= $persona->getIdentificacion() ?>" class="btn btn-danger">Cancelar</a>

    
</form>