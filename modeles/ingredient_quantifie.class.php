<?php

class IngredientQuantifie
{
    private ?Ingredient $ingredient;
    private string|null $quantite;

    public function __construct(?Ingredient $ingredient = null, ?string $quantite = null)
    {
        $this->setIngredient($ingredient);
        $this->setQuantite($quantite);
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): void
    {
        $this->ingredient = $ingredient;
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
