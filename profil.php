<?php
require_once('inc/init.inc.php');

//--------------------- TRAITEMENT -------------------
// Redirection si visiteur non connecté :
if (!internauteEstConnecte()) {
  header('location:connexion.php'); // nous invitons l'internaute non connecté à se connecter
  exit(); // pour sortir du script
}
//declaration des variables
$membre = $_SESSION['membre']['id_membre'];
// 7 - Suppression du membre :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
  $mysqli->query("DELETE FROM membre WHERE id_membre = '$_GET[id_membre]' "); 
  header('location:connexion.php');
  session_destroy();
}

  //Recap des infos
$contenu = '<h2 style="text-align:center;">Bonjour et bienvenue sur votre espace client.</h2>';
$contenu .= '<h3 style="color:red;">Vous pouver supprimer votre comptre<a href="?action=suppression&id_membre='. $membre .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer votre compte \'));" ><button class="btn btn-primary">supprimer</button></a></h3>';
$contenu .= '<div><h3 style="text-align:left;">Vos coordonnées enregistrées sont :</h3>';
$contenu .= '<h4>Nom  : '.$_SESSION['membre']['prenom'].'</h4>';
$contenu .= '<h4>Email : ' . $_SESSION['membre']['email'] . '</h4>';
$contenu .= '<h4>Adresse : ' . $_SESSION['membre']['adresse'] . ', '.$_SESSION['membre']['ville'].' '.$_SESSION['membre']['code_postal'].'</h4>';
$contenu .= '</div><hr>';

// affichage profil normal 
if (!isset($_GET['id_commande'])){

// affichage des commandes passées
$contenu .='<div class="col-md-12">';
$contenu .='<h3 style="text-align:left;">Historique de demande(s)</h3>';
  $commande = $mysqli->query("SELECT * FROM commande WHERE id_membre='$membre' ORDER BY id_commande DESC");
  if ($commande->num_rows > 0) {
    $contenu .= '<ul>';
    while($caps = $commande->fetch_assoc()) {
      $contenu .= '<li style="font-size:18px; list-style: none;"><div class="col-md-10">Le '. $caps['date_enregistrement'] .', demande numéro :'. $caps['id_commande'] .'. est : '. $caps['etat'] .'</div><div class="col-md-2"><a href="?id_commande=' . $caps['id_commande'] . '"><button class="btn btn-primary">Détail</button></a></div></li>';  
    }
    $contenu .= '</ul>';
  } else {
  $contenu .='Vous n\'avez pas passé de commande.';
  }
  $contenu .='</div>';
} elseif (isset($_GET['id_commande'])) {
  $commande = $mysqli->query("SELECT * FROM commande WHERE id_commande='$_GET[id_commande]'");
  $commande = $commande ->fetch_assoc();
    $contenu .= '<a href="'.RACINE_SITE.'profil.php">
                    <button class="btn btn-primary">Retour</button>
                </a>';
      $contenu .= '<div class="panel panel-default">
        <div class="panel-heading">
              <p>
              Le '. $commande['date_enregistrement'] .', demande numéro :'. $commande['id_commande'] .' , Statut de la demande '. $commande['etat'] .'
              </p>
        </div>
        <div class="panel-body">
          <table class="table affichageAdmin" style="border:2px solid black;">'; 
      $contenu .='<tr>';
        $detail_commande=$mysqli->query("SELECT * FROM commande WHERE id_commande='$_GET[id_commande]'");
        while($colonne = $detail_commande->fetch_field())
        {
          $contenu .= '<th style="border:2px solid black; text-align:center;">' . $colonne->name . '</th>';
        }
        $contenu .= "</tr>";
        // Affichage des lignes : 
        while ($commande = $detail_commande->fetch_assoc())
        {    
        
           $contenu .='<td style="border:2px solid black; text-align:center;">'.$commande['id_commande'].'</td>';
           $contenu .='<td style="border:2px solid black; text-align:center;">'.$commande['id_membre'].'</td>'; 
           $contenu .='<td style="border:2px solid black; text-align:center;">'.$commande['montant'].'</td>'; 
           $contenu .='<td style="border:2px solid black; text-align:center;">'.$commande['date_enregistrement'].'</td>';
           $contenu .='<td style="border:2px solid black; text-align:center;">'.$commande['etat'].'</td>'; 
           
        }
              $contenu .= '</table>';
            $contenu .='</div>';  
          $contenu .='</div>';

} else {
    $contenu .='Aucune demande n\'a été effectué.';
  }
// ---------------------- AFFICHAGE --------------------
require_once('inc/haut.inc.php');
echo $contenu;
require_once('inc/bas.inc.php');