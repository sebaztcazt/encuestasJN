<?php

 $ruta = $_GET["ruta"];

?>

<!--===========================
	MENU
 ============================-->
<aside class="main-sidebar sidebar-dark-primary elevation-3">

    <a href="index3.html" class="brand-link">

      <img src="vistas/img/logo.jpg" alt="Logo" class="brand-image img-circle elevation-2" style="opacity: .8">

      <span class="brand-text font-weight-light">Encuestas JN</span>

    </a>

    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">

          <img src="vistas/img/user-64.png" alt="Logo" class=img-circle elevation-2" style="opacity: .8">

        </div>

        <div class="info">

          <small class="d-block" style="color: white;"><?= $_SESSION["empleado"] ?></small>

        </div>

      </div>

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item has-treeview menu-open">

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="encuestas" class="nav-link <?php echo ($ruta == 'encuestas') ? 'active' :'' ; ?>">

                  <i class="fas fa-poll-h nav-icon"></i>

                  <p>Encuestas</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="colaboradores" class="nav-link <?php echo ($ruta == 'colaboradores') ? 'active' :'' ; ?>">

                  <i class="fas fa-users nav-icon"></i>

                  <p>Colaboradores</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="usuarios" class="nav-link <?php echo ($ruta == 'usuarios') ? 'active' :'' ; ?>">

                  <i class="fas fa-user nav-icon"></i>

                  <p>Usuarios</p>

                </a>

              </li>

            </ul>

          </li>

        </ul>

      </nav>

    </div>

</aside>


