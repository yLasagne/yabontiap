<?php

class IngredientQuantifieDao
{
    private PDO|null $pdo;

    public function __construct(PDO $pdo)
    {
        $this->setPdo($pdo);
    }

    public function findIngredientQuantifieByRecette(int $id): array
    {
        $sql = "SELECT I.id AS 'ingredient_id', I.nom AS 'ingredient_nom', I.image AS 'ingredient_image', RI.quantite AS 'quantite' 
                FROM  " . PREFIXE_TABLE . "recette_ingredient RI
                INNER JOIN  " . PREFIXE_TABLE . "ingredient I ON RI.id_ingredient = I.id
                WHERE RI.id_recette = :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(":id" => $id));
        $data = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        $ingredientquantifies = [];
        foreach ($data as $row)
        {
            $ingredient = new Ingredient($row['ingredient_id'], $row['ingredient_nom'], $row['ingredient_image']);
            $ingredientquantifie = new IngredientQuantifie($ingredient, intval($row['quantite']));
            $ingredientquantifies[] = $ingredientquantifie;
        }
        return $ingredientquantifies;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
    
    private function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }
}
