<?php
require_once('../inc/init.inc.php');

require_once('../inc/haut.inc.php');
$suppressionCommande='';
// 1- Vérification si Admin :
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
// 7 - Suppression d'une commande :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {

  $mysqli->query("DELETE FROM commande WHERE id_commande= '$_GET[id_commande]' ");
  
  $suppressionCommande .= '<div class="bg-success">Commande a bien été supprimée</div>';



  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour
  
}
////////////////////////// la pagination ///////////////////////////////////
  $perPage=10;

  

  $req=$mysqli->query("SELECT COUNT(*) AS total FROM membre");
  $result=$req->fetch_assoc();
  $total = $result['total'];
  
  $nbPage= ceil($total/$perPage);


  if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p'])==1) {
    if ($_GET['p'] > $nbPage){
      $current= $nbPage;
    }else{
      $current = $_GET['p'];
    }

  }else{
    $current=1;
  }

    $firstPage = ($current -1)*$perPage;

    $reqProduct = $mysqli->query("SELECT c.id_commande, c.id_membre, DATE_FORMAT(c.date_enregistrement, '%d-%m-%Y') AS date_enregistrement, c.montant, c.etat, m.pseudo, m.adresse, m.ville, m.code_postal FROM commande c LEFT JOIN membre m ON  m.id_membre = c.id_membre ORDER BY id_commande ASC LIMIT $firstPage, $perPage")or die('Erreur SQL' .$mysqli->error); 

?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div style="text-align: center;font-size: 20px;"><?php echo $suppressionCommande ?></div>
	<div class="table-responsive">
		<h1 style="text-align:center;">Voici les commandes passées sur le site </h1>
		
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>id_commande</th>
					<th>id_membre</th>
					<th>montant</th>
					<th>date_enregistrement</th>
					<th>etat</th>
					<th>pseudo</th>
					<th>adresse</th>
					<th>ville</th>
					<th>code postal</th>
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				 $chiffre_affaire = 0; 
					while ($product = $reqProduct -> fetch_assoc()) {
						$chiffre_affaire += $product['montant'];
					?>
					<tr>
						<td><a href="<?php echo '?id_commande=' . $product['id_commande'] . '?>">Validez la commande <?php echo ' . $product['id_commande'] . '' ?></a></td>
						<td><?php echo $product['id_membre']; ?></td>
						<td><?php echo $product['montant']; ?></td>
						<td><?php echo $product['date_enregistrement']; ?></td>
						<td><?php echo $product['etat']; ?></td>
						<td><?php echo $product['pseudo']; ?></td>
						<td><?php echo $product['adresse']; ?></td>
						<td><?php echo $product['ville']; ?></td>
						<td><?php echo $product['code_postal']; ?></td>
						<td><?php echo ' <a href="?action=suppression&id_commande='. $product['id_commande'] .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce membre \'));" >supprimer</a>'?></td>

						</tr>
					<?php	
					}
				?>
			</tbody>
			
		</table>
	</div>
		<ul class="pagination">
			<li class="<?php if($current =='1'){ echo "disabled";} ?>"><a href="?p=<?php if($current != '1'){echo $current - 1;}else{ echo $current;} ?>">&laquo;</a></li>
				<?php
					for ($i=1; $i <= $nbPage ; $i++) { 
						if ($i == $current) {
						?>
						<li class="active"><a href="? p=<?php echo $i; ?>"><?php echo $i ?></a></li>
						<?php	
						}else{
						?>
							<li><a href="? p=<?php echo $i; ?>"><?php echo $i ?></a></li>
						<?php
						}
					}
				?>
			<li><a href="?p=<?php if($current != $nbPage){echo $current + 1;}else{ echo $current;} ?>">&raquo;</a></li>
		</ul>

	</div>
	<?php
	// 4- Affichage du chiffre d'affaires :
	echo'<div class="panel panel-default">
			  <div class="panel-body">le chiffre d\'affaires de la société est de : ' . $chiffre_affaire . ' € </div>
		  </div>';


		  // 3- Affichage du détail de la commande :
	if(isset($_GET['id_commande']))	// si on cliqué sur le détail d'une commande
	{	
								// Passage de reservation-en-cours à envoyé
	$mysqli->query('UPDATE commande SET etat = "envoye" WHERE id_commande = "'.$_GET['id_commande'].'"')or die('Erreur SQL' .$mysqli->error);
	}
		  ?>
</div>


<?php
require_once('../inc/bas.inc.php');