$(function () {

  // Obtener los datos de la API
  fetch('../apis/v1/inventario/proveedores')
    .then(response => response.json())
    .then(data => {
      // Obtener la tabla por su ID
      const tabla = document.getElementById('tabla-proveedores');
      
      // Obtener la referencia al tbody de la tabla
      let tbody = document.getElementById("tabla-proveedores").getElementsByTagName("tbody")[0];
      // Establecer el contenido HTML del tbody a una cadena vacía
      tbody.innerHTML = "";

      // Recorrer los datos y crear una fila para cada producto
      data.forEach(producto => {
        // Crear una nueva fila
        const fila = document.createElement('tr');

        // Agregar las celdas con los datos del producto
        fila.innerHTML = `
          <td>${producto.id}</td>
          <td>${producto.nombre}</td>
          <td>${producto.cuit}</td>
          <td>${producto.domicilio}</td>
          <td>${producto.celular}</td>
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//evento guardar del modal

let formulario_modal = document.getElementById('form_agregarProveedor');
let respuesta_modal = document.getElementById('respuesta_modal');

formulario_modal.addEventListener('submit', function(e){
  e.preventDefault();
  console.log('mediste un click')

  let datos = new FormData(formulario_modal)

  console.log(datos)
  console.log(datos.get('nombre'))
  console.log(datos.get('cuit'))
  console.log(datos.get('domicilio'))
  console.log(datos.get('celular'))

  // Send a POST request
  axios.post('../apis/v1/inventario/proveedores/', {
    nombre : datos.get('nombre'),
    cuit : datos.get('cuit'),
    domicilio : datos.get('domicilio'),
    celular : datos.get('celular')
  })
  .then((response) => {
    respuesta_modal.innerHTML = `
    <div class="alert alert-success" role="alert">
      ${response.data.success}.
    </div>
    `
  })
  .catch((error) => {
    respuesta_modal.innerHTML = `
    <div class="alert alert-danger" role="alert">
      ${error.response.data.error}.
    </div>
    `
  });

});
