<?php
require('connect.php');
$ident=$_GET['ident'];
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

$se = "SELECT * FROM typeverseargent inner join verseargent on typeverseargent.id_typevera=verseargent.id_typevera WHERE verseargent.id_vera='$ident'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomtyp = $sele['nom_versa'];
        $montant = $sele['montant'];
        $recu = $sele['numRecu'];
        $datesave = $sele['date_vera'];
    }
}

$su="DELETE FROM verseargent where id_vera='$ident' AND agence='$agence'";
if($sup=$connec->query($su)){
    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Versement','Suppression','type de versement:".$nomtyp.", montant:".$montant.", Numéro du reçu:".$recu.", date de versement:".$datesave."','$agence')";
    if($ins = $connec -> exec($in)){}  
}
?>