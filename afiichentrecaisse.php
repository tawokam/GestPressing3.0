<?php
require('connect.php');
$dateclot     = $_GET['dateclot'];
$datefinclot  = $_GET['datefinclot'];
$pressing     = $_GET['pressing'];
$mont         = $_GET['mont'];
$montanttotal = 0;

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
$n=1;
if($dateclot == '' || $datefinclot == ''){
    echo '<div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px;border:0px">
    Entrées en caisse 
</div>';
    echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%;border-collapse:collapse" border="1">
    <thead class="table-primary">
     <tr><th>N°</th><th>Id versemen</th><th>N° Facture</th><th>Montant versé</th><th>Date de versement</th></tr>
     </thead>';
     if ($pressing == 'all') {
        if($mont != ''){
            $se="SELECT * FROM versement where code <> 0 AND montantv < '$mont'";
        }else{
            $se="SELECT * FROM versement where code <> 0";
        }
        
    }else {
        if($mont != ''){
            $se="SELECT * FROM versement where code <> 0 AND agence='$pressing' AND montantv < '$mont'";
        }else{
            $se="SELECT * FROM versement where code <> 0 AND agence='$pressing'";
        }
        
    }

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $code=$sele['code'];
        if($code==0){
            $code="Report";
        echo '<tr><td>'.$n.'</td><td >'.$sele['id_verse'].'</td><td >'.$code.'</td><td >'.$sele['montantv'].'</td><td >'.$sele['date_verse'].'</td></tr>';
        }else if($code!=0){
            echo '<tr><td>'.$n.'</td><td>'.$sele['id_verse'].'</td><td>'.$code.'</td><td >'.$sele['montantv'].'</td><td >'.$sele['date_verse'].'</td></tr>';   
        }
    $n++;
    }
}
if ($pressing == 'all') {
    if($mont != ''){
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND montantv < '$mont'";
    }else{
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0";
    }
    
}else {
    if($mont != ''){
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND agence='$pressing' AND montantv < '$mont'";
    }else{
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND agence='$pressing'";
    }
    
}

if($com=$connec->query($co)){
    while($comp=$com->fetch()){
        $montanttotal=$comp['montant'];
    }
}
}else if($dateclot != '' && $datefinclot != ''){
    echo '<div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px;border:0px">
    Entrées en caisse du '.$dateclot.' Au '.$datefinclot.'
</div>';
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%;border-collapse:collapse" border="1">
<thead class="table-primary">
 <tr><th>N°</th><th>Id versemen</th><th>N° Facture</th><th>Montant versé</th><th>Date de versement</th></tr>
 </thead>'; 
 if ($pressing == 'all') {
    if($mont != ''){
        $se="SELECT * FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot' AND montantv < '$mont'";
    }else{
        $se="SELECT * FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot'";
    }
    
}else {
    if($mont != ''){
        $se="SELECT * FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot' AND agence='$pressing' AND montantv < '$mont'";
    }else{
        $se="SELECT * FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot' AND agence='$pressing'";
    }   
} 

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $code=$sele['code'];
        if($code==0){
            $code="Report";
        echo '<tr><td>'.$n.'</td><td >'.$sele['id_verse'].'</td><td >'.$code.'</td><td >'.$sele['montantv'].'</td><td>'.$sele['date_verse'].'</td></tr>';
        }else if($code!=0){
            echo '<tr><td>'.$n.'</td><td>'.$sele['id_verse'].'</td><td>'.$code.'</td><td>'.$sele['montantv'].'</td><td>'.$sele['date_verse'].'</td></tr>';   
        }
    $n++;
    }
}
if ($pressing == 'all') {
    if($mont != ''){
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot' AND montantv < '$mont'";
    }else{
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot'";
    }
    
}else {
    if($mont != ''){
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot' AND agence='$pressing' AND montantv < '$mont'";
    }else{
        $co="SELECT *,sum(montantv) as montant FROM versement where code <> 0 AND date_verse BETWEEN '$dateclot' AND '$datefinclot' AND agence='$pressing'";
    }
    
}

if($com=$connec->query($co)){
    while($comp=$com->fetch()){
        $montanttotal=$comp['montant'];
    }
}
}
echo '</table><br/><br/>';
echo '<div style="font-size:20px;color:blue;font-weight:bold;">Somme des entrées: '.$montanttotal.' Fcfa</div>';
?>