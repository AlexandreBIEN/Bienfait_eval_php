<?php

// Paramètres de connexion à la base de données (à adapter en fonction de votre environnement);

define('HOST', 'localhost');
define('USER', 'root');
define('DBNAME', 'links_manager_dev');
define('PASSWORD', ''); // windows (Mamp le mot de passe c'est 'root')

/**
 * Fonction de connexion à la base de données
 *
 * @return \PDO
 */
function db_connect(): PDO
{
    try {
        /**
         * Data Source Name : chaine de connexion à la base de données
         * Elle permet de renseigner le domaine du serveur de la base de données, le nom de la base de données cible et l'encodage de données pendant leur transport
         * @var string
         */
        $dsn =  'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8';

        return new PDO($dsn, USER, PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (\PDOException $ex) {
        echo sprintf('La demande de connexion à la base de donnée a échouée avec le message %s', $ex->getMessage());
        exit(0);
    }
}


/**
 * Fonction qui permet de récupérer le tableau des enregistrements de la table des liens
 * @return array
 */
function get_all_link()
{
    // Connexion à la base de donnée
    $db = db_connect();

    // Requête SQL
    $sql = <<<EOD
        SELECT 
            `title`,
            `url` 
        FROM 
            `links`;
    EOD;

    $all_links = $db->query($sql);
    $all_links_stmt = $all_links -> fetchall(PDO::FETCH_ASSOC);
    // On retourne la réponse
    return $all_links_stmt;
}


/**
 * Fonction qui permet de récupérer un enregistrement à partir de son identifiant dans la table des liens
 * @param integer $link_id
 * @return array
 */
function get_link_by_id($link_id)
{
    // Connexion à la base de donnée
    $db = db_connect();

    // Requête SQL
    $sql = <<<EOD
        SELECT 
            `url` 
        FROM 
            `links` 
        WHERE 
            `link_id` = :link_id;
    EOD;

    // On prépare la requête
    $link = $db->prepare($sql);
    $link -> bindvalue(':link_id', $link_id);

    $link->execute();
    $link_stmt = $link -> fetch(PDO::FETCH_ASSOC);
    // On retourne la réponse
    return $link_stmt;
}


/**
 * Fonction qui permet de modifier un enregistrement dans la table des liens
 * @param array $data: ['link_id' => 1, 'title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function update_link($data)
{
    // Connexion à la base de donnée
    $db = db_connect();

    // Requête SQL
    $sql = <<<EOD
        UPDATE 
            `links` 
        SET 
            `title` = :title, 
            `url` = :url
        WHERE 
            `link_id` = :link_id;
    EOD;

    // On prépare la requête
    $link = $db->prepare($sql);
    $link -> bindvalue(':link_id', $data['link_id']);
    $link -> bindvalue(':title', $data['title']);
    $link -> bindvalue(':url', $data['url']);

    $link->execute();
    // On retourne la réponse
    return $link;
}


/**
 * Fonction qui permet de d'enregistrer un nouveau lien dans la table des liens
 * @param array $data: ['title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function create_link($data)
{
    // Connexion à la base de donnée
    $db = db_connect();

    // Requête SQL
    $sql = <<<EOD
        INSERT INTO 
            `links` (`title`, `url`) 
        VALUES 
            (:title, :url);
    EOD;

    // On prépare la requête
    $link = $db->prepare($sql);
    $link -> bindvalue(':title', $data['title']);
    $link -> bindvalue(':url', $data['url']);

    $link->execute();
    // On retourne la réponse
    return $link;
}

/**
 * Fonction qui permet de supprimer l'enregistrement dont l'identifiant est $linl_id dans la table des liens
 *@param integer $link_id
 * @return bool
 */
function delete_link($link_id)
{
    // TODO implement function
}
