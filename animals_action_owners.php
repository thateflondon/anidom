<?php
// Import de connexion à la BDD (Etape 1)
include_once 'db_connect_inc.php';

// Récupère les valeurs du formulaire (Etape 2)
//(1ere methode: longue)
if (isset($_POST['fname']) && !empty($_POST['fname'])) {
    $params[':fname'] = htmlspecialchars($_POST['fname']);
} else {
    $params['fname'] = null;
}
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $params[':name'] = htmlspecialchars($_POST['name']);
} else {
    $params['name'] = null;
}
if (isset($_POST['title']) && !empty($_POST['title'])) {
    $params[':title'] = htmlspecialchars($_POST['title']);
} else {
    $params['title'] = null;
}
if (isset($_POST['mail']) && !empty($_POST['mail'])) {
    $params[':mail'] = htmlspecialchars($_POST['mail']);
} else {
    $params['mail'] = null;
}
if (isset($_POST['city']) && !empty($_POST['city'])) {
    $params[':city'] = htmlspecialchars($_POST['city']);
} else {
    $params['city'] = null;
}

var_dump($_POST);



// Préparation et exécution de la requête (Etape 3) gestion du bouton Insert ou Update
try {
    if (isset($_GET['id_o']) && empty($_GET['id_o'])) {
        // Si id_o est vide alors INSERT
        $sql = 'INSERT INTO owners(fname, name, title, mail, city) VALUES (:fname, :name, :title, :mail, :city)';
    } else {
        // Si id_o n'est pas vide alors UPDATE
        $sql = 'UPDATE owners SET fname=:fname, name=:name, title=:title, mail=:mail, city=:city WHERE id_o='.$_GET['id_o'];
    }
    $data = $pdo->prepare($sql);
    $data->execute($params);
    header('location:index.php');
} catch (PDOException $err) {
    echo $err->getMessage();
}