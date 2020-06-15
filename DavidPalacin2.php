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
        return " ' . $genero . ' ";
        }
        
    function get_cantante($id) {
        global $db;
        $query = 'SELECT
        artista
        FROM
        musica
        WHERE
        id ='.$id;
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        $row = mysqli_fetch_assoc($result);
        extract($row);
        return " ' . $artista . ' ";
        }

$query = 'SELECT
        id, nombre, fecha, genero, artista,
        productor, musica_running_time, musica_cost, musica_takings
    FROM
        musica
    WHERE
        id=' . $_GET['id'];
        
$result = mysqli_query($db,$query) or die(mysqli_error($db));
$row = mysqli_fetch_assoc($result);
extract($row);

$nombre     =   $nombre;
$fecha      =   $fecha;
$genero      =   get_tipos($genero);
$artista  =   get_cantante($artista);
$musica_running_time = $musica_running_time;
$musica_cost = $musica_cost;
$musica_takings = $musica_takings;


// display the information
echo <<<ENDHTML
<html>
 <head>
  <title>Details and Reviews for: $nombre</title>
  <style type='text/css'>   
    tr:nth-child(odd) {  
        background-color:#FF4600; 
    }  
    tr:nth-child(even) {
        background-color:#D19781;
    }
</style>
 </head>
 <body>
  <div style="text-align: center;">
   <h2>$nombre</h2>
   <h3><em>Detalles</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 70%; margin-left: auto; margin-right: auto;">
    <tr style="background-color:white;">
     <td><strong>Titulo disco</strong></strong></td>
     <td>$nombre</td>
     <td><strong>Año de publicacion</strong></strong></td>
     <td>$fecha</td>
    </tr>
    <tr style="background-color:white;">
     <td><strong>Genero musical</strong></td>
     <td>$genero</td>
     <td><strong>Cantante</strong></td>
     <td>$artista</td>
    </tr>
    <tr style="background-color:white;">
     <td><strong>Duración</strong></td>
     <td>$musica_running_time</td>
     <td><strong>Coste</strong></td>
     <td>$musica_cost</td>
    </tr>
    <tr style="background-color:white;">
     <td><strong>Visitas</strong></td>
     <td>$musica_takings</td>
    </tr>
   </table>
ENDHTML;

// retrieve reviews for this movie

$query = 'SELECT
        critica_music_id, critica_fecha, critica_nombre, critica_comentario,
        critica_puntacion
    FROM
        criticas
    WHERE
        critica_music_id = ' . $_GET['id'];

$result = mysqli_query($db,$query) or die(mysqli_error($db));


// display the reviews
echo <<< ENDHTML
   <h3><em>Comentarios</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 90%; margin-left: auto; margin-right: auto;">
    <tr>
     <th style="width: 7em;"><a href='DavidPalacin2.php?id=$_GET[id]&orden=critica_fecha'>Fecha</a></th>
     <th style="width: 10em;"><a href='DavidPalacin2.php?id=$_GET[id]&orden=critica_nombre'>Nombre</th>
     <th><a href='DavidPalacin2.php?id=$_GET[id]&orden=critica_comentario'>Comentario</th>
     <th style="width: 5em;"><a href='DavidPalacin2.php?id=$_GET[id]&orden=critica_puntacion'>Valoracion</th>
    </tr>
ENDHTML;
    

    $query = 'SELECT
        critica_music_id, critica_fecha, critica_nombre, critica_comentario,
        critica_puntacion
    FROM
        criticas
    WHERE
        critica_music_id = ' . $_GET['id'] . '
    ORDER BY '. $_GET['orden'];

    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    function generate_ratings($rating){
        $critica_puntacion = "";
        for($i=0;$i<$rating;$i++){
            $critica_puntacion.='<img id="1" src="estrella.jpg" width="20px" height="20px" alt="star");" />';
            $entera = intval($rating);
            $decimal= $rating - $entera;
            $div= 20*$decimal;
                if(is_int($decimal) == false ){
                    $critica_puntacion.='<img id="1" src="estrella.jpg" width="20px" height="20px" alt="star" style="clip :rect(0px, '.($div).'px,200px,0px); position: absolute;" />';
                }
            }
            return $critica_puntacion;    
    }

// $row = mysqli_fetch_assoc($result);
// extract($row);

// $rating      =   generate_ratings($critica_puntacion);


/*$critica_fecha     =   $critica_fecha;
$critica_nombre      =   $critica_nombre;
$critica_comentario      =   $critica_comentario;
$critica_puntacion  =   $critica_puntacion;*/
$cont=0;
$cont2=0;

while ($row = mysqli_fetch_assoc($result)) {
    /*extract($row);
    $rating      =   generate_ratings($critica_puntacion);*/
    $critica_fecha = $row['critica_fecha'];
    $critica_nombre = $row['critica_nombre'];
    $critica_comentario = $row['critica_comentario'];
    $rating = generate_ratings($row['critica_puntacion']);
    $cont++;
    $cont2=$cont2+$row['critica_puntacion'];
    echo <<<ENDHTML
    <tr>
      <td style="vertical-align:top; text-align: center;">$critica_fecha</td>
      <td style="vertical-align:top;">$critica_nombre</td>
      <td style="vertical-align:top;">$critica_comentario</td>
      <td style="vertical-align:top;">$rating</td>

    </tr>

ENDHTML;
}

echo <<<ENDHTML
  </div>
 </body>
</html>
ENDHTML;

?>

<?php

$res=$cont2/$cont;
$res = round($res, 0);
echo $res;
$res = generate_ratings($res);
echo 'Media valoraciones:  '. $res;

?>

