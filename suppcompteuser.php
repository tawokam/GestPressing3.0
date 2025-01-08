<?php
require('connect.php');
$ident=$_GET['ident'];
$cookie=$_GET['cookie'];
$datetime = date('Y/m/d h:i:s');

$se="SELECT * FROM comptes where id_compte='$ident'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $userSupp = $sele['nom_user'];
    }
}

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
$se="SELECT * FROM comptes where login_user='$cookie'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $statut=$sele['typecompte'];
        $nom=$sele['nom_user'];
        if($statut=='admin'){
            $de="DELETE FROM comptes where id_compte='$ident'";
            if($del=$connec->query($de))
            {
                // inserer la suppression des les operations
                $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Utilisateur','Suppression','utilisateur supprimé : '.$userSupp.'','$agence')";
                if($ins = $connec -> exec($in)){}
            }
        }else if($statut=='simple'){
            echo 'non';
        }
    }
}
?>