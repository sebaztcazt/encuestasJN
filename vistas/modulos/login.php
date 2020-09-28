<div class="login-page">

  <div class="login-box elevation-5">

    <div class="card">

      <div class="card-body login-card-body">

        <div class="login-logo elevation-3">

          <img src="vistas/img/logo-fis.ico" class="img-responsive" style="padding: 0px 0px 0px 5px;" alt="">

        </div>

        <h4 class="login-box-msg"><b>INGRESAR</b></h4>

        <form method="post">

          <div class="input-group mb-3">

            <input type="text" class="form-control" placeholder="Documento Identidad" name="ingDocumento" required>

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-fingerprint"></span>

              </div>

            </div>

          </div>

          <div class="input-group mb-3">

            <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword">

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-lock"></span>

              </div>

            </div>

          </div>

          <div class="text-center mb-3">

            <button type="submit" class="btn btn-primary btn-success" >ENTRAR</button>

          </div>

        </form>

          <?php

          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();

          ?>
      </div>

    </div>

  </div>
  
</div>