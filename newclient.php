<?php
require('connect.php');
 $nom=htmlspecialchars($_POST['nomcl']);
 $telephone=htmlspecialchars($_POST['telephonecl']);
 $cookie=htmlspecialchars($_POST['cookie']);
 $dates=date('Y/m/d');
 $datetime = date('Y/m/d h:i:s');

 $se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomuser = $sele['nom_user'];
    }
}


 // récuperation de l'agence en local
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
 //verification des données entrée
 if($nom==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Veuillez entrez le nom du client
</div>';
 }else if($telephone==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Veuillez entrez le numéro de téléphone du client
</div>';
 }else if(strlen($telephone)<=8 || strlen($telephone)>9){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Le numéro de téléphone n\'est pas correct
</div>';
 }else if($telephone[0]!=6){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Le muméro de téléphone doit commancé par 6
</div>';
 }
 else{
 $re="SELECT *,count(id_client) as nbre FROM client where telephone_cl='$telephone'";
 if($req=$connec->query($re)){
     while($reqe=$req->fetch()){
         $nbre=$reqe['nbre'];
         if($nbre>=1){
             echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
             Un client a déja été enregistrer avec ce numéro de téléphone
        </div>';
         }else if($nbre<1){
                         $in="INSERT INTO client values('','$nom','$telephone','$dates','$cookie','$agence')";
                          if($insert=$connec->exec($in)){
                            echo '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau client enregistré</div>';
                            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Client','Insertion','nom:".$nom.", téléphone:".$telephone."','$agence')";
                            if($ins = $connec -> exec($in)){} 
                        }
                 }
             }
         }
     }
?>