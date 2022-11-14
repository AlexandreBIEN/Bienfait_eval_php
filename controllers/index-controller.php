<?php 
require_once '../functions.php';

// On créer un tableau $data avec les informations contenu dans le POST
$data = ['title' => $_POST['title'], 'url' => $_POST['url']];

// On ajoute le liens dans la base de donnée
create_link($data);
// On redirige vers la page d'accueil
header('location: ../index.php');