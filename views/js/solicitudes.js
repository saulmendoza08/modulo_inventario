$(function () {


  fetch('../apis/v1/solicitudes_compra/solicitudes_detalle.php')
.then(response => response.json())
.then(data => {
  // Obtener la tabla por su ID
  const tabla = document.getElementById('tabla-solicitudes');
  
  // Obtener la referencia al tbody de la tabla
  let tbody = document.getElementById("tabla-solicitudes").getElementsByTagName("tbody")[0];
  // Establecer el contenido HTML del tbody a una cadena vacía
  tbody.innerHTML = "";

  // Recorrer los datos y crear una fila para cada producto
  data.forEach(producto => {
    // Crear una nueva fila
    const fila = document.createElement('tr');

    // Agregar las celdas con los datos del producto
    fila.innerHTML = `
      <td>${producto.nro_sol}</td>
      <td>${producto.cod_producto}</td>
      <td>${producto.descripcion_prod}</td>
      <td>${producto.cantidad_sol}</td>
      <td>${producto.cantidad_recibida}</td>
      <td>${producto.fecha_sol}</td>
      <td>${producto.ticket}</td>
      <td>${producto.remito}</td>
      <td>${producto.oc}</td>
      <td>${producto.fecha_recepcion}</td>
      <td>${producto.pc}</td>
      <td>${producto.servicio}</td>
      <td>${producto.estado}</td>
    `;

    // Agregar la fila a la tabla
    tabla.querySelector('tbody').appendChild(fila);
  });

  $('.js-basic-example').DataTable();
  
  //Exportable table
  $('.js-exportable').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ],
  });
});
  
});

///////////////////////////////////////////////////////////////////////////////////////////





//agregador de la lista de PCs
axios.get('../apis/v1/equipos/equipos.json')
.then(function (response) {
  // Aquí se procesan los datos de la respuesta de la API
  var datos = response.data;
  // Luego, se genera una cadena de opciones de HTML
  var opciones = "";
  datos.forEach(function (opcion) {
    opciones += "<option value='" + opcion.nombre + "'>" + opcion.nombre + " - " + opcion.descripcion + "</option>";
  });
  // Finalmente, se agrega la cadena de opciones a la lista desplegable
  document.getElementById("pc").innerHTML = opciones;
})
.catch(function (error) {
  console.log(error);
});




//agregador de la lista de servicios
axios.get('../apis/v1/servicios')
.then(function (response) {
  // Aquí se procesan los datos de la respuesta de la API
  var datos = response.data;
  // Luego, se genera una cadena de opciones de HTML
  var opciones = "";
  datos.forEach(function (opcion) {
    opciones += "<option value='" + opcion.id + "'>" + opcion.servicio + "</option>";
  });
  // Finalmente, se agrega la cadena de opciones a la lista desplegable
  document.getElementById("servicio").innerHTML = opciones;
})
.catch(function (error) {
  console.log(error);
});


///////////////////////////////////////////////////////////////////////////////////////////
// buscador de productos

const codigo_bien = document.getElementById('codigo_bien');
const detalle_bien = document.getElementById('detalle_bien');
detalle_bien.innerHTML = "Ingrese el código del bien";
  


const filtrar = () => {
  console.log('Buscando...');
  console.log(codigo_bien.value);
  if (codigo_bien.value == "") {
    detalle_bien.innerHTML = "Debe ingresar un código";
    return;
  }else{
    
    //obtener datos de la API de productos
    axios.get(`../apis/v1/inventario/productos?id=${codigo_bien.value}`)
    .then(function (response) {
      // Aquí se procesan los datos de la respuesta de la API
      let datos = response.data;
      // Luego, se genera una cadena de opciones de HTML
      console.log("Datos obtenidos de la API:");
      console.log(datos);
      detalle_bien.innerHTML = `${datos[0].descripcion}`
    })
    .catch(function (error) {
      console.log(error);
      detalle_bien.innerHTML = "No se encontró el código ingresado";

    });
  }



}

codigo_bien.addEventListener('keyup', filtrar);



///////////////////////////////////////////////////////////////////////////////////////////


//evento guardar del modal

const formulario_modal = document.getElementById('form_agregarSolicitud');
const respuesta_modal = document.getElementById('respuesta_modal');
const agregar_productos = document.getElementById('agregar_productos');
const lista = document.getElementById('lista');

formulario_modal.addEventListener('submit', function(e){
  e.preventDefault();
  console.log('mediste un click')

  let datos = new FormData(formulario_modal)

  console.log(datos)
  console.log("Numero de solicitud: " + datos.get('nro_solicitud'))
  console.log("Fecha de solicitud: " + datos.get('fecha_sol'))
  console.log("Ticket: " + datos.get('ticket'))
  console.log("pc: " + datos.get('pc'))
  console.log("servicio: " + datos.get('servicio'))
  console.log("codigo bien: " + datos.get('codigo_bien'))
  console.log("Detalle bien: " + document.getElementById('detalle_bien').textContent)
  console.log("Cantidad solicitada: " + datos.get('cantidad_sol'))

  // // Send a POST request
  // axios.post('../apis/v1/inventario/solicitudes_compra', {
  //   nombre: datos.get('nombre_marca'),
  // })
  // .then((response) => {
  //   respuesta_modal.innerHTML = `
  //   <div class="alert alert-success" role="alert">
  //     ${response.data.success}.
  //   </div>
  //   `
  // })
  // .catch((error) => {
  //   respuesta_modal.innerHTML = `
  //   <div class="alert alert-danger" role="alert">
  //     ${error.response.data.error}.
  //   </div>
  //   `
  // });
});


///////////////////////////////////////////////////////////////////////////////////////////

  //lista de productos a agregar
  agregar_productos.addEventListener('click', function(){
    console.log('mediste un click a agregar producto')
    
    let datos = new FormData(formulario_modal)

    if( document.getElementById('codigo_bien').value !== "" && document.getElementById('cantidad_sol').value !== "" ){
      //agregar producto a la lista
      let contenido = `
      <div class="alert alert-primary d-flex align-items-center justify-content-between">
        <p>
          ${datos.get('codigo_bien')} - ${document.getElementById('detalle_bien').textContent} - ${datos.get('cantidad_sol')}
        </p>
        <button type="button" class="btn btn-danger inline" onclick="eliminar(this)">✖</button>
      </div>
      `;

      lista.innerHTML += contenido;
    }else{
      Swal.fire({     
        icon: 'error', //error, warning, info, success
        title: 'Datos incompletos', //titulo del modal
        text: 'No puede agregar productos si previamente no selecciona un producto y detalla la cantidad',//mensaje del modal
    });
    }
    
    

  })


  //eliminar producto de la lista
  function eliminar(e){
    console.log('mediste un click a eliminar producto')
    const divPadre  = e.parentNode;
    lista.removeChild(divPadre);

  }
