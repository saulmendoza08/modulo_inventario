// Obtener los datos de la API
fetch('../apis/v1/solicitudes_compra')
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
        <td>${producto.id}</td>
        <td>${producto.fecha_sol}</td>
        <td>${producto.ticket}</td>
        <td>${producto.oc}</td>
        <td>${producto.fecha_recepcion}</td>
        <td>${producto.remito}</td>
        <td>${producto.id_servicio}</td>
        <td>${producto.pc}</td>
        <td>${producto.id_estado}</td>
      `;

      // Agregar la fila a la tabla
      tabla.querySelector('tbody').appendChild(fila);
    });
  });
