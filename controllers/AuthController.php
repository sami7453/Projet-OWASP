<?php
require_once 'models/Database.php';
require_once 'models/User.php';
require_once 'config/session.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $pdo = $database->connect();
        $this->userModel = new User($pdo);
    }

    // Inscription
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'] ?? 'client'; // Par défaut, le rôle est 'client'

            if ($this->userModel->register($firstName, $lastName, $email, $password, $role)) {
                header('Location: index.php?action=login');
                exit;
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }
        require 'views/register.php';
    }

    // Connexion
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }
        require 'views/login.php';
    }

    // Déconnexion
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
