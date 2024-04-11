<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'Accueil</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background: #0f0c29; /* Couleur de fond avec dégradé */
      background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);
      background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
      font-family: Arial, sans-serif;
    }

    .jumbotron {
      background: #FFFFFF; /* Couleur de fond de la jumbotron */
      background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);
      background: linear-gradient(to right, #FFFFFF, #FFEFBA);
      color: #dc3545; /* Texte rouge */
      padding: 3rem;
      border-radius: 0;
    }

    .btn-primary {
      background-color: #dc3545; /* Couleur rouge pour le bouton Se Connecter */
      border-color: #dc3545;
      color: #fff; /* Texte blanc */
    }

    .btn-primary:hover {
      background-color: #c82333; /* Couleur rouge plus foncée au survol */
      border-color: #bd2130;
    }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
      color: #fff; /* Texte blanc */
    }

    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
  </style>
</head>
<body>

  <div class="jumbotron text-center mb-0">
    <h1 class="display-4">Bienvenue sur notre plateforme Muda ni Mali</h1>
    <p class="lead">La plateforme qui vous permet d'organiser vos tâches.</p>
    <p class="lead">Connectez-vous ou inscrivez-vous pour accéder à notre plateforme.</p>
  </div>

  <div class="container-fluid text-center py-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <a href="login.php" class="btn btn-primary btn-lg btn-block mb-2">Se Connecter</a>
      </div>
      <div class="col-md-4">
        <a href="register.php" class="btn btn-secondary btn-lg btn-block">S'Inscrire</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
