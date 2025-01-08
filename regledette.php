<?php
require('connect.php');
$code=$_GET['code'];


// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

if($code==''){
    echo 'Veillez saissir le numéro de facture';
}else{ 
$se="SELECT *,count(id_reg) as nbre FROM reglement where code='$code' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $nbre=$sele['nbre'];
        if($nbre<1){echo 'Aucune facture trouvé';}
        else if($nbre>=1){
            $regle=$sele['regle'];
            $dette=$sele['dette'];
            if($dette=='OUI' && $regle=='NON'){
                  echo '<table id="tabaffichclient"><tr><th class="thaffichcompt">Numéro de facture</th><th class="thaffichcompt">Montant de la dette</th><th class="thaffichcompt">Date enregistrer</th></tr>';
    
                  ?>
        <tr><td><?php echo $sele['code'] ?></td><td><?php echo $sele['restAverse'] ?></td><td><?php echo $sele['date_regle'] ?></td></tr>
                  <?php
                  echo '</table>';
              }else if($dette=='NON' && $regle=='OUI'){
                  echo 'cette facture a été réglé';
              }else if($dette=='OUI' && $regle=='OUI'){
                  echo 'cette dette a été réglé';
              }
          }
      }
  }
}
?>