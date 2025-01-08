<?php
require('connect.php');
$newnom = $_POST['newnom'];
$cookie = $_POST['cookie'];
$ident = $_POST['ident'];
$datetime = date('Y/m/d h:i:s');

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomuser = $sele['nom_user'];
    }
}

$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

if($newnom==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le nom du type de dépense
</div>';
}
else{ 
$up = "UPDATE typedepense SET nom_dep='$newnom' WHERE id_dep='$ident'";
if($upd=$connec->query($up)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectué
</div>';
 // inserer la suppression des les operations
 $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Type depense','Modification','nom :".$newnom."','$agence')";
 if($ins = $connec -> exec($in)){} 

}
}

?>