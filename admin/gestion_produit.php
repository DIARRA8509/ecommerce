<?php
require_once('../inc/init.inc.php');
require_once('../inc/haut.inc.php');
//require_once('../inc/script.php');
  // on va dans le dossier parent "../" puis on descend dans le dossier inc/
$contenuProduit='';
$contenuEnregistrer='';
//------------- TRAITEMENT -----------------------
// 1- Vérification ADMIN :
if (!internauteEstConnecteEtEstAdmin()) {
    header('location:../connexion.php');
    exit();
}

 
// 7 - Suppression d'un membre :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {

  $mysqli->query("DELETE FROM produit WHERE id_produit = '$_GET[id_produit]' ");
  
  $contenuProduit .= '<div class="bg-success">Le produit a bien été supprimé</div>';
  
  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour
}

////////////////////////// la pagination ///////////////////////////////////
if (isset($_GET['pp']) && !empty($_GET['pp']) && ctype_digit($_GET['pp'])==1){
  $perPage=$_GET['pp'];
}else{
  $perPage=10;
}
  

  $req=$mysqli->query("SELECT COUNT(*) AS total FROM produit");
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

    $reqProduct =$mysqli->query("SELECT * FROM produit LIMIT $firstPage, $perPage "); 
   


// 7 - Suppression d'un produit :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
  
  // Suppression de la photo :
  $resultat = $mysqli->query("SELECT photo FROM produit WHERE id_produit = '$_GET[id_produit]'"); // on sélectionne chemin de la photo en base pour pouvoir supprimer le fichier jpeg

  $produit_a_supprimer = $resultat->fetch_assoc();
  
  $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo'];  // détermine le chemin absolu du fichier photo
  
  if (!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) {
    unlink($chemin_photo_a_supprimer);  // si le fichier existe, on le supprime. unlink() supprime le fichier dont le chemin est spécifié
  }
  
  $mysqli->query("DELETE FROM produit WHERE id_produit = '$_GET[id_produit]'");
  
  $contenuProduit .= '<div class="bg-success">Le produit a bien été supprimé</div>';
  
  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour
}


// 4- Enregistrement du produit :
if ($_POST) { // si formulaire soumis
    $photo_bdd = '';  // contient l'url de la photo uploadée
    
    // 9 suite : on s'assure de conserver le chemin actuel de la photo pour ne pas insérer un champ vide en base :
    if (isset($_GET['action']) && $_GET['action'] == 'modification') {
      $photo_bdd = $_POST['photo_actuelle'];
    }
    // Notez que si l'administrateur a uploadé une nouvelle photo, la valeur de l'ancienne photo affectée à $photo_bdd est écrasée par le nouvelle dans la condition ci-dessous. 
    
    
    // 5 - PHOTO :
    if (!empty($_FILES['photo']['name'])) {
      //debug($_FILES);
      
      // Déterminer le nom de la photo :
      $nom_photo =$_FILES['photo']['name'];
      
      $photo_bdd = RACINE_SITE . 'photo/' . $nom_photo; // chemin de la photo enregistré en BDD
      
      $photo_dossier = $_SERVER['DOCUMENT_ROOT'].$photo_bdd; // on ajoute la racine serveur au chemin de la photo pour avoir un chemin absolu complet lors de la copie du fichier photo
      
      copy($_FILES['photo']['tmp_name'], $photo_dossier);
      // enregistrement de la photo temporairement stockée dans 'tmp_name' dans le répertoire $photo_dossier      
    }
       
    // 4 suite - enregistrement du produit en base :
    foreach ($_POST as $indice => $valeur) {
      $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
    }
    
    $mysqli->query("REPLACE INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES('$_POST[id_produit]', '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]', '$photo_bdd', '$_POST[prix]', '$_POST[stock]')");
    
    $contenuEnregistrer .= '<div class="bg-success">Le produit a été enregistré</div>';
    
    $_GET['action'] = 'affichage'; // pour déclencher l'affichage des produits (cf 6)
  
} // fin du if ($_POST)

//------------- AFFICHAGE -----------------------
require_once('../inc/haut.inc.php');

//if (isset($_GET['action']) && $_GET['action'] == 'affichage') {
?>
<style>
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'ajout') {
?>  
  .Xtables,
  .modifier{
    display: none;
  }
  .ajouter{
    text-align: center;
    font-size: 25px;
  }
<?php
    }

  if (isset($_GET['action']) && $_GET['action'] == 'modification') {
?>  
  .Xtables,
  .ajouter{
    display: none;
  }
  .modifier{
    text-align: center;
    font-size: 25px;
  }
<?php
    }
    ?>
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 Xtables">
     <!--<form method="GET" action="">
      <label>Nombre de ligne par page :</label>
      <select name="pp">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
      </select>
      <input type="hidden" name="p" value="<?php //echo $current; ?>">
      <button class="btn btn-primary btn-xs" type="submit">Appliquer</button>
    </form><br><br> -->
   <div style="text-align: center;font-size: 20px;"><?php echo $contenuEnregistrer ?></div>
    <div style="text-align: center;font-size: 20px;"><?php echo $contenuProduit ?></div>
  <div class="table-responsive" >
    <h1 style="text-align:center;">Affichage des membres</h1>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>id_produit</th>
          <th>reference</th>
          <th>categorie</th>
          <th>titre</th>
          <th>description</th>
          <th>taille</th>
          <th>public</th>
          <th> photo</th>
          <th>prix</th>
          <th>stock</th>
          <th>couleur</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        <?php
         
             // Affichage des lignes de la table :
      while($product = $reqProduct->fetch_assoc()) {
        echo '<tr>';
          foreach($product as $indice=>$valeur) {
             
             if ($indice == 'photo') {
               $valeur = '<img src="'. $valeur .'" width=70 height=70>';
             }
             echo '<td>'. $valeur .'</td>';
          }
        
        echo '<td>';
          
          echo '<a href="?action=ajout">Ajout</a> /<a href="?action=modification&id_produit='. $product['id_produit'] .'">modifier</a> / <a href="?action=suppression&id_produit='. $product['id_produit'] .'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce produit \'));" >supprimer</a>';
        
        $contenu .= '</td>';
        $contenu .= '</tr>';
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
            <li class="active"><a href="?p=<?php echo $i; ?>"><?php echo $i ?></a></li>
            <?php 
            }else{
            ?>
              <li><a href="?p=<?php echo $i; ?>"><?php echo $i ?></a></li>
            <?php
            }
          }
        ?>
      <li><a href="?p=<?php if($current != $nbPage){echo $current + 1;}else{ echo $current;} ?>">&raquo;</a></li>
    </ul>

  </div>




<?php
//}

// 3- Formulaire HTML :
if (isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) : // affichage du formulaire quand on est en ajout ou modif. Attention : endif en bas du fichier !

  // 8- Pré-remplissage du formulaire de modification :
  if (isset($_GET['id_produit'])) { // si id_produit existe c'est que nous sommes en modification (car on ne passe pas d'id_produit en ajout)
    
    $resultat = $mysqli->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
    $produit_actuel = $resultat->fetch_assoc(); // array qui permet de pré-remplir le formulaire ci-dessous
  }

?>
<div class="col-md-push-2 col-md-8" id="formulaire">
    <h3 class="ajouter">Formulaire d'ajout </h3>
    <h3 class="modifier">Formulaire de modification </h3>
    <form method="post" action="" enctype="multipart/form-data">
    <!-- multipart/form-data permet d'uploader un fichier et de générer une superglobale $_FILES -->


      <input type="hidden" name="id_produit" value="<?php if (isset($produit_actuel)){ echo $produit_actuel['id_produit'];} else { echo 0;} ?>">
      <!-- champ caché pour pouvoir passer dans $_POST l'id du produit à modifier -->
      
      <label for="reference">Référence</label><br>
      <input class="form-control" type="text" id="reference" name="reference" value="<?php if (isset($produit_actuel)) echo $produit_actuel['reference'];?>"><br>

      <label for="categorie">Catégorie</label><br>
      <input class="form-control" type="text" id="categorie" name="categorie" value="<?php if (isset($produit_actuel)) echo $produit_actuel['categorie'];?>"><br>

      <label for="titre">Titre</label><br>
      <input class="form-control" type="text" id="titre" name="titre" value="<?php if (isset($produit_actuel)) echo $produit_actuel['titre'];?>"><br>

      <label for="description">Description</label><br>
      <textarea class="form-control" id="description" name="description" ><?php if (isset($produit_actuel)) echo $produit_actuel['description'];?></textarea><br>
      
      <label for="couleur">Couleur</label><br>
      <input class="form-control" type="text" id="couleur" name="couleur" value="<?php if (isset($produit_actuel)) echo $produit_actuel['couleur'];?>"><br>
      
      <label>Taille</label><br>
      <select class="form-control" name="taille">
          <option value="S" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == 'S') echo 'selected';?>>S</option>
          <option value="M" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == 'M') echo 'selected';?>>M</option>
          <option value="L" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == 'L') echo 'selected';?>>L</option>
          <option value="XL" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == 'XL') echo 'selected';?>>XL</option>
          <option value="34" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == '34') echo 'selected';?>>34</option>
          <option value="35" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == '35') echo 'selected';?>>35</option>
          <option value="36" <?php if (isset($produit_actuel) && $produit_actuel['taille'] == '36') echo 'selected';?>>36</option>
      </select><br>
      
      <label>Public</label><br>
      <input type="radio" name="public" value="homme" checked>Homme
      <input type="radio" name="public" value="femme" <?php if (isset($produit_actuel) && $produit_actuel['public'] == 'femme') echo 'checked';?>>Femme
      <input type="radio" name="public" value="mixte" <?php if (isset($produit_actuel) && $produit_actuel['public'] == 'mixte') echo 'checked';?>>Mixte
      <br>
      <br>
      
      <label for="photo">Photo</label><br>
      <input class="form-control" type="file" id="photo" name="photo"><br> <!-- le type file est dépendant de l'attribut enctype = "multipart/form-data". Ils permettent de remplir la supergolable $_FILES lorsqu'une photo est uploadée -->
      
       
      <!-- 9- Modification de la photo -->
      <?php
        if (isset($produit_actuel)) {
          echo 'Vous pouvez remplacer la photo par une nouvelle<br>';  
          echo '<img src="'. $produit_actuel['photo'] .'" width=90 height=90><br>'; // affiche la photo actuelle
          echo '<input type="hidden" name="photo_actuelle" value="'. $produit_actuel['photo'] .'"><br>'; // pour renseigner le $_POST avec le chemin de la photo actuelle
        }  
      ?>
      
      
      <label for="prix">Prix</label><br>
      <input class="form-control" type="text" id="prix" name="prix" value="<?php if (isset($produit_actuel)) {echo $produit_actuel['prix'];} else { echo 0;}?>"><br>
      
      <label for="stock">Stock</label><br>
      <input class="form-control" type="text" id="stock" name="stock" value="<?php if (isset($produit_actuel)) {echo $produit_actuel['stock'];} else { echo 0;}?>"><br><br>
      
      <input type="submit" value="valider" class="btn btn-primary">
    </form>
    <?php
      endif;
      ?>
</div>
<?php

require_once('../inc/bas.inc.php');





