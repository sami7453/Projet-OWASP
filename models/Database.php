<?php
class Database
{
    private $host = 'localhost';
    private $db = 'OWASP';
    private $user = 'root';
    private $pass = 'root';
    private $pdo;

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die("Connexion échouée : " . $e->getMessage());
        }
    }
}
