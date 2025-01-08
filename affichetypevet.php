<?php
require('connect.php');
$af="SELECT * FROM typevetement";
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:95%">
<thead class="table-primary">
 <tr><th>N°</th><th>Nom du vêtement</th><th colspan="2">Action</th></tr>
 </thead>';
 $n =1;
if($aff=$connec->query($af)){
    while($affi=$aff->fetch()){
  echo '<tr><td>'.$n.'</td><td >'.$affi['nom_vet'].'</td><td id="'.$affi['id_typevet'].'" onclick="ouvreformmodiftypvet(this.id)" style="cursor:pointer"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td style="cursor:pointer" id="'.$affi['id_typevet'].'" onclick="xx=confirm(\'Veuillez confirmez la suppression de ce type de vêtement en cliquant sur OK\');if(xx){supptypevet(this.id),btnClick()}else{}"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>';
   $n++;
}
}
echo '</table>';
?>