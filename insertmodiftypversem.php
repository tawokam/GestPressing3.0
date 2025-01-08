<?php
require('connect.php');
$newtypversa = $_POST['newtypversa'];
$ident = $_POST['ident'];
$cookie = $_POST['cookie'];
$datetime = date('Y/m/d h:i:s');

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomuser = $sele['nom_user'];
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

if($newtypversa==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le nom du type de versement
</div>';
}
else{ 
$up = "UPDATE typeverseargent SET nom_versa='$newtypversa' WHERE id_typevera='$ident'";
if($upd=$connec->query($up)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectuée
    </div>';
    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Type versement','Modification','nom:".$newtypversa."','$agence')";
    if($ins = $connec -> exec($in)){} 
}
}

?>