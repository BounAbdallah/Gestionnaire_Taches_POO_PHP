<?php
// Initialiser la session
session_start();

// Inclure les fichiers nécessaires
require_once 'config.php';
require_once 'Task.php';

// Récupération des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_SESSION['user']['id']; // Remplacez par la manière dont vous récupérez l'ID de l'utilisateur
    $tache = $_POST['task'];
    $description = $_POST['description'];
    $statut = $_POST['status'];
    $date_creation = date("Y-m-d H:i:s"); // Date et heure actuelles
}

// Ensuite, passez ces variables à la méthode createTask de votre classe Task
if (isset($id_utilisateur, $tache, $description, $statut, $date_creation)) {
    $taskManager = new Task($connexion);
    $taskManager->createTask($id_utilisateur, $tache, $description, $statut, $date_creation);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une nouvelle tâche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5 mb-4">Ajouter une nouvelle tâche</h1>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="tache" class="form-label">Nom de la tâche</label>
            <input type="text" class="form-control" id="tache" name="task" required>

        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-control" id="status" name="status">
                <option value="À faire">A faire</option>
                <option value="En cours">En cours</option>
                <option value="Terminé">Terminer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter la tâche</button>
    </form>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

