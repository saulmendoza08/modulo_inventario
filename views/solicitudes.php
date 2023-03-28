<?php require_once ('../views/includes/header.php');?>
<?php require_once ('../views/includes/menu.php');?>
<?php require_once ('../views/functions/fx_solicitudes.php');?>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i>Inventario</a></li>
                        <li class="breadcrumb-item"><a href="">Solicitudes</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Tabla</strong> de Solicitudes</h2>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#agregarSolicitud">✔Agregar Solicitud</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#recepcionBien"><strong>+</strong>Registrar llegada de insumos </button>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id = "tabla-solicitudes">
                                    <thead>
                                        <tr>
                                            <th>Nro Sol</th>
                                            <th>Codigo del Bien</th>
                                            <th>Detalle del bien</th>
                                            <th>Cantidad Sol.</th>
                                            <th>Cantidad recib.</th>
                                            <th>Fecha Sol.</th>
                                            <th>Ticket</th>
                                            <th>Remito</th>
                                            <th>Oc</th>
                                            <th>Fecha recepcion</th>
                                            <th>Pc</th>
                                            <th>Servicio</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nro Sol</th>
                                            <th>Codigo del Bien</th>
                                            <th>Detalle del bien</th>
                                            <th>Cantidad Sol.</th>
                                            <th>Cantidad recib.</th>
                                            <th>Fecha Sol.</th>
                                            <th>Ticket</th>
                                            <th>Remito</th>
                                            <th>Oc</th>
                                            <th>Fecha recepcion</th>
                                            <th>Pc</th>
                                            <th>Servicio</th>
                                            <th>Estado</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    

<!-- Modal agregar solicitud -->
    <div class="modal fade " id="agregarSolicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cargar nueva solicitd de compra</h5>
                </div>
                <form id="form_agregarSolicitud" action="" method="POST">

                    <div class="modal-body">
                        <!-- Escribe el numero de solicitud -->
                        <label for="nro_solicitud">Escriba el numero de solicitud:</label>
                        <input type="number" class="form-control" id="nro_solicitud" name="nro_solicitud" placeholder="Ej 31654" required>

                        <!-- Escriba la fecha de la solicitud -->
                        <label for="fecha_sol">Escriba el numero de solicitud:</label>
                        <input type="date" class="form-control" id="fecha_sol" name="fecha_sol" placeholder="Ej 25-03-23" required>

                        <!-- mostrar tickets -->
                        <label for="ticket">Escriba el ticket:</label>
                        <input type="number" class="form-control" id="ticket" name="ticket" placeholder="Ej 31654" required>

                        <!-- mostrar las PCs -->
                        <label for="pc">Seleccione la PCs:</label>                   
                        <input  class="form-control show-tick ms search-select" list="pc" name="pc" required>
                        <datalist  id="pc"></datalist>

                        <!-- mostrar los servicios -->

                        <label for="servicio">Seleccione el servicio:</label>                   
                        <input  class="form-control show-tick ms search-select" list="servicio" name="servicio" required>
                        <datalist  id="servicio"></datalist>
                        <hr>
                        
                        <!-- mostrar los bienes -->
                        <div class="form-row">
                            <div class="col-12">
                                <label for="codigo_bien">Codigo del bien:</label>
                                <input id="codigo_bien" type="text" name="codigo_bien" class="form-control" placeholder="Ej 52252" required>
                            </div>
                            <div class="col">
                                <label for="detalle_bien">Detalle:</label>
                                <label id="detalle_bien" type="text" readonly class="form-control" placeholder="Ej Memoria Ram">
                            </div>
                        </div>
                        
                        <!-- cantidad solicitada -->
                        <label for="cantidad_sol">Cantidad Solicitada:</label>
                        <input type="number" class="form-control" id="cantidad_sol" name="cantidad_sol" placeholder="Ej 6" required>
                    
                        <button type="button" id="agregar_productos" class="btn btn-primary">Agregar producto</button>

                        <!-- productos agregados -->
                        <hr>

                        <table id = "tabla" class="table table-striped table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>

                        </table>

                        <hr>
                    </div>
                    <!-- boton enviar -->
                    <div class="modal-footer">
                        <button type="submit" id="btn_guardar_solicitud" class="btn btn-primary">Enviar Todo</button>
                    </div>
                </form>
                <!-- lugar donde ira la respuesta del servidor -->
                <div class="mt-3" id="respuesta_modal">
                </div>
            </div>
        </div>
    </div>
<!--Fin modal boostrap-->

</section>


<?php require_once ('../views/includes/footer.php');?>

<script src="./js/solicitudes.js"></script>