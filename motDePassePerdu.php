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
   //$resultat = $mysqli->query("SELECT * FROM membre WHERE email = '$_POST[email]'");
// Traitement du formulaire :
if ($_POST) { // si le formulaire de connexion est soumis

   $_POST['email'] = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
  $_POST['email'] = addslashes($_POST['email']); 

 $resultat = $mysqli->query("SELECT email, mdp FROM membre WHERE email = '$_POST[email]'");
       
 //var_dump($resultat);         
   $recap = $resultat->fetch_assoc(); 
   //var_dump($recap);
   $mail = $recap['email'];
   $mdp = $recap['mdp'];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   //5.8 Envoi du mail de confirmation à l'internaute :
    // Vous pouvez intervenir temporairement sur le fichier php.ini avec les instructions suivantes :
    ini_set('SMTP', 'www.diarracounda.fr'); // mettre en second argument le smtp de sa propre messagerie mail
    ini_set('sendmail_from', 'bakarydiarra8509@gmail.com');
    
     
    // variables utilisateur utilisées la fonction mail() :
    $to = $mail;  // destinataire
    $subject = 'Vos identifiants'; // objet du mail
     $formMdp = $mdp; //le mot de pass
     $message = 'Votre email : '.$to .  ' Votre mot de pass : ' . $formMdp;
    
    // La fonction mail():
     mail($to, $subject,$formMdp, $message);

     //on écrit un message de succès
 
     echo "<div> envoi  reussi connectez vous sur votre boite email </div>";

} // fin du if ($_POST)


//------------------------ AFFICHAGE --------------------
require_once('inc/haut.inc.php');
echo $contenu;
?>
<div class="col-md-push-4 col-md-4">
    <h3>Renvoyer vos identifiants</h3>
    <form method = "POST" action="">
      <label for="email">E-mail</label><br>
      <input class="form-control" type="email" id="email" name="email">
      <br>      
      <!-- <label for="mdp">Nouveau mot de passe</label><br>
      <input class="form-control" type="password" id="mdp" name="mdp">
      <br>  -->    
      <input  type="submit" value="Renvoyer" class="btn btn-primary">
    </form>
</div>
<?php
//require_once('inc/bas.inc.php');