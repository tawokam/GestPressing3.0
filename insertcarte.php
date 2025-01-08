<?php
require('connect.php');
$codecl   = $_POST['codecl'];
$mont     = $_POST['mont'];
$cookie   = $_POST['cookie'];
$dates    = date('Y/m/d');
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

$se = "SELECT nom_cl FROM client WHERE id_client='$codecl'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomcl = $sele['nom_cl'];
    }
}

if($codecl==''){
    echo '<div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez choisir le client
</div>';
}else if($mont==''){
    echo '<div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez saisir le pourcentage de réduction
</div>';
}else{
$se="SELECT *,count(id_carte) as nbre FROM cartefidelite where id_client='$codecl'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $en=$sele['nbre'];
        if($en<1){
           $in="INSERT INTO cartefidelite values('','$codecl','$mont','$dates','0','$agence')";
           if($ins=$connec->exec($in)){
            echo '<div class="alert alert-success" role="alert" style="font-size:12px">
            Nouvelle carte généré
        </div>';

        $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Carte fidelité','Générer une carte','nom du client:".$nomcl.", reduction:".$mont." %','$agence')";
        if($ins = $connec -> exec($in)){}  
        }
        }else if($en>=1){
            echo '<div class="alert alert-warning" role="alert" style="font-size:12px">
            Ce client possède déjà une carte de fidélité
        </div>';
        }
    }
}
}
?>