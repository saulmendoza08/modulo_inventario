$(function () {


    // Obtener los datos de la API
    fetch('../apis/v1/servicios')
      .then(response => response.json())
      .then(data => {
        // Obtener la tabla por su ID
        const tabla = document.getElementById('tabla-servicios');
            
        // Obtener la referencia al tbody de la tabla
        let tbody = document.getElementById("tabla-servicios").getElementsByTagName("tbody")[0];
        // Establecer el contenido HTML del tbody a una cadena vacía
        tbody.innerHTML = "";
    
        // Recorrer los datos y crear una fila para cada producto
        data.forEach(producto => {
          // Crear una nueva fila
          const fila = document.createElement('tr');
    
          // Agregar las celdas con los datos del producto
          fila.innerHTML = `
            <td>${producto.id}</td>
            <td>${producto.servicio}</td>
            <td>${producto.interno}</td>
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
      