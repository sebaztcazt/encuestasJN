<!--===========================
	ADINISTRAR ENCUESTAS
============================-->

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
          <h1 class="m-0 text-dark">Encuestas</h1>
        </div>
      </div>
    </div>
    <hr>
    <div class="container-fluid">
      <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#modalAgregarEncuesta">
        Agregar Encuesta 
      </button>
    </div>
  </section>

  <!--===========================
	  CAJAS DE ENCUESTAS
  ============================-->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
      <?php

        $item = null;
        $valor = null;
        $encuesta = ControladorEncuestas::ctrMostratEncuestas($item,$valor);
  
        foreach ($encuesta as $key => $value) :
          //Encuesta creada y sin preguntas
          if ($value['Estado'] == 1) {
            $iconEncuesta = '<i class="far fa-dizzy"></i>';
            $background = "bg-gradient-secondary";
            $accion = "agregar-preguntas";
            $idEncuesta= $value['IdEncuesta'];
            $estado = '<label>Estado: <p class="text-warning">Sin Preguntas</p></label>';
          }
          //encuesta creda pero no publicada
          if ($value['Estado'] == 2) {
            $iconEncuesta = '<i class="fas fa-meh-rolling-eyes"></i>';
            $background = "bg-gradient-warning";
            $accion = "agregar-preguntas";
            $idEncuesta= $value['IdEncuesta'];
            $estado = '<label>Estado: <p class="text-muted">Con preguntas y sin publicar</p> </label>';

          }
          //encuesta publicada
          if ($value['Estado'] == 3) {
            $iconEncuesta = '<i class="far fa-laugh-beam"></i>';
            $background = "bg-gradient-success";
            $accion = "agregar-preguntas";
            $idEncuesta= $value['IdEncuesta'];
            $estado = '<label>Estado: <p class="lead">Publicada</p></label>';
          }
          //fin de la encuesta
          if ($value['Estado'] == 4) {
            $iconEncuesta = '<i class="fas fa-laugh-wink"></i>';
            $background = "bg-gradient-danger";
            $accion = "agregar-preguntas";
            $idEncuesta= $value['IdEncuesta'];
            $estado = '<label>Estado:<p class="text-muted">Fin de la encuesta</p></label>';
          }

      ?>

        <div class="col-lg-3 col-6" >
          <div class="small-box <?= $background?> elevation-4" >

            <div class="inner">

              <h4><b><?= $value["Titulo"]?></b></h4>


              <p>Descripcion: <?= $value["Descripcion"]?></p>

              <p>Fecha Inicio: <?= $value["FechaInicio"]?></p>

              <p>Fecha Fin: <?= $value["FechaFin"]?></p>

              <?= $estado;?>

              <div class="d-flex justify-content-center">

                <button class="btn bg-orange btnEditarEncuesta" idEncuesta="<?=$value["IdEncuesta"];?>" data-toggle="modal" data-target="#modalEditarEncuesta">

                  <i class="far fa-edit"></i>

                </button>

                <button class="btn bg-lightblue btnEliminarEncuesta" idEncuesta="<?=$value["IdEncuesta"];?>" >

                  <i class="far fa-trash-alt"></i>

                </button>

                </div>
              </div>

            <div class="icon">
              <?=$iconEncuesta?>
            </div>
            <a href="index.php?ruta=<?=$accion?>&idEncuesta=<?=$idEncuesta?>" estado="<?= $value["Estado"]?>" class="small-box-footer" idEncuesta="<?=$value["IdEncuesta"];?>">Ver preguntas <i class="fas fa-arrow-circle-right"></i></a>

          </div>
        </div>

      <?php  endforeach;?>
      
      </div>
    </div>
  </section>
</div>

<!--==========================
   MODAL AGREGAR ENCUESTA
===========================-->

<div class="modal fade" id="modalAgregarEncuesta">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Agregar Encuesta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
        
            <!-- TITULO -->
            <div class="form-group">
              <label>Titulo:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-poll-h"></i></span>
                </div>
                 <input type="text" autocomplete="off" maxlength="50" class="form-control input-lg" name="nuevoTitulo" placeholder="Ingrese Titulo" required>
              </div>
            </div>

            <!-- DESCRIPCION -->
            <div class="form-group">
              <label>Descripción:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                </div>
                <textarea class="form-control"  rows="3" name="nuevaDescripcion" placeholder="Ingrese Descripción" ></textarea>
              </div>
            </div>

            <!-- FECHA -->
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha y Hora Inicio:</label>
                    <div class="input-group">
                      <input type="datetime-local" class="form-control input-lg" id="nuevaFechaInicio" name="nuevaFechaInicio" <?php $hoy = date('Y-m-d'); $hora = 'T00:00'; echo "min='$hoy$hora'"; ?> required>
                    </div> 
                </div>
              </div>
            

            <!-- FECHA -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha y Hora Fin:</label>
                    <div class="input-group">
                      <input type="datetime-local" class="form-control input-lg" id="nuevaFechaFin" name="nuevaFechaFin" <?php $hoy = date('Y-m-d'); $hora = 'T00:00'; echo "min='$hoy$hora'"; ?> required>
                    </div>
                </div>
              </div>
            </div>

            <input type="hidden" value="<?=$_SESSION['documento']?>" name="nuevoEmpleado">
            <input type="hidden" value="1"  name="nuevoEstado">

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

    <?php

      $agregarEncuesta = new ControladorEncuestas();
      $agregarEncuesta -> ctrAgregarEncuesta();

    ?>

    </div>

  </div>

</div>

<!--==========================
   MODAL EDITAR ENCUESTA
===========================-->

<div class="modal fade" id="modalEditarEncuesta">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar Encuesta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
        
            <!-- TITULO -->
            <div class="form-group">
              <label>Titulo:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-poll-h"></i></span>
                </div>
                 <input type="text" autocomplete="off" maxlength="50" class="form-control input-lg" name="editarTitulo" id="editarTitulo" placeholder="Ingrese Titulo" required>
              </div>
            </div>

            <!-- DESCRIPCION -->
            <div class="form-group">
              <label>Descripción:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                </div>
                <textarea class="form-control"  rows="3" name="editarDescripcion" id="editarDescripcion" placeholder="Ingrese Descripción" ></textarea>
              </div>
            </div>

            <!-- FECHA -->
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha y Hora Inicio:</label>
                    <div class="input-group">
                      <input type="datetime-local" class="form-control input-lg" name="editarFechaInicio" id="editarFechaInicio"  required>
                    </div> 
                </div>
              </div>

              <!-- FECHA -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Fecha y Hora Fin:</label>
                    <div class="input-group">
                      <input type="datetime-local" class="form-control input-lg" name="editarFechaFin" id="editarFechaFin" <?php $hoy = date('Y-m-d'); $hora = 'T00:00'; echo "min='$hoy$hora'"; ?> required>
                    </div>
                </div>
              </div>
            </div>
           
            <input type="hidden" name="editarEstado" id="editarEstado">
            <input type="hidden" name="editarIdEncuesta" id="editarIdEncuesta" value="">

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

    <?php

      $editarEncuesta = new ControladorEncuestas();
      $editarEncuesta -> ctrEditarEncuesta();

    ?>

    </div>

  </div>

</div>

<!--==========================
   BORRAR ENCUESTA
===========================-->

<?php

  $borrarEncuesta = new ControladorEncuestas();
  $borrarEncuesta -> ctrBorrarEncuesta();            

?>