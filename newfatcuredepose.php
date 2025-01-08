<?php
require('connect.php');
$btn=$_GET['btn'];
$typelavage = $_GET['typelavage'];


$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
echo '<table class="table table-secondary table-responsive table-bordered table-striped table-hover" style="font-size:12px;text-align: center;margin:0 auto;width:100%">
<thead class="table-info">
 <tr><th>Nom</th><th>Montant</th><th>quantité</th><th>Description</th><th>date dépot</th><th>date retrait</th><th colspan=2>Action</th></tr>
 </thead>';
if($btn=='debu'){
  $re="SELECT commande.id_typevet,commande.montaverse,commande.quantite_cmd,commande.monttotal,commande.date_depot,commande.date_retrait,typevetement.id_typevet,typevetement.nom_vet,commande.id_cmd,commande.description_cmd FROM commande inner join typevetement ON commande.id_typevet=typevetement.id_typevet where commande.code='0' AND commande.agence='$agence'";
  if($req=$connec->query($re)){
      while($reqe=$req->fetch()){
          ?>
<tr><td ><?php echo $reqe['nom_vet']?></td><td ><?php echo $reqe['montaverse']?></td><td ><?php echo $reqe['quantite_cmd']?></td><td ><?php echo $reqe['description_cmd']?></td><td ><?php echo $reqe['date_depot']?></td><td ><?php echo $reqe['date_retrait']?></td><td  id='<?php echo $reqe['id_cmd']?>' onclick="ouvreformodifvet(),modifvet(this.id)" style="cursor:pointer"> <i class="bi bi-pencil-fill text-warning"></i> </td><td  id='<?php echo $reqe['id_cmd']?>' onclick="xy=confirm('confirmer la suppression <?php echo $reqe['nom_vet']?> en cliquant sur le bouton OK');if(xy){supdepot(this.id,'debu')}else{}" style="cursor:pointer"> <i class="bi bi-trash3-fill text-danger"></i> </td></tr>
          <?php
      }
  }
  //affichage  du montant de la facture lors de la saissie
  $msesi="SELECT *,sum(monttotal) as montant FROM commande where code='0' AND agence='$agence'";
  if($msesis=$connec->query($msesi)){
      while($mne=$msesis->fetch()){
          echo '<div style="text-align:center;font-weight:bold;color:blue;font-size:14px">Montant: '.$mne['montant'].' Fcfa</div>';
      }
  }

}else if($btn=='fin'){

            //selection et modification du code depot
            $ser="SELECT *,max(code) as nfacture FROM commande WHERE agence='$agence'";
            if($serv=$connec->query($ser)){
                while($servi=$serv->fetch()){
                    $nfact=$servi['nfacture']+1;
                    $mo="UPDATE commande set code='$nfact' where code='0' AND agence='$agence'";
                    if($mod=$connec->query($mo)){
                        //insertion des nouvelle ligne enregistrer dans la table depot vetement
                        $ind="SELECT * FROM commande where code='$nfact' AND agence='$agence'";
                        if($inde=$connec->query($ind)){
                            while($indep=$inde->fetch()){
                                $idclient=$indep['id_client'];$idtypvet=$indep['id_typevet'];$qte=$indep['quantite_cmd'];
                                $descript=$indep['description_cmd'];$pu=$indep['montaverse'];$mt=$indep['monttotal'];
                                $datede=$indep['date_depot'];$dateret=$indep['date_retrait'];$user=$indep['utilisateur'];
                                $dateenreg=$indep['date_enreg_cmd'];$code=$indep['code'];
                                $dep="INSERT INTO depotvetement values('','$idclient','$idtypvet','$qte','$descript','$pu','$mt','$datede','$dateret','$user','$dateenreg','$code','$agence')";
                                if($depo=$connec->exec($dep)){}
                            }
                        }                
    $re="SELECT commande.id_typevet,commande.montaverse,commande.description_cmd,commande.quantite_cmd,commande.monttotal,commande.date_depot,commande.date_retrait,typevetement.id_typevet,typevetement.nom_vet,commande.code,commande.id_cmd FROM commande inner join typevetement ON commande.id_typevet=typevetement.id_typevet where commande.code='$nfact' AND commande.agence='$agence'";
    if($req=$connec->query($re)){
        while($reqe=$req->fetch()){
   
            ?>
  <tr><td ><?php echo $reqe['nom_vet']?></td><td ><?php echo $reqe['montaverse']?></td><td ><?php echo $reqe['quantite_cmd']?></td><td><?php echo $reqe['description_cmd']?></td><td ><?php echo $reqe['date_depot']?></td><td ><?php echo $reqe['date_retrait']?></td><td ></td></tr>
            <?php
        }
    }
  }
  //insertion du type de lavage (simple lavage ou lavage express)
  $typl = "INSERT INTO typelavage values('','$nfact','$typelavage','$agence')";
  if($typla = $connec -> exec($typl)){}
}
            }
        }
  echo '</table>';
?>