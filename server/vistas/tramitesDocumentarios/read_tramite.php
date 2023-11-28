<?php

require_once "./vistas/tramitesDocumentarios/breadcrumb.php";

?>

<section class="content">
  <div class="row">
    <?php

    require_once "./vistas/tramitesDocumentarios/carpetas.php";

    ?>
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Detalle de solicitud</h3>

          <div class="card-tools">
            <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
            <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="mailbox-read-info">
            <h2><?= "Solicitud de " . $dataTramite["tipo"] ?></h2>
            <h3>De: <?= $dataTramite["solicitante"] ?>
              <span class="mailbox-read-time float-right"><?= $dataTramite["fecha_envio"] ?></span>
            </h3>
          </div>
          <!-- /.mailbox-read-info -->
          <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
                <i class="far fa-trash-alt"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                <i class="fas fa-reply"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                <i class="fas fa-share"></i>
              </button>
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm" title="Print">
              <i class="fas fa-print"></i>
            </button>
          </div>
          <!-- /.mailbox-controls -->
          <div class="mailbox-read-message">
            <?php
            require_once $dataTramite["description"];
            ?>
          </div>
          <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-body -->
        <?php
        // var_dump("<pre>", $dataTramite, "</pre>");
        ?>
        <div class="card-footer bg-white">
          <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
            <?php

            foreach ($dataDocumentos as $data) {

              $infoArchivo = pathinfo($data["ubicacion"]);

              $tamañoEnBytes = filesize($data["ubicacion"]);

              if ($tamañoEnBytes > 1024 * 1024) {
                $tamañoFormateado = number_format($tamañoEnBytes / (1024 * 1024), 2) . " MB";
              } elseif ($tamañoEnBytes > 1024) {
                $tamañoFormateado = number_format($tamañoEnBytes / 1024, 2) . " KB";
              } else {
                $tamañoFormateado = $tamañoEnBytes . " bytes";
              }
              // var_dump("<pre>", $infoArchivo, "</pre>");exit;
            ?>
              <li>
                <span class="mailbox-attachment-icon"><i class="far fa-file"></i></span>

                <div class="mailbox-attachment-info">
                  <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> <?= $infoArchivo["basename"] ?></a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span><?= $tamañoFormateado ?></span>
                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                  </span>
                </div>
              </li>
            <?php
            }
            ?>


            <!-- <li>
              <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
                <span class="mailbox-attachment-size clearfix mt-1">
                  <span>1,245 KB</span>
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                </span>
              </div>
            </li>
            <li>
              <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                <span class="mailbox-attachment-size clearfix mt-1">
                  <span>2.67 MB</span>
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                </span>
              </div>
            </li>
            <li>
              <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
                <span class="mailbox-attachment-size clearfix mt-1">
                  <span>1.9 MB</span>
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                </span>
              </div>
            </li> -->
          </ul>
        </div>
        <!-- /.card-footer -->
        <div class="card-footer">
          <?php
          if ($_SESSION["perfil"] == 4) {
            $btn_derivar = 1;
            // var_dump("<pre>", $dataTramite["estado"], "</pre>");?>

            <?php
            // var_dump("<pre>", $estadosTramites, "</pre>");exit;
            foreach ($estadosTramites as $estados => $valor) {
            ?>


              <?php
              if ((($valor["estado"] != "Aceptado" OR $valor["estado"] != "Aceptado") AND $btn_derivar == 1) AND $dataTramite["estado"] != "En espera") {
              ?>
                <button id="derivar" data-id="<?= $dataTramite["id"] ?>" data-value="<?= $valor["id"] ?>" type="button" class="btn btn-secondary"><i class="fas fa-file-export"></i> Derivar</button>

                <?php
                $btn_derivar++;
              } else {

                if ($valor["estado"] == "Anulado" AND $btn_derivar < 2) {
                ?>
                  <div class="float-right">
                    <button id="anular" data-id="<?= $dataTramite["id"] ?>" data-value="<?= $valor["id"] ?>" type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"></i> Anular</button>
                  </div>
                <?php
                }
                if ($valor["estado"] == "Aceptado" AND $btn_derivar < 2) {
                ?>
                  <button id="validar" data-id="<?= $dataTramite["id"] ?>" data-value="<?= $valor["id"] ?>" type="button" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Validar</button>
                  <!-- <button type="button" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button> -->
                <?php
                }

                ?>
          <?php

              }
            }
          }
          ?>
        </div>

        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</section>


<div class="modal fade " id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-trash"></i> Anulando solicitud: <?= $dataTramite["id"] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <h5 class="font-weight-bold text-center">¿Estas seguro que deseas anular la solicitud?</h5>
        <h5>Solicita: <code class="text-uppercase"><?= $dataTramite["tipo"] ?></code></h5>
        <h5>Solicitante: <code class="text-uppercase"><?= $dataTramite["solicitante"] ?></code></h5>
        <h5>Observación:</h5>
        <textarea id="mensaje" class="form-control" rows="3" placeholder="Mensaje..." style="height: 92px;"></textarea>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="confirmar" type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"></i> Confirmar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->