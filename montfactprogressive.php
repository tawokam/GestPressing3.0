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

$se="SELECT *,sum(monttotal) as montotal FROM commande where code='0' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        echo $sele['montotal'];
    }
}
?>
