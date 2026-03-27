<!DOCTYPE html>

<?php
session_start();
session_unset();
session_destroy();
$mensaje = '';
if (isset($_REQUEST['mensaje'])) $mensaje = $_REQUEST['mensaje'];

$mensaje2 = '';
if (isset($_REQUEST['mensaje2'])) $mensaje2 = $_REQUEST['mensaje2'];
?>

<head>
  <meta charset="windows-1252">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="presentacion/fonts/icomoon/style.css">

  <link rel="stylesheet" href="presentacion//css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="presentacion/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">
  <title>Gestion Humana</title>
</head>

<body>

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('presentacion/img/medicron.jpg');"></div>

    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <center>
          <td></td><td></td><img class='fotos' src='presentacion/img/logo.jpg' width='450' height='300' />
            </center>
          
            <p>
              <font color='green'><?= $mensaje2 ?></font>
            </p>
            <p>
              <font color='red'><?= $mensaje ?></font>
            </p>
            <h5><strong>INICIO DE SESIÓN</strong></h5>
            <form action="control/validar.php" method="post">
              <div class="form-group first">
                <label for="username" class="text-info">Usuario</label>
                <input type="identificacion" class="form-control" placeholder="ingrese su numero identificacion" name="persona" required>
              </div>
              <div class="form-group last mb-3">
                <label for="password" class="text-info">Clave</label>
                <input type="password" class="form-control" placeholder="ingrese su clave" name="clave" required>
              </div>

              </br>
              <input type="submit" name="submit" value="Ingresar" class="btn btn-block btn-info">

            </form>
            </br>
            <p>¿No tienes una cuenta? <a href="presentacion/configuracion/RegistrarUsuario/RegistroUsuario.php" class="gradient-text">Crear una cuenta</a></p>
            <div class="input-link">
            <a href="presentacion/cambiarClave/passwordFormulario.php" class="gradient-text">¿Has Olvidado tu contraseña?</a>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>