<?php
// Initialiser la session
session_start();

require_once 'config.php';
require_once 'User.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance de la classe User
    $user = new User(new PDO(CONNECT, USER, PASSWORD));

    // Connexion de l'utilisateur
    if (!$user->login($email, $password)) {
        // Les informations d'identification sont incorrectes
        $error_message = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <form action="" method="post">
    <div class="form-group">
      <input type="text" class="form-control" name="email" placeholder="Nom d'utilisateur ou Email" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Connexion</button>
    <?php if(isset($error_message)) { ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?php echo $error_message; ?>
      </div>
    <?php } ?>
  </form>
  <div class="col-md-12 mt-3">
    <p>J'ai pas de compte, <a  class="btn btn-primary btn-block" href="register.php">m'inscrire maintenant</a></p>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


