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
const tabla = document.getElementById('tabla');

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

  console.log(tabla.rows)
  let json_productos = [];

  for (let index = 2; index < tabla.rows.length; index++) {
    console.log("codigo: " + tabla.rows[index].cells[0].innerHTML);
    console.log("descripcion: " + tabla.rows[index].cells[1].innerHTML);
    console.log("cantidad: " + tabla.rows[index].cells[2].innerHTML);    
    json_productos.push({
      "codigo": tabla.rows[index].cells[0].innerHTML,
      "descripcion": tabla.rows[index].cells[1].innerHTML,
      "cantidad": tabla.rows[index].cells[2].innerHTML
    });
  }

  console.log(json_productos);

  let json_solicitud = []
  json_solicitud.push({
    "nro_solicitud": datos.get('nro_solicitud'),
    "fecha_sol": datos.get('fecha_sol'),
    "ticket": datos.get('ticket'),
    "pc": datos.get('pc'),
    "servicio": datos.get('servicio'),
    "productos": json_productos
  })

  console.log(json_solicitud);


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

  //tabla de productos a agregar
  agregar_productos.addEventListener('click', function(){
    console.log('mediste un click a agregar producto')
    
    let datos = new FormData(formulario_modal)

    if( document.getElementById('codigo_bien').value !== "" && document.getElementById('cantidad_sol').value !== "" ){
      //agregar producto a la tabla
      let contenido = `
            <td>${datos.get('codigo_bien')}</td>
            <td>${document.getElementById('detalle_bien').textContent}</td>
            <td>${datos.get('cantidad_sol')}</td>
            <td><button id="eliminar" type="button" class="btn btn-danger inline">✖</button></td>
      `;

      tabla.innerHTML += contenido;
    }else{
      Swal.fire({     
        icon: 'error', //error, warning, info, success
        title: 'Datos incompletos', //titulo del modal
        text: 'No puede agregar productos si previamente no selecciona un producto y detalla la cantidad',//mensaje del modal
    });
    }
    
    

  })

  const boton_eliminar = document.getElementById('eliminar');
  //eliminar producto de la tabla
  boton_eliminar.addEventListener('click', function(){
    console.log('mediste un click a eliminar producto')
  })
