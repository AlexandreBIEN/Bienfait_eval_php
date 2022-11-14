<?php 
require_once '../functions.php';

// On supprime le liens ayant comme id "link_id"
delete_link($_GET['link_id']);
// On redirige vers la page d'accueil
header('location: ../index.php');