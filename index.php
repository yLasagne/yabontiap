<?php
require_once 'include.php';

try
{
    if (isset($_GET['controleur']))
    {
        $controllerName = $_GET['controleur'];
    }
    else
    {
        $controllerName = '';
    }
    if (isset($_GET['methode']))
    {
        $methode = $_GET['methode'];
    }
    else
    {
        $methode = '';
    }

    //Gestion de la page index.php sans paramètres
    if ($controllerName == '' && $methode == '')
    {
        $controllerName = "Categorie";
        $methode = "lister";
    }
    else
    {
        if ($controllerName == '')
        {
            throw new Exception("Il manque le contrôleur");
        }
        if ($methode == '')
        {
            throw new Exception("Il manque la méthode");
        }
    }

    $controleur = ControllerFactory::getController($controllerName, $loader, $twig);
    $controleur->call($methode);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
