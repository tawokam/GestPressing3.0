<?php
require('connect.php');
$nom=$_POST['nom'];
$cookie=$_POST['cookie'];
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
if($nom==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez saisir le nom d\'une dépense
</div>';
}else if($nom!=''){
    //selection de la table typedepense pour verifier si le nom de la depense existe deja ou pas
    $se="SELECT *,count(nom_dep) as nbre FROM typedepense where nom_dep='$nom'";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $nbre=$sele['nbre'];
            if($nbre<1){
                $in="INSERT INTO typedepense values('','$nom','$agence')";
                if($ins=$connec->exec($in)){
                    echo '<div class="alert alert-success" role="alert" style="font-size:12px">Type de dépense enregistré</div>';
                     // inserer la suppression des les operations
                     $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Type depense','Insertion','nom :".$nom."','$agence')";
                     if($ins = $connec -> exec($in)){}      
                }
            }else if($nbre>=1){
                echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
                Ce type de dépense a déjà été créé
            </div>';
            }
        }
    }
}
?>