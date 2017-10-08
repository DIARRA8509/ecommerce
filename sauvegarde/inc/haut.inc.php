<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ma boutique</title>

  <link href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css'; ?>" rel="stylesheet">

  <link href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.css'; ?>" rel="stylesheet">
  
  <link href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.css'; ?>" rel="stylesheet">
 
 <link href="<?php echo RACINE_SITE . 'inc/css/style.css'; ?>" rel="stylesheet">
 <style>





#menu a{ 
	display:block; 
	color: #fff; 
	text-decoration:none;
    
}
#menu  li,
#menu  li li {
	position: relative;	
	width: 130px;
	padding: 6px 15px;
	background-color: #777;
	background-image: linear-gradient(#aaa, #888 50%, #777 50%,#999);
    margin-bottom: 1px; 
}

#menu > li li { background: transparent none; }
#menu > li li a { color: #444; }
#menu > li li:hover { background:#ccc; }
    
    

    
}
#menu > li:hover {
	background-color: ;
    /*background-image: linear-gradient(#ccc, #aaa 50%, #999 50%,#bbb);*/
	 
}
/* (presque) fin de la partie positionnement/déco */
/* dans cette déclaration, on fixe le max-height */
#menu ul {
	position: absolute;
	top: 40px; left: 0px; /*disposition du menu déroulant*/
	max-height:0px;	
	margin: 0; padding: 0px;
	background-color: #ddd;
	background-image: linear-gradient(#fff,#ddd);
	overflow: hidden;
	transition: 1s max-height 0.3s;

}
/* ici on change la valeur de max-height au :hover */
#menu > li:hover ul {
	max-height: 13em;
}

</style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    
    <div class="container">
      
      <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo RACINE_SITE . 'boutique.php'; ?>">Ma Boutique</a>
      </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php  
          if (internauteEstConnecteEtEstAdmin()) { // admin connecté
            echo '<li><a href="'. RACINE_SITE .'admin/gestion_boutique.php">Gestion de la boutique</a></li>';
            
            echo '<li><a href="'. RACINE_SITE .'admin/gestion_commande.php">Gestion des commandes</a></li>';
            
            echo '<li><a href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a></li>';
			
			 
          }  
            
          if (internauteEstConnecte()) { // membre connecté
               echo '<li><a href="'. RACINE_SITE .'boutique.php">accueil</a></li>';
              
              echo '<li><a href="'. RACINE_SITE .'profil.php">Profil</a></li>';
            
              
              echo '<li><a  href="'. RACINE_SITE .'panier.php"><i class="glyphicon glyphicon-shopping-cart"></i>Panier('. quantiteProduit() .')</a></li>';
              
              echo '<li><a href="'.RACINE_SITE.'connexion.php?action=deconnexion">Se déconnecter</a></li>';
          } else { // simple visiteur
              
               echo '<li><a href="'. RACINE_SITE .'boutique.php">accueil</a></li>';
              echo '<li><a href="'. RACINE_SITE .'inscription.php">Inscription</a></li>';
              
              echo '<li><a href="'. RACINE_SITE .'connexion.php">Connexion</a></li>';
              
              echo '<li><a href="'. RACINE_SITE .'panier.php">Panier('. quantiteProduit() .')</a></li>';
          } 
          ?>
        </ul>
      </div><!-- fin navbar-collapse -->
    
    </div><!-- fin container -->
  
  </nav>
  <br><br>
 <div class="container" style="min-height: 80vh;"> 

  <!-- Contenu de la page --> 
 