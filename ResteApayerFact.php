<?php
require('connect.php');
$codefact=$_GET['codefact'];

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$re="SELECT * FROM facture where code='$codefact' AND agence='$agence'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        echo $reqe['reste'];
    }
}
?>