<?php
class ControllerFactory
{
    // Attention le design pattern Factory est un plus complexe que ce que nous utilisons ici.
    public static function getController(string $controleur, \Twig\Loader\FilesystemLoader $loader, \Twig\Environment $twig): object
    {
        $controllerName = 'Controller' . $controleur;
        //test si la controleur existe
        if (!class_exists($controllerName))
        {
            throw new Exception("La controleur $controllerName n'existe pas");
        }
        return new $controllerName($loader, $twig);
    }
}
