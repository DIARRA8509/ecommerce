<?php
require_once('inc/init.inc.php');

// Demande de déconnexion par l'internaute :
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
  session_destroy();  // on supprime la session du membre s'il demande la déconnexion
}

// Internaute déjà connecté est envoyé vers son profil :
if (internauteEstConnecte ()) {
  // redirection vers la page profil :
  header('location:profil.php');
 exit();
}

// Traitement du formulaire :
if ($_POST) { // si le formulaire de connexion est soumis
  
   $resultat = $mysqli->query("SELECT * FROM membre WHERE email = '$_POST[email]'");
   
        $_POST['mdp'] = md5($_POST['mdp']);
          $mysqli-> query("UPDATE membre SET email='$_POST[email]',mdp='$_POST[mdp]',pseudo='$_POST[pseudo]' WHERE email='$_POST[email]'");

          header('location:profil.php');
          exit();
} // fin du if ($_POST)


//------------------------ AFFICHAGE --------------------
require_once('inc/haut.inc.php');
echo $contenu;
?>
<div class="col-md-push-4 col-md-4">
    <h3>Réinitiliser votre mot de passe</h3>
    <form method = "GET" action="">

      <br>
      <label for="email">E-mail</label><br>
      <input class="form-control" type="email" id="email" name="email">
      <br>      
      <label for="mdp">Nouveau mot de passe</label><br>
      <input class="form-control" type="password" id="mdp" name="mdp">
      <br>     
      <input type="submit" value="Réinitiliser" class="btn btn-primary">
    </form>
</div>
<?php
//require_once('inc/bas.inc.php');