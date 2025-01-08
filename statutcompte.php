<?php
require('connect.php');
$id=$_GET['statut'];
$cookie=$_GET['cookie'];
$typcompte='';
$datetime = date('Y/m/d h:i:s');
$re="SELECT * FROM comptes where login_user='$cookie'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        $typcompte=$reqe['typecompte'];
        $nom=$reqe['nom_user'];
    }
}else{
    echo 'Problème de connexion';
}

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

if($typcompte=='admin'){
    $qw="SELECT * FROM comptes where id_compte='$id'";
    if($er=$connec->query($qw)){
        while($fer=$er->fetch()){
            $statut=$fer['statut'];
            $userdesact=$fer['nom_user'];
            if($statut=='Activer'){ 
                $mof="UPDATE comptes set statut='Desactiver' where id_compte='$id'";
                if($mofi=$connec->query($mof)){
                    echo 'oui';
                     // inserer la suppression des les operations
                    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Utilisateur','Désactivation','utilisateur desactivé : ".$userdesact."','$agence')";
                    if($ins = $connec -> exec($in)){}
                }
            }else if($statut=='Desactiver'){
                $mo="UPDATE comptes set statut='Activer' where id_compte='$id'";
                if($mod=$connec->query($mo)){
                    echo 'oui';
                    // inserer la suppression des les operations
                    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Utilisateur','Activation','utilisateur activé : ".$userdesact."','$agence')";
                    if($ins = $connec -> exec($in)){}
                }  
            }
        }
    }

}else if($typcompte=='simple'){
    echo 'non';
}
?>