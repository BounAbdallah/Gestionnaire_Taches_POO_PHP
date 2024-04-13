<?php
// Initialiser la session
session_start();

// Vérifier si la session est déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas déjà démarrée, démarrer une nouvelle session
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

require_once 'config.php';
require_once 'Task.php';

// Vérifier si la session est déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

// Récupérer l'ID de la tâche depuis l'URL
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
} else {
    // Rediriger avec un message d'erreur si l'ID de la tâche n'est pas fourni
    header("Location: dashboard.php?error=missing_id");
    exit;
}

// Créer une instance de la classe Task
$taskManager = new Task($connexion);

// Récupérer les détails de la tâche
$taskDetails = $taskManager->getTaskDetails($taskId);

// Vérifier si la tâche existe
if (!$taskDetails) {
    // Rediriger avec un message d'erreur si la tâche n'existe pas
    header("Location: dashboard.php?error=task_not_found");
    exit;
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $tache = $_POST['tache'];
    $description = $_POST['description'];
    $statut = $_POST['status'];

    // Mettre à jour la tâche
    $result = $taskManager->updateTask($taskId, $tache, $description, $statut);

    if ($result) {
        // Rediriger avec un message de succès
        header("Location: dashboard.php?success=task_updated");
        exit;
    } else {
        // Rediriger avec un message d'erreur
        header("Location: edit_task.php?id={$taskId}&error=update_failed");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Modifier une tâche</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="new_task" class="form-label">Nouveau nom de la tâche</label>
            <input type="text" class="form-control" id="tache" name="tache" value="<?php echo isset($taskDetails['tache']) ? htmlspecialchars($taskDetails['tache']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($taskDetails['description']) ? htmlspecialchars($taskDetails['description']) : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-control" id="status" name="status">
    <option value="A faire" <?php echo isset($taskDetails['statut']) && $taskDetails['statut'] == 'A faire' ? 'selected' : ''; ?>>À faire</option>
    <option value="En cours" <?php echo isset($taskDetails['statut']) && $taskDetails['statut'] == 'En cours' ? 'selected' : ''; ?>>En cours</option>
    <option value="Terminer" <?php echo isset($taskDetails['statut']) && $taskDetails['statut'] == 'Terminer' ? 'selected' : ''; ?>>Terminer</option>
</select>

        </div>
        <button type="submit" class="btn btn-primary">Modifier la tâche</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

