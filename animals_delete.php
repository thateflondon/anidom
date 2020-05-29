<?php
// Teste si ID passé en paramètre
if (isset($_GET['id_a']) && !empty($_GET['id_a'])) {
    try {
        // Imports
        include_once 'db_connect_inc.php';
        // Prépare et exécute la requête
        $sql = 'DELETE FROM animals WHERE id_a=?';
        $params = array($_GET['id_a']);
        $data = $pdo->prepare($sql);
        $data->execute($params);
        unset($pdo); // Déconnexion

        // Redirige vers liste des hôtels
        header('location:all_animals_list.php');
    } catch (PDOException $err){
        echo '<p>' .$err->getMessage(). '</p>';
    }
}
// Si 'include_once' est ds la partie 'try', faut mettre le 'unset' juste après. Si 'include_once' avant le 'try' mettre 'unset' après le 'catch'
?>