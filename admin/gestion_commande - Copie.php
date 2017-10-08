<?php
	


require_once("../inc/init.inc.php");
// 1- Vérification si Admin :
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}

// 7 - Suppression d'une commande :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {

  $mysqli->query("DELETE FROM commande WHERE id_commande = '$_GET[id_commande]' ");
  
  $contenu .= '<div class="bg-success">Commande a bien été supprimée</div>';
  
  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour
}
// 2- Affichage des commandes passées sur le site :

$information_sur_les_commandes = $mysqli->query("SELECT c.id_commande, c.id_membre, DATE_FORMAT(c.date_enregistrement, '%d-%m-%Y') AS date_enregistrement, c.montant, c.etat, m.pseudo, m.adresse, m.ville, m.code_postal FROM commande c LEFT JOIN membre m ON  m.id_membre = c.id_membre ORDER BY id_commande ASC")or die('Erreur SQL' .$mysqli->error); // informations sur les commandes


$contenu .= '<h3> Voici les commandes passées sur le site </h3>';		
$contenu .= "Nombre de commande(s) : " . $information_sur_les_commandes->num_rows;
		
	$contenu .= '<table border="5" style="border-collapse: collapse; width: 50%; margin: 0 auto; text-align: center;">';
		//  Affichage des entêtes :
		while($colonne = $information_sur_les_commandes->fetch_field())
		{    
			$contenu .= '<td style="padding: 30px;">'. $colonne->name . '</td>';
		}
		$contenu .= '<th style="text-align:center;">Action</th>';
		$contenu .= "</tr>";
 
		// Affichage des lignes :
		$chiffre_affaire = 0;	// pour calculer le C.A. total 
		while ($commande = $information_sur_les_commandes->fetch_assoc())
		{
			$chiffre_affaire += $commande['montant'];
			
			$contenu .= '<tr>';
				
        $contenu .= '<td><a href="gestion_commande.php?id_commande=' . $commande['id_commande'] . '">Voir la commande ' . $commande['id_commande'] . '</a></td>';	        
        $contenu .= '<td>' . $commande['id_membre'] . '</td>';
				$contenu .= '<td>' . $commande['date_enregistrement'] . '</td>';
				$contenu .= '<td>' . $commande['montant'] . '</td>';
				$contenu .= '<td>' . $commande['etat'] . '</td>';
				$contenu .= '<td>' . $commande['pseudo'] . '</td>';
				$contenu .= '<td>' . $commande['adresse'] . '</td>';
				$contenu .= '<td>' . $commande['ville'] . '</td>';
				$contenu .= '<td>' . $commande['code_postal'] . '</td>';
				$contenu .= '<td>';         
                $contenu .= ' <a href="?action=suppression&id_commande='. $commande['id_commande'] .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce produit \'));" >supprimer</a>';
        
$contenu .= '</td>';

$contenu .='</tr>';
			
		}
	$contenu .= '</table><br>';
	
	// 4- Affichage du chiffre d'affaires :
	$contenu .= '<div class="panel panel-default">
			  <div class="panel-body">le chiffre d\'affaires de la société est de : ' . $chiffre_affaire . ' € </div>
		  </div>';
	
	
	// 3- Affichage du détail de la commande :
	if(isset($_GET['id_commande']))	// si on cliqué sur le détail d'une commande
	{	
								// Passage de reservation-en-cours à envoyé
	$mysqli->query('UPDATE commande SET etat = "envoye" WHERE id_commande = "'.$_GET['id_commande'].'"')or die('Erreur SQL' .$mysqli->error);
	}
	







//-------------------------------------------------- Affichage ---------------------------------------------------------//
require_once("../inc/haut.inc.php");
echo $contenu;
require_once("../inc/bas.inc.php");	
