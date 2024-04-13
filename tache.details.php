<?php
// Inclure les fichiers nécessaires
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

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Tâche</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Custom styles for this template */
        body {
            background: #0f0c29;
            background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);
            background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #dc3545;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #FFEFBA;
        }

        .tache_en_cours {
            background-color: #00b09b;
        }

        .tache_en_terminer {
            background-color: red;
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .col-md-6 {
            margin-top: 20px;
        }

        .card-header {
            background-color: #dc3545;
            color: #fff;
        }
        h2{
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Détails de la Tâche</h2>
    <div class="card">
        <div class="card-header">
            <?php echo htmlspecialchars($taskDetails['tache']); ?>
        </div>
        <div class="card-body">
            <h5 class="card-title">Description :</h5>
            <p class="card-text"><?php echo htmlspecialchars($taskDetails['description']); ?></p>
            <h5 class="card-title">Statut :</h5>
            <p class="card-text"><?php echo htmlspecialchars($taskDetails['statut']); ?></p>
            <a href="edit_task.php?id=<?php echo $taskDetails['id']; ?>" class="btn btn-primary"> Modifier</a>
            <a href="delete_task.php?id=<?php echo $taskDetails['id']; ?>" class="btn btn-danger"> Supprimer</a>
            <a href="dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
