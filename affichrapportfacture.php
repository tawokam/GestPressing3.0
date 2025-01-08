<?php
require('connect.php');
$debu=$_GET['ddebufact'];
$fin=$_GET['dfinfact'];
$pressing=$_GET['pressing'];
$totaux=0;
$avance=0;
$reste=0;

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des factures de tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des factures du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}
echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Nom du client</th><th style="text-align:center;border:1px solid black">Montant facture</th><th style="text-align:center;border:1px solid black">Avance</th><th style="text-align:center;border:1px solid black">Reste</th><th style="text-align:center;border:1px solid black">Date dépot</th><th style="text-align:center;border:1px solid black">Numéro facture</th></tr>';

if($debu=='' || $fin==''){

  if($pressing == 'all'){
    $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.date_depot,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join client on facture.id_client=client.id_client";
}else{
  $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.date_depot,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join client on facture.id_client=client.id_client WHERE facture.agence='$pressing'";
}

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$sele['monttotal'].'</td><td style="text-align:center;border:1px solid black">'.$sele['avance'].'</td><td style="text-align:center;border:1px solid black">'.$sele['reste'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_depot'].'</td><td style="text-align:center;border:1px solid black">'.$sele['code'].'</td></tr>';

    }
}
       //requete d'affichage des totaux des facture,des avance et des reste a payer
    if($pressing == 'all'){
        $to="SELECT *,sum(monttotal) as totaux,sum(avance) as avances,sum(reste) as restes FROM facture";
    }else{
      $to="SELECT *,sum(monttotal) as totaux,sum(avance) as avances,sum(reste) as restes FROM facture WHERE agence='$pressing'";
    }
       
       if($tot=$connec->query($to)){
         while($tota=$tot->fetch()){
           $totaux=$tota['totaux'];
           $avance=$tota['avances'];
           $reste=$tota['restes'];
         }
       }
}else if($debu!='' && $fin!=''){
  echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';

  if($pressing == 'all'){
    $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.date_depot,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join client on facture.id_client=client.id_client where date_depot between '$debu' AND '$fin'";
  }else{
    $se="SELECT facture.monttotal,facture.avance,facture.reste,facture.date_depot,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join client on facture.id_client=client.id_client where date_depot between '$debu' AND '$fin' AND facture.agence='$pressing'";
  }
    
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$sele['monttotal'].'</td><td style="text-align:center;border:1px solid black">'.$sele['avance'].'</td><td style="text-align:center;border:1px solid black">'.$sele['reste'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_depot'].'</td><td style="text-align:center;border:1px solid black">'.$sele['code'].'</td></tr>';

    }
}
       //requete d'affichage des totaux des facture,des avance et des reste a payer

    if($pressing == 'all'){
      $to="SELECT *,sum(monttotal) as totaux,sum(avance) as avances,sum(reste) as restes FROM facture where date_depot between '$debu' AND '$fin'";
    }else{
      $to="SELECT *,sum(monttotal) as totaux,sum(avance) as avances,sum(reste) as restes FROM facture where date_depot between '$debu' AND '$fin' AND agence='$pressing'";
    }
     
       if($tot=$connec->query($to)){
         while($tota=$tot->fetch()){
           $totaux=$tota['totaux'];
           $avance=$tota['avances'];
           $reste=$tota['restes'];
         }
       }

}
echo '</table>';
echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">Montant total:'.$totaux.' Fcfa &nbsp;&nbsp; Avance:'.$avance.' Fcfa &nbsp;&nbsp; Reste:'.$reste.' Fcfa</div>';

?>