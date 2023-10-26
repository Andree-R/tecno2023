<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IESJCM | Sistema Virtual</title>


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/css/fontawesome-free/css/all.min.css">
    <!-- Theme style -->

    <link rel="stylesheet" href="/assets/css/icheck.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-toast.css">
    <link rel="stylesheet" href="/assets/css/adminlte.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->

    <script src="/assets/js/jquery.min.js"></script>


    <style>
        html {
            color-scheme: dark;
        }
    </style>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">
        <?php
        require_once "./vistas/plantilla/nav.php";
        require_once "./vistas/plantilla/sidebar.php";


        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php
            require_once "./vistas/plantilla/pageHeader.php";
            ?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <?= $contenido ?>
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Formularios modales -->
        <!-- Modal Formulario - Nuevo / Editar -->
        <div class="modal fade" id="modal-form" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="body-form">

                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Eliminar -->
        <div class="modal fade" id="modal-eliminar" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="frm-eliminar"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="body-eliminar">
                        <div class="text-center">
                            <h5>¿Estas seguro que deseas seguir con la eliminación?</h5>
                            <h5 class="reg-eliminacion">Registro: </h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cancelar</button>
                        <a type="button" class="btn btn-danger" id="btn-confirmar" href="" data-id="">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <script src="/assets/js/jq-toast.min.js"></script>

    <script type="text/javascript" src="/assets/js/moment.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- 
    <script src="/assets/js/jquery.flot.js"></script>

    <script src="/assets/js/jquery.flot.resize.js"></script> -->

    <script src="/assets/js/demo.js"></script>




    <?php require_once './vistas/plantilla/js.php'; ?>

    <script>
        let form2 = document.getElementById('form');

        form2.addEventListener('submit', function(e) {
            e.preventDefault();

            const DATA = new FormData(form2);


            for (var pair of DATA.entries()) {
                console.log(`Campo: ${pair[0]}, Valor: ${pair[1]}`);
            }

            fetch("?ctrl=CtrlTramiteDocumentario&accion=enviarTramite", {
                    method: "post",
                    body: DATA,

                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                })

                .then(data => {
                    console.log(data);
                })

            ;

        });
    </script>
</body>

</html>