<?php
require('connect.php');
$newnom = $_POST['newnom'];
$newprix = $_POST['newprix'];
$cookie = $_POST['cookie'];
$ident = $_POST['ident'];
$datetime = date('Y/m/d h:i:s');

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nom = $sele['nom_user'];
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

if($newnom==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le nom du type de vêtement
</div>';
}else if($newprix==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le prix de lavage du type de vêtement
</div>';
}
else{ 
$up = "UPDATE typevetement SET nom_vet='$newnom', prix_vet='$newprix' WHERE id_typevet='$ident'";
if($upd=$connec->query($up)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectué
</div>';

 // inserer la suppression des les operations
 $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Type de vetement','Modification','nom:".$newnom.", prix:".$newprix."','$agence')";
 if($ins = $connec -> exec($in)){} 
    
}
}

?>