<?php
/*$categories_des_produits = $mysqli->query("SELECT * FROM produit GROUP BY public")or die('Erreur SQL' .$mysqli->error);
while($cat = $categories_des_produits->fetch_assoc()){
  echo'<div class="col-md-1">';
  echo'<a href="?action=research&categorie='.$cat['public'] .'"class="list-group-item">'.$cat['public'].'</a>';
  echo'</div>';
}*/
/*if (isset($_GET['sexe']) && $_GET['sexe'] != 'mixte' && $_GET['sexe'] != 'homme') {
       $donnees = $mysqli->query("SELECT * FROM produit WHERE public='femme' ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
         echo'<div class="col-sm-6 col-xs-8 col-md-4">'; 
           echo'<div class="thumbnail"> ';    
                echo '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                   echo '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    echo'<h4 >'. $produit['categorie'] .'</h4>';           
            echo '</div>';
        echo '</div>';   
      }
  }elseif (isset($_GET['sexe']) && $_GET['sexe'] != 'mixte' && $_GET['sexe'] != 'femme') {
    $donnees = $mysqli->query("SELECT * FROM produit WHERE public='homme' ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
         echo'<div class="col-sm-6 col-xs-8 col-md-4">'; 
           echo'<div class="thumbnail"> ';    
                echo '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                   echo '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    echo'<h4 >'. $produit['categorie'] .'</h4>';           
            echo '</div>';
        echo '</div>';   
      }
  }elseif (isset($_GET['sexe']) && $_GET['sexe'] = 'mixte') {
    $donnees = $mysqli->query("SELECT * FROM produit WHERE public='mixte' ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
         echo'<div class="col-sm-6 col-xs-8 col-md-4">'; 
           echo'<div class="thumbnail"> ';    
                echo '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                   echo '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    echo'<h4 >'. $produit['categorie'] .'</h4>';           
            echo '</div>';
        echo '</div>';   
      }
  }else{
$donnees = $mysqli->query("SELECT id_produit, categorie, titre, photo, prix, description FROM produit");
       while($produit = $donnees->fetch_assoc()) {
          //debug($produit);    
          $contenu_droite .='<div class="col-sm-6 col-xs-8 col-md-4">'; 
            $contenu_droite .='<div class="thumbnail"> ';    
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    $contenu_droite .= '<h4 >'. $produit['categorie'] .'</h4>'; 
                    $contenu_droite .= '<h4 >'. $produit['description'] .'</h4>';    
            $contenu_droite .= '</div>';
        $contenu_droite .= '</div>'; 
  } 

} */ // fin boucle while


  ?>

<div class="row">
  <div class="col-md-12">
        <div class="col-md-3" style="margin-left:30px;">
        <form method="GET">
        <input type="text" class="form-control" name="q" size="20" placeholder="Rechercher catégories " style="width:170px;padding-top:10px; display:inline;" >
        <input type="submit" value="Search" style="padding-top:6px; display:inline;">
        </form>
        </div>
        <div class="col-md-2" style="margin-left:;">
         <?php
            echo '<li><a style="font-size:20px;"  href="'. RACINE_SITE .'panier.php"><i class="glyphicon glyphicon-shopping-cart"></i>Panier('. quantiteProduit() .')</a></li>'
        ?>
        </div>
        <div class="col-md-2" style="margin-right:-60px;">
          <?php
            echo '<li><a style="font-size:20px;" href="'. RACINE_SITE .'profil.php" class="glyphicon glyphicon-user">compte</a></li>'
          ?>
        </div> 
        <?php
          $categories_des_produits = $mysqli->query("SELECT * FROM produit GROUP BY public")or die('Erreur SQL' .$mysqli->error);
          while($cat = $categories_des_produits->fetch_assoc()){
          echo'<div class="col-md-1">';
          echo'<a style="font-size:20px;" href="?sexe='.$cat['public'] .'">'.$cat['public'].'</a>';
          echo'</div>';
        }


  ?>
  </div>

</div>
 