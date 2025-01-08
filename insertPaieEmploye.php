<?php
require('connect.php');
$debutdate            = $_POST['debutdate'];
$agenceEmployer       = $_POST['agenceEmployer'];
$datefinpaie          = $_POST['datefinpaie'];
$salaireEmplMontverse = $_POST['salaireEmplMontverse'];
$userid               = $_POST['userid'];
$cookie               = $_POST['cookie'];
$date                 = date('Y/m/d');
$datetime             = date('Y/m/d h:i:s');


$se = "SELECT nom_user,agence FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nom = $sele['nom_user'];
        $agence = $sele['agence'];
    }
}

if($debutdate == '' || $datefinpaie == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez définir une intervalle de date
</div>';
}else if($salaireEmplMontverse == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer le montant versé à l\'employer
</div>';
}else{
    $in="INSERT INTO salaire values('','$userid','$debutdate','$datefinpaie','$salaireEmplMontverse','$agenceEmployer','$date')";
    if($ins=$connec->exec($in)){
    echo '<div class="alert alert-success" role="alert" style="font-size:12px">Salaire enregistré</div>'; 

    // inserer la suppression des les operations
    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Paiement','Insertion','user:".$userid.", date_debut:".$debutdate.", date_fin:".$datefinpaie.", montant_verse:".$salaireEmplMontverse.", enregistrer le:".$date ."','$agence')";
    if($ins = $connec -> exec($in)){} 
}else{
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Un problème est survenu veuillez recommancer
</div>';  
}
}
?>