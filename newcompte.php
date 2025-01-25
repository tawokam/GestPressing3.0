<?php
require('connect.php');
 $nom=htmlspecialchars($_POST['nomuser']);
 $telephone=htmlspecialchars($_POST['telephoneuser']);
 $login=htmlspecialchars($_POST['login']);
 $mdp=htmlspecialchars(md5($_POST['mdpuser']));
 $cookie=htmlspecialchars($_POST['cookie']);
 $typenewuser = htmlspecialchars($_POST['typenewuser']);
 $datecreer = date('Y/m/d');
 $datenaissuser=htmlspecialchars($_POST['datenaissuser']);
 $CNIuser=htmlspecialchars($_POST['CNIuser']);
 $pereuser=htmlspecialchars($_POST['pereuser']);
 $mereuser=htmlspecialchars($_POST['mereuser']);
 $diplomeuser=htmlspecialchars($_POST['diplomeuser']);
 $nationaliteuser = htmlspecialchars($_POST['nationaliteuser']);
 $typeContrat=htmlspecialchars($_POST['typeContrat']);
 $daterecrute=htmlspecialchars($_POST['daterecrute']);
 $obligation=htmlspecialchars($_POST['obligation']);
 $poste = htmlspecialchars($_POST['poste']);
 $salaire = htmlspecialchars($_POST['salaire']);
 $PressingRattacher = htmlspecialchars($_POST['PressingRattacher']);

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


 //verification des données entrée
 if($nom==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Veuillez entrez votre nom complèt
</div>';
 }else if($telephone==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Veuillez entrer votre numéro de téléphone
</div>';
 }else if(strlen($telephone)<=8 || strlen($telephone)>9){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Le numéro de téléphone doit compté 9 caractères
</div>';
}else if($telephone[0]!=6){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Le numéro de téléphone doit commencé par 6
</div>';
}
 else if($login==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Veuillez entrez votre login
 </div>';
 }else if($typenewuser == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez selectionnez le type de compte
</div>';
 }else if($agence == 0){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    aucun pressing activé. Veuillez activer un pressing
</div>';
 }else if($typeContrat == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez sélectionner le type de contrat (CDI ou CDD)
</div>';
 
 }else if($poste == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez definir le poste de l\'employé
</div>';
 }
 else{ 
 $re="SELECT *,count(id_compte) as nbre FROM comptes where login_user='$login'";
 if($req=$connec->query($re)){
     while($reqe=$req->fetch()){
         $nbre=$reqe['nbre'];
         if($nbre>=1){
             echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
             Ce login a déja été utilisé pour créer un compte
         </div>';
         }else if($nbre<1){
             $ch="SELECT * FROM comptes where login_user='$cookie'";
             if($cher=$connec->query($ch)){
                 while($chere=$cher->fetch()){
                     $typ=$chere['typecompte'];
                     if($typ==='admin'){
                         $in="INSERT INTO comptes values('','$nom','$telephone','$login','$mdp','$typenewuser','activer','$datecreer','$PressingRattacher','$datenaissuser','$CNIuser','$pereuser','$mereuser','$diplomeuser','$nationaliteuser','$typeContrat','$daterecrute','$obligation','$poste','$salaire','')";
                          if($insert=$connec->exec($in)){
                            echo '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau compte enregistré</div>';
                            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Utilisateur','Insertion','nom:".$nom.", date_naissance:".$datenaissuser.", téléphone:".$telephone.", CNI:".$CNIuser.", nom du pere:".$pereuser .", nom de la mere :".$mereuser.", diplome:".$diplomeuser.", nationalite:".$nationaliteuser .", type contrat:".$typeContrat.", date recruté:".$daterecrute.", login:".$login .", mot de passe :*******, type de compte:".$typenewuser.", poste:".$poste.", salaire:".$salaire.", obligation:".$obligation."','$PressingRattacher')";
                            if($ins = $connec -> exec($in)){} 
                        }
                     }else if($typ==='simple'){echo '<div class="alert alert-success" role="alert" style="font-size:12px">Vous n\'etes pas habilité a créer un compte</div>';}
                 }
             }
         }
     }
 }
}
?>