<?php
require('connect.php');
$codefact=$_POST['codefact'];
$reste=$_POST['reste'];
$cookie=$_POST['cookie'];
$btn=$_POST['btn'];
$date=date('Y/m/d');
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
        $nom = $sele['nom_user'];
    }
}

$se="SELECT *,count(id_reg) as nbre FROM reglement where code='$codefact' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($selec=$sel->fetch()){
       $nbre=$selec['nbre'];
       if($nbre<1){
        if($btn=='regle'){
            $in="INSERT INTO reglement values('','$reste','OUI','NON','$date','$codefact','$agence')";
            if($inser=$connec->exec($in)){
                $up="UPDATE facture set avance=avance+$reste, reste='0' where code='$codefact' AND agence='$agence'";
                if($upd=$connec->query($up)){
                    //versement dans la table versement
                    $ver="INSERT INTO versement values('','$codefact','$reste','$date','$agence')";if($verse=$connec->exec($ver)){
                         // inserer la suppression des les operations
                        $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','facture','Reglement facture','code facture :".$codefact.", Montant versé:".$reste."','$agence')";
                        if($ins = $connec -> exec($in)){} 
                    }
                }
            }
        }else if($btn=='dette'){
            $in="INSERT INTO reglement values('','$reste','NON','OUI','$date','$codefact','$agence')";
            if($inser=$connec->exec($in)){
                 // inserer la suppression des les operations
                 $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','facture','Enregistrement d'une dette','code facture :".$codefact.", reste a versé:".$reste."','$agence')";
                 if($ins = $connec -> exec($in)){} 
            }
        }
       }else if($nbre>=1){}
    }
}

?>