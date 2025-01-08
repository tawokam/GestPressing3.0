<?php
require('connect.php');
$idcl=$_GET['idcli'];
//affichage du nom du client concerné
$no="SELECT * FROM client where id_client='$idcl'";
if($nom=$connec->query($no)){
    while($nome=$nom->fetch()){
        echo '<h5 class="card-title">Factures de Mr/Mme '.$nome['nom_cl'].' </h5>';
    }
}
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin-top:0%;width:100%;border-collapse:collapse" border=1>
<thead class="table-primary">
  <tr><th>N°</th><th>Total facture</th><th>Avance</th><th>Reste</th><th>Numéro facture</th><th>Date dépot</th><th>Détails facture</th><th>Action</th></tr>
  </thead>';
$n = 1;
$su="SELECT * FROM facture where id_client='$idcl'";
if($sup=$connec->query($su)){
    while($supp=$sup->fetch()){
      
        echo '<tr><td>'.$n.'</td><td>'.$supp['monttotal'].'</td><td>'.$supp['avance'].'</td><td>'.$supp['reste'].'</td><td>'.$supp['code'].'</td><td>'.$supp['date_depot'].'</td><td id="'.$supp['code'].'" onclick="affichfactenreg(this.id,'.$idcl.')" style="cursor:pointer"><i class="bi bi-layout-text-sidebar-reverse text-primary"></i> Détails</td><td style="cursor:pointer" id="'.$supp['code'].'" onclick="xy=confirm(\'Si vous souhaitez réellement effacer la facture Numéro '.$supp['code'].', veuillez cliquez sur le bouton OK. Mais une copie de la facture est conservée pour un control\');if(xy){suppfacture(this.id,'.$idcl.')}else{}"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>';
   $n++;
    }
}
//somme 
echo '</table>';
echo '<table style="width:100%;margin-top:2%;text-align:center">';
$so="SELECT *,sum(monttotal) as total,sum(avance) as avances,sum(reste) as restes FROM facture where id_client='$idcl'";
if($som=$connec->query($so)){
    while($some=$som->fetch()){
  echo '<tr><th class="fact1clt">Totaux: '.$some['total'].'Fcfa</th><th class="fact1clt">Avance: '.$some['avances'].'Fcfa </th><th class="fact1clt">Reste: '.$some['restes'].'Fcfa </th></tr>';
}
}
echo'</table>';
?>