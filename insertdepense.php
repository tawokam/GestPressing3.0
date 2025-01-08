<?php
require('connect.php');
$choix=$_POST['choix'];
$motif=$_POST['motif'];
$datedep=$_POST['datedep'];
$cookie=$_POST['cookie'];
$montant=$_POST['montant'];
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
$se = "SELECT nom_dep FROM typedepense WHERE id_dep='$choix'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomdep = $sele['nom_dep'];
    }
}
if($choix==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez selectionnez le type de dépense
</div>';
}else if($motif==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuiilez saisir le motif de la dépense
</div>';
}else if($datedep==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez la date de la dépense
</div>';
}else{
    $in="INSERT INTO depense values('','$choix','$motif','$montant','$datedep','$cookie','$agence')";
    if($inser=$connec->exec($in)){
        echo '<div class="alert alert-success" role="alert" style="font-size:12px">La dépense a été enregistré avec succès</div>';
         // inserer la suppression des les operations
         $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Depense','Insertion','type de depense :".$nomdep.", Motif:".$motif.", Montant:".$montant.", date:".$datedep."','$agence')";
         if($ins = $connec -> exec($in)){}  
    }else{
        echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
        Problème de connexion au serveur
    </div>'; 
    }
}
?>