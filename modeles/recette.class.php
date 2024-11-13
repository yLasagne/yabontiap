<?php

/**
 * Une classe pour représenter des recettes de cuisine
 */
class Recette
{
    private int|null $id;
    private string|null $nom;
    private string|null $description;
    private string|null $image;
    private ?Categorie $categorie;
    private ?array $ingredientQuantifies; //[objet ingrédient_quantifié],

    /**
     * Undocumented function
     *
     * @param integer|null $id L'identification de la Recette
     * @param string|null $nom Le nom de la Recette
     * @param string|null $description La description de la Recette
     * @param string|null $image Le chemin d'accès à l'image représentat la Recette
     * @param Categorie|null $categorie La Categorie de la Recette : Enntrée, Plat, Desset
     * @param array|null $ingredientQuantifies
     */
    public function __construct(?int $id = null, ?string $nom = null, ?string $description = null, ?string $image = null, ?Categorie $categorie = null, ?array $ingredientQuantifies = null)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setDescription($description);
        $this->setImage($image);
        $this->setCategorie($categorie);
        $this->setIngredientQuantifies($ingredientQuantifies);
    }

    /**
     * Retourne l'identifiant de la Recette
     *
     * @return integer|null l'id de la Recette
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getIngredientQuantifies(): ?array
    {
        if ($this->ingredientQuantifies == null)
        {
            $db = Bd::getInstance();
            $pdo = $db->getConnection();
            $manager = new IngredientQuantifieDao($pdo);
            $this->ingredientQuantifies = $manager->findIngredientQuantifieByRecette($this->id);
        }
        return $this->ingredientQuantifies;
    }

    public function setIngredientQuantifies(?array $ingredientQuantifies): void
    {
        $this->ingredientQuantifies = $ingredientQuantifies;
    }
}
