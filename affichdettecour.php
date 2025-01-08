<?php
require('connect.php');
$deb=$_GET['deb'];
$fin=$_GET['fin'];
$pressing=$_GET['pressing'];
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
echo '<div class="alert alert-secondary bg-secondary text-light" role="alert" style="border-radius:0px;font-size:12px">
<i class="bi bi-journal-text text-light"></i> Liste des dettes non réglé
</div>';
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%">
<thead class="table-primary">
 <tr><th>N°</th><th>N° facture</th><th>Nom du client</th><th>Montant total</th><th>Avance</th><th>Reste(dette)</th></tr>
 </thead>';
 $n=1;
if($deb=='' || $fin==''){
    if($pressing == 'all'){
        $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.code,reglement.regle,reglement.dette,facture.id_client,client.id_client,client.nom_cl from facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client where facture.reste!=0";
    }else
    {
        $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.code,reglement.regle,reglement.dette,facture.id_client,client.id_client,client.nom_cl from facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client where facture.reste!=0 AND reglement.agence='$pressing'";
    }

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>
<tr><td><?php echo $n;?></td><td ><?php echo $sele['code'] ?></td><td ><?php echo $sele['nom_cl'] ?></td><td ><?php echo $sele['monttotal'] ?></td><td ><?php echo $sele['avance'] ?></td><td ><?php echo $sele['reste'] ?></td></tr>
<?php
$n++;
    }
}
}else if($deb!='' && $fin!=''){
    if($pressing == 'all'){
        $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.code,reglement.regle,reglement.dette,reglement.date_regle,facture.id_client,client.id_client,client.nom_cl from facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client where facture.reste!=0 AND reglement.date_regle between '$deb' AND '$fin' ";
    }else{
        $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.code,reglement.regle,reglement.dette,reglement.date_regle,facture.id_client,client.id_client,client.nom_cl from facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client where facture.reste!=0 AND reglement.date_regle between '$deb' AND '$fin' AND reglement.agence='$pressing' ";
    }

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>
<tr><td><?php echo $n;?></td><td ><?php echo $sele['code'] ?></td><td ><?php echo $sele['nom_cl'] ?></td><td ><?php echo $sele['monttotal'] ?></td><td ><?php echo $sele['avance'] ?></td><td ><?php echo $sele['reste'] ?></td></tr>
<?php
$n++;
    }
}
}
?>