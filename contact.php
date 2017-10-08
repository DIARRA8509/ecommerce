<?php
require_once ('inc/init.inc.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="description" content="Votre devis transferts entreprises, déménagement, solution recyclage, garde-meubles sous 24h.">
  <title>Contact : diarracounda </title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>  
  <link href="https://fonts.googleapis.com/css?family=Roboto|Poppins:500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo RACINE_SITE .'form/css/form.css';?>">
  <link rel="stylesheet" type="text/css" href="<?php echo RACINE_SITE .'form/css/color_scheme_light.css';?>"> 
  
  <link rel="stylesheet" type="text/css" href="<?php echo RACINE_SITE .'form/css/js_styles/jquery.maximage.min.css';?>">
  <link rel="stylesheet" type="text/css" href="<?php echo RACINE_SITE .'form/css/typo.css';?>">

  
  <link rel="stylesheet" type="text/css" media="screen and (max-width: 1199px)" href="<?php echo RACINE_SITE .'inc/css/mediaquery.css';?>">

  </head>
  <body>
  <?php
  require_once('inc/haut.inc.php');
?>
  <div class="container-fluid" style="min-height: 75vh;" >    
    
    <section id="article">

      <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-sm-push-1 col-md-push-1 col-lg-push-1">
          <h1 style="text-align:center;">Contact</h1>
          <p style="text-align: center; font-size: x-large">Faites une demande  je vous contacte sous 24h!</p>

          <div class="thumbnail"> <!-- Contact Form -->
            <form action="form/contactform.php" id="contact-form" method="post">
              <div class="contact_form">

                <div class="input-field" style="margin-bottom:22px;margin-top:22px;">
                    <input id="first_name" type="text" name="contact-name">
                    <label for="first_name" style="font-size:17px;">Nom/Société</label>
                  </div>
                  <div class="input-field" style="margin-bottom:22px;">
                    <input id="contact_email" type="email" name="contact-email">
                    <label for="contact_email" style="font-size:17px;">Adresse email</label>
                  </div>
                  <div class="input-field" style="margin-bottom:22px;">
                    <input id="contact_tel" type="text" name="contact-tel">
                    <label for="contact_tel" style="font-size:17px;">Numéro de téléphone</label>
                  </div>
                  <div class="input-field" style="margin-bottom:22px;">
                    <textarea class="materialize-textarea" name="contact-message" rows="5"></textarea>
                    <label style="font-size:17px;">Votre message</label>
                  </div>
                </div>  
                <button class="btn btn-warning" type="submit" name="action" style="float: right;">Envoyer</button>
            </form>
          </div>
            <!-- //Contact Form -->
          
          
            <div id="message"><div id="alert"></div></div><!-- Message container --> 
          </div>
          <!-- //Contact Form Section -->
        </div>        
    </section><!-- //More info -->
  
  </div>
  
    <div class="container-fluid"  style="background-color:#dfdbdb;">
    <footer>      
    <hr>    
    <footer>
      <div class="row">
          <div class=" col-md-3">
            <p style="text-align:center;margin-top:;">Copyright &copy; Ma Boutique - 2016</p>
          </div>
          <div class=" col-md-2">
            <p style="text-align:center;margin-top:;"><a href="cgv.php">CGV</a></p>
          </div>
          <div class=" col-md-2">
            <p style="text-align:center;margin-top:;"><a href="mentions.php">Les mentions</a></p>
          </div>
          <div class=" col-md-2">
            <p style="text-align:center;margin-top:;"><a href="contact.php">contact</a></p>
          </div>
          </footer>        
      </div>
   
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo RACINE_SITE .'inc/js/main.js';?>"></script>
    <script src="<?php echo RACINE_SITE .'form/js/jquery.form.js';?>"></script>
    <script src="<?php echo RACINE_SITE .'form/js/jquery.maximage.min.js';?>"></script>
    <script src="<?php echo RACINE_SITE .'form/js/count_down.js';?>"></script>
    <script src="<?php echo RACINE_SITE .'form/js/happy.js';?>"></script>
    <script src="<?php echo RACINE_SITE .'form/js/main.js';?>"></script>
    <script src="<?php echo RACINE_SITE .'form/js/materialize.js';?>"></script>
  </body>
</html>