<?php
require('connect.php');
$ident  = $_GET['ident'];
$cookie = $_GET['cookie'];
$datetime = date('Y/m/d h:i:s');

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nom = $sele['nom_user'];
    }
}

$se = "SELECT * FROM commande WHERE id_cmd='$ident'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $pu = $sele['montaverse'];
        $qte = $sele['quantite_cmd'];
        $descript = $sele['description_cmd'];
        $datede = $sele['date_depot'];
        $datere = $sele['date_retrait'];
        $net = $sele['monttotal'];
    }
}

$sup="DELETE from commande where id_cmd='$ident' AND agence='$agence'";
if($supp=$connec->query($sup)){
    // inserer la suppression des les operations
    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','depot vetement','Suppression','prix unitaire:".$pu.", quantité:".$qte.", description:".$descript.", date depot:".$datede.", date retrait:".$datere .", montant total:".$net."','$agence')";
    if($ins = $connec -> exec($in)){} 
}
?>