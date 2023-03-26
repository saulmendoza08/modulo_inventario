<?php require_once ('../views/includes/header.php');?>
<?php require_once ('../views/includes/menu.php');?>
<?php require_once ('../views/functions/fx_productos.php');?>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i>Inventario</a></li>
                        <li class="breadcrumb-item"><a href="">Productos</a></li>
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
                            <h2><strong>Tabla</strong> de Productos</h2>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#agregarCategoria">✔Agregar producto</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id = "tabla-productos">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Categoria</th>
                                            <th>Marca</th>
                                            <th>Descripcion</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Categoria</th>
                                            <th>Marca</th>
                                            <th>Descripcion</th>
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


<!-- Modal -->
    <div class="modal fade" id="agregarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear nuevo Producto</h5>
                    </div>
                    <form id="form_agregarProducto" action="" method="POST">

                        <div class="modal-body">
                            <!-- mostrar las categorias -->
                            <label for="categoria_lista">Seleccione la categoria:</label>
                            <select id="categoria_lista" class="form-control show-tick ms search-select" name="categoria" ></select>
                            <!-- mostrar las marcas -->
                            <label for="marca_lista">Seleccione la marca:</label>
                            <select id="marca_lista" class="form-control show-tick ms search-select" name="marca" ></select>
                            <!-- escribir el codigo del bien -->
                            <label for="codigo_bien">Escriba el codigo del bien:</label>
                            <input type="number" class="form-control" id="codigo_bien" name="codigo_bien" placeholder="Ej 256869" required>
                            <!-- escribir una descripcion -->
                            <label for="descripcion">Escriba una descripcion para el producto:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ej Modelo,color y/o capacidad" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn_guardar_categoria" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                    <div class="mt-3" id="respuesta_modal">

                </div>
            </div>
        </div>
    </div>
<!--Fin modal boostrap-->

<?php require_once ('../views/includes/footer.php');?>
<script src="./js/productos.js"></script>

