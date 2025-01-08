<?php
require('connect.php');
$date=$_POST['date'];
$montreel=$_POST['montreel'];

$somdep=$_POST['somdep'];
$montnet=$_POST['montnet'];
$cookie=$_POST['cookie'];
$somentre=$_POST['somentre'];
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

//verification si la cloture de caisse a ete deja effectuer avec la datte entréé
$ch="SELECT *,count(id_clot) as nbre FROM cloturecaisse where date_clot='$date' AND agence='$agence'";
if($che=$connec->query($ch)){
    while($cher=$che->fetch()){
        $nbre=$cher['nbre'];
        if($nbre>=1){
            echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
            La clôture de caisse a déjà été effectuée à cette date
       </div>';
        }
        else if($nbre<1){
            if($montreel==''){
                echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
                veuillez saisir le montant réel en caisse
           </div>';
            }
            else{
                //comparaison entre le montant net el le montant reel en caisse
                $manque=$montnet-$montreel;
                $observation;
                if($manque=='0'){
                    $observation='Exact';
                }else if($manque>0){
                    $observation='Manquant';
                }else if($manque<0){
                    $observation='Surplus';
                }
                $in="INSERT INTO cloturecaisse values('','$somentre','$somdep','$montnet','$montreel','$manque','$observation','$cookie','$date','$agence')";
                if($inser=$connec->exec($in)){
                    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
                    Données enregistré avec succès
               </div>';
                    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Cloture de caisse','Insertion','Somme des entrées:".$somentre.", somme des depense:".$somdep.", montant net:".$montnet.", montant en caisse:".$montreel."','$agence')";
                    if($ins = $connec -> exec($in)){}  
                }
                
            }
        }
    }
}

?>