<?php
class RecetteDao
{
    private ?PDO $pdo;

    public function __construct(?PDO $pdo)
    {
        $this->setPdo($pdo);
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function findWithDetail(int $id): ?Recette
    {
        $sql = "SELECT R.id, R.nom, R.description, R.image, R.id_categorie, C.id as categorie_id, C.nom as categorie_nom, C.image as categorie_image, I.id as ingredient_id, I.nom as ingredient_nom, I.image as ingredient_image, RI.quantite 
                FROM  " . PREFIXE_TABLE . "recette R
                INNER JOIN  " . PREFIXE_TABLE . "recette_ingredient RI ON R.id = RI.id_recette
                INNER JOIN  " . PREFIXE_TABLE . "ingredient I ON RI.id_ingredient = I.id
                INNER JOIN  " . PREFIXE_TABLE . "categorie C ON R.id_categorie = C.id
                WHERE R.id = :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(":id" => $id));
        $data = $pdoStatement->fetchAll();
        $recette = $this->hydrate($data);
        return $recette;
    }

    public function findAllWithDetail(): array
    {
        $sql = "SELECT R.id, R.nom, R.description, R.image, R.id_categorie, C.id as categorie_id, C.nom as categorie_nom, C.image as categorie_image, I.id as ingredient_id, I.nom as ingredient_nom, I.image as ingredient_image, RI.quantite 
                FROM  " . PREFIXE_TABLE . "recette R
                INNER JOIN  " . PREFIXE_TABLE . "recette_ingredient RI ON R.id = RI.id_recette
                INNER JOIN  " . PREFIXE_TABLE . "ingredient I ON RI.id_ingredient = I.id
                INNER JOIN  " . PREFIXE_TABLE . "categorie C ON R.id_categorie = C.id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $data = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($data);
        return $recettes;
    }

    public function findByCategorieWithDetail(int $idCategorie): array
    {
        $sql = "SELECT R.id, R.nom, R.description, R.image, R.id_categorie, C.id as categorie_id, C.nom as categorie_nom, C.image as categorie_image, I.id as ingredient_id, I.nom as ingredient_nom, I.image as ingredient_image, RI.quantite 
                FROM  " . PREFIXE_TABLE . "recette R
                INNER JOIN  " . PREFIXE_TABLE . "recette_ingredient RI ON R.id = RI.id_recette
                INNER JOIN  " . PREFIXE_TABLE . "ingredient I ON RI.id_ingredient = I.id
                INNER JOIN  " . PREFIXE_TABLE . "categorie C ON R.id_categorie = C.id
                WHERE R.id_categorie = :idCategorie";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(":idCategorie" => $idCategorie));
        $data = $pdoStatement->fetchAll();
        $recettes = $this->hydrateMany($data);
        return $recettes;
    }

    // Hydrate l'objet recette avec les données de la bd
    public function hydrate(array $data): Recette
    {
        $recette = new Recette();
        $recette->setId($data[0]['id']);
        $recette->setNom($data[0]['nom']);
        $recette->setDescription($data[0]['description']);
        $recette->setImage($data[0]['image']);
        $categorie = new Categorie($data[0]['id_categorie'], $data[0]['categorie_nom'], $data[0]['categorie_image']);
        $recette->setCategorie($categorie);
        $detailrecette = [];
        foreach ($data as $row)
        {
            $ingredient = new Ingredient($row['ingredient_id'], $row['ingredient_nom'], $row['ingredient_image']);
            $detailrecette[] = ['ingredient' => $ingredient, 'quantite' => $row['quantite']];
        }
        $recette->setIngredientQuantifies($detailrecette);

        return $recette;
    }

    // Hydrate une liste d'objets recette avec les données de la bd
    public function hydrateMany(array $data): array
    {
        $subdata = [];
        $listeRecettes = [];

        foreach ($data as $key => $row)
        {
            $subdata[] = $row;
            if (!isset($data[$key + 1]) || $row['id'] != $data[$key + 1]['id'])
            {
                $recette = $this->hydrate($subdata);
                $listeRecettes[] = $recette;
                $subdata = [];
            }
        }
        return $listeRecettes;
    }
}
