<?php
require('connect.php');
$ddebu=$_GET['ddebu'];
$dfin=$_GET['dfin'];
$choix=$_GET['choix'];
$pressing=$_GET['pressing'];

if($pressing == 'all')
{
  echo '<br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des versements de tous les pressings</div>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
            <br><br><br><br><br><br><br><div style="font-weight:bold;font-size:20px;text-align:center">Liste des versements du pressing <?php echo $agence ; ?></div>
          <?php
      }
  }
}

$total=0;
echo '<table style="width:90%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black">Type de versement</th><th style="text-align:center;border:1px solid black">Montant du versement</th><th style="text-align:center;border:1px solid black">Date de versement</th><th style="text-align:center;border:1px solid black">Versement validé par:</th></tr>';
if($choix==''){
    if($ddebu=='' || $dfin==''){

    if($pressing == 'all'){
        $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera";
    }else{
        $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera WHERE verseargent.agence='$pressing'";
    }
        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td style="text-align:center;border:1px solid black"><?php echo $sele['nom_versa']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['montant']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['date_vera']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['utilisateur']?></td></tr>
             <?php
            }
        }
        //affichage du total des versement
        if($pressing == 'all'){
            $to="SELECT *,sum(montant) as total FROM verseargent";
        }else{
            $to="SELECT *,sum(montant) as total FROM verseargent WHERE agence='$pressing'";
        }
        
        if($tot=$connec->query($to)){
            while($tota=$tot->fetch()){
                $total=$tota['total'];
            }
        }
    }else if($ddebu!='' && $dfin!=''){
        echo '<div style="text-align:center">DU '.$ddebu.' Au '.$dfin.'</div>';

        if($pressing == 'all'){
            $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' ";
        }else{
            $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' AND verseargent.agence='$pressing'";
        }

        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td style="text-align:center;border:1px solid black"><?php echo $sele['nom_versa']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['montant']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['date_vera']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['utilisateur']?></td></tr>
             <?php
            }
        }
               //affichage du total des versement
            if($pressing == 'all'){
                $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin'";
            }else{
                $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin' AND agence='$pressing'";
            }
              
               if($tot=$connec->query($to)){
                   while($tota=$tot->fetch()){
                       $total=$tota['total'];
                   }
               }
    }
}else if($choix!=''){
    if($ddebu=='' || $dfin==''){
        if($pressing == 'all'){
            $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where verseargent.id_typevera='$choix'";
        }else{
            $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where verseargent.id_typevera='$choix' AND verseargent.agence='$pressing'";
        }

        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td style="text-align:center;border:1px solid black"><?php echo $sele['nom_versa']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['montant']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['date_vera']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['utilisateur']?></td></tr>
             <?php
            }
        }
            //affichage du total des versement

            if($pressing == 'all'){
                $to="SELECT *,sum(montant) as total FROM verseargent where id_typevera='$choix'";
            }else{
                $to="SELECT *,sum(montant) as total FROM verseargent where id_typevera='$choix' AND agence='$pressing'";
            }
            
            if($tot=$connec->query($to)){
                while($tota=$tot->fetch()){
                    $total=$tota['total'];
                }
            }
    }else if($ddebu!='' && $dfin!=''){
        echo '<div style="text-align:center">DU '.$ddebu.' Au '.$dfin.'</div>';

        if($pressing == 'all'){
            $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix' ";
        }else{
            $se="SELECT verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix' AND verseargent.agence='$pressing'";
        }

        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td style="text-align:center;border:1px solid black"><?php echo $sele['nom_versa']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['montant']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['date_vera']?></td><td style="text-align:center;border:1px solid black"><?php echo $sele['utilisateur']?></td></tr>
             <?php
            }
        }
           //affichage du total des versement
        if($pressing == 'all'){
            $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix'";
        }else{
            $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix' AND agence='$pressing'";
        }
           
           if($tot=$connec->query($to)){
               while($tota=$tot->fetch()){
                   $total=$tota['total'];
               }
           }
    }
}
echo '</table>';
//affichage du total des versement
echo '<div style="font-size:25px;color:blue;margin-top:2%">Total: '.$total.' Fcfa</div>';;

?>