<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Clínica Médica</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar como Paciente</p>

    <form method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario-Ing" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="clave-Ing" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>

      <?php
      $ingreso = new PacientesC();
      $resultado = $ingreso->IngresarPacienteC();

      // Mostrar error si el login falla
      if ($_SERVER["REQUEST_METHOD"] == "POST" && !$resultado) {
          echo '<div class="alert alert-danger" style="margin-top:10px;">Usuario o contraseña incorrectos.</div>';
      }
      ?>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
