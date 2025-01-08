<?php
require('connect.php');
$choix=$_GET['choix'];
$ddebu=$_GET['datedebu'];
$dfin=$_GET['datefin'];
$pressing=$_GET['pressing'];
$total=0;

if($pressing == 'all')
{
  echo '<h2>Tous les pressings</h2>';
}else
{
  $ag = "SELECT nom FROM agence WHERE id_agence='$pressing'";
  if($age = $connec -> query($ag)){
      while($agen = $age -> fetch()){
          $agence = $agen['nom'];
          ?>
          <h2> Pressing : <?php echo $agence?></h2>
          <?php
      }
  }
}
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:12px;text-align: center;margin:0 auto;width:100%">
<thead class="table-primary">
 <tr><th>N°</th><th>Type</th><th>Montant</th><th>Date</th><th>Numéro reçu</th><th>Réceptionniste</th><th colspan="2"> Action</th></tr>
 </thead>';
 $n=1;
if($choix==''){
    if($ddebu=='' || $dfin==''){
        if($pressing == 'all'){
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera";
        }else {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera WHERE verseargent.agence='$pressing'";
        }
        
        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td ><?php echo $n;?></td><td ><?php echo $sele['nom_versa']?></td><td ><?php echo $sele['montant']?></td><td ><?php echo $sele['date_vera']?></td><td ><?php echo $sele['numRecu']?></td><td ><?php echo $sele['utilisateur']?></td><td id="<?php echo $sele['id_vera']?>" onclick="ouvreformmodifversa(this.id)" style="cursor: pointer;"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $sele['id_vera']?>" onclick="xy=confirm('Veuillez cliquez sur OK pour validé la suppression');if(xy){suppvesement(this.id)}else{};btnClick()" style="cursor: pointer;"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td>
             <?php
             $n++;
            }
        }
        //affichage du total des versement
        if ($pressing == 'all') {
            $to="SELECT *,sum(montant) as total FROM verseargent";
        }else {
            $to="SELECT *,sum(montant) as total FROM verseargent where agence='$pressing'";
        }       
        if($tot=$connec->query($to)){
            while($tota=$tot->fetch()){
                $total=$tota['total'];
            }
        }
    }else if($ddebu!='' && $dfin!=''){
        if ($pressing == 'all') {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' ";
        }else {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' AND verseargent.agence='$pressing'";
        }
        
        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td ><?php echo $n;?></td><td ><?php echo $sele['nom_versa']?></td><td ><?php echo $sele['montant']?></td><td ><?php echo $sele['date_vera']?></td><td><?php echo $sele['numRecu']?></td><td ><?php echo $sele['utilisateur']?></td><td  id="<?php echo $sele['id_vera']?>" onclick="ouvreformmodifversa(this.id)" style="cursor: pointer;"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $sele['id_vera']?>" onclick="xy=confirm('Veuillez cliquez sur OK pour validé la suppression');if(xy){suppvesement(this.id)}else{};btnClick()" style="cursor: pointer;"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td>
             <?php
             $n++;
            }
        }
               //affichage du total des versement
            if ($pressing == 'all') {
                $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin'";
            }else {
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
        if ($pressing == 'all') {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where verseargent.id_typevera='$choix'";
        }else {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where verseargent.id_typevera='$choix' AND verseargent.agence='$pressing'";
        }
        
        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td ><?php echo $n;?></td><td ><?php echo $sele['nom_versa']?></td><td ><?php echo $sele['montant']?></td><td ><?php echo $sele['date_vera']?></td><td ><?php echo $sele['numRecu']?></td><td ><?php echo $sele['utilisateur']?></td><td  id="<?php echo $sele['id_vera']?>" onclick="ouvreformmodifversa(this.id)" style="cursor: pointer;"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $sele['id_vera']?>" onclick="xy=confirm('Veuillez cliquez sur OK pour validé la suppression');if(xy){suppvesement(this.id)}else{};btnClick()" style="cursor: pointer;"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td>
             <?php
             $n++;
            }
        }
            //affichage du total des versement
            if ($pressing == 'all') {
                $to="SELECT *,sum(montant) as total FROM verseargent where id_typevera='$choix'";
            }else {
                $to="SELECT *,sum(montant) as total FROM verseargent where id_typevera='$choix' AND agence='$pressing'";
            }
            
            if($tot=$connec->query($to)){
                while($tota=$tot->fetch()){
                    $total=$tota['total'];
                }
            }
    }else if($ddebu!='' && $dfin!=''){
        if ($pressing == 'all') {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix' ";
        }else {
            $se="SELECT verseargent.numRecu,verseargent.id_vera,verseargent.id_typevera,verseargent.montant,verseargent.date_vera,verseargent.utilisateur,typeverseargent.id_typevera,typeverseargent.nom_versa FROM verseargent inner join typeverseargent on verseargent.id_typevera=typeverseargent.id_typevera where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix' AND verseargent.agence='$pressing'";
        }
        
        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
             ?>
              <tr><td ><?php echo $n;?></td><td ><?php echo $sele['nom_versa']?></td><td><?php echo $sele['montant']?></td><td ><?php echo $sele['date_vera']?></td><td ><?php echo $sele['numRecu']?></td><td ><?php echo $sele['utilisateur']?></td><td id="<?php echo $sele['id_vera']?>" onclick=" ouvreformmodifversa(this.id)" style="cursor: pointer;"><i class="bi bi-pencil-fill text-warning"></i>Modifier</td><td id="<?php echo $sele['id_vera']?>" onclick="xy=confirm('Veuillez cliquez sur OK pour validé la suppression');if(xy){suppvesement(this.id)}else{};btnClick()" style="cursor: pointer;"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td>
             <?php
             $n++;
            }
        }
           //affichage du total des versement
        if ($pressing == 'all') {
            $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix'";
        }else {
            $to="SELECT *,sum(montant) as total FROM verseargent where date_vera between '$ddebu' AND '$dfin' AND verseargent.id_typevera='$choix' AND verseargent.agence='$pressing'";
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
echo '<div style="font-size:25px;color:blue;margin-top:2%">Total: '.$total.' Fcfa</div>';
?>