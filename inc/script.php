<?php
 
// 7 - Suppression d'un membre :
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {

  $mysqli->query("DELETE FROM membre WHERE id_membre = '$_GET[id_membre]' ");
  
  $contenu .= '<div class="bg-success">membre a bien été supprimé</div>';
  
  $_GET['action'] = 'affichage';  // pour lancer l'affichage de la table HTML mise à jour
}

////////////////////////// la pagination ///////////////////////////////////
/*if (isset($_GET['pp']) && !empty($_GET['pp']) && ctype_digit($_GET['pp'])==1){
  $perPage=$_GET['pp'];
}else{*/
  $perPage=10;
//}
  

  $req=$mysqli->query("SELECT COUNT(*) AS total FROM membre");
  $result=$req->fetch_assoc();
  $total = $result['total'];
  
  $nbPage= ceil($total/$perPage);


  if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p'])==1) {
    if ($_GET['p'] > $nbPage){
      $current= $nbPage;
    }else{
      $current = $_GET['p'];
    }

  }else{
    $current=1;
  }

    $firstPage = ($current -1)*$perPage;

    $reqProduct =$mysqli->query("SELECT id_membre, pseudo, email, nom, prenom, civilite, ville, code_postal, adresse, statut FROM membre LIMIT $firstPage, $perPage "); 
   

?>