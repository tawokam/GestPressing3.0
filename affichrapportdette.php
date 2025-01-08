<?php
require('connect.php');
$debu=$_GET['ddebudet'];
$fin=$_GET['dfindet'];
$pressing=$_GET['pressing'];
$totaux=0;

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des dettes non réglés de tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des dettes non réglés du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}
echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Nom du client</th><th style="text-align:center;border:1px solid black">Montant de la dette</th><th style="text-align:center;border:1px solid black">Date enregistrer</th><th style="text-align:center;border:1px solid black">Facture numéro</th></tr>';
if($debu=='' || $fin==''){

  if($pressing == 'all'){
    $se="SELECT reglement.restAverse,reglement.regle,reglement.dette,reglement.date_regle,reglement.code,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client";
}else{
  $se="SELECT reglement.restAverse,reglement.regle,reglement.dette,reglement.date_regle,reglement.code,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client WHERE facture.agence='$pressing'";
}
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $veri=$sele['dette'];$reg=$sele['regle'];
        if($veri=='OUI' && $reg=='NON'){
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$sele['restAverse'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_regle'].'</td><td style="text-align:center;border:1px solid black">'.$sele['code'].'</td></tr>';
             
        }
    }
}
       //requete d'affichage des totaux des dettes encour...
       if($pressing == 'all'){
        $to="SELECT *,sum(restAverse) as totaux FROM reglement where dette='OUI' AND regle='NON'";
    }else{
      $to="SELECT *,sum(restAverse) as totaux FROM reglement where dette='OUI' AND regle='NON' AND agence='$pressing'";
    }
       
       if($tot=$connec->query($to)){
         while($tota=$tot->fetch()){
           $totaux=$tota['totaux'];
         }
       }
 }else if($debu!='' && $fin!=''){
  echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';

  if($pressing == 'all'){
    $se="SELECT reglement.restAverse,reglement.regle,reglement.dette,reglement.date_regle,reglement.code,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client where date_regle between '$debu' AND '$fin' ";
}else{
  $se="SELECT reglement.restAverse,reglement.regle,reglement.dette,reglement.date_regle,reglement.code,facture.code,facture.id_client,client.id_client,client.nom_cl FROM facture inner join reglement on facture.code=reglement.code inner join client on facture.id_client=client.id_client where date_regle between '$debu' AND '$fin' AND reglement.agence='$pressing'";
}

    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $veri=$sele['dette'];$reg=$sele['regle'];
            if($veri=='OUI' && $reg=='NON'){
                echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$sele['restAverse'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_regle'].'</td><td style="text-align:center;border:1px solid black">'.$sele['code'].'</td></tr>';
                 
            }
        }
    }
           //requete d'affichage des totaux des dettes encour...

           if($pressing == 'all'){
            $to="SELECT *,sum(restAverse) as totaux FROM reglement where dette='OUI' AND regle='NON' AND date_regle between '$debu' AND '$fin'";
        }else{
          $to="SELECT *,sum(restAverse) as totaux FROM reglement where dette='OUI' AND regle='NON' AND date_regle between '$debu' AND '$fin' AND agencer='$pressing'";
        }
         
           if($tot=$connec->query($to)){
             while($tota=$tot->fetch()){
               $totaux=$tota['totaux'];
             }
           }
 }
 echo '</table>';
echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">Somme des dettes:'.$totaux.' Fcfa </div>';

?>