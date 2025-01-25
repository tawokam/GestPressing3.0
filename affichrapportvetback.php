<?php
require('connect.php');
$debu     = $_GET['ddebu'];
$fin      = $_GET['dfin'];
$pressing = $_GET['pressing'];
$count    = 0;

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des vetements retournés dans tous les pressings </div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des vetements retournés au pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}
 

echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">N° facture</th><th style="text-align:center;border:1px solid black;">Nom du client</th><th style="text-align:center;border:1px solid black">Type de vetement</th><th style="text-align:center;border:1px solid black">motif du retour</th><th style="text-align:center;border:1px solid black">Quantité</th><th style="text-align:center;border:1px solid black">Date retour</tr>';
if($debu=='' || $fin==''){
  
  if($pressing == 'all'){
      $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,backvetement.motif,backvetement.quantite,backvetement.date_enreg,backvetement.facture FROM backvetement inner join typevetement on backvetement.id_typevet=typevetement.id_typevet inner join client on backvetement.id_client=client.id_client";
  }else{
    $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,backvetement.motif,backvetement.quantite,backvetement.date_enreg,backvetement.facture FROM backvetement inner join typevetement on backvetement.id_typevet=typevetement.id_typevet inner join client on backvetement.id_client=client.id_client WHERE backvetement.agence='$pressing'";
  }

  if($str=$connec->query($st)){
    $count = $str -> rowCount();
      while($stri=$str->fetch()){
      echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$stri['facture'].'</td><td style="text-align:center;border:1px solid black">'.$stri['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$stri['nom_vet'].'</td><td style="text-align:center;border:1px solid black">'.$stri['motif'].'</td><td style="text-align:center;border:1px solid black">'.$stri['quantite'].'</td><td style="text-align:center;border:1px solid black">'.$stri['date_enreg'].'</td></tr>';
      }
     
  }

}else if($debu!='' && $fin!=''){
  echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';
  if($pressing == 'all'){
    $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,backvetement.motif,backvetement.quantite,backvetement.date_enreg,backvetement.facture FROM backvetement inner join typevetement on backvetement.id_typevet=typevetement.id_typevet inner join client on backvetement.id_client=client.id_client WHERE backvetement.date_enreg between '$debu' AND '$fin'";
}else{
  $st="SELECT client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet,backvetement.motif,backvetement.quantite,backvetement.date_enreg,backvetement.facture FROM backvetement inner join typevetement on backvetement.id_typevet=typevetement.id_typevet inner join client on backvetement.id_client=client.id_client WHERE backvetement.agence='$pressing' AND backvetement.date_enreg between '$debu' AND '$fin'";
}

if($str=$connec->query($st)){
    $count = $str -> rowCount();
    while($stri=$str->fetch()){
    echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$stri['facture'].'</td><td style="text-align:center;border:1px solid black">'.$stri['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$stri['nom_vet'].'</td><td style="text-align:center;border:1px solid black">'.$stri['motif'].'</td><td style="text-align:center;border:1px solid black">'.$stri['quantite'].'</td><td style="text-align:center;border:1px solid black">'.$stri['date_enreg'].'</td></tr>';
    }
   
}

}
echo '</table>';

echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">'.$count.' vetement(s) retourné(s)</div>';
?>