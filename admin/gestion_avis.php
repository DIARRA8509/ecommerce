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
$suppressionCommande ='';
// 7 - Suppression d'un avis :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
  $mysqli->query("DELETE FROM commentaire WHERE id_commentaire= '$_GET[id_commentaire]' ");  
  $suppressionCommande .= '<div class="bg-success">Commande a bien été supprimée</div>';
  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour  
}
////////////////////////// la pagination ///////////////////////////////////
  $perPage=10;

  

  $req=$mysqli->query("SELECT COUNT(*) AS total FROM commentaire");
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

    $reqProduct = $mysqli->query("SELECT * FROM commentaire ORDER BY date_enregistrement ASC LIMIT $firstPage, $perPage")or die('Erreur SQL' .$mysqli->error); 

?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div style="text-align: center;font-size: 20px;"><?php echo $suppressionCommande ?></div>
	<div class="table-responsive">
		<h1 style="text-align:center;">Voici les commandes passées sur le site </h1>
		
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>N° commentaire</th>
					<th>N° produit</th>
					<th>N° membre</th>
					<th>Commentaire</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

					while ($product = $reqProduct -> fetch_assoc()) {

					?>
					<tr>						
						<td><?php echo $product['id_commentaire']; ?></td>
						<td><?php echo $product['id_produit']; ?></td>
						<td><?php echo $product['id_membre']; ?></td>
						<td><?php echo $product['commentaire']; ?></td>
						<td><?php echo $product['date_enregistrement']; ?></td>
						
						<td><?php echo ' <a href="?action=suppression&id_commentaire='. $product['id_commentaire'] .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce membre \'));" >supprimer</a>'?></td>

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

		  ?>
</div>


<?php
require_once('../inc/bas.inc.php');