<?php
require('connect.php');

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$re="SELECT max(code) as nbre from commande WHERE agence='$agence'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        $maxcode=$reqe['nbre'];
        $mo="SELECT *,sum(monttotal) as total FROM commande where code='$maxcode' AND agence='$agence'";
          if($mox=$connec->query($mo)){
              while($moxe=$mox->fetch()){
                  $max=$moxe['total'];
                  echo $max;
              }
          }
    }
}
?>