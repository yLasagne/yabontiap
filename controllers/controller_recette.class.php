<?php

class ControllerRecette extends Controller
{
    public function __construct(\Twig\Loader\FilesystemLoader $loader, \Twig\Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function lister(): void
    {
        $idCategorie = isset($_GET['id_categorie']) ? $_GET['id_categorie'] : null;

        //Récupération des recettes
        $manager = new RecetteDao($this->getPdo());

        // Méthode sans jointure
        if ($idCategorie == null)
        {
            $recettes = $manager->findAllWithDetail();
            $title = "Toutes les recettes";
        }
        else
        {
            $recettes = $manager->findByCategorieWithDetail($idCategorie);
            $title = "Recettes de la catégorie " . $recettes[0]->getCategorie()->getNom();
        }

        //Chargement du template
        $template = $this->getTwig()->load('recettes.twig');

        //Affichage du template et transmission des données
        echo $template->render(array(
            'recettes' => $recettes,
            'menu' => "recette",
            'title' => $title

        ));
    }

    /**
     * @return void
     */
    public function listerTableau(): void
    {
        $manager = new RecetteDao($this->getPdo());
        $recettes = $manager->findAllWithDetail();

        //Chargement du template
        $template = $this->getTwig()->load('recettes_tableau.twig');


        //Affichage du template et transmission des données
        echo $template->render(array(
            'recettes' => $recettes

        ));
    }

    /**
     * @return void
     */
    public function afficher(): void
    {
        $manager = new RecetteDao($this->getPdo());
        if (!isset($_GET['id'])) throw new Exception("Pas d'id de recette");
        $idrecette = $_GET['id'];
        $recette = $manager->findWithDetail($idrecette);
        $template = $this->getTwig()->load('recette.twig');
        echo $template->render(array(
            'recette' => $recette,
            'menu' => "recette"
        ));
    }

    public function afficher_formulaire_insertion(): void
    {
    }

    public function traiter_formulaire_insertion(): void
    {
    }
}
