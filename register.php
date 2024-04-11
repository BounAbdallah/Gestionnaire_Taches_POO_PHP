<?php
// Initialiser la session
// session_start();

require_once 'config.php';
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance de la classe User
    $user = new User($connexion);

    // Inscription de l'utilisateur
    $user->register($prenom, $nom, $telephone, $adresse, $email, $password);

    // Rediriger l'utilisateur vers une page de confirmation ou autre
    // Par exemple, rediriger vers la page de connexion
    // header("Location: login.php");
    // exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #0f0c29; /* Couleur de fond avec dégradé */
      background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);
      background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 400px;
      margin-top: 100px;
    }

    .form-control {
      background-color: #FFEFBA; /* Couleur de fond pour les champs de saisie */
      color: #dc3545; /* Couleur du texte */
    }

    .btn-primary {
      background-color: #dc3545; /* Couleur rouge pour le bouton */
      border-color: #dc3545;
      color: #fff; /* Texte blanc */
    }

    .btn-primary:hover {
      background-color: #c82333; /* Couleur rouge plus foncée au survol */
      border-color: #bd2130;
    }
  </style>
</head>
<body>

<div class="container">
  <form action="" method="post">
    <div class="form-group">
      <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="nom" placeholder="Nom" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="telephone" placeholder="Téléphone" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="adresse" placeholder="Adresse" required>
    </div>
    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Inscription</button>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

