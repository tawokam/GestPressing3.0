<?php
require('connect.php');
$ident=$_GET['ident'];
$cookie=$_GET['cookie'];
$datetime = date('Y/m/d h:i:s');

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
$se = "SELECT nom_dep FROM typedepense WHERE id_dep='$ident'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomdep = $sele['nom_dep'];
    }
}
$su="DELETE FROM typedepense where id_dep='$ident'";
if($sup=$connec->query($su)){
     // inserer la suppression des les operations
     $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Type depense','Suppression','nom :".$nomdep."','$agence')";
     if($ins = $connec -> exec($in)){} 
}
?>