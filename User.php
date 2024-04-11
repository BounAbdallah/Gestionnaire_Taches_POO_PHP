<?php

class User {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function register($prenom, $nom, $telephone, $adresse, $email, $password) {
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Préparer la requête SQL d'insertion
        $query = "INSERT INTO Utilisateur (prenom, nom, telephone, adresse, email, mot_de_passe) VALUES (:prenom, :nom, :telephone, :adresse, :email, :password)";
        $statement = $this->connexion->prepare($query);
    
        // Binder les valeurs
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':telephone', $telephone);
        $statement->bindParam(':adresse', $adresse);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $hashedPassword);
    
        // Exécuter la requête
        $statement->execute();
        header("Location: login.php");

    }
    

    public function login($email, $password) {
        // Préparer la requête SQL pour récupérer l'utilisateur avec l'email donné
        $query = "SELECT * FROM Utilisateur WHERE email = :email";
        $statement = $this->connexion->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
    
        // Récupérer l'utilisateur depuis la base de données
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // L'utilisateur est connecté avec succès
            // Vous pouvez stocker des informations sur l'utilisateur dans la session si nécessaire
            $_SESSION['user'] = $user;
    
            // Rediriger l'utilisateur vers le tableau de bord
            header("Location: dashboard.php");
            exit;
        } else {
            // Les informations d'identification sont incorrectes
            return false; // Retourner false pour indiquer que la connexion a échoué
        }
    }
}

