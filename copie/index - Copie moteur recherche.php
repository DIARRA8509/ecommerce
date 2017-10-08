<?php
require_once('inc/init.inc.php');
//------------------ TRAITEMENT --------------------

//le moteur de recherche s
if(isset($_GET['q']) && !empty($_GET['q'])){
    $donnees = $mysqli->query("SELECT id_produit, categorie, titre, photo, prix, description  FROM produit WHERE categorie LIKE '%$_GET[q]%' ORDER BY categorie ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
                $contenu_droite .='<div class="col-sm-4 col-lg-4 col-md-4">';      
                    $contenu .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img src="'. $produit['photo'] .'" alt="" height="250px"></a>';
                    //$contenu_droite .='<div class="caption">';
                       // $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                        //$contenu_droite .= '<h4 >'. $produit['categorie'] .'</h4>';                   
                    //$contenu_droite .= '</div>';  
                   $contenu_droite .= ' <hr>  ';    
                $contenu_droite .= '</div>';  
      }
}else{
$donnees = $mysqli->query("SELECT id_produit, categorie, titre, photo, prix, description FROM produit");
       while($produit = $donnees->fetch_assoc()) {
          //debug($produit);    
          $contenu_droite .='<div class="col-sm-4 col-lg-4 col-md-4">';      
              $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img src="'. $produit['photo'] .'" alt="" width="90%" height="250px"></a>';              
              //$contenu_droite .='<div class="caption">';
                  $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                  $contenu_droite .= '<h4 >'. $produit['categorie'] .'</h4>';                   
              //$contenu_droite .= '</div>';  
             $contenu_droite .= ' <hr>  ';    
          $contenu_droite .= '</div>'; 
  } 

}  // fin boucle while




//------------------ AFFICHAGE --------------------
require_once('inc/haut.inc.php');
?>
  <div class="row">
  <?php echo $contenu; ?>
        <hr>
        <div class="col-md-4">
        <form method="GET">
        <input type="text" class="form-control" name="q" size="20" placeholder="Rechercher d'articles, de catégories " style="width:270px;padding-top:10px; display:inline;" >
        <input type="submit" value="Rechercher" style="padding-top:8px; display:inline;">
        </form>
        </div>
        <div class="col-md-2">
         <?php
            echo '<li><a style="font-size:25px;"  href="'. RACINE_SITE .'panier.php"><i class="glyphicon glyphicon-shopping-cart"></i>Panier('. quantiteProduit() .')</a></li>';
        ?>
        </div>
        <div col-md-2>
          <?php
            echo '<li><a style="font-size:25px;" href="'. RACINE_SITE .'profil.php" class="glyphicon glyphicon-user">compte</a></li>';
          ?>
        </div>
      <div class="col-md-12">
      <hr>
          <div class="row">
            <?php echo $contenu_droite; ?>
          </div> 
      </div>
  </div>
<?php
require_once('inc/bas.inc.php');


