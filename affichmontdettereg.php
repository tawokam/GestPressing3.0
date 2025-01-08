<?php
require('connect.php');
$code=$_GET['code'];

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec-> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
$se="SELECT * FROM facture where code='$code' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $mont=$sele['reste'];
       echo $mont;
  }
}
?>