<?php
@session_start();
if (!isset($_SESSION['usuario']))
    header('location: ../../index.php?mensaje=Acceso no autorizado');
$persona = new EditUser('identificacion', $_REQUEST['idPersona']);


?>


<center>
    </br>
    <h4>Editar usuario</h4>
    <P>Aquí podrás editar los datos del usuario</P>
</center>

<form name="formulario" method="post" action="principal.php?CONTENIDO=presentacion/hojaDeVida/editUserActualizar.php">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Numero de Identificación: </label>
        <div class="col-sm-2">
            <input type="text" name="identificacion" class="form-control" value="<?= $persona->getId() ?>"
                required>
        </div>
        <label class="col-sm-2 col-form-label">Nombres </label>
        <div class="col-sm-2">
            <input type="text" name="nombres" class="form-control" value="<?= $persona->getNombre() ?>" required>
        </div>
        <label class="col-sm-2 col-form-label">Apellidos </label>
        <div class="col-sm-2">
            <input type="text" name="apellidos" class="form-control" value="<?= $persona->getApellidos() ?>" required>
        </div>

        <label class="col-sm-2 col-form-label">Cargo </label>
        <div class="col-sm-2">
            <input type="text" name="cargo" class="form-control" value="<?= $persona->getCargo() ?>" required>
        </div>
        <label class="col-sm-2 col-form-label">Contraseña </label>
        <div class="col-sm-2">
            <input type="password" name="password" value="<?= $persona->getPassword() ?>" class="form-control" required>
        </div>
    </div>
    </br>
    </br>
    </br>
    <button type="submit" name="accion" class="btn btn-primary" value="Modificar">Modificar</button>
</form>

