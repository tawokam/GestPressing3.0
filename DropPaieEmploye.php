<?php
require('connect.php');
$id=$_GET['id'];
$cookie = $_GET['cookie'];

$datetime = date('Y/m/d h:i:s');

//utilisateur qui drop
$se ="SELECT * FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while($sele = $sel -> fetch()){
        $user = $sele['nom_user'];

    }
}
//selection de la ligne a supprimer
$se ="SELECT * FROM salaire inner join comptes on salaire.user=comptes.id_compte WHERE ligne='$id'";
if($sel = $connec -> query($se)){
    while($sele = $sel -> fetch()){
        $nom = $sele['nom_user'];
        $debutdate = $sele['date_debut'];
        $datefinpaie = $sele['date_fin'];
        $salaireEmplMontverse = $sele['montverse'];
        $date = $sele['date_save'];

    }
}
// récuperation de l'agence en local
$agence = 0;
$ag = "DELETE FROM salaire WHERE ligne = '$id'";
if($age = $connec -> query($ag)){
  // inserer la suppression des les operations
  $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$user','Paiement','Suppression','user:".$nom.", date_debut:".$debutdate.", date_fin:".$datefinpaie.", montant_verse:".$salaireEmplMontverse.", enregistrer le:".$date ."')";
  if($ins = $connec -> exec($in)){} 
}

?>