<?php

class RecetteIngredient
{
    private int|null $id_recette;
    private int|null $id_ingredient;
    private string|null $quantite;

    public function __construct($id_recette = null, $id_ingredient = null, $quantite = null)
    {
        $this->setIdRecette($id_recette);
        $this->setIdIngredient($id_ingredient);
        $this->setQuantite($quantite);
    }

    // Permet de récupérer un recette_ingredient en fonction de son id
    public function findByIdRecette($pdo, $id_recette)
    {
        $sql = "SELECT * FROM recette_ingredient WHERE id_recette = :id_recette";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute(array(":id_recette" => $id_recette));
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "recette_ingredient");
        $recette_ingredient = $pdoStatement->fetchAll();
        return $recette_ingredient;
    }

    public function getIdRecette(): ?int
    {
        return $this->id_recette;
    }

    public function setIdRecette(?int $id_recette): void
    {
        $this->id_recette = $id_recette;
    }

    public function getIdIngredient(): ?int
    {
        return $this->id_ingredient;
    }

    public function setIdIngredient(?int $id_ingredient): void
    {
        $this->id_ingredient = $id_ingredient;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): void
    {
        $this->quantite = $quantite;
    }
}
