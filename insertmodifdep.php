<?php
require('connect.php');
$newtypdep = $_POST['newtypdep'];
$newmotif = $_POST['newmotif'];
$newmontdep = $_POST['newmontdep'];
$ident = $_POST['ident'];
$cookie = $_POST['cookie'];
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
        $nomuser = $sele['nom_user'];
    }
}

if($newmotif==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le motif de la dépense
</div>';
}else if($newmontdep==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le montant de la dépense
</div>';
}
else{ 
$up = "UPDATE depense SET id_dep='$newtypdep', motif='$newmotif', montant='$newmontdep' WHERE id_depense='$ident' AND agence='$agence'";
if($upd=$connec->query($up)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectué
</div>';
 // inserer la suppression des les operations
 $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Depense','Modification','motif :".$newmotif.", Montant:".$newmontdep."','$agence')";
 if($ins = $connec -> exec($in)){} 
}
}

?>