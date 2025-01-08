<?php
require('connect.php');
$pu       = $_POST['pu'];
$qte      = $_POST['qte'];
$descript = $_POST['descript'];
$datede   = $_POST['datede'];
$datere   = $_POST['datere'];
$ident    = $_POST['ident'];
$cookie   = $_POST['cookie'];
$net      = $pu*$qte;
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
if($pu == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer le prix unitaire
</div>';
}else if($qte == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer la quantite
</div>';
}else if($descript == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer la description du vêtement
</div>';
}else{
$mo="UPDATE commande set montaverse='$pu', quantite_cmd='$qte', description_cmd='$descript', date_depot='$datede', date_retrait='$datere', monttotal='$net' where id_cmd='$ident' AND agence='$agence'";
if($mod=$connec->query($mo)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectué
</div>';
// inserer la suppression des les operations
$in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','depot vetement','Modification','prix unitaire:".$pu.", quantité:".$qte.", description:".$descript.", date depot:".$datede.", date retrait:".$datere .", montant total:".$net."','$agence')";
if($ins = $connec -> exec($in)){} 
}else{echo 'echec';}
}
?>