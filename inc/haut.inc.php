﻿<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8">
   <link rel="icon" type="img/jpg" href="<?php echo RACINE_SITE .'images/logo.png';?>" />
  <title>Diarracouda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="copyright" content="diarracounda, Bakary DIARRA"> 
  <link href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css'; ?>" rel="stylesheet">
  <link href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.css'; ?>" rel="stylesheet"> 
  <link href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.css'; ?>" rel="stylesheet"> 
 <link href="<?php echo RACINE_SITE . 'inc/css/styles.css'; ?>" rel="stylesheet"> 
   <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>  
   <script src="<?php echo RACINE_SITE . 'inc/js/bootstrap.js'; ?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){

      $(".zoom_arrea").each(function(){
        var zoomm = $(this).find(".zoomm");
        var zoom_sur = $(this).find(".zoom_sur");

        var image = new Image();
        image.src = zoom_sur.attr("src");
        /*alert(image.width + "-" + image.height);*/
        zoomm.css({background:"url('"+$(this).find(".zoom_sur").attr("src")+"') no-repeat"});

        var offset = $(this).offset();
        $(this).mousemove(function(e){
          var x= e.pageX - offset.left;
          var y= e.pageY - offset.top;
          if(x>0 && x < $(this).width() && y>0 && y < $(this).height())
          {
            zoomm.fadeIn(250);
          }
          else
          {
            zoomm.fadeOut(200);
          }
          var rx= -Math.round(image.width/zoom_sur.width()*x - zoomm.width()/2);

          var ry= -Math.round(image.height/zoom_sur.height()*y - zoomm.height()/2);

          zoomm.css({left: (x-zoomm.width()/2)+"px",top: (y-zoomm.height()/2)+"px", backgroundPosition: rx+ "px "+ry+"px"});
        });
      });

	   $("button").click(function(){
        	$("p#alertCookies").hide(2000);
    	   });
    });


  </script>
  <style>

    .navbar-collapse{
      background-color: transparent;

    }
    .navbar-nav a{
      font-size: 25px;
      color: #000;
    }

     
   
    @media handled, screen and (max-width:480px), screen and (max-device-width:480px)
      {
        .navbar-header img{
          margin-left: -5px;
        }
        .text{
          display: none;
        }
        .marge{
          display: none;
        }
        .mrg{
          display: none;
        }
      }
      
  </style>
<body data-spy="scroll" data-target=".main-nav">

<header class="st-navbar">
  <nav class="navbar navbar-default navbar-fixed-top clearfix" role="navigation">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo RACINE_SITE .'index.php'; ?>">
      <img style="margin-top: -10px; " src="<?php echo RACINE_SITE .'images/logoS.png'; ?>" alt="logo" width="" height=""></a>
    </div>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sept-main-nav" style="margin-top: -50px;">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
    </button>
    <div class="navbar-collapse collapse" id="sept-main-nav">
      <ul class="nav navbar-nav" id="main-navigation">
      <?php  
      if (internauteEstConnecteEtEstAdmin()) { // admin connecté
        echo '<li role="presentation" class="dropdown">
          <a class="dropdown-toggle menu" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="menu">Administration</span><span class="caret"></span>
          </a>
        <ul class="dropdown-menu">';
          echo '<li><a href="'. RACINE_SITE .'admin/gestion_produit.php">Gestion des produits</a></li>';
          echo '<li><a href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a></li>';
          echo '<li><a href="'. RACINE_SITE .'admin/gestion_commande.php">Gestion des commandes</a></li>'; 
          echo '<li><a href="'. RACINE_SITE .'admin/gestion_avis.php">Gestion des Avis</a></li>
        </ul>
      </li>';
      }                      
      if (internauteEstConnecte()) { // membre connecté
        echo '<li><a href="'. RACINE_SITE .'index.php"> Accueil</a></li>';
        //echo '<li><a href="'. RACINE_SITE .'panier.php"> Panier</a></li>';
        echo '<li><a href="'. RACINE_SITE .'profil.php">Profil</a></li>';
        echo '<li><a href="'. RACINE_SITE .'panier.php">Panier('. quantiteProduit() .')</a></li>';
        echo '<li><a href="'.RACINE_SITE.'connexion.php?action=deconnexion"> Se déconnecter</a></li>';      
      } else { // simple visiteur
        echo '<li><a href="'. RACINE_SITE .'index.php"> Accueil</a></li>';
        echo '<li><a href="'. RACINE_SITE .'inscription.php"> Inscription</a></li>';
        //echo '<li><a href="'. RACINE_SITE .'panier.php"> Panier</a></li>';
        echo '<li><a href="'. RACINE_SITE .'panier.php">Panier('. quantiteProduit() .')</a></li>';
        echo '<li><a href="'. RACINE_SITE .'connexion.php"> Connexion</a></li>';
      }
      ?>
      </ul> 
      </div>
      
      </div>  
  </nav><!-- fin navbar-collapse -->   

<div class="container" style="min-height: 75vh;" style="background-color:;"> 

  <!-- Contenu de la page --> 
 