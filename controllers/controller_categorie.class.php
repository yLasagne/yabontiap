<?php
class ControllerCategorie extends Controller
{
    public function __construct(\Twig\Loader\FilesystemLoader $loader, \Twig\Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function lister(): void
    {
        $manager = new CategorieDao($this->getPdo());
        $categories = $manager->findAll();

        //Chargement du template
        $template = $this->getTwig()->load('index.twig');

        //Affichage du template et transmission des données
        echo $template->render(array(
            'categories' => $categories,
            'menu' => "category"
        ));
    }
}
