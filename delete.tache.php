<?php
require_once 'config.php';
require_once 'Task.php';
// Créer une instance de la classe Task
$taskManager = new Task($connexion);

// Supprimer une tâche
$taskIdToDelete = $_GET['id'];  // Vous pouvez récupérer cet ID depuis la requête HTTP
$result = $taskManager->deleteTask($taskIdToDelete);

// Vérifier le résultat de la suppression
if ($result) {
    // Rediriger vers le dashboard ou une autre page après la suppression
    header("Location: dashboard.php");
    exit;
} else {
    // Afficher un message d'erreur si la suppression a échoué
    echo "La suppression de la tâche a échoué.";
}
