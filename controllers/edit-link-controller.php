<?php 
require_once '../functions.php';

// Link_id n'est pas défini

// On créer un tableau $data avec les informations contenu dans le POST
$data = ['link_id' => $_POST['link_id'], 'title' => $_POST['title'], 'url' => $_POST['url']];

// On remplace les informations de la bdd avec celles du tableau $data
update_link($data);
// On redirige vers la page d'accueil
header('location: ../index.php');