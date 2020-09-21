<?php
// Imports
include_once 'constants_inc.php';
include_once 'db_connect_inc.php';
include_once 'functions_inc.php';

// Vérifier que l'adresse mail est nouvelle (pas de doublon)
//SQL pour afficher le nb de lignes ou adresse mail = xx@y.fr ("?")

$sql = 'SELECT COUNT(*) AS Nb FROM owners WHERE mail = ?';
$params = array($_POST['mail']);
$data = $pdo->prepare($sql);
$data->execute($params);
$row = $data->fetch();

if ((int) $row['Nb'] === 0) {
    // Insérer les données dans la table SUBSCRIBERS
    $sql = 'INSERT INTO owners(title, fname, name, mail, city, pass) VALUES (:title, :fname, :name, :mail, :city, :pass)';
    $data = $pdo->prepare($sql);
    // Solution 1 : avec BINDVALUE (qd on a pas bcp de parametres)
    //$data->bindValue(':fname', htmlspecialchars($_POST['fname']),PDO::PARAM_STR);
    //$data->bindValue(':mail', htmlspecialchars($_POST['mail']),PDO::PARAM_STR);
    //$data->bindValue(':dob', htmlspecialchars($_POST['dob']),PDO::PARAM_STR);
    //$data->bindValue(':gender', htmlspecialchars($_POST['gender']),PDO::PARAM_STR);
    //$data->bindValue(':news', htmlspecialchars($_POST['news']),PDO::PARAM_INT);
    // Exécuter la requête
    //$data->execute();

    // Solution 2 avec ARRAY
    //on traite le mot de passe normalement qd on reçoit le mail(sendmail) avec mdp a decommenter si ok
    //$pass = get_password();
    //$hash = sha1( md5($pass) . sha1($_POST['fname']) );

    //on traite le mot de passe autrement qd on ne reçoit pas encore le mmdp
    $pass = 'secret'; //get_password();
    $hash = sha1(md5($pass) . sha1($_POST['mail']));


    $params = array(
        ':title' => htmlspecialchars($_POST['title']),
        ':fname' => htmlspecialchars($_POST['fname']),
        ':name' => htmlspecialchars($_POST['name']),
        ':mail' => htmlspecialchars($_POST['mail']),
        ':city' => htmlspecialchars($_POST['city']),
        ':pass' => $hash
        //':pass' => $pass
    );
    $data->execute($params);

    // Envoyer un mail de confirmation d'inscription
    // Prépare le corps du mail
    $html = '<p>Bienvenue ' . $_POST['fname'] . ',';
    $html .= '<p>Nous confirmons votre inscription à PetSitter.com, vous pouvez désormais vous connecter en tant que membre en utilisant les accréditations suivantes :';
    $html .= '<ul>';
    $html .= '<li>Identifiant : ' . $_POST['mail'];
    $html .= '<li>Mot de passe : ' . $pass;
    $html .= '<ul>';
    $html .= '<p>A très vite sur PetSitter.com !';


    // Header du mail : IMPORTANT !!! 
    $header = "MIME-Version: 1.0 \n"; // Version MIME
    $header .= "Content-type: text/html;charset=utf-8 \n"; // Format du mail
    $header .= "From: jerry.frederic.l@gmail.com \n"; // Expéditeur
    $header .= "Reply-to: jerry.fpl@gmail.com \n"; // Destinataire de la réponse
    $header .= "Disposition-Notification-To: jerry.frederic.l@gmail.com \n"; // Accusé de réception
    $header .= "X-Priority: 1 \n"; // Important
    $header .= "X-MSMail-Priority: High \n";

    // Envoie le mail
    // Pour Linux, installer un serveur de messagerie : http://www.postfix.org/
    ini_set('SMTP', 'smtp.sfr.fr');
    //ini_set('sendmail_from', 'jerry.frederic.l@gmail.com'); //WINDOWS ONLY !!! 
    ini_set('sendmail_path', 'usr/sbin/sendmail');//ini_set('sendmail_path', '/chemin où se trouve sendmail.exe'); // LINUX only !!! 
    mail($_POST['mail'], 'Confirmation Inscription', $html, $header);

    echo '<p>Nous avons bien enregistré votre inscription !</p>';
} else {
    echo '<p>Vous êtes déjà inscris sur notre plateforme, veuillez vous connecter à l\'aide de vos identifiants !</p>';
}
