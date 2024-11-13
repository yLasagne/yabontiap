<?php
require_once 'include.php';

//Chargement du template
$template = $twig->load('licence.twig');

//Affichage du template et transmission des données
echo $template->render(array());
