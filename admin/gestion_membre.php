<?php
require_once('../inc/init.inc.php');

require_once('../inc/haut.inc.php');
require_once('../inc/t-fonction.php');
require_once('../inc/script.php');

// 1- Vérification si Admin :
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}

?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<h1 style="text-align:center;">Affichage des membres</h1>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>id_membre</th>
					<th>pseudo</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>Civilité</th>
					<th>Ville</th>
					<th>Code postal</th>
					<th>Adresse</th>
					<th>Statut</th>
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while ($product = $reqProduct -> fetch_assoc()) {
					?>
						<tr>
							<td><?php echo $product['id_membre']; ?></td>
							<td><?php echo $product['pseudo']; ?></td>
							<td><?php echo $product['nom']; ?></td>
							<td><?php echo $product['prenom']; ?></td>
							<td><?php echo $product['email']; ?></td>
							<td><?php echo $product['civilite']; ?></td>
							<td><?php echo $product['ville']; ?></td>
							<td><?php echo $product['code_postal']; ?></td>
							<td><?php echo $product['adresse']; ?></td>
							<td><?php echo $product['statut']; ?></td>
							<td><?php echo ' <a href="?action=suppression&id_membre='. $product['id_membre'] .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce membre \'));" >supprimer</a>/<a href="../incription.php?id_membre=' . $product['id_membre'] . '">modifier</a></td>'?>

						</tr>
					<?php	
					}
				?>
			</tbody>
			
		</table>
	</div>
		<ul class="pagination">
			<li><a href="?p=<?php if($current != '1'){echo $current - 1;}else{ echo $current;} ?>">&laquo;</a></li>
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
			<li><a href="?p=<?php if($current != $nbPage){echo $current + 1;}else{ echo $current;} ?>">&raquo;</a></li
		</ul>

	</div>
</ul>



<?php
require_once('../inc/bas.inc.php');


