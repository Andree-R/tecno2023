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
        ?>
            
            <div class="float-right">
              <button id="anular" data-value="<?= $dataTramite["id"] ?>" type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"></i> Anular</button>
            </div>
            <button id="validar" data-value="<?= $dataTramite["id"] ?>" type="button" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Validar</button>
            <button type="button" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>
            <?php
        }
        ?>
        </div>

        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
  </div>

</section>