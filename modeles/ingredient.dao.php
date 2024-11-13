<?php
class IngredientDao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->setPdo($pdo);
    }

    // Permet de récupérer un ingrédient en fonction de son id
    public function find(int $id): ?Ingredient
    {
        $sql = "SELECT * FROM " . PREFIXE_TABLE . " ingredient WHERE id = :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(":id" => $id));
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Ingredient::class);
        $ingredient = $pdoStatement->fetch();
        return $ingredient;
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
