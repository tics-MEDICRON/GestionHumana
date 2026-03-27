<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="windows-1252">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/estilos.css" />
    <title>Gestion Humana</title>
</head>

<body>

    <center>
        <br>
        <h3>CAMBIAR CONTRASEÑA</h3>

        <form name="formulario" method="post" action="passwordActualizar.php">

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Número de identificacion: (*)</label>
                <input type="text" name="identificacion" required class="form-control" placeholder="Ingrese el número del documento">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Nueva contraseña: (*)</label>
                <input type="password" name="password" required class="form-control" placeholder="Ingrese su nueva contraseña">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">Repita la nueva contraseña: (*)</label>
                <input type="password" name="password2" required class="form-control" placeholder="Confirme su nueva contraseña">
            </div>

            <br>
            <br>

            <button type="submit" name="accion" class="btn btn-success" value="actualizar">Cambiar Clave</button>
        </form>
    </center>

</body>

</html>