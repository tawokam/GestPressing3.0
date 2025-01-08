<?php
require('connect.php');
$ident    = $_GET['ident'];
$cookie   = $_GET['cookie'];
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
        $nomuser = $sele['nom_user'];
    }
}
$se = "SELECT nom_versa FROM typeverseargent WHERE id_typevera='$ident'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomtype = $sele['nom_versa'];
    }
}

$su="DELETE FROM typeverseargent where id_typevera='$ident' AND agence='$agence'";
if($sup=$connec->query($su)){
    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Type versement','Suppression','nom:".$nomtype."','$agence')";
     if($ins = $connec -> exec($in)){} 
}
?>