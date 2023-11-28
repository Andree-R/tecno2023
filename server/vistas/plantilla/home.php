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
    <link rel="stylesheet" href="/assets/css/toastr.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jsPDF/jspdf.debug.js"></script>
    <script src="/assets/js/jsPDF/jspdf.plugin.autotable3.1.1.min.js"></script>



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

    <script src="/assets/js/toastr.min.js"></script>


    <script>
        $(function() {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
                if (clicks) {
                    //Uncheck all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
                } else {
                    //Check all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
                }
                $(this).data('clicks', !clicks)
            })

            //Handle starring for font awesome
            $('.mailbox-star').click(function(e) {
                e.preventDefault()
                //detect type
                var $this = $(this).find('a > i')
                var fa = $this.hasClass('fa')

                //Switch states
                if (fa) {
                    $this.toggleClass('fa-star')
                    $this.toggleClass('fa-star-o')
                }
            })
        })
    </script>


    <?php require_once './vistas/plantilla/js.php'; ?>

    <script>
        let form2 = document.getElementById('form');

        if (form2) {
            form2.addEventListener('submit', function(e) {
                e.preventDefault();

                const DATA = new FormData(form2);


                for (var pair of DATA.entries()) {
                    // console.log(`Campo: ${pair[0]}, Valor: ${pair[1]}`);
                }

                fetch("?ctrl=CtrlTramiteDocumentario&accion=enviarSolicitud", {
                        method: "post",
                        body: DATA,
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                    })
                    .then(data => {
                        // console.log(data);
                        if (data.length > 0) {
                            for (const i of data) {
                                toastr.error(i);
                            }
                        }

                        if (data !== null && data.length < 1) {
                            // console.log("Datos:" + data);
                            // Realiza la redirección después de procesar la respuesta
                            window.location.href = "?ctrl=CtrlTramiteDocumentario&accion=mostrarSolicitudes";
                        } else {
                            console.error("La respuesta data es null");
                        }

                    })
                    .catch(error => {
                        console.error("Ocurrió un error:", error);
                    });
            });
        }
    </script>

    <script>
        const inbox = document.querySelector("table");

        if (inbox) {
            inbox.addEventListener("click", function(event) {

                console.log("click en: " + event.target.innerHTML);
                // Verifica que el objetivo del evento sea un elemento 'tr'
                let targetElement = event.target;

                // Recorre los elementos padres hasta encontrar un 'tr' o llegar al elemento raíz 'table'
                while (targetElement !== inbox) {
                    if (targetElement.tagName === "TR") {
                        const primerHijo = targetElement.firstElementChild;
                        if (primerHijo && primerHijo.tagName === "TD") {
                            // Busca el primer hijo 'td' y luego busca un 'input' dentro de él
                            const input = primerHijo.querySelector('input[id][value]');
                            if (input) {
                                // Obtén los atributos 'id' y 'value' del 'input'
                                const idAtributo = input.getAttribute('id');
                                const valueAtributo = input.getAttribute('value');
                                console.log("ID del input:", idAtributo);
                                console.log("Valor del input:", valueAtributo);
                                if (valueAtributo) {
                                    window.location.href = "?ctrl=CtrlTramiteDocumentario&accion=mostrarDetalleTramite&tramite=" + valueAtributo;
                                }



                                // mostrarTramite(idAtributo, valueAtributo);

                            }
                        }
                        return; // Rompe el bucle
                    }
                    targetElement = targetElement.parentNode;



                }

                function mostrarTramite(id, value) {

                    const DATA = {
                        id: id,
                        value: value,
                    }



                    fetch("?ctrl=CtrlTramiteDocumentario&accion=mostrarTramite", {
                            method: "post",
                            body: DATA,
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                        })
                        .then(data => {
                            if (data !== null) {
                                console.log("Datos:" + data);
                                // Realiza la redirección después de procesar la respuesta
                                window.location.href = "?ctrl=CtrlTramiteDocumentario&accion=inbox";
                            } else {
                                console.error("La respuesta data es null");
                            }

                        })
                        .catch(error => {
                            console.error("Ocurrió un error:", error);
                        });
                }

            });
        }
    </script>

    <script>
        const BTN_VALIDAR = document.querySelector("#validar");
        const BTN_ANULAR = document.querySelector("#anular");

        let accionRealizada = true;



        if (BTN_VALIDAR) {
            BTN_VALIDAR.addEventListener("click", function(event) {
                if (accionRealizada) {
                    accionRealizada = false;
                    const DATA = {
                        id: BTN_VALIDAR.getAttribute("data-id"),
                        valor: BTN_VALIDAR.getAttribute("data-value"),
                    }

                    fetch("?ctrl=CtrlTramiteDocumentario&accion=validarSolicitud", {
                            method: "post",
                            body: JSON.stringify(DATA),
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                        })
                        .then(data => {
                            if (data.length > 0) {
                                for (const i of data) {
                                    toastr.success(i);
                                }
                                setTimeout(function() {
                                    window.location.href = "?ctrl=CtrlTramiteDocumentario&accion=mostrarSolicitudes";
                                    accionRealizada = true;
                                }, 2000);

                            } else {
                                console.error("La respuesta data es null");
                            }

                        })
                        .catch(error => {
                            console.error("Ocurrió un error:", error);
                        });
                }
            })
        }

        $(() => {

            $('#anular').click(function(e) {
                e.preventDefault();
                // alert('nuevo')
                $('#modal-lg').modal('show')
            });
        });

        $(() => {

            $('#confirmar').click(function(e) {
                e.preventDefault();
                // alert('nuevo')
                eliminar()
                $('#modal-lg').modal('show')
            });
        });


        function eliminar() {
            if (accionRealizada) {
                accionRealizada = false;
                const DATA = {
                    id: BTN_ANULAR.getAttribute("data-id"),
                    valor: BTN_ANULAR.getAttribute("data-value"),
                    observacion: document.querySelector("#mensaje").value,
                }


                fetch("?ctrl=CtrlTramiteDocumentario&accion=anularSolicitud", {
                        method: "post",
                        body: JSON.stringify(DATA),
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                    })
                    .then(data => {

                        console.log(data);
                        if (data.length > 0 && DATA.observacion == false) {
                            for (const i of data) {
                                toastr.error(i);
                            }

                            setTimeout(function() {
                                accionRealizada = true;
                            }, 1000);


                        }
                        if (data.length > 0 && DATA.observacion != false) {
                            for (const i of data) {
                                toastr.success(i);
                            }
                            setTimeout(function() {
                                window.location.href = "?ctrl=CtrlTramiteDocumentario&accion=mostrarSolicitudes";
                                accionRealizada = true;
                            }, 2000);
                        }

                    })
                    .catch(error => {
                        console.error("Ocurrió un error:", error);
                    });

            }
        };
    </script>
</body>

</html>