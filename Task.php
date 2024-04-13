<?php
class Task {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function createTask($id_utilisateur, $tache, $description, $statut, $date_creation) {
        $query = "INSERT INTO TacheAFaire (id_utilisateur, tache, description, statut, date_creation) 
                  VALUES (:userId, :taskName, :description, :status, :dateCreation)";
        $statement = $this->connexion->prepare($query);
    
        $statement->bindParam(':userId', $id_utilisateur);
        $statement->bindParam(':taskName', $tache);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':status', $statut);
        $statement->bindParam(':dateCreation', $date_creation);
        
        if ($statement->execute()) {
            // Rediriger vers le tableau de bord après la création de la tâche
            header("Location: dashboard.php");
            exit;
        } else {
            // Gérer les erreurs ici, si nécessaire
            echo "Erreur lors de la création de la tâche.";
        }
    }
    

    public function getTasks($userId) {
        // Préparer la requête SQL pour récupérer les tâches de l'utilisateur
        $query = "SELECT * FROM TacheAFaire WHERE id_utilisateur = :userId";
        $statement = $this->connexion->prepare($query);
    
        // Binder les valeurs
        $statement->bindParam(':userId', $userId);
    
        // Exécuter la requête
        $statement->execute();
    
        // Récupérer et retourner les résultats
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateTask($taskId, $tache, $description, $statut) {
        // Vérifier la longueur de la valeur 'statut'
        if (strlen($statut) > 9) {
            echo "Erreur: La valeur du statut est trop longue.";
            exit;
        }
        
        $query = "UPDATE TacheAFaire SET tache = :taskName, description = :description, statut = :status WHERE id = :taskId";
        $statement = $this->connexion->prepare($query);
        
        $statement->bindParam(':taskId', $taskId);
        $statement->bindParam(':taskName', $tache);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':status', $statut);
        
        $result = $statement->execute();
        
        if (!$result) {
            // Afficher un message d'erreur
            echo "Erreur lors de la mise à jour de la tâche: " . $statement->errorInfo()[2];
            exit;
        }
        
        // Rediriger vers le dashboard après la mise à jour
        header("Location: dashboard.php");
        exit;
    }
    
    
    
    public function getTaskDetails($taskId) {
        // Préparer la requête SQL pour récupérer les détails de la tâche
        $query = "SELECT * FROM TacheAFaire WHERE id = :taskId";
        $statement = $this->connexion->prepare($query);
    
        // Binder les valeurs
        $statement->bindParam(':taskId', $taskId);
    
        // Exécuter la requête
        $statement->execute();
    
        // Récupérer et retourner les résultats
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getTasksByStatus($userId, $status) {
        // Préparer la requête SQL pour récupérer les tâches de l'utilisateur avec un statut spécifique
        $query = "SELECT * FROM TacheAFaire WHERE id_utilisateur = :userId AND statut = :status";
        $statement = $this->connexion->prepare($query);
    
        // Binder les valeurs
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':status', $status);
    
        // Exécuter la requête
        $statement->execute();
    
        // Récupérer et retourner les résultats
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteTask($taskId) {
        // Requête SQL pour supprimer la tâche
        $query = "DELETE FROM TacheAFaire WHERE id = :taskId";
        $statement = $this->connexion->prepare($query);
        
        // Liaison du paramètre taskId
        $statement->bindParam(':taskId', $taskId);
        
        // Exécution de la requête
        $result = $statement->execute();
        
        // Vérification du succès de la requête
        if (!$result) {
            // Afficher un message d'erreur
            echo "Erreur lors de la suppression de la tâche: " . $statement->errorInfo()[2];
            exit;
        }
        
        // Retourner le résultat
        return $result;
    }
    
    
    
    
}


