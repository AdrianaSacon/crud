<!DOCTYPE html>
<html>
<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      text-align: left;
      padding: 8px;
    }
    tr:nth-child(even){background-color: #f2f2f2}
    th {
      background-color: #4CAF50;
      color: white;
    }
    
    /* Estilos adicionales para centrar el formulario */
    #formContainer {
      width: 100%; /* Ancho del cuadro al 100% */
      max-width: 200px; /* Ancho máximo del cuadro */
      margin: 0 auto; /* Centrar horizontalmente */
      padding: 10px; /* Espacio interno */
      border: 1px solid #ccc; /* Borde */
      border-radius: 5px; /* Esquinas redondeadas */
    }
    
    #userForm input[type="submit"] {
      margin-top: 10px; /* Espacio superior para el botón Agregar */
    }
  </style>
</head>
<body>
  <div id="formContainer">
    <h2>Formulario </h2>
    <form id="userForm">
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username"><br><br>
      
      <label for="name">Nombre:</label>
      <input type="text" id="name" name="name"><br><br>
      
      <label for="city">Ciudad:</label>
      <input type="text" id="city" name="city"><br><br>
      
      <label for="address">Dirección:</label>
      <input type="text" id="address" name="address"><br><br>
      
      <label for="category">Categoría:</label>
      <input type="text" id="category" name="category"><br><br>
      
      <label for="size">Talla:</label>
      <input type="text" id="size" name="size"><br><br>
      
      <input type="submit" value="Agregar">
    </form>
  </div>
  
  <h2>Resultados</h2>
  <table id="resultsTable">
    <tr>
      <th>Usuario</th>
      <th>Nombre</th>
      <th>Ciudad</th>
      <th>Dirección</th>
      <th>Categoría</th>
      <th>Talla</th>
      <th>Acciones</th>
    </tr>
	
    <?php
    // Conexión a la base de datos
    $conn = pg_connect("host=127.0.0.1 dbname=db_registros user=postgres password=123456");
    if (!$conn) {
		echo "Error al conectar a la base de datos.";
	  } else {
    // Consulta para obtener los registros
    $query = "SELECT * FROM usuario";
    $result =pg_query($conn, $query);
    
    // Iterar sobre los registros y mostrarlos en la tabla
    while ($row = pg_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row['usuarios']."</td>";
      echo "<td>".$row['nombres']."</td>";
      echo "<td>".$row['ciudad']."</td>";
      echo "<td>".$row['direccion']."</td>";
      echo "<td>".$row['categoria']."</td>";
      echo "<td>".$row['talla']."</td>";
      echo '<td><button onclick="editRow(this)">Editar</button> <button onclick="deleteRow(this)">Eliminar</button></td>';
      echo "</tr>";
    }
    
    // Cerrar la conexión a la base de datos
    pg_close($conn);
}
    ?>
 
  </table>
 
  <script>
    // Función para agregar un nuevo registro a la tabla
    function addRow() {
      var table = document.getElementById("resultsTable");
      var row = table.insertRow();
      
      var username = document.getElementById("username").value;
      var name = document.getElementById("name").value;
      var city = document.getElementById("city").value;
      var address = document.getElementById("address").value;
      var category = document.getElementById("category").value;
      var size = document.getElementById("size").value;
      
      var cell1 = row.insertCell();
      var cell2 = row.insertCell();
      var cell3 = row.insertCell();
      var cell4 = row.insertCell();
      var cell5 = row.insertCell();
      var cell6 = row.insertCell();
      var cell7 = row.insertCell();
      
      cell1.innerHTML = username;
      cell2.innerHTML = name;
      cell3.innerHTML = city;
      cell4.innerHTML = address;
      cell5.innerHTML = category;
      cell6.innerHTML = size;
      cell7.innerHTML = '<button onclick="editRow(this)">Editar</button> <button onclick="deleteRow(this)">Eliminar</button>';
      
      // Limpiar los campos del formulario
      document.getElementById("username").value = "";
      document.getElementById("name").value = "";
      document.getElementById("city").value = "";
      document.getElementById("address").value = "";
      document.getElementById("category").value = "";
      document.getElementById("size").value = "";
    }
    
    // Función para eliminar una fila de la tabla
    function deleteRow(button) {
      var row = button.parentNode.parentNode;
      row.parentNode.removeChild(row);
    }
    
    // Función para editar una fila de la tabla
    function editRow(button) {
      var row = button.parentNode.parentNode;
      var cells = row.getElementsByTagName("td");
      
      document.getElementById("username").value = cells[0].innerHTML;
      document.getElementById("name").value = cells[1].innerHTML;
      document.getElementById("city").value = cells[2].innerHTML;
      document.getElementById("address").value = cells[3].innerHTML;
      document.getElementById("category").value = cells[4].innerHTML;
      document.getElementById("size").value = cells[5].innerHTML;
      
      row.parentNode.removeChild(row);
    }
    
    // Event listener para el formulario
    document.getElementById("userForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Evitar el envío del formulario
      
      addRow();
    });
  </script>
</body>
</html>
