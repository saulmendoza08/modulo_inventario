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
                        <li class="breadcrumb-item"><a href="">Productos</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button">sss<i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Tabla</strong> de Productos</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id = "tabla-solicitudes">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Ticket</th>
                                            <th>Oc</th>
                                            <th>Fecha recepcion</th>
                                            <th>Remito</th>
                                            <th>Id servicio</th>
                                            <th>Pc</th>
                                            <th>Id estado</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Ticket</th>
                                            <th>Oc</th>
                                            <th>Fecha recepcion</th>
                                            <th>Remito</th>
                                            <th>Id servicio</th>
                                            <th>Pc</th>
                                            <th>Id estado</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php tbody_solicitudes();?>
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

<!-- <script src="./js/solicitudes.js"></script> -->
<?php require_once ('../views/includes/footer.php');?>
