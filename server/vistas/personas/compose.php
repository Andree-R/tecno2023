<link rel="stylesheet" href="assets/css/summernote/summernote-bs5.min.css">


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Solicitud</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Compose</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <a href="?ctrl=CtrlPersona&accion=inbox" class="btn btn-primary btn-block mb-3">Volver a la bandeja</a>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Carpetas</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                <a href="#" class="nav-link">
                  <i class="fas fa-inbox"></i> Bandeja
                  <span class="badge bg-primary float-right">12</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-envelope"></i> Enviado
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-file-alt"></i> Borrador
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-filter"></i> Archivado
                  <span class="badge bg-warning float-right">65</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-trash-alt"></i> Papelera
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Filtros</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Importantes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Recientes</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Compose New Message</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <select class="custom-select" name="idCta" id="">
              <option value="">Mesa de partes</option>
                <?php
                $esSeleccionado = null;
                if (is_array($oficinas))
                  foreach ($oficinas as $c) {
                    $esSeleccionado = '';
                    if ($idCta === $c['id'])
                      $esSeleccionado = 'selected';
                ?>

                  <option <?= $esSeleccionado ?> value="<?= $c['id'] ?>"> <?= $c['descripcion'] ?></option>
                <?php
                  }
                ?>
                <input class="form-control" placeholder="Oficina">
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Solicitud:">
            </div>
            <div class="form-group">
              <textarea id="compose-textarea" class="form-control" style="height: 300px">
                      <h1><u>Heading Of Message</u></h1>
                      <h4>Subheading</h4>
                      <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                        was born and I will give you a complete account of the system, and expound the actual teachings
                        of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                        dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                        how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                        is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                        but because occasionally circumstances occur in which toil and pain can procure him some great
                        pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                        except to obtain some advantage from it? But who has any right to find fault with a man who
                        chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                        produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                        dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                        blinded by desire, that they cannot foresee</p>
                      <ul>
                        <li>List item one</li>
                        <li>List item two</li>
                        <li>List item three</li>
                        <li>List item four</li>
                      </ul>
                      <p>Thank you,</p>
                      <p>John Doe</p>
                    </textarea>
            </div>
            <div class="form-group">
              <div class="btn btn-default btn-file">
                <i class="fas fa-paperclip"></i> Adjunto
                <input type="file" name="attachment">
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
            <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Desechar</button>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
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