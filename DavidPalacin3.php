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
/*
//alter the movie table to include running time, cost and takings fields
$query = 'ALTER TABLE musica ADD COLUMN (
    musica_running_time TINYINT UNSIGNED NULL,
    musica_cost         DECIMAL(4,1)     NULL,
    musica_takings      DECIMAL(4,1)     NULL)';
mysqli_query($db,$query) or die(mysqli_error($db));

//insert new data into the movie table for each movie
$query = 'UPDATE musica SET
        musica_running_time = 500,
        musica_cost = 500,
        musica_takings = 500.8
    WHERE
        id = 1';
mysqli_query($db,$query) or die(mysqli_error($db));

$query = 'UPDATE musica SET
        musica_running_time = 50,
        musica_cost = 50.7,
        musica_takings = 50.8
    WHERE
        id = 2';
mysqli_query($db,$query) or die(mysqli_error($db));

$query = 'UPDATE music SET
        musica_running_time = 134,
        musica_cost = NULL,
        musica_takings = 33.2
    WHERE
        music_id = 3';
mysqli_query($db,$query) or die(mysqli_error($db));

*/
$query = 'CREATE TABLE criticas (
        critica_music_id INTEGER UNSIGNED NOT NULL, 
        critica_fecha     DATE             NOT NULL, 
        critica_nombre   VARCHAR(255)     NOT NULL, 
        critica_comentario  VARCHAR(255)     NOT NULL, 
        critica_puntacion   TINYINT UNSIGNED NOT NULL  DEFAULT 0, 

        KEY (critica_music_id)
    )
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//insert new data into the reviews table
$query = <<<ENDSQL
INSERT INTO criticas
    (critica_music_id, critica_fecha, critica_nombre, critica_comentario,
        critica_puntacion)
VALUES 
    (1, "2008-09-23", "John Doe", "I thought this was a great movie
        Even though my girlfriend made me see it against my will.", 4),
    (1, "2008-09-23", "Billy Bob", "I liked Eraserhead better.", 2),
    (1, "2008-09-28", "Peppermint Patty", "I wish I'd have seen it
        sooner!", 5),
    (2, "2008-09-23", "Marvin Martian", "This is my favorite movie. I
        didn't wear my flair to the movie but I loved it anyway.", 5),
    (3, "2008-09-23", "George B.", "I liked this movie, even though I
        Thought it was an informational video from my travel agent.", 3),
    (4, "2018-09-23", "Fran G.", "I liked this movie, even though I
        Thought it was an informational video from my travel agent.", 8),
    (5, "2005-09-23", "Maikel B.", "I liked this movie, even though I
        Thought it was an informational video from my travel agent.", 3),
    (6, "2008-09-23", "Paco B.", "I liked this movie, even though I
        Thought it was an informational video from my travel agent.", 7)
ENDSQL;
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Music database successfully updated!';
?>

