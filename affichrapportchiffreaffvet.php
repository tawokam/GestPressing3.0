<?php
require('connect.php');
$debu=$_GET['ddebuchvet'];
$fin=$_GET['dfinchvet'];
$pressing=$_GET['pressing'];

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Chiffre d\'affiare par vetement dans tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Chiffre d'affiare par vetement du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}

echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Nom du vetement</th><th style="text-align:center;border:1px solid black">Somme versé(FCFA)</th><th style="text-align:center;border:1px solid black">Somme versé(%)</th></tr>';
$totauxs=0;
if($debu=='' || $fin==''){
    if($pressing == 'all'){
        $st="SELECT *,sum(monttotal) as tots FROM commande";
    }else{
        $st="SELECT *,sum(monttotal) as tots FROM commande WHERE agence='$pressing'";
    }
    if($sto=$connec->query($st)){
        while($stot=$sto->fetch()){
            $totauxs=$stot['tots'];
        }
    }

    if($pressing == 'all'){
        $se="SELECT commande.id_typevet FROM commande group by id_typevet";
    }else{
        $se="SELECT commande.id_typevet FROM commande WHERE agence='$pressing' group by id_typevet";
    }
    
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $ser=$sele['id_typevet'];
            //sommage des totaux des facture d'un client 
            if($pressing == 'all'){
                $so="SELECT typevetement.id_typevet,typevetement.nom_vet,commande.monttotal,commande.id_typevet,sum(commande.monttotal) as totaux from commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where commande.id_typevet='$ser'";
            }else{
                $so="SELECT typevetement.id_typevet,typevetement.nom_vet,commande.monttotal,commande.id_typevet,sum(commande.monttotal) as totaux from commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where commande.id_typevet='$ser' AND commande.agence='$pressing'";
            }
            if($som=$connec->query($so)){
                while($some=$som->fetch()){
                    $tott=$some['totaux'];
                    $pourc=($tott*100)/$totauxs;
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$some['nom_vet'].'</td><td style="text-align:center;border:1px solid black">'.$some['totaux'].'</td><td style="text-align:center;border:1px solid black">'.round($pourc,2).'</td></tr>';

                }
            }
        }
    }
}else if($debu!='' || $fin!=''){
    echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';
    if($pressing == 'all'){
        $st="SELECT *,sum(monttotal) as tots FROM commande where date_enreg_cmd between '$debu' AND '$fin'";
    }else{
        $st="SELECT *,sum(monttotal) as tots FROM commande where date_enreg_cmd between '$debu' AND '$fin' AND agence='$pressing'";
    }
    
    if($sto=$connec->query($st)){
        while($stot=$sto->fetch()){
            $totauxs=$stot['tots'];
        }
    }
    if($pressing == 'all'){
        $se="SELECT commande.id_typevet FROM commande where date_enreg_cmd between '$debu' AND '$fin' group by id_typevet";
    }else{
        $se="SELECT commande.id_typevet FROM commande where date_enreg_cmd between '$debu' AND '$fin' AND agence='$pressing' group by id_typevet";
    }
    
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $ser=$sele['id_typevet'];
            //sommage des totaux des facture d'un client
            if($pressing == 'all'){
                $so="SELECT typevetement.id_typevet,typevetement.nom_vet,commande.monttotal,commande.id_typevet,sum(commande.monttotal) as totaux from commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where commande.id_typevet='$ser' AND date_enreg_cmd between '$debu' AND '$fin'";
            }else{
                $so="SELECT typevetement.id_typevet,typevetement.nom_vet,commande.monttotal,commande.id_typevet,sum(commande.monttotal) as totaux from commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where commande.id_typevet='$ser' AND date_enreg_cmd between '$debu' AND '$fin' AND commande.agence='$pressing'";
            } 

            if($som=$connec->query($so)){
                while($some=$som->fetch()){
                    $tott=$some['totaux'];
                    $pourc=($tott*100)/$totauxs;
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$some['nom_vet'].'</td><td style="text-align:center;border:1px solid black">'.$some['totaux'].'</td><td style="text-align:center;border:1px solid black">'.round($pourc,2).'</td></tr>';

                }
            }
        }
    }
}
echo '</table>';
echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">TOTAUX:'.$totauxs.' Fcfa</div>';

?>