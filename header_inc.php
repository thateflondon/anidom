<?php
// Teste si session est active ou non 
session_start();
// Teste si connected existe et est vrai
if (isset($_SESSION['connected']) && !empty($_SESSION['connected']) && $_SESSION['connected'] === true) {
    $connected = true;
} else {
    $connected = false;
}
?>