<?php
require_once 'models/Product.php';
require_once 'models/Database.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $database = new Database();
        $pdo = $database->connect();
        $this->productModel = new Product($pdo);
    }

    public function listProducts()
    {
        $categorie = $_GET['categorie'] ?? '';

        try {
            if ($categorie) {
                $products = $this->productModel->getProductsByCategory($categorie);
            } else {
                $products = $this->productModel->getAllProducts();
            }

            require 'views/products.php';
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            require 'views/error.php';
        }
    }
}
