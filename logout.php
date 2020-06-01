<?php
// Restaure la session en cours
session_start();
// Efface les variables de session
unset($_SESSION);
// Détruit la session
session_destroy();
// Redirige vers INDEX
header('location:index.php');
?>