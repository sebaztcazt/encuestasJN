<?php session_start(); ?>
<!DOCTYPE html>

<html lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Encuestas | Administrador</title>

  <link rel="icon" href="vistas/img/Logo-fis.ico"> 

  <!--======================================================= 
          PLUGUNS DE CSS 
  ===========================================================--> 

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/bootstrap-daterangepicker/daterangepicker.css">

  <!--======================================================= 
          PLUGUNS DE JAVASCRIPT
  ===========================================================-->

  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- Toastr -->
  <script src="vistas/plugins/toastr/toastr.min.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- date-range-picker -->
  <script src="vistas/plugins/daterangepicker/moment.min.js"></script>
  <script src="vistas/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

</head>

<!--===========================
 CUERPO DOCUMENTO
=========================== -->

<body class="hold-transition sidebar-collapse sidebar-mini">

  <?php

    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

        echo '<div class="wrapper">';


          /*===========================
            CABEZOTE
          ========================= */
          include 'modulos/cabezote.php';

          /*===========================
            MENU
          ======================== */
          include 'modulos/menu.php';

          /*===========================
            CONTENIDO
          ======================== */

            if (isset($_GET["ruta"])) {
              if ($_GET["ruta"] == "encuestas" ||
                  $_GET["ruta"] == "colaboradores" ||
                  $_GET["ruta"] == "usuarios" ||
                  $_GET["ruta"] == "agregar-preguntas" ||
                  $_GET["ruta"] == "vista-previa" ||
                  $_GET["ruta"] == "salir"){

                  include "vistas/modulos/".$_GET['ruta'].".php";
              }else{

                include 'modulos/404.php';

              }

            }else{

              include 'modulos/encuestas.php';

            }

            include 'modulos/footer.php';

        echo '</div>';

    }else{
      
       include 'modulos/login.php';

    }

  ?>

  <script src="vistas/js/plantilla.js"> </script>
  <script src="vistas/js/usuarios.js"> </script>
  <script src="vistas/js/encuestas.js"> </script>
  <script src="vistas/js/preguntas.js"> </script>

</body>

</html>
