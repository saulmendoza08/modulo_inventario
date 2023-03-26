$(function () {


// Obtener los datos de la API
  fetch('../apis/v1/inventario/marcas')
    .then(response => response.json())
    .then(data => {
      // Obtener la tabla por su ID
      const tabla = document.getElementById('tabla-marcas');
      
      // Obtener la referencia al tbody de la tabla
      let tbody = document.getElementById("tabla-marcas").getElementsByTagName("tbody")[0];
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
          <td>${producto.nombre_categoria}</td>
          <td style="visibility:collapse; display:none;">${producto.id_categoria}</td>
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
  
//agregador de opciones en el data list
  axios.get('../apis/v1/inventario/categorias')
    .then(function (response) {
      // Aquí se procesan los datos de la respuesta de la API
      var datos = response.data;
      // Luego, se genera una cadena de opciones de HTML
      var opciones = "";
      datos.forEach(function (opcion) {
        opciones += "<option value='" + opcion.id + "'>" + opcion.nombre + "</option>";
      });
      // Finalmente, se agrega la cadena de opciones a la lista desplegable
      document.getElementById("categoria_lista").innerHTML = opciones;
    })
    .catch(function (error) {
      console.log(error);
    });



//evento guardar del modal

let formulario_modal = document.getElementById('form_agregarCategoria');
let respuesta_modal = document.getElementById('respuesta_modal');

formulario_modal.addEventListener('submit', function(e){
  e.preventDefault();
  console.log('mediste un click')

  let datos = new FormData(formulario_modal)

  console.log(datos)
  console.log(datos.get('categoria'))
  console.log(datos.get('nombre_marca'))

  // Send a POST request
  axios.post('../apis/v1/inventario/marcas/', {
    nombre: datos.get('nombre_marca'),
    id_categoria: datos.get('categoria')
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
