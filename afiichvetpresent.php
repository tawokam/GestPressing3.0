<?php
require('connect.php');
$datedepotvetstock = $_GET['datedepotvetstock'];
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

$attendu=0;
if($datedepotvetstock == ''){

  if($pressing == 'all')
  {
    $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client)as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet order by depotvetement.code asc";
  }else
  {
    $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client)as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.agence='$pressing' order by depotvetement.code asc";
  }

  if($nb = $connec -> query($ni)){
      while($nbr = $nb -> fetch()){
          echo '<br/><div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px">
          '.$nbr['nbrel'].' vêtement(s) sont présent dans le pressing actuellement
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
    $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet order by depotvetement.code asc";
  }else
  {
    $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet WHERE depotvetement.agence='$pressing' order by depotvetement.code asc";
  }

  if($sel=$connec->query($se)){
      while($sele=$sel->fetch()){
          ?>
  <tr><td><?php echo $n;?></td><td><?php echo $sele['code'] ?></td><td ><?php echo $sele['nom_cl'] ?></td><td ><?php echo $sele['nom_vet'] ?></td><td ><?php echo $sele['quantite_dep'] ?></td><td ><?php echo $sele['description_dep'] ?></td><td ><?php echo $sele['date_depot'] ?></td><td ><?php echo $sele['date_retrait'] ?></td></tr>
  <?php
  $n++;
      }
  }

  if($pressing == 'all')
  {
    $mo="SELECT *,sum(reste) AS rest FROM facture ";
  }else
  {
    $mo="SELECT *,sum(reste) AS rest FROM facture WHERE agence='$pressing' ";
  }

    if($mon=$connec->query($mo)){
        while($mont=$mon->fetch()){
          $attendu=$attendu+$mont['rest'];
        }
    }
    echo '</table><br/>';
}
else if($datedepotvetstock != ''){

  if($pressing == 'all')
  {
    echo "<div style='font-size:28px;color:gray;text-align:center'></div>";
    $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client) as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_depot >= '$datedepotvetstock' order by depotvetement.code asc";
  }else
  {
    echo "<div style='font-size:28px;color:gray;text-align:center'></div>";
    $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client) as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_depot >= '$datedepotvetstock' AND depotvetement.agence='$pressing' order by depotvetement.code asc";
  }
    
    if($nb = $connec -> query($ni)){
        while($nbr = $nb -> fetch()){
            echo '<br/><div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px">
            '.$nbr['nbrel'].' Vêtement(s) déposé(s) après et le '.$datedepotvetstock.' et présent en stock
       </div>';
        }
    }
    echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin-top:0%;border-collapse:collapse;width:100%" border="1">
    <thead class="table-primary">
      <tr><th>N°</th><th>N° facture</th><th>Nom du client</th><th>Type de vêtement</th><th>Quantité</th><th>Description</th><th>Date dépot</th><th>Date retrait</th></tr>
      </thead>';
      $n = 1;

      if($pressing == 'all')
      {
        $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_depot >= '$datedepotvetstock' order by depotvetement.code asc";
      }else
      {
        $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_depot >= '$datedepotvetstock' AND depotvetement.agence='$pressing' order by depotvetement.code asc";
      }

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        ?>
<tr><td><?php echo $n;?></td><td ><?php echo $sele['code'] ?></td><td ><?php echo $sele['nom_cl'] ?></td><td ><?php echo $sele['nom_vet'] ?></td><td ><?php echo $sele['quantite_dep'] ?></td><td ><?php echo $sele['description_dep'] ?></td><td ><?php echo $sele['date_depot'] ?></td><td ><?php echo $sele['date_retrait'] ?></td></tr>
<?php
$n++;
    }
}
if($pressing == 'all')
{
  $mo="SELECT *,sum(reste) AS rest FROM facture where date_depot >= '$datedepotvetstock'";
  if($mon=$connec->query($mo)){
      while($mont=$mon->fetch()){
         $attendu=$attendu+$mont['rest'];
      }
  }
}else
{
  $mo="SELECT *,sum(reste) AS rest FROM facture where date_depot >= '$datedepotvetstock' AND agence='$pressing'";
  if($mon=$connec->query($mo)){
      while($mont=$mon->fetch()){
         $attendu=$attendu+$mont['rest'];
      }
  }
}

  echo '</table><br/>';
}
  echo '<div style="color:blue;font-size:20px;font-weight:bold">Montant attendu pour les dettes et factures non réglé '.$attendu.' Fcfa</div>';

?>