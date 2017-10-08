<?php
require_once('inc/init.inc.php');
//------------------ TRAITEMENT --------------------

//le moteur de recherche s
if(isset($_GET['q']) && !empty($_GET['q'])){
    $donnees = $mysqli->query("SELECT id_produit, categorie, titre, photo, prix,taille, description  FROM produit WHERE categorie LIKE '%$_GET[q]%' ORDER BY categorie ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
          $contenu_droite .='<div class="col-sm-6 col-xs-12 col-md-4">'; 
            $contenu_droite .='<div class="thumbnail"> ';    
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    $contenu_droite .= '<h4 >'. $produit['categorie'] .'</h4>';
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['taille'] .'</h4>';
                    $contenu_droite .= '<h4 style="margin-top:20px;width:100px;">Taille :</h4>';         
            $contenu_droite .= '</div>';
        $contenu_droite .= '</div>';   
      }
}elseif (isset($_GET['sexe']) && $_GET['sexe'] != 'mixte' && $_GET['sexe'] != 'femme') {
    $donnees = $mysqli->query("SELECT * FROM produit WHERE public='homme' ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
         $contenu_droite .='<div class="col-sm-6 col-xs-12 col-md-4">'; 
           $contenu_droite .='<div class="thumbnail"> ';    
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                   $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    $contenu_droite .='<h4 >'. $produit['categorie'] .'</h4>'; 
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['taille'] .'</h4>'; 
                    $contenu_droite .= '<h4 style="margin-top:20px;width:100px;">Taille :</h4>';         
            $contenu_droite .= '</div>';
        $contenu_droite .= '</div>';   
      }
  }elseif (isset($_GET['sexe']) && $_GET['sexe'] != 'mixte' && $_GET['sexe'] != 'homme') {
    $donnees = $mysqli->query("SELECT * FROM produit WHERE public='femme' ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
         $contenu_droite .='<div class="col-sm-6 col-xs-12 col-md-4">'; 
           $contenu_droite .='<div class="thumbnail"> ';    
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                   $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    $contenu_droite .='<h4 >'. $produit['categorie'] .'</h4>';
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['taille'] .'</h4>';
                    $contenu_droite .= '<h4 style="margin-top:20px;width:100px;">Taille :</h4>';           
            $contenu_droite .= '</div>';
        $contenu_droite .= '</div>';   
      }
  }elseif (isset($_GET['sexe']) && $_GET['sexe'] = 'mixte') {
    $donnees = $mysqli->query("SELECT * FROM produit WHERE public='mixte' ");   
             while($produit = $donnees->fetch_assoc()) {
                //debug($produit);    
         $contenu_droite .='<div class="col-sm-6 col-xs-12 col-md-4">'; 
           $contenu_droite .='<div class="thumbnail"> ';    
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                   $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    $contenu_droite .='<h4 >'. $produit['categorie'] .'</h4>';
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['taille'] .'</h4>';
                    $contenu_droite .= '<h4 style="margin-top:20px;width:100px;">Taille :</h4>';           
            $contenu_droite .= '</div>';
        $contenu_droite .= '</div>';   
      }
  }else{
$donnees = $mysqli->query("SELECT id_produit, categorie, titre, photo, prix,taille, description FROM produit");
       while($produit = $donnees->fetch_assoc()) {
          //debug($produit);    
          $contenu_droite .='<div class="col-sm-6 col-xs-12 col-md-4">'; 
            $contenu_droite .='<div class="thumbnail"> ';    
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="photo" src="'. $produit['photo'] .'" alt="" class="zoom_sur"></a>';              
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['prix'] .' €</h4>';
                    $contenu_droite .= '<h4 >'. $produit['categorie'] .'</h4>'; 
                    $contenu_droite .= '<h4 class="pull-right" style="padding-right:60px;">'. $produit['taille'] .'</h4>';
                    $contenu_droite .= '<h4 style="margin-top:20px;width:100px;">Taille :</h4>';    
            $contenu_droite .= '</div>';
        $contenu_droite .= '</div>'; 
  } 

}  // fin boucle while



//------------------ AFFICHAGE --------------------
require_once('inc/haut.inc.php');
?>




  <div class="row">
  <p id="alertCookies" >En navigant sur ce site vous acceptez les conditions de la politique des cookies.<button>ok</button></p>
  <?php echo $contenu; ?>
        <hr>
  <?php require_once('inc/menu.php') ?>


          <section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>                       
            <div class="carousel-inner">
                  <div class="item active">
                    <div class="col-sm-6 text" >
                      <h1>Votre boutique en ligne</h1>
                      <p style="font-size:17px;">Votre boutique en ligne <span>DIARRACOUNDA</span> est située en plein coeur de Paris. Les articles sont à la mode et pas chers, vous y trouverez toutes les nouveautés à des prix défiants toutes concurrences. Nous vous attendons avec impatience afin de vous satisfaire.</p>
                      <P style="font-size:17px;"> <span>Adresse</span>: 156 rue du monsieur le fou 75021.  </p>
                    </div>
                    <div class="col-sm-6">
                      <img src="image/girl11.jpg" class="girl img-responsive" alt="" />
                    </div>
                  </div>
                  <div class="item">
                    <div class="col-sm-6 text">
                      <h1>Votre boutique en ligne</h1>
                      <p style="font-size:17px;">Votre boutique en ligne<span> DIARRACOUNDA</span> est située en plein coeur de Paris. Les articles sont à la mode et pas chers, vous y trouverez toutes les nouveautés à des prix défiants toutes concurrences. Nous vous attendons avec impatience afin de vous satisfaire.</p>
                      <p style="font-size:17px;"><span> Adresse</span>: 156 rue du monsieur le fou 75021.  </p>
                    </div>
                    <div class="col-sm-6">
                      <img src="image/girl22.jpg" class="girl img-responsive" alt="" />
                    </div>
                  </div>
                  
                  <div class="item">
                    <div class="col-sm-6 text">
                      <h1>Votre boutique en ligne</h1>
                      <p style="font-size:17px;">Votre boutique en ligne <span>DIARRACOUNDA</span> est située en plein coeur de Paris. Les articles sont à la mode et pas chers, vous y trouverez toutes les nouveautés à des prix défiants toutes concurrences. Nous vous attendons avec impatience afin de vous satisfaire.
                      <p style="font-size:17px;"><span> Adresse</span>: 156 rue du monsieur le fou 75021.  </p>
                    </div>
                    <div class="col-sm-6">
                      <img src="image/girl33.jpg" class="girl img-responsive" alt="" />
                    </div>
                  </div>
              
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section><!--/slider-->
      <div class="row">
      <hr>
          <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:50px;">
            <?php echo $contenu_droite; ?>
          </div> 
      </div>
  </div>
<?php
require_once('inc/bas.inc.php');


