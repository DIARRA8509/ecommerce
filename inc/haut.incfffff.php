<!DOCTYPE html>
<html>
<head>  
  <title>Diarracouda</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="copyright" content="diarracounda, Bakary DIARRA">
  <link rel="icon" type="img/jpg" href="<?php echo RACINE_SITE .'images/logo.png';?>" />
  <link href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css'; ?>" rel="stylesheet">

  <link href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.css'; ?>" rel="stylesheet">
  
  <link href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.css'; ?>" rel="stylesheet">
 
 <link href="<?php echo RACINE_SITE . 'inc/css/styles.css'; ?>" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
    .header_contact{
      font-size:20px;
      background-color:#dfdbdb;
      margin-top: 15px;
      margin-right:140px;
      margin-left:140px;
    }

  </style>

</head>
<body>
  <!-- Navigation -->
  <div class="container"  style="background-color:#dfdbdb;">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"   style="background-color:#dfdbdb;">
        <a class="navbar-brand" href="<?php echo RACINE_SITE .'index.php'; ?>">
        <img src="<?php echo RACINE_SITE .'images/logo.png'; ?>" alt="logo" width="100" height="30"></a>  
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="  .navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="main-navigation">
          <?php  
              if (internauteEstConnecteEtEstAdmin()) { // admin connecté
          ?>
              <li role="presentation" class="dropdown">
                <a  style="font-size:20px;color:#000;background-color:#dfdbdb;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <span  style="font-size:20px;color:#000;background-color:#dfdbdb;">Administration<span><span class="caret"></span>
                </a>
      <ul class="dropdown-menu">
          <?php
            echo '<li>
            <a style="font-size:20px;color:#000;" href="'. RACINE_SITE .'admin/gestion_produit.php">Gestion des produits</a></li>';
            echo '<li>
            <a style="font-size:20px;color:#000;" href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a>
            </li>';

            echo '<li>
            <a style="font-size:20px;color:#000;" href="'. RACINE_SITE .'admin/gestion_commande.php">Gestion des commandes</a>
            </li>';                      
          ?>
              </ul>
            </li>
          <?php                            }             
            if (internauteEstConnecte()) { // membre connecté
                echo '<li>
                    <a style="font-size:20px;color:#000;"  href="'. RACINE_SITE .'index.php"> Accueil</a>
                </li>';
                echo '<li>
                    <a style="font-size:20px;color:#000;"  href="'. RACINE_SITE .'profil.php"> Profil</a>
                </li>';                         
                echo '<li>
                    <a style="font-size:20px;color:#000;"  href="'.RACINE_SITE.'connexion.php?action=deconnexion"> Se déconnecter</a>
                </li>';      
          ?>
            </ul>

          <?php        
            } else { // simple visiteur
                echo '<li>
                          <a style="font-size:20px;color:#000;"  href="'. RACINE_SITE .'index.php"> Acceuil</a>
                      </li>';                                                     
                echo '<li>
                          <a style="font-size:20px;color:#000;"  href="'. RACINE_SITE .'inscription.php"> Inscription</a>
                       </li>';
                echo '<li>
                         <a style="font-size:20px;color:#000;"  href="'. RACINE_SITE .'connexion.php"> Connexion</a>
                       </li>';            
          ?>
      </ul>
                <?php } ?>   
       <div style="float:right;">
                    <ul class="nav nav-pills">
                      <li class="header_contact" > 01 51 01 62 06</li>
                      <li class="header_contact"  ><i></i> contact@diarracounda.fr</li>
                    </ul>
                  </div>
                </div>
        </nav><!-- fin navbar-collapse -->   
</div><!-- fin container -->  
    
<div class="container" style="min-height: 72vh;" style="background-color:;"> 

  <!-- Contenu de la page --> 
 