<?php
/*
Ce fichier sera inclus dans TOUS les scripts du site (hors les fichiers inc eux-mêmes) pour initialiser les éléments suivants :
- connexion à la BDD
- création ou ouverture de session
- définir le chemin (url) du site comme dans les CMS
- et inclure le fichier fonction.inc.php systématiquement dans tous les scripts
*/

// Connexion à la BDD :
 $mysqli = new Mysqli('db663876413.db.1and1.com', 'dbo663876413', 'bak123456789', 'db663876413');
 if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);

 // $mysqli= new Mysqli('db646953454.db.1and1.com','dbo646953454', 'bak123456789', 'db646953454');
 // if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8");  // force les transactions avec la BDD en utf-8


// Session :
session_start();

// Chemin du site :
define('RACINE_SITE', '/'); // on définit le chemin de la racine du site pour pouvoir établir des url de fichiers en chemin absolu que l'on soit dans un template admin ou front

// Déclaration de variables d'affichage de contenus :
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

// Autre inclusion nécessaire à tous les scripts :
require_once('fonction.inc.php');























