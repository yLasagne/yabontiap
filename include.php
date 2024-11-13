<?php

//Autoload composer
require_once 'vendor/autoload.php';

//chargement de twig
require_once 'config/twig.php';

//Chargement de la connexion à la base de données en pdo
require_once 'config/constantes.php';

//chargement des controllers
require_once 'controllers/controller_factory.class.php';
require_once 'controllers/controller.class.php';
require_once 'controllers/controller_categorie.class.php';
require_once 'controllers/controller_recette.class.php';

//chargement des modèles
require_once 'modeles/bd.class.php';
require_once 'modeles/categorie.class.php';
require_once 'modeles/categorie.dao.php';
require_once 'modeles/recette.class.php';
require_once 'modeles/recette.dao.php';
require_once 'modeles/ingredient.class.php';
require_once 'modeles/ingredient.dao.php';
require_once 'modeles/ingredient_quantifie.class.php';
require_once 'modeles/ingredient_quantifie.dao.php';
