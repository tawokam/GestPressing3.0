<?php
require('connect.php');
$debu=$_GET['ddebu'];
$fin=$_GET['dfin'];
$pressing=$_GET['pressing'];
$totaux=0;

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des vetements déposés dans tous les pressings </div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des vetements déposés au pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}
 

echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Nom du client</th><th style="text-align:center;border:1px solid black">Type de vetement</th><th style="text-align:center;border:1px solid black">Description</th><th style="text-align:center;border:1px solid black">PU</th><th style="text-align:center;border:1px solid black">Quantité</th><th style="text-align:center;border:1px solid black">Total</th><th style="text-align:center;border:1px solid black">Date depot</th><th style="text-align:center;border:1px solid black">Date retrait</th></tr>';
if($debu=='' || $fin==''){
  
  if($pressing == 'all'){
      $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,commande.description_cmd,commande.montaverse,commande.quantite_cmd,commande.monttotal,commande.date_depot,commande.date_retrait FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet inner join client on commande.id_client=client.id_client";
  }else{
    $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,commande.description_cmd,commande.montaverse,commande.quantite_cmd,commande.monttotal,commande.date_depot,commande.date_retrait FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet inner join client on commande.id_client=client.id_client WHERE commande.agence='$pressing'";
  }

  if($str=$connec->query($st)){
      while($stri=$str->fetch()){
      echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$stri['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$stri['nom_vet'].'</td><td style="text-align:center;border:1px solid black">'.$stri['description_cmd'].'</td><td style="text-align:center;border:1px solid black">'.$stri['montaverse'].'</td><td style="text-align:center;border:1px solid black">'.$stri['quantite_cmd'].'</td><td style="text-align:center;border:1px solid black">'.$stri['monttotal'].'</td><td style="text-align:center;border:1px solid black">'.$stri['date_depot'].'</td><td style="text-align:center;border:1px solid black">'.$stri['date_retrait'].'</td></tr>';
      }
     
  }
  //requete d'affichage des totaux de depot de vetement
  if($pressing == 'all'){
    $to="SELECT *,sum(monttotal) as totaux FROM commande";
}else{
  $to="SELECT *,sum(monttotal) as totaux FROM commande WHERE agence='$pressing'";
}
if($tot=$connec->query($to)){
  while($tota=$tot->fetch()){
    $totaux=$tota['totaux'];
  }
}
}else if($debu!='' && $fin!=''){
  echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';
  
  if($pressing == 'all'){
    $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,commande.description_cmd,commande.montaverse,commande.quantite_cmd,commande.monttotal,commande.date_depot,commande.date_retrait,commande.date_enreg_cmd FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet inner join client on commande.id_client=client.id_client where date_enreg_cmd between '$debu' AND '$fin'";
}else{
  $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,commande.description_cmd,commande.montaverse,commande.quantite_cmd,commande.monttotal,commande.date_depot,commande.date_retrait,commande.date_enreg_cmd FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet inner join client on commande.id_client=client.id_client where date_enreg_cmd between '$debu' AND '$fin' AND commande.agence='$pressing'";
}

  if($str=$connec->query($st)){
      while($stri=$str->fetch()){
       // $totaux=$stri['totaux'];
      echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$stri['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$stri['nom_vet'].'</td><td style="text-align:center;border:1px solid black">'.$stri['description_cmd'].'</td><td style="text-align:center;border:1px solid black">'.$stri['montaverse'].'</td><td style="text-align:center;border:1px solid black">'.$stri['quantite_cmd'].'</td><td style="text-align:center;border:1px solid black">'.$stri['monttotal'].'</td><td style="text-align:center;border:1px solid black">'.$stri['date_depot'].'</td><td style="text-align:center;border:1px solid black">'.$stri['date_retrait'].'</td></tr>';
      }
  }
  //requete d'affichage des totaux de depot de vetement
  if($pressing == 'all'){
    $to="SELECT *,sum(monttotal) as totaux FROM commande where date_enreg_cmd between '$debu' AND '$fin'";
}else{
  $to="SELECT *,sum(monttotal) as totaux FROM commande where date_enreg_cmd between '$debu' AND '$fin' AND agence='$pressing'";
}

if($tot=$connec->query($to)){
  while($tota=$tot->fetch()){
    $totaux=$tota['totaux'];
  }
}
}
echo '</table>';

echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">Totaux:'.$totaux.' Fcfa</div>';
?>