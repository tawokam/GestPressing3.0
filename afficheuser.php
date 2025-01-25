<?php

 require('connect.php');
 $agence = $_GET['agence'];
 ?>
 <button type="button" style="margin-bottom:1% ;" class="btn btn-success" onclick="affichAllPaieEmploye()">
    <i class="bi bi-steam"></i> Fiche de paie du personnel
</button>&nbsp;&nbsp;
<button type="button" style="margin-bottom:1% ;" class="btn btn-primary" onclick="creercompte(),btnClick()"><i class="bi bi-plus"></i> Ajouter un compte</button>
  <?php 
 $ne="SELECT *,count(id_compte) as nbrec FROM comptes ";
 if($nb=$connec->query($ne)){
     while($nbre=$nb->fetch()){
        echo '<div class="alert alert-secondary bg-secondary text-light" style="font-size:13px;width:95%;margin:0 auto;text-align:left" role="alert">
        '.$nbre['nbrec'].' utilisateurs enregistrés. cliquer sur le nom d\'un employé pour avoir accès a ses informations et enregistrer ses paiements
        </div><br/>';
     }
     echo '</table>';
 }
 echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:95%">
<thead class="table-primary">
 <tr><th>N°</th><th> Nom complèt</th><th>Téléphone</th><th>Née le</th><th>N° CNI</th><th>Diplome</th><th>Nationalité</th><th>Login</th><th>Type de compte</th><th>Pressing</th><th>Statut</th><th colspan="2"> Action</th></tr>
 </thead>';
 $n = 1;

    $re="SELECT * FROM comptes";


 if($req=$connec->query($re)){
     while($reqe=$req->fetch()){
        $idagence = $reqe['agence'];
        
        $r = "SELECT nom FROM agence WHERE id_agence='$idagence'";
        if($re = $connec -> query($r)){
            while ($rel = $re -> fetch()) {
                $nomagence = $rel['nom'];
            }
        }
         ?>
         <tr><td><?php echo $n?></td><td style="cursor:pointer" onclick="affichblockGestpersonnel('<?php echo $reqe['id_compte']?>')"><?php echo $reqe['nom_user']?></td><td ><?php echo $reqe['telephone_user']?></td><td ><?php echo $reqe['datenaiss']?></td><td ><?php echo $reqe['CNI']?></td><td ><?php echo $reqe['diplome']?></td><td ><?php echo $reqe['nationalite']?></td><td ><?php echo $reqe['login_user']?></td><td ><?php echo $reqe['typecompte']?></td><td ><?php echo $nomagence?></td><td style="cursor: pointer;"  id="<?php echo $reqe['id_compte']?>" onclick="statutcompt(this.id)"><?php $st = $reqe['statut'];if($st == 'desactiver'){echo '<i class="bi bi-file-lock2 text-danger"></i> ';}else{echo '<i class="bi bi-file-person text-success"></i> ';} ?><?php echo $reqe['statut']?></td><td style='cursor:pointer'><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td style="cursor:pointer" id="<?php echo $reqe['id_compte']?>" onclick="xy=confirm('Veuillez confimer la suppression du compte de <?php echo $reqe['nom_user'] ?> en cliquant sur le bouton OK');if(xy){suppcompteuser(this.id)}else{}"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>
         <?php
         $n++;
     }
     echo '</table>';
 }
?>