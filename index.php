<?php
require_once 'Router.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProductController.php';

// Instanciation des contrôleurs
$authController = new AuthController();
$userController = new UserController();
$productController = new ProductController();

// Création du routeur
$router = new Router();

// Ajout des routes
$router->addRoute('login', [$authController, 'login']);
$router->addRoute('register', [$authController, 'register']);
$router->addRoute('logout', [$authController, 'logout']);
$router->addRoute('profile', [$userController, 'profile']);
$router->addRoute('products', [$productController, 'listProducts']);

// Gestion de la route demandée
if (isset($_GET['action'])) {
    $router->route($_GET['action']);
} else {
    // Page par défaut : liste des produits
    $productController->listProducts();
}
