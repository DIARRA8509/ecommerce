

<div class="row">
  <div class="col-md-12">
        <div class="col-md-3 col-sm-5 " >
        <form method="GET">
        <input type="text" class="form-control" name="q" size="20" placeholder="Rechercher catégories " style="width:170px;padding-top:10px; display:inline;" >
        <input type="submit" value="Search" style="padding-top:6px; display:inline;">
        </form>
        </div><br>
        <?php
          $categories_des_produits = $mysqli->query("SELECT * FROM produit GROUP BY public")or die('Erreur SQL' .$mysqli->error);
          while($cat = $categories_des_produits->fetch_assoc()){
          echo'<div class="col-md-3 col-sm-2 col-xs-4">';
          echo'<a style="font-size:20px;" href="?sexe='.$cat['public'] .'">'.$cat['public'].'</a>';
          echo'</div>';
        }
  ?>
  </div>

</div>
 