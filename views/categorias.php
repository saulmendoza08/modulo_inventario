<?php require_once ('../views/includes/header.php');?>
<?php require_once ('../views/includes/menu.php');?>
<?php require_once ('../views/functions/fx_categorias.php');?>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i>Inventario</a></li>
                        <li class="breadcrumb-item"><a href="">Equipos</a></li>
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
                            <h2><strong>Tabla</strong> de Equipos</h2>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#agregarCategoria">✔Agregar categoria</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id = "tabla-categorias">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre de categoria</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre de categoria</th>
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
    
    

    <!-- modal agregar categoria -->
    <div class="modal fade"  id="agregarCategoria" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="tituloVentana">Agregar categoria</h5>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_agregarCategoria">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre de la categoria a crear:</label>
                            <input type="text" name ="categoria" class="form-control"  >
                            <div class="form-text">Antes de agregar una nueva categoria, asegurate de que se categoria no exista previamente.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>                                     
                </div>
            </div>
        </div>
    </div>
    

</section>



<?php require_once ('../views/includes/footer.php');?>
<script src="./js/categorias.js"></script>
