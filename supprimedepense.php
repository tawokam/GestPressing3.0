<?php
require('connect.php');
$iden=$_GET['identd'];
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
        $nomuser = $sele['nom_user'];
    }
}
$se = "SELECT * FROM depense WHERE id_depense='$iden'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $motif = $sele['motif'];
        $montant = $sele['montant'];
        $enreg = $sele['date_enreg'];
    }
}

$su="DELETE FROM depense where id_depense='$iden' AND agence='$agence'";
if($sup=$connec->query($su)){
     // inserer la suppression des les operations
     $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Depense','Suppression','Motif :".$motif.", Montant:".$montant.", enregistrer le:".$enreg."','$agence')";
     if($ins = $connec -> exec($in)){} 
}
?>