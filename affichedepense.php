<?php
require('connect.php');
$dated=$_POST['datedebu'];
$datef=$_POST['datefin'];
$pressing=$_POST['pressing'];
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
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%">
<thead class="table-primary">
 <tr><th>N°</th><th>Type de dépense</th><th>Motif de la dépense</th><th>Montant</th><th>Enregistrer le</th><th>Réceptionniste</th><th colspan="2"> Action</th></tr>
 </thead>';
 $n = 1;
if($dated=='' || $datef==''){
    if($pressing == 'all'){
        $se="SELECT depense.id_dep,depense.motif,depense.date_enreg,depense.utilisateur,typedepense.id_dep,typedepense.nom_dep,depense.montant,depense.id_depense FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep order by date_enreg desc";
    }else
    {
        $se="SELECT depense.id_dep,depense.motif,depense.date_enreg,depense.utilisateur,typedepense.id_dep,typedepense.nom_dep,depense.montant,depense.id_depense FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep WHERE depense.agence='$pressing' order by date_enreg desc";
    }

    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
       <tr><td><?php echo $n;?></td><td ><?php echo $sele['nom_dep'] ?></td><td ><?php echo $sele['motif'] ?></td><td ><?php echo $sele['montant'] ?></td><td><?php echo $sele['date_enreg'] ?></td><td><?php echo $sele['utilisateur'] ?></td><td id="<?php echo $sele['id_depense']?>" onclick="ouvreformmodifdep(this.id)" style="cursor:pointer"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $sele['id_depense']?>" onclick="xy=confirm('Veuillez confirmer la suppression de cette depense en cliquant sur le bouton OK');if(xy){suppsdepense(this.id)}else{};btnClick()" style="cursor:pointer"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>
            <?php
            $n++;
        }
    }
    if($pressing == 'all'){
        $sede="SELECT *,sum(montant) as total FROM depense";
    }else
    {
        $sede="SELECT *,sum(montant) as total FROM depense WHERE agence='$pressing'";
    }
    
    if($sedep=$connec->query($sede)){while($sed=$sedep->fetch()){$total=$sed['total'];}}
}else if($dated!='' && $datef!=''){
    if($pressing == 'all'){
        $se="SELECT depense.id_dep,depense.motif,depense.date_enreg,depense.utilisateur,depense.montant,typedepense.id_dep,typedepense.nom_dep,depense.id_depense FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep where date_enreg between '$dated' AND '$datef'";
    }else
    {
        $se="SELECT depense.id_dep,depense.motif,depense.date_enreg,depense.utilisateur,depense.montant,typedepense.id_dep,typedepense.nom_dep,depense.id_depense FROM depense inner join typedepense on depense.id_dep=typedepense.id_dep where date_enreg between '$dated' AND '$datef' AND depense.agence='$pressing'";
    }

    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
       <tr><td><?php echo $n;?></td></td><td ><?php echo $sele['nom_dep'] ?></td><td ><?php echo $sele['motif'] ?></td><td ><?php echo $sele['montant'] ?></td><td ><?php echo $sele['date_enreg'] ?></td><td ><?php echo $sele['utilisateur'] ?></td><td  id="<?php echo $sele['id_depense']?>" onclick="ouvreformmodifdep(this.id)" style="cursor:pointer"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $sele['id_depense']?>" onclick="xy=confirm('Veuillez confirmer la suppression de cette depense en cliquant sur le bouton OK');if(xy){suppsdepense(this.id)}else{};btnClick()" style="cursor:pointer"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>
            <?php
            $n++;
        }
    }
    if($pressing == 'all')
    {
        $sede="SELECT *,sum(montant) as total FROM depense where date_enreg between '$dated' AND '$datef'";
    }else
    {
        $sede="SELECT *,sum(montant) as total FROM depense where date_enreg between '$dated' AND '$datef' AND agence='$pressing'";
    }
    
    if($sedep=$connec->query($sede)){while($sed=$sedep->fetch()){$total=$sed['total'];}}
}
echo '</table>';
//affichage de la somme des depenses
echo '<div style="font-size:25px;color:blue;margin-top:2%">Total des depenses: '.$total.' Fcfa</div>';
?>