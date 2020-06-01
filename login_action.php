<?php
// Imports
include_once 'constants.inc.php';
include_once 'db_connect_inc.php';

// GESTION DU CAPTCHA (rajouté en toute fin)
// Crée ou restaure une session
session_start();

// Test saisie
if (isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
    // Analyse et transforme la saisie
    $mail = htmlspecialchars($_POST['mail']);
    $pass = htmlspecialchars($_POST['pass']);
    $pass = sha1(md5($pass) . sha1($mail)); // Ici on a crypté le mdp avec md5 qu'on a concatené avec le mail crypté en sha1 le tout crypté en sha1

    //Prépare la requête d'authentification
    $sql = ' SELECT COUNT(*) As Nb FROM subscribers WHERE mail=? AND pass=?';
    $params = array($mail, $pass);
    $data = $pdo->prepare($sql);
    $data->execute($params);
    $row = $data->fetch();

    // Test authentification
    if ((int) $row['Nb'] === 1) {
        if ($_POST['captcha'] === $_SESSION['captcha']) { // on integre la vérification du captcha ds la boucle
            // Suppprime la session en cours
            session_unset();
            session_destroy();
            // Créer une nouvelle session
            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['mail'] = $mail;
            $_SESSION['connection_time'] = date('Y-m-d h:i:s');
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; // Pour IP Localisation par exemple
            // Créer un cookie
            setcookie('subscriber', json_encode($_SESSION), time() + 30 * 24 * 60 * 60);
            // Redirection vers INDEX
            header('location:index.php');
        } else {
            header('location:login.php?auth=false');
        }
        
    } else {
        header('location:login.php?auth=false');
    }
} else {
    header('location:login.php?auth=false');
}