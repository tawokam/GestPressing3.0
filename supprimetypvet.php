<?php
require('connect.php');
$iden=$_GET['iden'];
$cookie=$_GET['cookie'];
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

$se = "SELECT * FROM typevetement WHERE id_typevet='$iden'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomvet  = $sele['nom_vet'];
        $prixvet = $sele['prix_vet'];
    }
}

$su="DELETE FROM typevetement where id_typevet='$iden' AND agence='$agence'";
if($sup=$connec->query($su)){
     // inserer la suppression des les operations
     $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Type de vetement','Suppression','nom:".$nomvet.", prix:".$prixvet."','$agence')";
     if($ins = $connec -> exec($in)){} 
}
?>