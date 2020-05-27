<?php
// Import
include_once 'constants_inc.php';

try {
    // Connexion à BDD
    $dsn = 'mysql:host=' . HOST . ';dbname=' . BASE . ';charset=utf8';
    $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $pdo = new PDO($dsn, USER, PASS, $opt);
} catch (PDOException $err) {
    echo '<div class="alert alert-danger">' . $err->getMessage() . '</div>';
}
//var_dump($opt)
?>