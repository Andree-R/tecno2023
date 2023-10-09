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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


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



    </div>
    <script src="/assets/js/jq-toast.min.js"></script>

    <script type="text/javascript" src="/assets/js/moment.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/js/demo.js"></script>
</body>

</html>