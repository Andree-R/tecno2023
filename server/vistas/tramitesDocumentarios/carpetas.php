<div class="col-md-3">
    <?php 
    if ($_SESSION["perfil"] != 4) {
      ?>
      <a href="<?= $url ?>" class="btn btn-primary btn-block mb-3"><?= $solicitud ?></a>
      <?php 
    }
    
    ?>
        

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