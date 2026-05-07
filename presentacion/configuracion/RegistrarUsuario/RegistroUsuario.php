<?php
include('../../../logica/clasesGenericas/ConectorBD.php');
include('../../../logica/clases/Cargos.php');

$cargo = new Cargos();

$cargosAll = $cargo->getCargos();



?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="windows-1252">


  <link rel="stylesheet" href="../../../presentacion/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../presentacion/css/estilos.css" />
  <title>Software de gestión de usuarios</title>
</head>

<body>
  <center>
    <h3>REGISTRAR USUARIO</h3>
  </center>
  <form name="formulario" method="post" action="registrarUsuarioBD.php">
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">NÚMERO DE IDENTIFICACIÓN: (*)</label>
      <input type="text" name="identificacion" class="form-control" maxlength="15" placeholder="Ingrese su identificacion: " required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">NOMBRES COMPLETOS: (*)</label>
      <input type="text" name="nombres" required class="form-control" placeholder="Ingrese sus nombres completos: ">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">APELLIDOS COMPLETOS: (*)</label>
      <input type="text" name="apellidos" class="form-control" placeholder="Ingrese sus apellidos completos: " required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">CLAVE: (*)</label>
      <input type="password" name="password" class="form-control" placeholder="Ingrese una clave" required>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">CARGO: (*)</label>
      <select class="form-select" name="cargo" id="">
        <?php
        foreach ($cargosAll[0] as $key => $value) {
          ?>
          <option value="<?= $value["id"] ?>"><?= $value["nombreCargo"] ?></option>
          <?php
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="exampleSelect1" class="form-label mt-4">ROL DE USUARIO: (*)</label>
      <select class="form-select" id="exampleSelect1" name="tipo" required>
        <option value="" disabled selected>Seleccione un rol de usuario</option>
        <option value="Colaborador">Colaborador</option>
        <option value="Contrato de Servicio">Contrato de Servicio</option> 
      </select>
    </div>

    </br>
    </br>
    <button type="submit" name="accion" class="btn btn-success" value="Registrarse">Registrarse</button>
    <button type="submit" name="accion" class="btn btn-danger" value="Cancelar">Cancelar</button>
  </form>

</body>

</html>
