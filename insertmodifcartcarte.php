<?php
require('connect.php');
$mont=$_POST['mont'];
$id_cart=$_POST['cookie'];
$nomcl=$_POST['nomcl'];
$cookie=$_POST['cookie'];
$dates=date('Y/m/d');
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

if($nomcl==''){
    echo '<br><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez selectionnez une carte
</div>';
}else{
    $recin="INSERT INTO rechargecf values('','$mont',0,'$id_cart','$dates','$agence')";
    if($recine=$connec->exec($recin)){
$in="UPDATE cartefidelite set pourcentage='$mont' where id_carte='$id_cart' ";
if($inser=$connec->query($in)){
    echo '<br><div class="alert alert-success" role="alert" style="font-size:12px">
    Pourcentage modifié
</div>';
$in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Carte fidelité','Modification','nom du client:".$nomcl.", reduction:".$mont." %','$agence')";
if($ins = $connec -> exec($in)){}  
}else{
    echo '<br><div class="alert alert-danger" role="alert" style="font-size:12px">
    Problème de connexion
</div>';
}
    }
}
?>