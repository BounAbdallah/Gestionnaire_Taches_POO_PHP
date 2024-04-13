<?php
// Inclure les fichiers nécessaires
require_once 'config.php';
require_once 'Task.php';

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

// Initialiser la session (déjà fait ci-dessus)
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// Afficher le nom de l'utilisateur connecté
$userFullName = $_SESSION['user']['prenom'] . " " . $_SESSION['user']['nom'];

// Récupérer l'ID de l'utilisateur
$userId = $_SESSION['user']['id'];

// Créer une instance de la classe Task
$taskManager = new Task($connexion);

// Récupérer les tâches de l'utilisateur
$tasks = $taskManager->getTasks($userId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style.css">

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
      margin-bottom: 20px;
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
      background-color: #2193b0;
    }

    .tache_en_terminer {
      background-color: #00b09b;
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
    main{
      margin-top: 50px;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-10 mb-15 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Dashboard</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Se deconnecter </a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="fas fa-home"></i>
                 <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="fas fa-chart-bar"></i>
                Accueil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.taches.php">
                <i class="fas fa-table"></i>
                Creer une tâche
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="taches.php">
                <i class="fas fa-table"></i>
                Voire toutes les tâches
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Bienvenue, <?php echo $userFullName; ?></h1>
        </div>

        <div class="row">
        <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            A faire
        </div>
        <div class="card-body">
            <ul>
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['statut'] == 'A faire') : ?>
                        <a href="edit_task.php?id=<?php echo $task['id']; ?>">
                            <li><?php echo htmlspecialchars($task['tache']); ?></li>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Tâches en cours
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom de la tâche</th>
                      <th>Description</th>
                      <th>Statut</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Récupérer les tâches avec le statut "En cours"
                    $tasksInProgress = $taskManager->getTasksByStatus($userId, 'En cours');
                    foreach ($tasksInProgress as $task) : ?>
                      <tr>
                        <td><?php echo htmlspecialchars($task['id']); ?></td>
                        
                        <td>
                        <a href="tache.details.php?id=<?php echo $task['id']; ?>">  
                          <?php echo htmlspecialchars($task['tache']); ?></td>
                        </a>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td class="tache_en_cours"><?php echo htmlspecialchars($task['statut']); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-6 mt-10">
    <div class="card">
        <div class="card-header">
            Terminées
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom de la tâche</th>
                        <th>Description</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les tâches avec le statut "Terminé"
                    $tasksCompleted = $taskManager->getTasksByStatus($userId, 'Terminer');
                    foreach ($tasksCompleted as $task) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['id']); ?></td>
                            <td>
                                <a href="tache.details.php?id=<?php echo $task['id']; ?>">
                                    <?php echo htmlspecialchars($task['tache']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                            <td class="tache_en_terminer"><?php echo htmlspecialchars($task['statut']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

      </main>
    </div>
  </div>
 


  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
