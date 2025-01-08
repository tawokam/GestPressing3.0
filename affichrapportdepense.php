<?php
require('connect.php');
$debu=$_GET['ddebudep'];
$fin=$_GET['dfindep'];
$pressing=$_GET['pressing'];
$totaux=0;

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des dépenses dans tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des dépenses du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}
echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Type de dépense</th><th style="text-align:center;border:1px solid black">Motif de la dépense</th><th style="text-align:center;border:1px solid black">Montant</th><th style="text-align:center;border:1px solid black">Date enregistrer</th></tr>';

if($debu=='' || $fin==''){
  if($pressing == 'all'){
    $se="SELECT depense.id_dep,depense.motif,depense.montant,depense.date_enreg,typedepense.id_dep,typedepense.nom_dep FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep";
}else{
  $se="SELECT depense.id_dep,depense.motif,depense.montant,depense.date_enreg,typedepense.id_dep,typedepense.nom_dep FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep WHERE depense.agence='$pressing'";
}

     if($sel=$connec->query($se)){
         while($sele=$sel->fetch()){
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_dep'].'</td><td style="text-align:center;border:1px solid black">'.$sele['motif'].'</td><td style="text-align:center;border:1px solid black">'.$sele['montant'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_enreg'].'</td></tr>';

         }
     }
       //requete d'affichage des totaux des depenses
if($pressing == 'all'){
  $to="SELECT *,sum(montant) as totaux FROM depense";
}else{
  $to="SELECT *,sum(montant) as totaux FROM depense WHERE agence='$pressing'";
}

if($tot=$connec->query($to)){
  while($tota=$tot->fetch()){
    $totaux=$tota['totaux'];
  }
}
}else if($debu!='' && $fin!=''){
  echo '<div style="text-align:center">DU '.$debu.' Au '.$fin.'</div>';

    if($pressing == 'all'){
      $se="SELECT depense.id_dep,depense.motif,depense.montant,depense.date_enreg,typedepense.id_dep,typedepense.nom_dep FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep where date_enreg between '$debu' AND '$fin' ";
  }else{
    $se="SELECT depense.id_dep,depense.motif,depense.montant,depense.date_enreg,typedepense.id_dep,typedepense.nom_dep FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep where date_enreg between '$debu' AND '$fin' AND depense.agence='$pressing'";
  }

    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
           echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_dep'].'</td><td style="text-align:center;border:1px solid black">'.$sele['motif'].'</td><td style="text-align:center;border:1px solid black">'.$sele['montant'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_enreg'].'</td></tr>';

        }
    }
    if($pressing == 'all'){
      $to="SELECT *,sum(montant) as totaux FROM depense where date_enreg between '$debu' AND '$fin'";
  }else{
    $to="SELECT *,sum(montant) as totaux FROM depense where date_enreg between '$debu' AND '$fin' AND agence='$pressing'";
  }
   
if($tot=$connec->query($to)){
  while($tota=$tot->fetch()){
    $totaux=$tota['totaux'];
  }
}
}
echo '</table>';
echo '<div style="font-size:25px;font-weight:bold;margin-top:2%;color:blue">SOMME DES DEPENSES:'.$totaux.' Fcfa</div>';

?>