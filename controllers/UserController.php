<?php
require_once 'models/Database.php';
require_once 'models/User.php';
require_once 'models/Product.php';
require_once 'config/session.php';

class UserController
{
    private $userModel;
    private $productModel;
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
        $this->userModel = new User($this->db);
        $this->productModel = new Product($this->db);
    }

    /**
     * Gère l'affichage et les actions du profil utilisateur
     */
    public function profile()
    {
        // Vérification de la connexion
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // Récupération des informations utilisateur
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        if (!$user) {
            header('Location: index.php?error=user_not_found');
            exit;
        }

        // Vérification du rôle vendeur
        $isVendeur = $this->userModel->isVendeur($_SESSION['user_id']);

        // Traitement du formulaire de création de produit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Vérification des permissions
            if (!$isVendeur) {
                $_SESSION['error'] = "Vous n'avez pas les permissions nécessaires pour créer un produit.";
                header('Location: index.php?action=profile');
                exit;
            }

            try {
                // Validation des données
                $name = $this->validateInput($_POST['name'] ?? '');
                $description = $this->validateInput($_POST['description'] ?? '');
                $id_categorie = filter_var($_POST['id_categorie'] ?? '', FILTER_VALIDATE_INT);

                if (!$name || !$description || !$id_categorie) {
                    throw new Exception("Tous les champs sont requis.");
                }

                // Traitement de l'image
                $image = $this->handleImageUpload($_FILES['image'] ?? null);
                if (!$image) {
                    throw new Exception("L'image est requise et doit être au format JPG, PNG ou GIF.");
                }

                // Création du produit
                $success = $this->productModel->addProduct(
                    $_SESSION['user_id'],
                    $id_categorie,
                    $name,
                    $description,
                    $image
                );

                if ($success) {
                    $_SESSION['success'] = "Le produit a été créé avec succès.";
                    header('Location: index.php?action=profile');
                    exit;
                } else {
                    throw new Exception("Erreur lors de la création du produit.");
                }
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }

        // Récupération des messages de session
        $error = $_SESSION['error'] ?? null;
        $success = $_SESSION['success'] ?? null;

        // Nettoyage des messages de session
        unset($_SESSION['error'], $_SESSION['success']);

        // Chargement de la vue
        require 'views/profile.php';
    }

    /**
     * Valide et nettoie les entrées utilisateur
     */
    private function validateInput($input)
    {
        $input = trim($input);
        return !empty($input) ? htmlspecialchars($input) : false;
    }

    /**
     * Gère l'upload et la validation des images
     */
    private function handleImageUpload($file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Vérification du type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        // Vérification de la taille (5MB max)
        if ($file['size'] > 5 * 1024 * 1024) {
            return false;
        }

        // Génération d'un nom unique
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $extension;
        $uploadPath = 'uploads/products/' . $newFileName;

        // Déplacement du fichier
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return false;
        }

        return $newFileName;
    }
}
