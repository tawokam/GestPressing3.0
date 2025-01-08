<?php
require('connect.php');
$montreel = $_POST['montreel'];
$dateclo = $_POST['dateclo'];
$cookie = $_POST['cookie'];
$aterdate=date('Y/m/d', strtotime($dateclo.' +1 days'));
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

if($dateclo=='' || $montreel==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Echec. Veuillez vérifier si le montant réel a été saisi et réessayer
</div>';
}else if($dateclo!='' && $montreel!=''){
$se="SELECT *,count(id_verse) as nbre FROM versement where date_verse='$aterdate' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $nbre = $sele['nbre'];
        if($nbre>=1){
            //echo $aterdate;
            echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
                 Le report de caisse a déjà été effectuer à cette date
            </div>';
        }else if($nbre<1){
            $in="INSERT INTO versement values('','','$montreel','$aterdate','$agence')";
            if($ins=$connec->exec($in)){
                echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
                Caisse reportée avec succès
                </div>';
                $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Cloture caisse','Report de caisse','Montant en caisse:".$montreel.", reporter pour le:".$aterdate."','$agence')";
                if($ins = $connec -> exec($in)){}  
                }
        }
    }
}
}
?>