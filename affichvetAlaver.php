<?php
require('connect.php');
$pressing = $_GET['pressing'];

if($pressing == 'all')
{
  echo '<h2>Tous les pressings</h2>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
          <h2> Pressing : <?php echo $agence?></h2>
          <?php
      }
  }
}

  if($pressing == 'all')
  {
    $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client)as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet WHERE NOT EXISTS(SELECT * FROM dispovetement WHERE depotvetement.code=dispovetement.code AND depotvetement.id_client=dispovetement.id_client AND depotvetement.id_typevet=dispovetement.id_typevet AND depotvetement.quantite_dep=dispovetement.quantite_dep AND depotvetement.description_dep=dispovetement.description_dep AND depotvetement.montaverse=dispovetement.montaverse AND depotvetement.monttotal=dispovetement.monttotal AND depotvetement.date_depot=dispovetement.date_depot AND depotvetement.date_retrait=dispovetement.date_retrait AND depotvetement.date_entreg=dispovetement.date_entreg) order by depotvetement.code asc";
  }else
  {
    $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client)as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet WHERE NOT EXISTS(SELECT * FROM dispovetement WHERE depotvetement.code=dispovetement.code AND depotvetement.id_client=dispovetement.id_client AND depotvetement.id_typevet=dispovetement.id_typevet AND depotvetement.quantite_dep=dispovetement.quantite_dep AND depotvetement.description_dep=dispovetement.description_dep AND depotvetement.montaverse=dispovetement.montaverse AND depotvetement.monttotal=dispovetement.monttotal AND depotvetement.date_depot=dispovetement.date_depot AND depotvetement.date_retrait=dispovetement.date_retrait AND depotvetement.date_entreg=dispovetement.date_entreg) AND depotvetement.agence='$pressing' order by depotvetement.code asc";
  }

  if($nb = $connec -> query($ni)){
      while($nbr = $nb -> fetch()){
          echo '<br/><div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px">
          '.$nbr['nbrel'].' vêtement(s) à nettoyer.
    </div>';
      }
  }
  echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin-top:0%;border-collapse:collapse;width:100%" border="1">
  <thead class="table-primary">
    <tr><th>N°</th><th>N° facture</th><th>Nom du client</th><th>Type de vêtement</th><th>Quantité</th><th>Description</th><th>Date dépot</th><th>Date retrait</th></tr>
    </thead>';
    $n=1;

  if($pressing == 'all')
  {
    $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet WHERE NOT EXISTS(SELECT * FROM dispovetement WHERE depotvetement.code=dispovetement.code AND depotvetement.id_client=dispovetement.id_client AND depotvetement.id_typevet=dispovetement.id_typevet AND depotvetement.quantite_dep=dispovetement.quantite_dep AND depotvetement.description_dep=dispovetement.description_dep AND depotvetement.montaverse=dispovetement.montaverse AND depotvetement.monttotal=dispovetement.monttotal AND depotvetement.date_depot=dispovetement.date_depot AND depotvetement.date_retrait=dispovetement.date_retrait AND depotvetement.date_entreg=dispovetement.date_entreg) order by depotvetement.code asc";
  }else
  {
    $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet WHERE NOT EXISTS(SELECT * FROM dispovetement WHERE depotvetement.code=dispovetement.code AND depotvetement.id_client=dispovetement.id_client AND depotvetement.id_typevet=dispovetement.id_typevet AND depotvetement.quantite_dep=dispovetement.quantite_dep AND depotvetement.description_dep=dispovetement.description_dep AND depotvetement.montaverse=dispovetement.montaverse AND depotvetement.monttotal=dispovetement.monttotal AND depotvetement.date_depot=dispovetement.date_depot AND depotvetement.date_retrait=dispovetement.date_retrait AND depotvetement.date_entreg=dispovetement.date_entreg) AND depotvetement.agence='$pressing' order by depotvetement.code asc";
  }

  if($sel=$connec->query($se)){
      while($sele=$sel->fetch()){
          ?>
  <tr><td><?php echo $n;?></td><td><?php echo $sele['code'] ?></td><td ><?php echo $sele['nom_cl'] ?></td><td ><?php echo $sele['nom_vet'] ?></td><td ><?php echo $sele['quantite_dep'] ?></td><td ><?php echo $sele['description_dep'] ?></td><td ><?php echo $sele['date_depot'] ?></td><td ><?php echo $sele['date_retrait'] ?></td></tr>
  <?php
  $n++;
      }
  }

    echo '</table><br/>';
 
?>