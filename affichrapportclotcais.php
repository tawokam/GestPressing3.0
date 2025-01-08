<?php
require('connect.php');
$debu=$_GET['ddebuclotc'];
$fin=$_GET['dfinclotc'];
$pressing=$_GET['pressing'];

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des clotures de caisse dans tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des clotures de caisse du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}

echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Somme des emtrées</th><th style="text-align:center;border:1px solid black">Somme des depenses</th><th style="text-align:center;border:1px solid black">Montant net</th><th style="text-align:center;border:1px solid black">Montant réel en caisse</th><th style="text-align:center;border:1px solid black">Diference</th><th style="text-align:center;border:1px solid black">Observation</th><th style="text-align:center;border:1px solid black">Caisse cloture par:</th><th style="text-align:center;border:1px solid black">Caisse cloture le:</th></tr>';
$somnet=0;$somrel=0;$sompert=0;
if($debu=='' || $fin==''){
if($pressing == 'all'){
    $se="SELECT * FROM cloturecaisse";
}else{
    $se="SELECT * FROM cloturecaisse WHERE agence='$pressing'";
}
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['somentre'].'</td><td style="text-align:center;border:1px solid black">'.$sele['somdep'].'</td><td style="text-align:center;border:1px solid black">'.$sele['monnet'].'</td><td style="text-align:center;border:1px solid black">'.$sele['monreel'].'</td><td style="text-align:center;border:1px solid black">'.$sele['manque'].'</td><td style="text-align:center;border:1px solid black">'.$sele['observation'].'</td><td style="text-align:center;border:1px solid black">'.$sele['utilisateur'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_clot'].'</td></tr>';

    }
}
if($pressing == 'all'){
    $so="SELECT *,sum(monnet) as somnet,sum(monreel) as somrel,sum(manque) as perte FROM cloturecaisse";
}else{
    $so="SELECT *,sum(monnet) as somnet,sum(monreel) as somrel,sum(manque) as perte FROM cloturecaisse WHERE agence='$pressing'";
}

if($sos=$connec->query($so)){
    while($soc=$sos->fetch()){
        $somnet=$soc['somnet'];$somrel=$soc['somrel'];$sompert=$soc['perte'];
    }
}
}else if($debu!='' && $fin!=''){
    echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';
    if($pressing == 'all'){
        $se="SELECT * FROM cloturecaisse where date_clot between '$debu' AND '$fin'";
    }else{
        $se="SELECT * FROM cloturecaisse where date_clot between '$debu' AND '$fin' AND agence='$pressing'";
    }
   
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['somentre'].'</td><td style="text-align:center;border:1px solid black">'.$sele['somdep'].'</td><td style="text-align:center;border:1px solid black">'.$sele['monnet'].'</td><td style="text-align:center;border:1px solid black">'.$sele['monreel'].'</td><td style="text-align:center;border:1px solid black">'.$sele['manque'].'</td><td style="text-align:center;border:1px solid black">'.$sele['observation'].'</td><td style="text-align:center;border:1px solid black">'.$sele['utilisateur'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_clot'].'</td></tr>';

    }
}
if($pressing == 'all'){
    $so="SELECT *,sum(monnet) as somnet,sum(monreel) as somrel,sum(manque) as perte FROM cloturecaisse where date_clot between '$debu' AND '$fin'";
}else{
    $so="SELECT *,sum(monnet) as somnet,sum(monreel) as somrel,sum(manque) as perte FROM cloturecaisse where date_clot between '$debu' AND '$fin' AND agence='$pressing'";
}

if($sos=$connec->query($so)){
    while($soc=$sos->fetch()){
        $somnet=$soc['somnet'];$somrel=$soc['somrel'];$sompert=$soc['perte'];
    }
}
}
echo '</table>';
echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">MONTANT NET:'.$somnet.' Fcfa <br> MONTANT EN CAISSE:'.$somrel.' Fcfa<br> DIFFERENCE:'.$sompert.' Fcfa</div>';

?>