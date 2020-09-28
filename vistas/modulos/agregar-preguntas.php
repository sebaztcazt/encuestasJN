<!--==========================
  ADMINISTRAR PREGUNTAS 
===========================-->

<div class="content-wrapper">
  <section class="content-header">

    <h1>
       
    </h1>

  </section>

  <section class="content">
    <div class="box">

      <div class="box-header with-border">

        
        <button class="btn bg-gradient-primary " data-toggle="modal" id="btnAgregarPregunta" data-target="#modalAgregarPregunta">

          Agregar

        </button>

        <a href="index.php?ruta=vista-previa&idEncuesta=<?=$_GET['idEncuesta']?>">

          <button style="color:white;" class="btn bg-gradient-warning">

            Vista Previa

            </button>

        </a>

        <button class="btn bg-gradient-success disabled">

            Publicar

        </button>

        <button class="btn bg-gradient-danger disabled">
            Terminar

        </button>


      </div>

      <div class="card-body">

        <table class="table table-bordered table-stripted dt-responsive tablas" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>De Encuesta</th>
              <th>Titulo-Pregunta</th>
              <th>Descripción</th>
              <th>Tipo Pegunta</th>
              <th>Obligatoria</th>
              <th>Valor-Opciones</th>
              <th style="width:60px">Acciones</th>
            </tr>
          </thead>

          <tbody>
          <?php
            $item = "IdEncuesta";
            $valor = $_GET['idEncuesta'];
            $ordenar = "IdPregunta";
            $modo = "ASC";
            $preguntas = ControladorPreguntas::ctrMostrarPreguntas($item,$valor,$ordenar,$modo);

            foreach($preguntas as $key => $value):
              
          ?>
            <tr>
              <td><?= $key+1?></td>
              <td><?= $value['TituloEncuesta']?></td>
              <td><?= $value['TituloPregunta']?></td>
              <td><?= $value['Descripcion']?></td>
              <td><?= $value['TipoPregunta']?></td>
              <td>
              <?php
                if ($value['Requerido'] == 1) {
                  echo 'Si';
                }else {
                  echo 'No';
                }

              ?>
              </td>
              <td>   
              <?php 

              if ( $value['IdTipoPregunta'] == 3) {

                $item = "IdPregunta";
                $valor = $value['IdPregunta'];  
                $opciones = ControladorOpciones::ctrMostrarOpciones($item,$valor);

                if ($opciones == null) {
                  echo '
                    <button class="btn bg-gradient-navy btn-sm btnAgregarValor" data-toggle="modal" data-target="#modalAgregarValor" idPregunta="'.$value['IdPregunta'].'" idEncuesta="'.$_GET['idEncuesta'].'">

                    <i class="far fa-hand-point-up"></i>

                    </button>

                    <button class="btn bg-gradient-primary btnVerValor btn-sm disabled">

                    <i class="far fa-eye"></i>
  
                    </button>';
                }else {
                  echo '
                  <button class="btn bg-gradient-navy btn-sm disabled btnAgregarValor">

                  <i class="far fa-hand-point-up"></i>

                  </button>

                  <button class="btn bg-gradient-primary btn-sm btnVerValor" data-toggle="modal" data-target="#modalVerValor" idPregunta="'.$value['IdPregunta'].'" idEncuesta="'.$_GET['idEncuesta'].'">

                  <i class="far fa-eye"></i>

                  </button>';
                }


              }else {
                  echo '       
                    <button class="btn bg-gradient-navy disabled btn-sm" data-toggle="modal" data-target="#">
                    <i class="far fa-thumbs-up"></i>
                    </button>';
              }

              
              ?>


              </td>

              <td>

              <div class="btn-group">

                <button class="btn btn-warning btn-sm btnEditarPregunta" idEncuesta="<?=$value["IdPregunta"];?>" idPregunta="<?=$value["IdPregunta"];?>" data-toggle="modal" data-target="#modalEditarPreguta">

                  <i class="far fa-edit"></i>

                </button>

                <button class="btn btn-danger btn-sm btnEliminarPregunta" idPregunta="<?=$value["IdPregunta"];?> " idEncuesta="<?=$_GET["idEncuesta"];?> ">

                  <i class="far fa-trash-alt"></i>

                </button>
              </div>

              </td>

            </tr>
          <?php endforeach?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>


<!--==========================
   MODAL AGREGAR PREGUNTA
===========================-->

<div class="modal fade" id="modalAgregarPregunta">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Agregar Pregunta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">

          <!-- TITULO-PREGUNTA -->
          <div class="form-group">
            <label>Titulo-Pregunta:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-heading"></i></span>
              </div>
                <input type="text" class="form-control input-lg" name="nuevoTitulo" autocomplete="off" placeholder="Ingrese Titulo - Pregunta" required>
            </div>
          </div>

            
          <div class="row">
            <!-- DESCRIPCION -->
            <div class="col-lg-7">
              <div class="form-group">
                <label>Descripción:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                  </div>
                  <textarea class="form-control"  rows="3" name="nuevaDescripcion" placeholder="Ingrese Descripción" ></textarea>
                </div>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="form-group">
                <label>Campo Obligatorio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                    </div>
                    <select class="form-control input-lg " name="nuevoRequerido" id="nuevoRequerido" required>
                      <option value="">Seleccione </option>
              
                      <option value="1">Si</option>
                      <option value="0">No</option>
                          
                    </select>
                  </div>
                </div>
              </div>
          </div>


            <!-- TIPO PREGUNTA -->
          <div class="row" id="listaTipoPregunta">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tipo Pregunta:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                  </div>
                    <select class="form-control input-lg nuevoTipoPregunta" name="nuevoTipoPregunta" id="nuevoTipoPregunta" required>
                      <option value="">Seleccione Tipo pregunta</option>
                        <?php
                          $item = null;
                          $valor = null;
                          $tipoPregunta = ControladorPreguntas::ctrMostrarTipoPreguntas($item,$valor);
                          foreach($tipoPregunta as $key => $value):
                        ?>
                          <option value="<?= $value["IdTipoPregunta"]?>"><?= $value["Nombre"]?></option>
                        <?php endforeach ?>
                    </select>
                </div>
              </div>
            </div>

            <div class="col-lg-6 cambioColor center-text">
              <div class="form-group">
                <label for="inputWarning">Descripción</label>
                <textarea class="form-control descripcion is-warning" rows="7"  placeholder="Aquí podrás ver una breve descripción de Tipo de pregunta que elijas, por favor Seleccione un tipo de pregunta." id="inputWarning" disabled></textarea>  
              </div>            
            </div>

          </div>


          <input type="hidden" name="nuevoIdEncuesta" value="<?= $_GET['idEncuesta']?>">


        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

    <?php

      $agregarUsuario = new ControladorPreguntas();
      $agregarUsuario -> ctrAgregarPregunta();

    ?>

    </div>

  </div>

</div>

<!--==========================
   MODAL EDITAR PREGUNTA
===========================-->

<div class="modal fade" id="modalEditarPreguta">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar Pregunta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">

            <!-- TITULO-PREGUNTA -->
            <div class="form-group">
              <label>Titulo-Pregunta:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-heading"></i></span>
                </div>
                 <input type="text" class="form-control input-lg" name="editarTitulo" id="editarTitulo" autocomplete="off" placeholder="Ingrese Titulo - Pregunta" required>
              </div>
            </div>


            <div class="row">
              <!-- DESCRIPCION -->
              <div class="col-lg-7">
                <div class="form-group">
                  <label>Descripción:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                    </div>
                    <textarea class="form-control"  rows="3" name="editarDescripcion" id="editarDescripcion" placeholder="Ingrese Descripción" require></textarea>
                  </div>
                </div>
              </div>

              <div class="col-lg-5">
                <div class="form-group">
                  <label>Campo Obligatorio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                      </div>
                      <select class="form-control input-lg " name="editarRequerido" id="editarRequerido" required>
                        <option value="">Seleccione </option>
                
                        <option value="1">Si</option>
                        <option value="0">No</option>
                            
                      </select>
                    </div>
                  </div>
                </div>
            </div>

            <!-- TIPO PREGUNTA -->
            <div class="row" id="editarlistaTipoPregunta">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Tipo Pregunta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                    </div>
                      <select class="form-control input-lg editarTipoPregunta" name="editarTipoPregunta" id="editarValTipoPregunta" required>
                        <option id="editarTipoPregunta" value=""></option>
                          <?php
                            $item = null;
                            $valor = null;
                            $tipoPregunta = ControladorPreguntas::ctrMostrarTipoPreguntas($item,$valor);
                            foreach($tipoPregunta as $key => $value):
                          ?>
                            <option value="<?= $value["IdTipoPregunta"]?>"><?= $value["Nombre"]?></option>
                          <?php endforeach ?>
                      </select>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 cambioColor center-text">
                <div class="form-group">
                  <label for="inputWarning">Descripción</label>
                  <textarea class="form-control editardescripcion is-warning" rows="7"  placeholder="Aquí podrás ver una breve descripción de Tipo de pregunta que elijas, por favor Seleccione un tipo de pregunta." id="inputWarning" disabled></textarea>  
                </div>            
              </div>

            </div>

            <input type="hidden" name="editarIdPregunta" id="editarIdPregunta">
            <input type="hidden" name="editarIdEncuesta" value="<?= $_GET['idEncuesta']?>">

          </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

    <?php

      $agregarUsuario = new ControladorPreguntas();
      $agregarUsuario -> ctrEditarPregunta();

    ?>

    </div>

  </div>

</div>

<!--==========================
   BORRAR PREGUNTA
===========================-->

<?php

  $borrarPregunta = new ControladorPreguntas();
  $borrarPregunta -> ctrBorrarPregunta();            

?>

<!--==========================
   MODAL AGREGAR VALORES
===========================-->

<div class="modal fade" id="modalAgregarValor" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title text-center">Agregar Valor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
        
      <button class="btn bg-gradient-success btn-ms" id="btnAgregarValorPregunta"> Agregar Valor <i class="fas fa-plus"></i> </button>

      <form role="form" method="POST" class="formularioValor">

        <input type="hidden" name="nuevoIdPreguntaValor" id="nuevoIdPreguntaValor">

        <div class="modal-body" id="listarValorPregunta">

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" id="guardarValores" disabled="true" >Guardar</button>

        </div>

      </form>

      <?php

      $agregarValorRadio = new ControladorOpciones();
      $agregarValorRadio -> ctrAgregarValorRadio();

      ?>

    </div>

  </div>

</div>


<!--==========================
   MODAL VER VALORES
===========================-->

<div class="modal fade" id="modalVerValor" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title text-center">Valores</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>

      <form role="form" method="POST" class="formularioValor">
        

        <div class="modal-body" id="modalTraerValores">

        <button class="btn bg-gradient-success btn-ms" id="btnAgregarValorPregunta"> Agregar Valor <i class="fas fa-plus"></i> </button>
          
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn bg-gradient-danger btnEliminarValores" id="idPreguntaEliminar" idEncuesta="<?=$_GET["idEncuesta"];?>">Eliminar todo</button>

          <button type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

        </div>

      </form>

      <?php


      ?>

    </div>

  </div>

</div>

<div class="modal fade" id="modalVerValor">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title text-center">Valores</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
        
      <button class="btn bg-gradient-success btn-ms" id="btnAgregarValorPregunta"> Agregar Valor <i class="fas fa-plus"></i> </button>

      <form role="form" method="POST" class="formularioValor">

        <input type="hidden" name="nuevoIdPreguntaValor" id="nuevoIdPreguntaValor">

        <div class="modal-body" id="listarValorPregunta">

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" id="guardarValores" disabled="true" >Guardar</button>

        </div>

      </form>

      <?php

      $agregarValorRadio = new ControladorOpciones();
      $agregarValorRadio -> ctrAgregarValorRadio();

      ?>

    </div>

  </div>

</div>


