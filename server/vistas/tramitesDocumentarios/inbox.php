<?php

require_once "./vistas/tramitesDocumentarios/breadcrumb.php";

?>

<section class="content">
  <div class="row">
    <?php

    require_once "./vistas/tramitesDocumentarios/carpetas.php";

    ?>
    <style>
      tbody td:not(td:first-child){
        cursor: pointer;
      }
    </style>

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
              1-10/200
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
                $check = 1;

                $fechaActual = new DateTime();


                function interval($interval)
                {
                  if ($interval->y > 0) {
                    return $interval->format("%y años atrás");
                  } elseif ($interval->m > 0) {
                    return $interval->format("%m meses atrás");
                  } elseif ($interval->d > 0) {
                    return $interval->format("%d días atrás");
                  } elseif ($interval->h > 0) {
                    return $interval->format("%h horas atrás");
                  } elseif ($interval->i > 0) {
                    return $interval->format("%i minutos atrás");
                  } else {
                    return "Hace unos segundos";
                  }
                }


                if (is_array($tramites)) {
                  foreach ($tramites as $t) {
                ?>
                      <tr>
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" value="<?= $t["id"] ?>" id="check<?= $check ?>">
                            <label for="check<?= $check ?>"></label>
                          </div>
                        </td>
                        <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                        <td class="mailbox-name"><?= $t["estado"] ?></td>
                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution to this problem...
                        </td>
                        <td class="mailbox-attachment"></td>
                        <td class="mailbox-date">
                          <?= interval($fechaActual->diff(new DateTime($t["fecha_envio"])))
                          ?>
                        </td>
                      </tr>

                  <?php
                    $check++;
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
                    <td class="mailbox-date">Hace unos segundos</td>
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
              1-10/200
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