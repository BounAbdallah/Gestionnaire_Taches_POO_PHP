<?php



define('CONNECT', 'mysql:host=localhost;dbname=GS_TACHE;charset=utf8');
define('USER', 'root');
define('PASSWORD', '');

try {
    $connexion = new PDO(CONNECT, USER, PASSWORD);
} catch (PDOException $erreur) {
    die('Erreur de connexion à la base de données : ' . $erreur->getMessage());
}