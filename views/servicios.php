<?php require_once ('../views/includes/header.php');?>
<?php require_once ('../views/includes/menu.php');?>
<?php require_once ('../views/functions/fx_servicios.php');?>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i>Inventario</a></li>
                        <li class="breadcrumb-item"><a href="">Servicios</a></li>
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
                            <h2><strong>Tabla</strong> de Servicios</h2>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#agregarServicio">✔Agregar servicios</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id = "tabla-servicios">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Servicio</th>
                                            <th>Interno</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Servicio</th>
                                            <th>Interno</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php tbody_servicios();?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    

    <!-- modal agregar servicio -->
    <div class="modal fade"  id="agregarServicio" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="tituloVentana">Agregar servicio</h5>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_agregarservicio">
                        <div class="mb-3">
                            <div class="form-text">Lo siento. Esta opcion no esta disponible para tu perfil.</div>
                        </div>
                    </form>   
                    
                    <div class="mt-3" id="respuesta">
                        
                    </div>                
                </div>
            </div>
        </div>
    </div>
    
    
</section>

<?php require_once ('../views/includes/footer.php');?>
<script src="./js/servicios.js"></script>


