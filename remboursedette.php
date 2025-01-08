<?php
require('connect.php');
$code=$_GET['code'];
$avancedette=$_GET['avance'];
$cookie=$_GET['cookie'];
$date=date('Y/m/d');
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

$se="SELECT * FROM facture where code='$code' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $montver=$sele['avance'];
        $somavance=$montver+$avancedette;
        $total=$sele['monttotal'];
        $reste=$total-$somavance;
        //insertion du versement dans la table versement
        $ver="INSERT INTO versement values('','$code','$avancedette','$date','$agence')";if($vere=$connec->exec($ver)){}
        $mo="UPDATE facture set reste='$reste',avance='$somavance' where code='$code' AND agence='$agence'";
        if($mod=$connec->query($mo)){
            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Dette','Remboursement','code de la facture:".$code.", montant versé:".$avancedette.", Reste:".$reste."','$agence')";
            if($ins = $connec -> exec($in)){} 
            //modification du reste a payer dans reglement
            $mor="UPDATE reglement set restAverse='$reste' where code='$code' AND agence='$agence'";
            if($more=$connec->query($mor)){}
            if($reste==0){
            $ch="SELECT * FROM reglement where code='$code' AND agence='$agence'";
            if($cher=$connec->query($ch)){
                while($cherc=$cher->fetch()){
                    $mo2="UPDATE reglement set regle='OUI' WHERE code='$code' AND agence='$agence'";
                    if($mod2=$connec->query($mo2)){
                        // inserer la suppression des les operations
                        
                    }
                }
            }
        }
         }
    }
}
?>