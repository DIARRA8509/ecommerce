<?php
require_once('inc/init.inc.php');
require_once('inc/haut.inc.php');
$membre= $_SESSION['membre']['id_membre'];
if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
  $mysqli->query("DELETE FROM membre WHERE id_client = '.$membre.' "); 
 header('location:../index.php');
}

require_once('inc/bas.inc.php');


