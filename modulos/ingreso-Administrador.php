<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Clínica Médica</b></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar como Administrador</p>

    <form method="post">

      <?php
      $error = false;
      $usuarioIngresado = '';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $usuarioIngresado = $_POST["usuario-Ing"] ?? '';
          $ingreso = new AdminC();
          $resultado = $ingreso->IngresarAdminC(); // Devuelve true/false

          if (!$resultado) {
              $error = true;
          }
      }
      ?>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario-Ing" placeholder="Usuario" value="<?php echo htmlspecialchars($usuarioIngresado); ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="clave-Ing" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <?php
      // Mensaje de error ABAJO de los inputs
      if ($error) {
          echo '<div class="alert alert-danger" style="margin-top:10px;">Usuario o contraseña incorrectos</div>';
      }
      ?>

      <div class="row" style="margin-top:10px;">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>

    </form>
  </div>
</div>
