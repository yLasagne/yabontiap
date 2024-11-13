<?php

class CategorieDao
{
    private ?PDO $pdo;

    public function __construct(?PDO $pdo)
    {
        $this->setPdo($pdo);
    }

    // Permet de récupérer une catégorie en fonction de son id
    public function find(int $id): ?Categorie
    {
        $sql = "SELECT * 
        FROM " . PREFIXE_TABLE . "categorie 
        WHERE id = :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(":id" => $id));
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Categorie::class);
        $categorie = $pdoStatement->fetch();
        return $categorie;
    }

    // Permet de récupérer toutes les catégories
    public function findAll(): array
    {
        $sql = "SELECT * FROM " . PREFIXE_TABLE . "categorie";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Categorie::class);
        $pdoStatement->execute();
        $categories = $pdoStatement->fetchAll();
        return $categories;
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    public function setPdo(\PDO $pdo): void
    {
        $this->pdo = $pdo;
    }
}
