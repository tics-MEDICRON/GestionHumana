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
<html lang="es">
<head>
  <meta charset="windows-1252">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="presentacion/fonts/icomoon/style.css">
  <link rel="stylesheet" href="presentacion/css/owl.carousel.min.css">
  <link rel="stylesheet" href="presentacion/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <title>Gestion Humana</title>

  <style>
    :root {
      --primary: #178fcb;
      --primary-dark: #0b6ea5;
      --green: #9cc51c;
      --text: #1f2937;
      --muted: #6b7280;
      --bg: #f4f7fb;
      --card: rgba(255, 255, 255, 0.92);
      --border: rgba(15, 23, 42, 0.08);
      --danger-bg: #fdecec;
      --danger-text: #b42318;
      --success-bg: #e8f7ee;
      --success-text: #157347;
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background:
        radial-gradient(circle at top left, rgba(23, 143, 203, 0.10), transparent 28%),
        radial-gradient(circle at bottom right, rgba(156, 197, 28, 0.10), transparent 24%),
        var(--bg);
      color: var(--text);
    }

    .login-layout {
      min-height: 100vh;
      display: flex;
      flex-wrap: wrap;
    }

    .login-panel {
      width: 46%;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 28px;
      position: relative;
      background: linear-gradient(180deg, #f8fbff1e 0%, #f3f6fb1c 100%);
    }

    .login-panel::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        linear-gradient(135deg, rgba(23, 143, 203, 0.05), transparent 45%),
        linear-gradient(315deg, rgba(156, 197, 28, 0.06), transparent 40%);
      pointer-events: none;
    }

    .login-card {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 520px;
      background: var(--card);
      backdrop-filter: blur(10px);
      border: 1px solid var(--border);
      border-radius: 28px;
      padding: 34px 34px 28px;
      box-shadow:
        0 20px 50px rgba(15, 23, 42, 0.10),
        0 8px 20px rgba(23, 143, 203, 0.08);
    }

    .brand-top {
      text-align: center;
      margin-bottom: 18px;
    }

    .brand-top .mini-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 18px;
      letter-spacing: 0.2px;
    }

    .brand-top img {
      max-width: 210px;
      width: 100%;
      height: auto;
      object-fit: contain;
      filter: drop-shadow(0 8px 16px rgba(0,0,0,0.08));
    }

    .login-heading {
      text-align: center;
      margin: 10px 0 26px;
    }

    .login-heading h2 {
      margin: 0 0 8px;
      font-size: 28px;
      font-weight: 700;
      color: var(--text);
    }

    .login-heading p {
      margin: 0;
      color: var(--muted);
      font-size: 14px;
      line-height: 1.5;
    }

    .alert-custom {
      border: none;
      border-radius: 14px;
      padding: 12px 14px;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 14px;
    }

    .alert-danger-custom {
      background: var(--danger-bg);
      color: var(--danger-text);
    }

    .alert-success-custom {
      background: var(--success-bg);
      color: var(--success-text);
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: 600;
      color: #374151;
    }

    .form-control {
      width: 100%;
      height: 56px;
      border-radius: 16px;
      border: 1px solid #dbe3ec;
      background: #f8fbff;
      padding: 0 16px;
      font-size: 15px;
      color: #111827;
      box-shadow: none;
      transition: all 0.25s ease;
    }

    .form-control::placeholder {
      color: #9aa4b2;
    }

    .form-control:focus {
      background: #fff;
      border-color: rgba(23, 143, 203, 0.55);
      box-shadow: 0 0 0 4px rgba(23, 143, 203, 0.12);
    }

    .btn-login {
      width: 100%;
      height: 56px;
      border: none;
      border-radius: 16px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: #fff;
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 0.4px;
      text-transform: uppercase;
      transition: all 0.28s ease;
      box-shadow: 0 14px 24px rgba(23, 143, 203, 0.22);
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 28px rgba(23, 143, 203, 0.28);
    }

    .btn-login:focus {
      outline: none;
      box-shadow: 0 0 0 4px rgba(23, 143, 203, 0.16);
    }

    .extra-links {
      margin-top: 22px;
      text-align: center;
    }

    .extra-links p {
      margin-bottom: 10px;
      color: var(--muted);
      font-size: 14px;
    }

    .gradient-text {
      color: var(--primary-dark);
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .gradient-text:hover {
      color: var(--green);
      text-decoration: none;
    }

    .visual-panel {
      width: 54%;
      min-height: 100vh;
      position: relative;
      background:
        linear-gradient(rgba(255, 255, 255, 0.07), rgba(255, 255, 255, 0.09)),
        url('presentacion/img/medicron.jpg') center center / cover no-repeat;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      overflow: hidden;
      padding-top: 40px;
    }

    .visual-panel::before {
      content: "";
      position: absolute;
      top: -80px;
      right: -80px;
      width: 240px;
      height: 240px;
      background: linear-gradient(135deg, var(--green), #b8d400);
      transform: rotate(45deg);
      border-radius: 30px;
      opacity: 0.92;
    }

    .visual-panel::after {
      content: "";
      position: absolute;
      bottom: -100px;
      left: -100px;
      width: 250px;
      height: 250px;
      background: linear-gradient(135deg, #b8d400, var(--green));
      transform: rotate(45deg);
      border-radius: 34px;
      opacity: 0.90;
    }

    .visual-overlay {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 640px;
      text-align: center;
      padding: 40px 24px;
    }

    .visual-badge {
      display: inline-block;
      padding: 10px 18px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.78);
      color: var(--primary-dark);
      font-weight: 700;
      font-size: 14px;
      margin-bottom: 20px;
      box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
    }

    .visual-overlay h1 {
      font-size: 44px;
      line-height: 1.1;
      font-weight: 700;
      color: #0f4f7b;
      margin-bottom: 14px;
    }

    .visual-overlay p {
      margin: 0 auto 28px;
      max-width: 520px;
      font-size: 16px;
      color: #496476;
      line-height: 1.7;
    }

    .visual-card {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 20px;
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.72);
      backdrop-filter: blur(8px);
      color: #21526f;
      font-weight: 600;
      box-shadow: 0 16px 32px rgba(15, 23, 42, 0.10);
    }

    .visual-card span {
      color: var(--green);
      font-weight: 700;
    }

    @media (max-width: 1199px) {
      .login-panel {
        width: 50%;
      }

      .visual-panel {
        width: 50%;
      }

      .visual-overlay h1 {
        font-size: 36px;
      }
    }

    @media (max-width: 991px) {
      .login-layout {
        flex-direction: column;
      }

      .login-panel,
      .visual-panel {
        width: 100%;
        min-height: auto;
      }

      .visual-panel {
        order: 1;
        min-height: 300px;
      }

      .login-panel {
        order: 2;
        padding: 20px 15px 35px;
      }

      .login-card {
        max-width: 560px;
        padding: 28px 22px 24px;
      }

      .visual-overlay {
        padding: 40px 18px;
      }

      .visual-overlay h1 {
        font-size: 30px;
      }

      .visual-overlay p {
        font-size: 14px;
      }
    }

    @media (max-width: 576px) {
      .brand-top img {
        max-width: 170px;
      }

      .login-heading h2 {
        font-size: 24px;
      }

      .form-control,
      .btn-login {
        height: 52px;
      }

      .visual-panel {
        min-height: 250px;
      }

      .visual-overlay h1 {
        font-size: 25px;
      }
    }
  </style>
</head>

<body>
  <div class="login-layout">

    <div class="login-panel">
      <div class="login-card">
        <div class="brand-top">
          <div class="mini-title">Gestión Humana - Trabajando contigo</div>
        </div>

        <div class="login-heading">
          <h2>Inicio de sesión</h2>
          <p>Accede con tu número de identificación y tu clave para ingresar al sistema.</p>
        </div>

        <?php if (!empty($mensaje2)) { ?>
          <div class="alert-custom alert-success-custom"><?= $mensaje2 ?></div>
        <?php } ?>

        <?php if (!empty($mensaje)) { ?>
          <div class="alert-custom alert-danger-custom"><?= $mensaje ?></div>
        <?php } ?>

        <form action="control/validar.php" method="post">
          <div class="form-group first">
            <label for="persona">Usuario</label>
            <input
              id="persona"
              type="text"
              class="form-control"
              placeholder="Ingrese su número de identificación"
              name="persona"
              required>
          </div>

          <div class="form-group last mb-4">
            <label for="clave">Clave</label>
            <input
              id="clave"
              type="password"
              class="form-control"
              placeholder="Ingrese su clave"
              name="clave"
              required>
          </div>

          <input type="submit" name="submit" value="Ingresar" class="btn btn-login">
        </form>

        <div class="extra-links">
          <p>
            ¿No tienes una cuenta?
            <a href="presentacion/configuracion/RegistrarUsuario/RegistroUsuario.php" class="gradient-text">Crear una cuenta</a>
          </p>

          <div class="input-link">
            <a href="presentacion/cambiarClave/passwordFormulario.php" class="gradient-text">¿Has olvidado tu contraseña?</a>
          </div>
        </div>
      </div>
    </div>

    <div class="visual-panel">
      <div class="visual-overlay">
        <div class="visual-badge">Red Medicron IPS</div>
        <h1></h1>
        <p>
        </p>

      </div>
    </div>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>