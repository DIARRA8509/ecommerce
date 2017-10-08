<?php

require_once('inc/init.inc.php');

//---------------- TRAITEMENT -------------------------
if ($_POST) {
  //debug($_POST,1);
  
  // Vérifier que tous les champs sont remplis :
/*
  if (empty($_POST['pseudo']) || empty($_POST['mdp']) || empty($_POST['nom'])|| empty($_POST['prenom'])|| empty($_POST['email'])|| empty($_POST['ville'])|| empty($_POST['code_postal'])|| empty($_POST['adresse'])) {
      $contenu = '<div class="bg-danger">Veuillez remplir tous les champs ! </div>';
  }
  */
  // Alternative :
  foreach($_POST as $value) {
    if (empty($value)) $contenu = '<div class="bg-danger">Veuillez remplir tous les champs ! </div>';    
  }
  
  // vérification de la longueur du pseudo :
  if (strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20 ) {
    $contenu .= '<div class="bg-danger">Le pseudo doit contenir entre  4 et 20 caractères</div>';
  }
  
  // Vérification que le code postal est un numérique :
  if (!is_numeric($_POST['code_postal'])) {
     $contenu .= '<div class="bg-danger">Le code postal n\'est pas valide ! </div>';
  }
  /* 
  if (!$_POST['code_postal'] > 0) {
       $contenu .= '<div class="bg-danger">Le code postal n\'est pas valide ! </div>';
  }
  */
  
  // Vérification de l'unicité du pseudo :
  if (empty($contenu)) { // si il n'y a pas de message d'erreur
      $membre = $mysqli->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
    
      if ($membre->num_rows > 0) { // s'il y a au moins 1 enregistrement, c'est que le pseudo est déjà pris
          $contenu .= '<div class="bg-danger">Pseudo indisponible. Veuillez en choisir un autre.</div>';
      } else { // le pseudo n'existe pas, on peut donc enregistrer le membre
        // Cryptage du mot de passe :

        //$_POST['mdp'] = md5($_POST['mdp']); // la fonction prédéfinie md5() permet de crypter un string. 
        
        // Retraitement du $_POST dans htmlentities() pour convertir les caractères spéciaux en entité HTML :
        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
        }
        
        // Traitement des apostrophes :
        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = addslashes($valeur);
        }
            
        // Insertion en base :
        $mysqli->query("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES('$_POST[pseudo]', '$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[code_postal]','$_POST[adresse]', 0)"); // 0 pour un membre non admin
        
        $contenu .= '<div class="bg-success">Vous êtes inscrit à notre site. <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
      } 
  } // fin if (empty($contenu))
} // fin du if ($_POST)

// --------------- AFFICHAGE -------------------------
require_once('inc/haut.inc.php');
echo $contenu;
// Pré-remplissage du formulaire de modification :
  if (isset($_GET['id_membre'])) { // si id_produit existe c'est que nous sommes en modification (car on ne passe pas d'id_produit en ajout)
    
    $resultat = $mysqli->query("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'");
    $produit_actuel = $resultat->fetch_assoc(); // array qui permet de pré-remplir le formulaire ci-dessous
  }
?>
<div class="col-md-push-3 col-md-6 ">
<h3>Veuillez renseigner le formulaire pour vous inscrire :</h3>
<form method="post" action="">
  <label for="pseudo">Pseudo</label><br>
  <input class="form-control" type="text" id="pseudo" name="pseudo" value="<?php if (isset($produit_actuel)) echo $produit_actuel['prenom'];?>"><br>
  
  <label for="mdp">Mot de passe</label><br>
  <input class="form-control" type="password" id="mdp" name="mdp" value="<?php if (isset($produit_actuel)) echo $produit_actuel['mdp'];?>"><br>

  <label for="nom">Nom</label><br>
  <input class="form-control" type="text" id="nom" name="nom" value="<?php if (isset($produit_actuel)) echo $produit_actuel['nom'];?>"><br>

  <label for="prenom">Prénom</label><br>
  <input class="form-control" type="text" id="prenom" name="prenom" value="<?php if (isset($produit_actuel)) echo $produit_actuel['prenom'];?>"><br>

  <label for="email">Email</label><br>
  <input class="form-control" type="email" id="email" name="email" value="<?php if (isset($produit_actuel)) echo $produit_actuel['email'];?>"><br>
  
  <label>Civilité</label><br>
  <input type="radio" name="civilite" value="m" checked>Homme
  <input type="radio" name="civilite" value="f" <?php if (isset($produit_actuel) && $produit_actuel['civilite'] == 'femme') echo 'checked';?>>Femme
  <br>
  
  <label for="ville">Ville</label><br>
  <input class="form-control" type="text" id="ville" name="ville" value="<?php if (isset($produit_actuel)) echo $produit_actuel['ville'];?>"><br>
  
  <label for="code_postal">Code postal</label><br>
  <input class="form-control" type="text" id="code_postal" name="code_postal" value="<?php if (isset($produit_actuel)) echo $produit_actuel['code_postal'];?>"><br>
  
  <label for="adresse">Adresse</label><br>
  <input class="form-control" type="text" id="adresse" name="adresse" value="<?php if (isset($produit_actuel)) echo $produit_actuel['adresse'];?>"><br>
  
  <input type="submit" name="inscription" value="inscrire" class="btn btn-primary">
</form>
</div>
<?php
require_once('inc/bas.inc.php');



