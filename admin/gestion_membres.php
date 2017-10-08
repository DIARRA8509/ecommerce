<?php
require_once('../inc/init.inc.php');  // on va dans le dossier parent "../" puis on descend dans le dossier inc/

//------------- TRAITEMENT -----------------------
// 1- Vérification ADMIN :
if (!internauteEstConnecteEtEstAdmin()) {
    header('location:../connexion.php');
    exit();
}
//---------------- TRAITEMENT -------------------------
// 7 - Suppression d'un produit :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {

  $mysqli->query("UPDATE membre SET id_membre = '$_GET[id_membre]' ");
  
  $contenu .= '<div class="bg-success">Le membre a bien été modifier</div>';
  
  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour
}

//AFFICHAGE DU TABLEAU COMPLET DES MEMBRES
$resultat= $mysqli->query("SELECT * FROM membre ");
 $contenu .= '<h3 style="text-align:center;">Affichage des Membres</h3>';
  //$contenu .= 'Nombre de profil inscris : ' . $resultat->num_row;

$contenu .= '<table border="5" style="border-collapse: collapse; width: 90%; margin: 0 auto; text-align: center;">';
 //AFFICHAGE DE L'ENTETE DE LA TABLES
	$contenu .= '<tr>';
 		while($colonne= $resultat->fetch_field()){
  		$contenu .='<td style="height:20px; font-size:20px; ">'.$colonne->name.'</td>';
 		}
  		$contenu .= '<th style="height:20px; font-size:25px;color:red; ">Action</th>';
	$contenu .= '</tr>';
	// AFFICHAGE DES LIGNES DE LA TABLES :
	while($ligne = $resultat->fetch_assoc()){
		$contenu .= '<tr>';
			foreach ($ligne as $indice => $value) {
				$contenu .= '<td>'.$value.'</td>';
			}
				$contenu .= '<td>';          
            	$contenu .= ' <a href="?action=suppression&id_membre='. $ligne['id_membre'] .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce membre \'));" >supprimer</a>';      
        		$contenu .= '</td>';
		$contenu .= '</tr>';
	}
$contenu .= '</table>';

//------------- AFFICHAGE -----------------------
require_once('../inc/haut.inc.php');
echo $contenu;


require_once('../inc/bas.inc.php');





