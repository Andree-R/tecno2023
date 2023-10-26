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
          <h3 class="card-title"><?= $title ?></h3>
          <div class="card-tools">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Buscar">
              <div class="input-group-append">
                <div class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="card-body p-0">
          <div class="mailbox-controls">

            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm">
                <i class="far fa-trash-alt"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-reply"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-share"></i>
              </button>
            </div>

            <button type="button" class="btn btn-default btn-sm">
              <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div>

            </div>

          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>

                <?php
                if (is_array($tramites)) {
                  foreach ($tramites as $t) {
                    # code..

                ?>
                    <tr>
                      <td>
                        <div class="icheck-primary">
                          <input type="checkbox" value="" id="check1">
                          <label for="check1"></label>
                        </div>
                      </td>
                      <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                      <td class="mailbox-name"><a href="read-mail.html"><?= $_SESSION["nombre"] ?></a></td>
                      <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution to this problem...
                      </td>
                      <td class="mailbox-attachment"></td>
                      <td class="mailbox-date">5 mins ago</td>
                    </tr>

                  <?php
                  }
                } else {
                  ?>
                  <tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" value="" id="check1">
                        <label for="check1"></label>
                      </div>
                    </td>
                    <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.html">Sin nuevos mensajes</a></td>
                    <td class="mailbox-subject"><b>Sin nuevos mensajes</b> - Trying to find a solution to this problem...
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">5 mins ago</td>
                  </tr>
                <?php
                }
                ?>

                <!-- <tr>
                  <td>
                    <div class="icheck-primary">
                      <input type="checkbox" value="" id="check1">
                      <label for="check1"></label>
                    </div>
                  </td>
                  <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                  <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                  <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution to this problem...
                  </td>
                  <td class="mailbox-attachment"></td>
                  <td class="mailbox-date">5 mins ago</td>
                </tr>
                <tr>
                  <td>
                    <div class="icheck-primary">
                      <input type="checkbox" value="" id="check2">
                      <label for="check2"></label>
                    </div>
                  </td>
                  <td class="mailbox-star"><a href="#"><i class="fas fa-star-o text-warning"></i></a></td>
                  <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                  <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution to this problem...
                  </td>
                  <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                  <td class="mailbox-date">28 mins ago</td>
                </tr> -->

              </tbody>
            </table>

          </div>

        </div>

        <div class="card-footer p-0">
          <div class="mailbox-controls">

            <button type="button" class="btn btn-default btn-sm checkbox-toggle">
              <i class="far fa-square"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm">
                <i class="far fa-trash-alt"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-reply"></i>
              </button>
              <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-share"></i>
              </button>
            </div>

            <button type="button" class="btn btn-default btn-sm">
              <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div>

            </div>

          </div>
        </div>
      </div>

    </div>

  </div>

</section>