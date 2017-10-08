<?php
require_once('inc/init.inc.php');

//--------------------- TRAITEMENT -------------------
// Redirection si visiteur non connecté :
if (!internauteEstConnecte()) {
  header('location:connexion.php'); // nous invitons l'internaute non connecté à se connecter
  exit(); // pour sortir du script
}

// Préparation de l'affichage du profil :
//debug($_SESSION);

$contenu .= '<h2>Bonjour '. $_SESSION['membre']['pseudo'] .'</h2>';

if (internauteEstConnecteEtEstAdmin()) {
  $contenu .= '<p>Vous êtes un administrateur.</p>';
} else {
  $contenu .= '<p>Vous êtes un membre.</p>';
}

$contenu .= '<div><h3>Voici vos informations de profil</h3>';
    $contenu .= '<p> Votre email : ' . $_SESSION['membre']['email'] . '</p>';
   // $contenu .= '<p> Votre adresse : ' . $_SESSION['membre']['adresse'] . '</p>';
   // $contenu .= '<p> Votre code postal : ' . $_SESSION['membre']['code_postal'] . '</p>';
   // $contenu .= '<p> Votre ville : ' . $_SESSION['membre']['ville'] . '</p>';
$contenu .= '</div>';

//-------------------
// EXERCICE :
//-------------------
/*  1- Affichez la liste des commandes passées par le membre sous son profil, sous forme de liste <ul><li>. Vous indiquerez l'id_commande, la date et l'état. Si toutefois il n'y avait pas de commande, vous afficherez "aucune commande en cours."

*/
$contenu .= '<h3>Historique de vos commandes</h3>';
$id_membre = $_SESSION['membre']['id_membre'];

$commande = $mysqli->query("SELECT id_commande, DATE_FORMAT(date_enregistrement, '%d-%m-%Y') AS date_enregistrement  , etat FROM commande WHERE id_membre = '$id_membre'");

if ($commande->num_rows > 0) {
    $contenu .= '<ul>';
        while($caps = $commande->fetch_assoc()) {
        $contenu .= '<li>Commande numéro '. $caps['id_commande'] .' passée le '. $caps['date_enregistrement'] .'. Actuellement le statut de votre commande est '. $caps['etat'] .'</li>';  

        }
    $contenu .= '</ul>';
} else {
  $contenu .='Vous n\'avez pas passé de commande.';
}

// ---------------------- AFFICHAGE --------------------
require_once('inc/haut.inc.php');
echo $contenu;
require_once('inc/bas.inc.php');