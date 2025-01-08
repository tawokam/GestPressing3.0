<?php
require('connect.php');

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$codefact=$_GET['codefact'];
if($codefact==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    veuillez entrer le numéro de facture 
</div>';
}else{ 
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;width:100%">
<thead class="table-primary">
 <tr><th>Nom</th><th>Montant</th><th>Quantité</th><th>Montant Total</th><th> dépot</th><th>Retrait</th><th> Action</th></tr>
 </thead>';
$re="SELECT depotvetement.id_typevet,depotvetement.montaverse,depotvetement.quantite_dep,depotvetement.monttotal,depotvetement.date_depot,depotvetement.date_retrait,typevetement.id_typevet,typevetement.nom_vet,depotvetement.id_depot FROM depotvetement inner join typevetement ON depotvetement.id_typevet=typevetement.id_typevet where depotvetement.code='$codefact' AND depotvetement.agence='$agence'";
  if($req=$connec->query($re)){
      while($reqe=$req->fetch()){
          ?>
<tr><td ><?php echo $reqe['nom_vet']?></td><td ><?php echo $reqe['montaverse']?></td><td ><?php echo $reqe['quantite_dep']?></td><td ><?php echo $reqe['monttotal']?></td><td ><?php echo $reqe['date_depot']?></td><td><?php echo $reqe['date_retrait']?></td><td id='<?php echo $reqe['id_depot']?>' onclick="sortivet(this.id)" style="cursor:pointer"><i class="bi bi-hand-index-fill text-primary"></i> Sortie</td></tr>
          <?php
      }
  }
}
echo '</table>';
?>