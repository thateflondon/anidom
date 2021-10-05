<?php
// Import
include_once 'constants_inc.php';

// try {
//     // Connexion à BDD
//     $dsn = 'mysql:host=' . HOST . ';dbname=' . BASE . ';charset=utf8';
//     $opt = array(
//         //affichage messages erreurs
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     );
//     $pdo = new PDO($dsn, USER, PASS, $opt);
// } catch (PDOException $err) {
//     echo '<div class="alert alert-danger">' . $err->getMessage() . '</div>';
// }
//var_dump($opt)

//Get HEROKU ClearDB connection informations
$cleardb_url = parse_url(getenv('CLEAR_DATABASE_URL'));
$cleardb_server = $cleardb_url['host'];
$cleardb_username = $cleardb_url['user'];
$cleardb_password = $cleardb_url['password'];
$cleardb_db = substr($cleardb_url['path'], 1);

$active_group = 'default';
$query_builder = TRUE;

//Connect to the DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
echo "Hello i'm connected to heroku";
