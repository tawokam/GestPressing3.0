<?php
require('connect.php');
$date=$_GET['dat'];
$pressing=$_GET['pressing'];

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
if($date==''){
    if ($pressing == 'all') {
        $sen="SELECT *,count(id_clot) as breli FROM cloturecaisse order by date_clot desc";
    }else {
        $sen="SELECT *,count(id_clot) as breli FROM cloturecaisse where agence='$pressing' order by date_clot desc";
    }

    if($seln=$connec->query($sen)){
        while($selen=$seln->fetch()){
            echo '<div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px">
            '.$selen['breli'].' cloture(s) de caisse effectuée
            </div>';
        }
    }

echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%;border-collapse:collapse" border="1">
<thead class="table-primary">
 <tr><th>N°</th><th>Somme entrée</th><th>Somme dépense</th><th>Montant net</th><th>Montant réel</th><th>Difference</th><th>Observation</th><th >Effectuer par</th><th>Effectuer le</th></tr>
 </thead>';
 if ($pressing == 'all') {
    $se="SELECT * FROM cloturecaisse order by date_clot desc";
}else {
    $se="SELECT * FROM cloturecaisse where agence='$pressing' order by date_clot desc";  
}
    
      if($sel=$connec->query($se)){
          while($sele=$sel->fetch()){
  echo '<tr><td>'.$n.'</td><td >'.$sele['somentre'].'</td><td >'.$sele['somdep'].'</td><td >'.$sele['monnet'].'</td><td>'.$sele['monreel'].'</td><td>'.$sele['manque'].'</td><td id="coleur">'.$sele['observation'].'</td><td>'.$sele['utilisateur'].'</td><td>'.$sele['date_clot'].'</td></tr>';
$n++;
          }
      }
}else if($date!=''){
    if ($pressing == 'all') {
        $sen="SELECT *,count(id_clot) as breli FROM cloturecaisse where date_clot='$date'";
    }else {
        $sen="SELECT *,count(id_clot) as breli FROM cloturecaisse where date_clot='$date' AND agence='$pressing'";
    }
    
if($seln=$connec->query($sen)){
    while($selen=$seln->fetch()){
        echo '<div class="alert alert-secondary bg-secondary text-light" role="alert" style="font-size:12px">
        '.$selen['breli'].' cloture(s) de caisse effectuée
        </div>';
    }
}

echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%;border-collapse:collapse" border="1">
<thead class="table-primary">
 <tr><th>N°</th><th>Somme entrée</th><th>Somme dépense</th><th>Montant net</th><th>Montant réel</th><th>Difference</th><th>Observation</th><th >Effectuer par</th><th>Effectuer le</th></tr>
 </thead>';
 if ($pressing == 'all') {
    $se="SELECT * FROM cloturecaisse where date_clot='$date'";
}else {
    $se="SELECT * FROM cloturecaisse where date_clot='$date' AND agence='$pressing'";
}

if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
echo '<tr><td>'.$n.'</td><td>'.$sele['somentre'].'</td><td>'.$sele['somdep'].'</td><td>'.$sele['monnet'].'</td><td>'.$sele['monreel'].'</td><td>'.$sele['manque'].'</td><td id="coleur">'.$sele['observation'].'</td><td >'.$sele['utilisateur'].'</td><td >'.$sele['date_clot'].'</td></tr>';
$n++;
    }
}
}echo '</table>';
?>