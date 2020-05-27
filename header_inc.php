<?php
// Restaurer une session si elle existe
session_start();

// Teste si connected existe et est vrai
if (!isset($_SESSION['connected']) && !$_SESSION['connected']) {
    header('location:index.php');
    exit();
}
?>