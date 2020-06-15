<?php
//connect to MySQL
// Datos para conectar a la base de datos.
$servername = "localhost";
$database = "admin";
$username = "root";
$password = "root";

// Create connection
$db = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
echo 'Se ha conectado a la bd'; 
echo '<br>';

// retrieve information
$query = 'SELECT
        id, nombre, fecha, genero, artista,
        productor
    FROM
        musica
    ORDER BY
        nombre ASC,
        fecha DESC';
        
$result = mysqli_query($db,$query) or die(mysqli_error($db));

// determine number of rows in returned result
$num_music = mysqli_num_rows($result);
?>
<div style="text-align: center;">
 <h2>Musica</h2>
 <table border=1 cellpadding="2" cellspacing="2"
  style="width: 70%; margin-left: auto; margin-right: auto;">
  <tr>
   <th>Titulo</th>
   <th>Fecha</th>
   <th>Genero</th>
   <th>Artista</th>

  </tr>
<?php
    function get_tipos($id) {
        global $db;
        $query = 'SELECT
        genero
        FROM
        genero
        WHERE
        id ='.$id;
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        $row = mysqli_fetch_assoc($result);
        extract($row);
        return $genero;
        }
        
    function get_cantante($id) {
        global $db;
        $query = 'SELECT
        nombre_completo
        FROM
        persona
        WHERE
        id ='.$id;
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        $row = mysqli_fetch_assoc($result);
        extract($row);
        return " ' . $nombre_completo . ' ";
        }
?>
<?php
// loop through the results
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    echo '<tr>';
    echo '<td><a href="DavidPalacin2.php?id='.$id.'&orden=critica_fecha">' . $nombre . '</a></td>';
    echo '<td>' . $fecha . '</td>';
    echo '<td>' . get_tipos($genero) . '</td>';
    echo '<td>' . get_cantante($nombre_completo) . '</td>';
    echo '</tr>';
}     
?>
 </table>
<p><?php echo $num_music; ?> Musica</p>
</div>