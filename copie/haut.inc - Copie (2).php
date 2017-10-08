<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ma soutenance</title>

  <link href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css'; ?>" rel="stylesheet">

  <link href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.css'; ?>" rel="stylesheet">
  
  <link href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.css'; ?>" rel="stylesheet">
 
 <link href="<?php echo RACINE_SITE . 'inc/css/styles.css'; ?>" rel="stylesheet">
 
   <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  
  <script src="<?php echo RACINE_SITE . 'inc/js/bootstrap.js'; ?>"></script>
 <style>
 <!---body{
    background: rgba(0, 0, 10, 0) url("images/ma_boutique.jpg") no-repeat fixed 0 0 / cover;
       }--->
   .img_homme{
     width:360px;
     height:460px;
   }
 </style>
</head>
<body>
  <!-- Navigation -->
  <div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#ccc;">
    <a class="navbar-brand" href="<?php echo RACINE_SITE . 'index.php'; ?>"><img src="images/logo.png" alt="logo" width="100" height="30"></a>  
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="  .navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      
    
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav" id="main-navigation">
    
          <?php  
          if (internauteEstConnecteEtEstAdmin()) { // admin connecté
      ?><li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <span class="glyphicon glyphicon-triangle-bottom">Administration<span><span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
  <?php
      echo '<li><a href="'. RACINE_SITE .'admin/gestion_art_homme.php">Gestion des articles homme</a></li>';
      echo '<li><a href="'. RACINE_SITE .'admin/gestion_art_femme.php">Gestion des articles femme</a></li>';
      echo '<li><a href="'. RACINE_SITE .'admin/gestion_art_enfant.php">Gestion des articles enfant</a></li>';
            
            echo '<li><a href="'. RACINE_SITE .'admin/gestion_produit.php">Gestion des produits</a></li>';
      
      echo '<li><a href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a></li>';
            
            echo '<li><a href="'. RACINE_SITE .'admin/gestion_commentaitre.php">Gestion des commentaires</a></li>';

      echo '<li><a href="'. RACINE_SITE .'admin/gestion_commande.php">Gestion des commandes</a></li>';      
            
    ?>
  </ul>
  </li>
    <?php        
          }             
          if (internauteEstConnecte()) { // membre connecté
              echo '<li><a class="glyphicon glyphicon-align-justify" href="'. RACINE_SITE .'index.php"> Accueil</a></li>';                        
              echo '<li><a class="glyphicon glyphicon-log-in " href="'.RACINE_SITE.'connexion.php?action=deconnexion"> Se déconnecter</a></li>';
              echo '<li><a class="" href="'. RACINE_SITE .'profil.php"> Profil</a></li>';       
              ?>
</ul>

             <?php        
          } else { // simple visiteur
              echo '<li><a class="glyphicon glyphicon-align-justify" href="'. RACINE_SITE .'index.php"> Acceuil</a></li>';                                                     
        echo '<li><a class="glyphicon glyphicon-pencil" href="'. RACINE_SITE .'inscription.php"> Inscription</a></li>';
         echo '<li><a class="glyphicon glyphicon-log-in " href="'. RACINE_SITE .'connexion.php"> Connexion</a></li>';
        
               ?>
</ul>

    <?php
  
              } 
          ?>        
                </div><!-- fin navbar-collapse -->    
              </div><!-- fin container -->  
          </nav>
  </div>
          <div class="container" style="min-height: 60vh;" style="background-color:#ccc;"> 

  <!-- Contenu de la page --> 