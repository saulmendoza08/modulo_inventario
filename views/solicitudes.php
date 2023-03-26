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
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#agregarProveedor">✔Agregar Solicitud</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#agregarProveedor"><strong>+</strong>Agregar productos a una solicitud</button>

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
</section>


<?php require_once ('../views/includes/footer.php');?>

<script src="./js/solicitudes.js"></script>