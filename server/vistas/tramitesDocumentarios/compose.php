<link rel="stylesheet" href="assets/css/summernote/summernote-bs5.min.css">


<?php

require_once "./vistas/tramitesDocumentarios/breadcrumb.php";

?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <?php

      require_once "./vistas/tramitesDocumentarios/carpetas.php";

      ?>
      <!-- /.col -->
      <form id="form" class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Nueva solicitud</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              Dirigido a:
              <?php

              // var_dump("<pre>", $oficinas, "</pre>");
              ?>

              <select class="custom-select" name="oficina" id="">
                <?php
                $esSeleccionado = null;


                if (is_array($oficinas))

                  foreach ($oficinas as $c) {
                    $esSeleccionado = '';
                    if ("Mesa de partes" === $c['nombre'])
                      $esSeleccionado = 'selected';
                ?>

                  <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['nombre'] ?></option>
                <?php
                  }
                ?>
              </select>
              <br>
              <br>
              Tipo de solicitud:
              <select class="custom-select" name="tipTramites" id="">
                <?php
                $esSeleccionado = null;


                if (is_array($tipTramites))

                  foreach ($tipTramites as $c) {
                    $esSeleccionado = '';
                    if ("FUT" === $c['tipo'])
                      $esSeleccionado = 'selected';
                ?>

                  <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>">Solicitud de <?= $c['tipo'] ?></option>
                <?php
                  }
                ?>
              </select>
              <br>
              <br>
              <div class="form-group">
                <textarea id="compose-textarea" name="descripcion" class="form-control" style="height: 300px">
                      <h4><b>A Ud. respetuosamente me presento y expongo:</b></h4>
                      <blockquote class="blockquote">
                        <font>
                        Que habiendo aprobado satisfactoriamente el <b>semestre academico 2023-I</b> y siendo requisito indispensable las <b>Experiencias Formativas en Situaciones Reales de Trabajo</b> las cuales voy a realizar en la empresa <b>"NOMBRE DE LA EMPRESA"</b>, ubicada en <b>DIRECCION DE LA EMPRESA</b>, <b>ENCARGADO DE LA EMPRESA</b> con DNI N° XXXXXXXX, las EFSRT corresponden al <b>MODULO ACTUAL</b> con un <b>TOTAL DE HORAS REALIZADAS</b>. Por tal motivo solicito mi carta de presentación

                        </font>
                      </blockquote>
                    </textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fas fa-paperclip"></i> Adjunto
                  <input type="file" name="adjuntos[]" multiple>
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Borrador</button>
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
              </div>
              <a href="?ctrl=CtrlTramiteDocumentario&accion=mostrarSolicitudes" type="reset" class="btn btn-default"><i class="fas fa-times"></i> Cancelar</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
      </form>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script src="/assets/js/summernote-bs4.min.js"></script>

<script>
  $(function() {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>