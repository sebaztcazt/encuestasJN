<!--==========================
  ADMINISTRAR COLABORADORES
===========================-->

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar Colaboradores
    </h1>

  </section>

  <section class="content">
    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar Colaborador
        </button>
      </div>

      <div class="card-body">

        <table class="table table-bordered table-stripted dt-responsive tablas" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Documento</th>
              <th>Nombres Apellidos</th>
              <th>Area</th>
              <th>Empresa</th>
              <th>Tipo Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
          <?php
            $item = null;
            $valor = null;
            $usuarios = ControladorColaboradores::ctrMostrarColaboradores($item,$valor);
            foreach($usuarios as $key => $value):
          ?>
            <tr>
              <td><?= $key+1?></td>
              <td><?= $value['DocId']?></td>
              <td><?= $value['Nombre']?></td>
              <td><?= $value['Area']?></td>
              <td><?= $value['Empresa']?></td>
              <td><?= $value['IdTipoUsuario']?></td>

              <td>

              <div class="btn-group">

                <button class="btn btn-warning btnEditarUsuario" idUsuario="<?=$value["DocId"];?>" data-toggle="modal" data-target="#modalEditarUsuario">

                  <i class="far fa-edit"></i>

                </button>

                <button class="btn btn-danger btnEliminarColaborador" idColaborador="<?=$value["DocId"];?>">

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
   MODAL AGREGAR USUARIO
===========================-->

<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Agregar Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
        
            <!-- DOCUMENTO -->
            <div class="form-group">
              <label>Documento:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
                </div>
                 <input type="number" class="form-control input-lg" name="nuevoDocumento" placeholder="Documento" id="nuevoDocumento" required>
              </div>
            </div>

            <!-- NOMBRE -->
            <div class="form-group">
              <label>Nombres y Apellidos:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre y Apellidos"
                  required>
              </div>
            </div>

            <!-- CONTRASEÑA -->
            <div class="form-group">
              <label>Contraseña</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                 <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Contraseña" required>
              </div>
            </div>

            <!-- AREA -->
            <div class="form-group">
              <label>Area:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user-astronaut"></i></span>
                </div>
                  <select class="form-control input-lg" name="nuevaArea" required>
                    <option value="">Seleccione Area</option>
                      <?php
                        $item = null;
                        $valor = null;
                        $area = ControladorUsuarios::ctrMostrarAreas($item,$valor);
                        foreach($area as $key => $value):
                      ?>
                        <option value="<?= $value["IdArea"]?>"><?= $value["Nombre"]?></option>
                      <?php endforeach ?>
                  </select>
              </div>
            </div>

            <!-- EMPRESA -->
            <div class="form-group">
              <label>Empresa:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-building"></i></span>
                </div>
                  <select class="form-control input-lg" name="nuevaEmpresa" required>
                    <option value="">Seleccione Empresa</option>
                      <?php
                        $empresa = ControladorUsuarios::ctrMostrarEmpresas();
                        foreach($empresa as $key => $value):
                      ?>
                        <option value="<?= $value["IdEmpresa"]?>"><?= $value["Nombre"]?></option>
                      <?php endforeach ?>
                  </select>
              </div>
            </div>

            <!-- TIPO USUARIO -->
            <div class="form-group">
              <label>Tipo Usuario:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                </div>
                  <select class="form-control input-lg" name="nuevoTipousuario" required>
                    <option value="">Seleccione Tipo Usuario</option>
                    <?php
                      $item = null;
                      $valor = null;
                      $tipoUsuario = ControladorUsuarios::ctrMostrarTipoUsuarios($item,$valor);
                      foreach($tipoUsuario as $key => $value):
                    ?>
                      <option value="<?= $value["IdTipoUsuario"]?>"><?= $value["Nombre"]?></option>
                    <?php endforeach ?>
                  </select>
              </div>
            </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

    <?php

    $editarUsuario = new ControladorColaboradores();
    $editarUsuario -> ctrAgregarColaborador();

    ?>

    </div>

  </div>

</div>

<!--==========================
   MODAL EDITAR USUARIO
===========================-->

<div class="modal fade" id="modalEditarUsuario" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
        
            <!-- DOCUMENTO -->
            <div class="form-group">
              <label>Documento:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
                </div>
                 <input type="number" class="form-control input-lg" name="editarDocumento" id="editarDocumento" readonly required>
              </div>
            </div>

            <!-- NOMBRE -->
            <div class="form-group">
              <label>Nombres y Apellidos:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Nombre y Apellidos"
                  required>
              </div>
            </div>

            <!-- CONTRASEÑA -->
            <div class="form-group">
              <label>Contraseña</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                 <input type="password" class="form-control input-lg" name="editarPassword" id="editarPassword" placeholder="Contraseña" required>
                 <input type="hidden" name="passwordActual" id="passwordActual">
              </div>
            </div>

            <!-- AREA -->
            <div class="form-group">
              <label>Area:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user-astronaut"></i></span>
                </div>
                  <select class="form-control input-lg" name="editarArea" required>
                    <option id="editarArea" ></option>
                      <?php
                        $item = null;
                        $valor = null;
                        $area = ControladorUsuarios::ctrMostrarAreas($item,$valor);
                        foreach($area as $key => $value):
                      ?>
                        <option value="<?= $value["IdArea"]?>"><?= $value["Nombre"]?></option>
                      <?php endforeach ?>
                  </select>
              </div>
            </div>


            <!-- EMPRESA -->
            <div class="form-group">
              <label>Empresa:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-building"></i></span>
                </div>
                  <select class="form-control input-lg" name="editarEmpresa" required>
                    <option id="editarEmpresa" value=""></option>
                      <?php
                        $empresa = ControladorUsuarios::ctrMostrarEmpresas();
                        foreach($empresa as $key => $value):
                      ?>
                        <option value="<?= $value["IdEmpresa"]?>"><?= $value["Nombre"]?></option>
                      <?php endforeach ?>
                  </select>
              </div>
            </div>


            <!-- TIPO USUARIO -->
            <div class="form-group">
              <label>Tipo Usuario:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                </div>
                <select class="form-control input-lg" name="editarTipoUsuario" required>
                  <option id="editarTipoUsuario" value=""></option>
                    <?php
                        $item = null;
                        $valor = null;
                        $tipoUsuario = ControladorUsuarios::ctrMostrarTipoUsuarios($item,$valor);
                        foreach($tipoUsuario as $key => $value):
                      ?>
                        <option value="<?= $value["IdTipoUsuario"]?>"><?= $value["Nombre"]?></option>
                      <?php endforeach ?>
                  </select>
              </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        

    </form>

    <?php

      $editarUsuario = new ControladorUsuarios();
      $editarUsuario -> ctrEditarUsuario();

    ?>

    </div>

  </div>

</div>

<!--==========================
   BORRAR USUARIO
===========================-->

<?php

  $borrarUsuario = new ControladorColaboradores();
  $borrarUsuario -> ctrBorrarColaborador();            


?>

