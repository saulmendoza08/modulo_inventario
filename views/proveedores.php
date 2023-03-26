<?php require_once ('../views/includes/header.php');?>
<?php require_once ('../views/includes/menu.php');?>
<?php require_once ('../views/functions/fx_proveedores.php');?>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i>Inventario</a></li>
                        <li class="breadcrumb-item"><a href="">Proveedores</a></li>
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
                            <h2><strong>Tabla</strong> de Proveedores</h2>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#agregarProveedor">✔Agregar Proveedor</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id = "tabla-proveedores">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Cuit</th>
                                            <th>Domicilio</th>
                                            <th>Celular</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Cuit</th>
                                            <th>Domicilio</th>
                                            <th>Celular</th>
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



    
    <!-- modal agregar proveedor -->
    <div class="modal fade"  id="agregarProveedor" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="tituloVentana">Agregar Proveedor</h5>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_agregarProveedor">
                        <div class="mb-3">
                            <!-- nombre del proveedor -->
                            <label for="nombre" class="form-label">Nombre del proveedor a crear:</label>
                            <input type="text" name ="nombre" class="form-control"  >
                            <!-- cuit del proveedor -->
                            <label for="cuit" class="form-label">cuit del proveedor a crear:</label>
                            <input type="number" name ="cuit" class="form-control"  >
                            <!-- domicilio del proveedor -->
                            <label for="domicilio" class="form-label">Domicilio del proveedor a crear:</label>
                            <input type="text" name ="domicilio" class="form-control"  >
                            <!-- celular del proveedor -->
                            <label for="celular" class="form-label">celular del proveedor a crear:</label>
                            <input type="number" name ="celular" class="form-control"  >
                        </div>

                        <button type="submit" class="btn btn-primary">Crear</button>
                        
                    </form>   
                    
                    <div class="mt-3" id="respuesta_modal">
                        
                    </div>                
                </div>
            </div>
        </div>
    </div>
    
</section>





<?php require_once ('../views/includes/footer.php');?>
<script src="./js/proveedores.js"></script>

