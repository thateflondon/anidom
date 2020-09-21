<?php
// Import de connexion à la BDD (Etape 1)
include_once 'db_connect_inc.php';
session_start(); //vérifie si on est connecté

// Récupère les valeurs du formulaire (Etape 2)
//(1ere methode: longue)
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $params[':name'] = htmlspecialchars($_POST['name']);
} else {
    $params['name'] = null;
}
if (isset($_POST['gender']) && !empty($_POST['gender'])) {
    $params[':gender'] = htmlspecialchars($_POST['gender']);
} else {
    $params['gender'] = null;
}
if (isset($_POST['dob']) && !empty($_POST['dob'])) {
    $params[':dob'] = htmlspecialchars($_POST['dob']);
} else {
    $params['dob'] = null;
}
if (isset($_POST['types_id_type']) && !empty($_POST['types_id_type'])) {
    $params[':types_id_type'] = htmlspecialchars($_POST['types_id_type']);
} else {
    $params['types_id_type'] = null;
}
if (isset($_POST['owners_id_own']) && !empty($_POST['owners_id_own'])) {
    $params[':owners_id_own'] = htmlspecialchars($_POST['owners_id_own']);
} else {
    $params['owners_id_own'] = $_SESSION['id_o']; //récupere ID owner stocké dans $_SESSION (login_action.php)
}
if (isset($_POST['photo']) && !empty($_POST['photo'])) {
    $params[':photo'] = htmlspecialchars($_POST['photo']);
} else {
    $params['photo'] = null;
}

// Récupèration des valeurs du formulaire : 2nd itération (2e méthode de la boucle)
/*foreach ($_POST as $key => $val) {
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        $params[':' . $key] = htmlspecialchars($val);
    } else {
        $params[':' . $key] = null;
    }
*/
//var_dump($_POST);

/***************************************** 
 * 
 *           VARIABLES
 * 
 *****************************************/


// Récupération du fichier à téléverser (Etape 4: intermediaire possible du 2 et 3)
if (isset($_FILES['photo']) && !empty($_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE)) { // tableau multidimensionnel + on rajoute la gestion d'entrée d'animal sans photo avec UPLOAD_ERR_NO_FILE soit error 4 dans php.net et on rajoute un unset du param MAX_SIZE_FILE à la fin du traitement de fichier 
    // Variables
    //var_dump($_FILES);
    $file_name = $_FILES['photo']['name']; // on récupère le nom du fichier photo
    $file_ext = ''; // on recupère l'extension du fichier www/cp7bis/maphoto.jpg on peut egalement utiliser les fonctions suivantes:
    // SUBSTR    :   substr("Mareme, Salima et Tahia sont en vacances.", 18, 5) = "Tahia" on lui indique qu'on ne garde que Tahia 
    // STRPOS    :   strpos("Lesly et Ali forever Aliluia !", "Ali") = 9, on cherche "Ali" donc on l'indique en second dans ("x", "ALi") il compte et A du Ali est en 9e position
    // STRRPOS   :   strrpos("Lesly et Ali forever Aliluia !", "Ali") = xx dans ce cas il applique la même chose qu'au dessus mais en partant de la fin
    $file_ext = substr($file_name, strrpos($file_name, '.') + 1); // soustraire dans $file_name a partant de la fin tout ce qui est après le "." point

    // Taille du fichier en octets
    $file_size = $_FILES['photo']['size'];

    // Type de fichier (Ex.: application/pdf OU text/css OU image/png)
    $file_type = $_FILES['photo']['type'];

    // Adresse du fichier temporaire avant upload
    $file_temp = $_FILES['photo']['tmp_name'];

    // Extensions autorisées
    $allowed_ext = array('bmp', 'gif', 'jpg', 'jpeg', 'png'); //parfois à mettre en MAJ sur certains OS

    /***************************************** 
     * 
     *         GESTION DES ERREURS
     * 
     *****************************************/

    $errors = array();

    // Si extension incorrecte

    if (!in_array($file_ext, $allowed_ext)) {
        $errors[] = '<p>Extension ' . $file_ext . ' non autorisée : ' . implode(',', $allowed_ext);
    }
    if ($file_size > (int) $_POST['MAX_FILE_SIZE']) {
        $errors[] = '<p>Fichier trop lourd : ' . $_POST['MAX_FILE_SIZE'] . ' octets maximum';
    }

    /***************************************** 
     * 
     *         TRAITEMENT DU FICHIER
     * 
     *****************************************/
    if (empty($errors)) {
        // 1. Conversion de l'image en base64 et insersion dans le tableau de paramètres
        $bin = file_get_contents($file_temp);
        $base64 = 'data:' . $file_type . ';base64,' . base64_encode($bin); // Prête à afficher dans SRC
        unset($params[':MAX_FILE_SIZE']); // Supprime l'entrée du tableau de paramètres qui est en trop après le vardump test
        $params[':photo'] = $base64;
        // 2. Téléverse le fichier dans le dossier UPLOAD
        if (!move_uploaded_file($file_temp, 'uploads/' . $file_name)) {
            echo '<p>Erreur dans le téléversement du fichier : ' . $file_name;
            echo '<a href="index.php">Retour page d\'accueil</a>';
            exit(); // die() autre façon de faire
        }
    } else {
        // Affiche les erreurs du tableau
        foreach ($errors as $error) {
            echo $errors;
            echo '<a href="index.php">Retour page d\'accueil</a>';
            exit(); // die() autre façon de faire
        }
    }
} else {
    // SI pas de photo choisie
    unset($params[':MAX_FILE_SIZE']);
    $params[':photo'] = null;
}


// Préparation et exécution de la requête (Etape 3) avec gestion du bouton Insert ou Update
try {
    if (isset($_GET['id_a']) && empty($_GET['id_a'])) {
        // Si id_a est vide alors INSERT
        $sql = 'INSERT INTO animals(name, gender, dob, types_id_type, owners_id_own, photo) VALUES (:name, :gender, :dob, :types_id_type, :owners_id_own, :photo)';   
    } else {
        // Si id_a n'est pas vide alors UPDATE
        $sql = 'UPDATE animals SET name=:name, gender=:gender, dob=:dob, types_id_type=:types_id_type, photo=:photo, owners_id_own=:owners_id_own WHERE id_a='.$_GET['id_a'];     
    }
    
    $data = $pdo->prepare($sql);
    $data->execute($params);
    echo '<p>Votre animal a bien été enregistré !</p>';
    //header('location:index.php');
} catch (PDOException $err) {
    echo $err->getMessage();
}
