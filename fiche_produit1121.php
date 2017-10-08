<?php
require_once('inc/init.inc.php');
$aside = '';
$contenus ='';
//------------------ TRAITEMENT -------------------
// 1- Contrôler l'existence du produit demandé :
if (isset($_GET['id_produit'])) {
        $resultat = $mysqli->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]' ");
        
        if ($resultat->num_rows == 0) { // si l'id_produit n'existe pas on oriente vers la boutique :
          header('location:boutique.php');
          exit();
        }
        
        
        //2- Affichage et mise en forme des infos sur le produit 
        $produit = $resultat->fetch_assoc();
        
        $contenu .= '<div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">'. $produit['titre'] .'</h1>
                        </div>
                    </div>';
        
        $contenu .= '<div class="col-md-6">';
              $contenu .= '<div class="zoom_arrea">';
                $contenu .='<div class="zoomm"></div>';
                $contenu .= '<img  src="'. $produit['photo'] .'" alt="" class="zoom_sur">';
              $contenu .='</div>'; 
       $contenu .= ' </div>';

        $public = array('m'=>'masculin','f'=>'féminin', 'mixte'=>'mixte');
        
        $contenu .= '<div class="col-md-6">
                          <h3>Description</h3>
                          <p>'. $produit['description'] .'</p>
                          <h2>Détails :</h2>                         
                            <h3>Catégorie : '. $produit['categorie'] .'</h3>
                            <h3>Couleur : '. $produit['couleur'] .'</h3>        
                          <p class="lead">Prix : '. $produit['prix'] .'€</p>
                     </div>';
                     
      // 3- Affichage du formulaire d'ajout au panier si stock>0 
  $contenu .='<div class="col-md-6">';
    if ($produit['stock'] > 0) {
    $contenu .= '<form method="post" action="panier.php">';
      $contenu .= '<input type="hidden" name="id_produit" value="'. $produit['id_produit'] .'">';

   
      $contenu .='<label>Taille</label><br>';
      $contenu .='<select style="width:100px;" class="form-control" name="taille">
      <option value="s" >S</option>
      <option value="m">M</option>
      <option value="l">L</option>
      <option value="39-40">39-40</option>
      <option value="43-44">43-44</option>
      <option value="45-46">45-46</option>
      </select> <br><br>';

      $contenu .= '<select name="quantite" class="form-group-sm form-control-static">';
      for($i = 1; $i <= $produit['stock']; $i++) {
          $contenu .= '<option>'. $i .'</option>';
      }
        $contenu .= '</select>';
        $contenu .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn">';                
    $contenu .= '</form><br>';
    $contenus .= '<i>Nombre de produits disponibles : '. $produit['stock'] .'</i><br>';
    } else {
      // si pas de stock :
      $contenu .= '<p>Rupture de stock</p>';
    }     
      // 4- lien retour vers la boutique :
    $contenu .= '<p><a href="index.php?categorie='. $produit['categorie'] .'">Retour vers la sélection de '. $produit['categorie'] .'</a></p>';          
    $contenu .='</div>';
    } // fin du if (isset($_GET['id_produit']))         
         
 
//------------------ AFFICHAGE -------------------
require_once('inc/haut.inc.php');
require_once('inc/menu.php');

echo'<hr>';

echo $contenu_gauche;  // pour afficher la confirmation d'ajout de produit au panier 
?>
         <div class="row" style="text-align:center; font-size:20px; color:red;">
           <?php echo $contenus; ?>
         </div>
         <div class="row">
           <?php echo $contenu; ?>
         </div>  
           <!-- Pour le TP : -->
        <div class="row" style="margin-bottom: 25px;">
        <div class="col-lg-12">
                 <h3 class="page-header">Egalement consultés par nos clients</h3>
         </div>
          <?php
             $resultat3 = $mysqli->query("SELECT * FROM produit LIMIT 0,4 ; ")
                                   or die('Erreur SQL' .$mysqli->error);
              while($req3 = $resultat3->fetch_assoc()){
                echo '<div class="col-md-3">
                          <a href="fiche_produit.php?id_produit='. $req3['id_produit'] .'"><img src="'. $req3['photo'] .'" alt="" width="90%" height="250px"></a>
                     </div>';
              }  
         ?>
  
  </div>
<?php
require_once('inc/bas.inc.php');



