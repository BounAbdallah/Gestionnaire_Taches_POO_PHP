<?php
// Démarrer la session
session_start();

// Détruire toutes les données de session
session_destroy();

// Rediriger l'utilisateur vers la page d'index
header("Location: index.php");
exit;
