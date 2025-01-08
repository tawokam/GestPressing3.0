<?php
require('connect.php');
$newnom = $_POST['newnom'];
$newphone = $_POST['newphone'];
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

if($newnom==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le nom du client
</div>';
}else if($newphone==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le numéro de téléphone du client
</div>';
}else if(strlen($newphone)<=8 || strlen($newphone)>9){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Le numéro de téléphone n\'est pas correct
</div>';
    
}else if($newphone[0]!=6){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Le muméro de téléphone doit commancé par 6
</div>';
}
else{ 
$up = "UPDATE client SET nom_cl='$newnom', telephone_cl='$newphone' WHERE id_client='$ident'";
if($upd=$connec->query($up)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectuer
</div>';
$in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Client','Modification','nom:".$newnom.", téléphone:".$newphone."','$agence')";
if($ins = $connec -> exec($in)){} 
}
}