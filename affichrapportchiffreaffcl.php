<?php
require('connect.php');
$debu=$_GET['ddebuchcl'];
$fin=$_GET['dfinchcl'];
$pressing=$_GET['pressing'];

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Chiffre d\'affiare par client de tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Chiffre d'affiare par client du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}

echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Nom du client</th><th style="text-align:center;border:1px solid black">Somme versé(FCFA)</th><th style="text-align:center;border:1px solid black">Somme versé(%)</th></tr>';
$totauxs=0;
if($debu=='' || $fin==''){

    if($pressing == 'all'){
        $st="SELECT *,sum(monttotal) as tots FROM facture";
    }else{
        $st="SELECT *,sum(monttotal) as tots FROM facture WHERE agence='$pressing'";
    }
    
    if($sto=$connec->query($st)){
        while($stot=$sto->fetch()){
            $totauxs=$stot['tots'];
        }
    }

    if($pressing == 'all'){
        $se="SELECT * FROM facture group by id_client";
    }else{
        $se="SELECT * FROM facture WHERE agence='$pressing' group by id_client ";
    }
    
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $ser=$sele['id_client'];
            //sommage des totaux des facture d'un client 
            if($pressing == 'all'){
                $so="SELECT client.id_client,client.nom_cl,facture.id_client,facture.monttotal,sum(monttotal) as totaux from facture inner join client on facture.id_client=client.id_client where facture.id_client='$ser' order by totaux desc";
            }else{
                $so="SELECT client.id_client,client.nom_cl,facture.id_client,facture.monttotal,sum(monttotal) as totaux from facture inner join client on facture.id_client=client.id_client where facture.id_client='$ser' AND facture.agence='$pressing' order by totaux desc";
            }

            if($som=$connec->query($so)){
                while($some=$som->fetch()){
                    $tott=$some['totaux'];
                    $pourc=($tott*100)/$totauxs;
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$some['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$some['totaux'].'</td><td style="text-align:center;border:1px solid black">'.round($pourc,2).'</td></tr>';

                }
            }
        }
    }
}else if($debu!='' || $fin!=''){
    echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';
    if($pressing == 'all'){
        $st="SELECT *,sum(monttotal) as tots FROM facture where date_depot between '$debu' AND '$fin'";
    }else{
        $st="SELECT *,sum(monttotal) as tots FROM facture where date_depot between '$debu' AND '$fin' AND agence='$pressing'";
    }
    
    if($sto=$connec->query($st)){
        while($stot=$sto->fetch()){
            $totauxs=$stot['tots'];
        }
    }
    if($pressing == 'all'){
        $se="SELECT * FROM facture where date_depot between '$debu' AND '$fin' group by id_client ";
    }else{
        $se="SELECT * FROM facture where date_depot between '$debu' AND '$fin' AND agence='$pressing' group by id_client ";
    }
    
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $ser=$sele['id_client'];
            //sommage des totaux des facture d'un client 
            if($pressing == 'all'){
                $so="SELECT client.id_client,client.nom_cl,facture.id_client,facture.monttotal,sum(monttotal) as totaux from facture inner join client on facture.id_client=client.id_client where facture.id_client='$ser' AND date_depot between '$debu' AND '$fin' order by totaux desc";
            }else{
                $so="SELECT client.id_client,client.nom_cl,facture.id_client,facture.monttotal,sum(monttotal) as totaux from facture inner join client on facture.id_client=client.id_client where facture.id_client='$ser' AND date_depot between '$debu' AND '$fin' AND facture.agence='$pressing' order by totaux desc";
            }

            if($som=$connec->query($so)){
                while($some=$som->fetch()){
                    $tott=$some['totaux'];
                    $pourc=($tott*100)/$totauxs;
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$some['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$some['totaux'].'</td><td style="text-align:center;border:1px solid black">'.round($pourc,2).'</td></tr>';

                }
            }
        }
    }
}
echo '</table>';
echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">TOTAUX:'.$totauxs.' Fcfa</div>';

?>