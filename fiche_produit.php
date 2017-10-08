<?php
require_once('inc/init.inc.php');
$aside = '';
$contenus ='';
$contenu_commentaire='';
$contenu_comment='';
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
$contenu .= '<div class="col-md-12">';        
        $contenu .= '<div class="col-md-6">';
              $contenu .= '<div class="zoom_arrea">';
                $contenu .='<div class="zoomm"></div>';
                $contenu .= '<img  src="'. $produit['photo'] .'" alt="" class="zoom_sur">';
              $contenu .='</div>'; 
       $contenu .= ' </div>';

        $public = array('m'=>'masculin','f'=>'féminin', 'mixte'=>'mixte');
  $contenu .= '<div class="col-md-6" >      
        
                          <h3>Description</h3>
                          <p>'. $produit['description'] .'</p>
                          <h2>Détails :</h2>                         
                            <h3>Catégorie : '. $produit['categorie'] .'</h3>
                            <h3>Couleur : '. $produit['couleur'] .'</h3>        
                          <p class="lead">Prix : '. $produit['prix'] .'€</p>';
                     
                     
      // 3- Affichage du formulaire d'ajout au panier si stock>0 
  /*$contenu .='<div class="col-md-6">';*/
    if ($produit['stock'] > 0) {
    $contenu .= '<form method="post" action="panier.php">';
      $contenu .= '<input type="hidden" name="id_produit" value="'. $produit['id_produit'] .'">';
      if ($produit['categorie']=='chaussure') {
        $contenu .='<label>Pointure</label><br>';
      $contenu .='<select style="width:100px;" class="form-control" name="taille">
      <option value="39">39</option>
      <option value="40">40</option>
      <option value="41">41</option>
      <option value="42">42</option>     
      </select> <br><br>';
      }else{
         $contenu .='<label>Taille</label><br>';
      $contenu .='<select style="width:100px;" class="form-control" name="taille">
      <option value="s">S</option>
      <option value="m">M</option>
      <option value="l">L</option>
      <option value="l">XL</option>
      <option value="l">XXL</option>
      </select> <br><br>';
      }

      

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
    $contenu .= '<p><a href="index.php?categorie='. $produit['categorie'] .'">Retour vers la sélection de '. $produit['categorie'] .'</a></p><hr>';          
    $contenu .='</div>';
    } // fin du if (isset($_GET['id_produit']))
 $contenu .= '</div>';   

//Insertion en base 
if (isset($_POST['poster'])) {
    if(empty($_POST['commentaire'])){
          $contenu = '<div class="bg-danger">Veuillez remplir le champs commentaire ! </div>';
        }
  
        $_POST['commentaire'] = htmlentities($_POST['commentaire'], ENT_QUOTES);
        $_POST['commentaire'] = addslashes($_POST['commentaire']);
        $mysqli->query("INSERT INTO commentaire (id_produit, id_membre,pseudo, commentaire, date_enregistrement) VALUES('$_POST[id_produit]','$_POST[id_membre]', '$_POST[pseudo]','$_POST[commentaire]', NOW())")or die('Erreur SQL' .$mysqli->error);
       }
    $commentaire = $mysqli->query("SELECT * FROM commentaire WHERE id_produit = '$_GET[id_produit]' ORDER BY date_enregistrement DESC")or die('Erreur SQL' .$mysqli->error); 
               
    while($comment=$commentaire->fetch_assoc()){
      //var_dump($comment);
    $contenu_comment .='<h4> Pseudo : '.$comment['pseudo'].'</h4>';
    $contenu_comment .='<p><h4>Commentaire :</h4> '.$comment['commentaire'].'</p>';
    $contenu_comment .='<p>Date : '.$comment['date_enregistrement'].'</p>';
    $contenu_comment .='<hr>';
    }
    


 if (internauteEstConnecte()){
    $id_membre = $_SESSION['membre']['id_membre'];
    $pseudo = $_SESSION['membre']['pseudo'];
    //var_dump($_SESSION);
    if ($produit['id_produit']) {
        $contenu_commentaire .= '<h3>Les commentaires :</h3>';
     
         $contenu_commentaire .= '<form method="POST" action="">';
           
           $contenu_commentaire .= '<input type="hidden" name="id_produit" value="'.$produit["id_produit"].'">';
           $contenu_commentaire .= '<input type="hidden" name="id_membre" value="';
          $contenu_commentaire .= $id_membre.'">';
     
          $contenu_commentaire .= '<input type="hidden" name="pseudo" value="';
          $contenu_commentaire .= $pseudo.'">';

           $contenu_commentaire .='<label for="commentaire">commentaire</label><br>
          <textarea class="form-control" id="commentaire"  
          name="commentaire" ></textarea><br>
         
          <input type="submit" value="poster" name="poster" class="btn btn-primary btn-primary"><br><br><br>
 
</form>';
          //var_dump($_POST);
    }
  }
//------------------ AFFICHAGE -------------------
require_once('inc/haut.inc.php');
//require_once('inc/menu.php');

echo'<hr>';

echo $contenu_gauche;  // pour afficher la confirmation d'ajout de produit au panier 
?>
         <div class="row" style="text-align:center; font-size:20px; color:red;">
           <?php echo $contenus; ?>
         </div>
         <div class="row">
         <div class="col-md-10 col-md-10 col-sx-10">
           <?php echo $contenu; ?>
           </div>
           <div class="col-md-2" style="margin-top:120px;" >
              <h3>Commentaires:</h3>
              <hr>
              <?php echo $contenu_comment; ?>
           </div>
           <div class="col-md-6">
              <?php echo $contenu_commentaire; ?>
           </div> 
             
         </div>  
           <!-- Pour le TP : -->
        <div class="row">
        <div class="col-lg-12 ">
                 <h3 class="page-header mrg">Egalement consultés par nos clients</h3>
         </div>
         <?php
             $resultat3 = $mysqli->query("SELECT * FROM produit WHERE id_produit !='$_GET[id_produit]' ORDER BY RAND() LIMIT 4; ") or die('Erreur SQL' .$mysqli->error);
              while($req3 = $resultat3->fetch_assoc()){
                echo '<div class="col-md-3 col-sm-6 col-xs-6 marge" style="margin-bottom:50px;">
                          <a href="fiche_produit.php?id_produit='. $req3['id_produit'] .'"><img src="'. $req3['photo'] .'" alt="" width="90%" height="250px"></a>
                     </div>';
              }  
         ?>
  
  </div>
<?php
require_once('inc/bas.inc.php');



