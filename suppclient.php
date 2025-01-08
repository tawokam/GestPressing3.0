<?php
require('connect.php');
$idcl=$_GET['idcli'];
$cookie=$_GET['cookie'];
$datetime = date('Y/m/d h:i:s');

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
   while ($sele = $sel -> fetch()) {
       $nomuser = $sele['nom_user'];
   }
}
$se = "SELECT * FROM client WHERE id_client='$idcl'";
if($sel = $connec -> query($se)){
   while ($sele = $sel -> fetch()) {
       $nom = $sele['nom_cl'];
       $telephone = $sele['telephone_cl'];
   }
}

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$su="DELETE FROM client where id_client='$idcl'";
if($sup=$connec->query($su)){
    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Client','Suppression','nom:".$nom.", téléphone:".$telephone."','$agence')";
    if($ins = $connec -> exec($in)){} 
}
?>