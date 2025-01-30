<?php
class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer tous les produits
    public function getAllProducts()
    {
        $query = "SELECT id_product, id_categorie, id_user, name, description, date AS date_creation, image 
                  FROM product 
                  ORDER BY date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les produits par catégorie
    public function getProductsByCategory($categorie)
    {
        $query = "SELECT p.id_product, p.name, p.description, p.image, p.date AS date_creation 
                  FROM product p 
                  JOIN categorie c ON p.id_categorie = c.id_categorie 
                  WHERE c.categorie = :categorie 
                  ORDER BY p.date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouveau produit
    public function addProduct($id_user, $id_categorie, $name, $description, $image)
    {
        $query = "INSERT INTO product (id_user, id_categorie, name, description, image, date) 
                  VALUES (:id_user, :id_categorie, :name, :description, :image, NOW())";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
