<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Vérifier si un utilisateur est un vendeur
    public function isVendeur($userId)
    {
        $query = "SELECT role FROM User WHERE id_user = :id_user";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && $user['role'] === 'vendeur';
    }

    // Enregistrer un nouvel utilisateur
    public function register($firstName, $lastName, $email, $password, $role = 'client')
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO User (firstName, lastName, email, password, role) 
                  VALUES (:firstName, :lastName, :email, :password, :role)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Connexion de l'utilisateur
    public function login($email, $password)
    {
        $query = "SELECT id_user, firstName, lastName, email, password, role 
                  FROM User 
                  WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id_user)
    {
        $query = "SELECT id_user, firstName, lastName, email, role 
                  FROM User 
                  WHERE id_user = :id_user";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
